<?php

namespace frontend\controllers;

use Yii;
use yii\db\Query;
use frontend\models\Risk;
use frontend\models\RiskSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\authclient\AuthAction;

//  Add User Dektrium
use dektrium\user\filters\AccessRule;
use dektrium\user\Finder;
use dektrium\user\models\Profile;
use dektrium\user\Module;
use dektrium\user\traits\EventTrait;
use dektrium\user\models\User;


//  dropdownlist
use frontend\models\Department;
use frontend\models\Departmentgroup;

use frontend\models\Riskstore;
use frontend\models\Level;

// Add upload
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;
use yii\helpers\Url;

// condatabase
use yii\db\Command;


/**
 * RiskController implements the CRUD actions for Risk model.
 */
class RiskController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    
    public function behaviors() 
    {
        $role = 0;
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
        }
        $arr = ['index'];
        if ($role != 99) {
            $arr = ['index','approve', 'send', 'view', 'create', 'update', 'delete', 'searchrisk'];
        }
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'switch'       => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => AccessRule::className(),
                ],
                'only' => ['index', 'view', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => $arr,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Risk models.
     * @return mixed
     */

    public function actionIndex()
    {
        $id_r= Yii::$app->user->identity->id; 
        
        $searchModel = new RiskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere(['status_risk'=>'รายงาน','created_by'=> $id_r ]); //  ดึงเฉพาะที่ risk status = รายงาน และ ตรวจสอบผู้ใช้ให้แสดงข้อมูลเฉพาะของตัวเอง
        $dataProvider->pagination->pageSize=100;
        
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
                 'id' => SORT_DESC,
               //'create_date' => SORT_ASC, 
        ];
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            
        ]);
    }

    /**
     * Displays a single Risk model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Risk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Risk();
        
        $cid_r= Yii::$app->user->identity->cid;
        $sql = Yii::$app->db->createCommand("SELECT department_id FROM member  WHERE cid='$cid_r'")->queryOne();
        $dep_id =  $sql['department_id'];
        
        $model->department_id = $dep_id; 
   
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        //if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->image = $model->uploadMultiple($model,'image');
            $model->save();
            Yii::$app->session->setFlash('success', 'รายงานความเสี่ยงเรียบร้อยแล้ว');
            return $this->redirect('index.php?r=risk/index');
        }else {
                $model->date_report = date('Y-m-d'); 
                $model->duration_id = 1; 
                $model->user_ir_type = 1; 
                $model->inform_id= 8;
                $model->edit = 'ได้'; 
               
                return $this->render('create', [
                 'model' => $model,
                 'riskse' =>[],
                 'level' =>[],
             ]);
    }
    }

    /**
     * Updates an existing Risk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->affectedToArray();

        $riskse = ArrayHelper::map($this->GetRisk($model->program_id),'id','name');
        $level = ArrayHelper::map($this->GetLevel($model->level_id),'id','name');
        
        $cid_r= Yii::$app->user->identity->cid;
        $sql = Yii::$app->db->createCommand("SELECT department_id FROM member  WHERE cid='$cid_r'")->queryOne();
        $dep_id =  $sql['department_id'];
        
        $model->department_id = $dep_id; 

       // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
              $model->image = $model->uploadMultiple($model,'image');
              $model->save();
            Yii::$app->session->setFlash('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
            return $this->redirect('index.php?r=risk/index');
        }

        return $this->render('update', [
            'model' => $model,
            'riskse' => $riskse,
            'level' =>$level,
        ]);
    }
    
    /**
     * Deletes an existing Risk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'ลบข้อมูลเรียบร้อยแล้ว');
        return $this->redirect(['index']);
    }

    /**
     * Finds the Risk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Risk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Risk::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
 // function ดึงชื่อความเสี่ยง DepDrop 3 ตัวเลือก
    public function actionGetRisk() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $program_id = $parents[0];
                $out = $this->getRisk($program_id );
                echo Json::encode(['output' => $out, 'selected' => '']);
                return;
            }
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }
    
    public function actionGetLevel() {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $ids = $_POST['depdrop_parents'];
            $program_id = empty($ids[0]) ? null : $ids[0];
            $level_id = empty($ids[1]) ? null : $ids[1];
            if ($program_id != null) {
               $data = $this->getLevel($level_id);      
               echo Json::encode(['output'=>$data, 'selected'=>'']);
               return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    protected function GetRisk($id) {
        $datas = Riskstore::find()->where(['program_id' => $id])->all();
        return $this->MapData1($datas, 'riskstore_id', 'riskstore_name');
    }
    
      protected function GetLevel($id) {
        $datas = Level::find()->where(['level_id' => $id])->all();
        return $this->MapData1($datas, 'level_id', 'level_name');
    }
    
 
    protected function MapData1($datas, $fieldId, $fieldName) {
        $obj = [];
        foreach ($datas as $key => $value) {
            array_push($obj, ['id' => $value->{$fieldId}, 'name' => $value->{$fieldName}]);
        }
        return $obj;
    }
    
    public function actionSearchrisk($search = NULL) {
        
        if (!empty($search)) {
            $se = $search;
        } else {
            $se = '';
        }

        $sql = "SELECT p.program_name,rt.riskstore_name,IF(rt.status='1','ใช้งาน','ยกเลิก') AS st,
                IF(m.member_name<>'',m.member_name,'ไม่ระบุผู้รับผิดชอบ') AS riskmem,
                IF(t.team_name<>'',t.team_name,'ไม่ระบุทีม') AS te
                FROM riskstore rt
                LEFT JOIN program p ON p.program_id=rt.program_id
                LEFT JOIN member m ON m.cid=rt.member_cid
                LEFT JOIN team t ON t.id=rt.team_id
                WHERE rt.riskstore_name LIKE '%$se%'";

        $data1 = Yii::$app->db->createCommand($sql)->queryAll();

        $dataProvider = new ArrayDataProvider([
            'allModels'=>$data1,
                'pagination'=>[
                'pageSize'=>5 //แบ่งหน้า
                ]
        ]);
        return $this->render('searchrisk', [
            'dataProvider' => $dataProvider]);
    }
    
    public function actionApprove(){
        
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role == 99 || Yii::$app->user->identity->role == 3) {
              return $this->redirect(['user/security/login']);
        }  
        //$this->permitRole([1, 2]);
        $searchModel = new RiskSearch();
        $searchModel2 = new \frontend\models\RiskregisterSearch();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider2 = $searchModel2->search(Yii::$app->request->queryParams);
        
        $dataProvider->query->andWhere(['status_risk'=>'รายงาน']); //  ดึงเฉพาะที่ risk status = รายงาน เพื่อมาตรวจสอบ และ ส่งให้หน่วย/ทีมทบทวน
        $dataProvider2->query->andWhere(['status_risk'=>'รายงาน']); //  ดึงเฉพาะที่ risk status = รายงาน เพื่อมาตรวจสอบ และ ส่งให้หน่วย/ทีมทบทวน
        
        $dataProvider->pagination->pageSize=100;
        $dataProvider2->pagination->pageSize=500;
        
        $dataProvider->sort->enableMultiSort = true;
        $dataProvider->sort->defaultOrder = [
                 'level_id' => SORT_DESC,
               //'create_date' => SORT_ASC, 
        ];
        
        $dataProvider2->sort->enableMultiSort = true;
        $dataProvider2->sort->defaultOrder = [
                 'send_date' => SORT_ASC,
               //'send_date' => SORT_ASC, 
        ];
        
        return $this->render('approve', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider2' => $dataProvider2,
        ]);
    }
    
    
    public function actionSend($id) {
        
        if (Yii::$app->user->isGuest || Yii::$app->user->identity->role == 99 || Yii::$app->user->identity->role == 3) {
              return $this->redirect(['user/security/login']);
        }  
        $user = Yii::$app->user->identity->username;
        $connection = Yii::$app->db;

        $model = Risk::find()->where(['id' => $id])->one();

        if ($model === null) {
            Yii::$app->session->setFlash('warning', 'ลงทะเบียนความเสี่ยงไม่สำเร็จ');
            return $this->redirect(['risk/approve']);
        } else {
            $datals = $connection->createCommand("INSERT INTO riskregister 
                      SELECT NULL AS id,id AS id_risk,date_report,time_report,
                      duration_id,location_id,user_ir_type,user_ir,program_id,level_id,
                      riskstore_id,detail,detail_hosxp,affected,edit,problem_basic,image,
                      inform_id,status_risk,created_by,department_id,updated_by,create_date,
                      modify_date,NOW() AS send_date, '$user' AS send_use,NULL AS register_date,
                      NULL AS note,NULL AS refer_type,NULL AS sendto_team_id,NULL AS sendto_department_id,
                      NULL AS sendto_member_cid,NULL AS repeat_code,NULL AS url
                      FROM risk WHERE id='$id' ")->execute();

            $datals = $connection->createCommand("UPDATE risk SET status_risk = 'ตรวจสอบ' WHERE id='$id'")->execute();
        
            Yii::$app->session->setFlash('success', 'ลงทะเบียนความเสี่ยงเรียบร้อยแล้ว');
                return $this->redirect(['approve']);
        }     
    }
    
}
