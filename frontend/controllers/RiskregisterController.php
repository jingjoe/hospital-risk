<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Riskregister;
use frontend\models\RiskregisterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

//  dropdownlist function Get
use frontend\models\Riskstore;
use frontend\models\Level;

// Add upload
use yii\web\UploadedFile;
use yii\helpers\Json;
use yii\helpers\BaseFileHelper;
use yii\helpers\Html;


/**
 * RiskregisterController implements the CRUD actions for Riskregister model.
 */
class RiskregisterController extends Controller
{
    /**
     * @inheritdoc
     */
    public $enableCsrfValidation = false;
    
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Riskregister models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RiskregisterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Riskregister model.
     * @param integer $id
     * @param integer $id_risk
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id, $id_risk)
    {
        return $this->render('view', [
            'model' => $this->findModel($id, $id_risk),
        ]);
    }

    /**
     * Creates a new Riskregister model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Riskregister();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'id_risk' => $model->id_risk]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Riskregister model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $id_risk
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
        
// Function Send To Line
    public function sendLine($model,$id, $id_risk){
        
        $model = Riskregister::find()->where(['id' => $id,'id_risk' => $id_risk])->one();
        
        $url = Url::to(['riskregister/view', 'id' => $id,'id_risk'=>$id_risk], true);

        //$command1 = Yii::$app->db->createCommand("SELECT linetoken FROM hospital WHERE id='1' ");
        //$line_token = $command1->queryScalar();
        
	//$line_token = "Rh8MR5G3fkKgvxKTab5zVhhpdaIk4HGZobYhjvzhdlf";
        $line_token = "";
        if ($line_token <> '') {
            $ch = curl_init();  
            curl_setopt($ch, CURLOPT_URL,"https://notify-api.line.me/api/notify");
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,"message=".'ความเสี่ยง : ' .$model->id_risk. ' วันที่รายงาน : ' .$model->date_report. ' เหตุการณ์ : ' .$model->detail.' ระดับการทบทวน : ' . $model->repeat_code. ' สถานะ : ' .$model->status_risk.' Read more : ' . $url); // ตรงนี้คือ Field ที่จะส่งข้อความไป Line

            // follow redirects
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER,[
                    'Content-type: application/x-www-form-urlencoded',
                    'Authorization: Bearer ' .$line_token,
            ]);

            // receive server response...
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $server_output = curl_exec ($ch);

            curl_close ($ch);
         }
	 
    }
        
    public function actionUpdate($id, $id_risk)
    {
        $model = $this->findModel($id, $id_risk);
        $model->affectedToArray();
        
        $riskse = ArrayHelper::map($this->GetRisk($model->program_id),'id','name');
        $level = ArrayHelper::map($this->GetLevel($model->level_id),'id','name');

        $url_link = Url::to(['riskregister/view', 'id' => $id,'id_risk'=>$id_risk], true); // ลิงค์แบบเต็ม http://localhost/myweb/controller/action=para1=para2
  
        $model->register_date = date('Y-m-d'); 
        
        $connection = Yii::$app->db;

          if ($model->load(Yii::$app->request->post()) && $model->validate()) {
              $model->image = $model->uploadMultiple($model,'image');
              $model->save();
        
        $datals = $connection->createCommand("UPDATE riskregister SET status_risk = 'ตรวจสอบ' ,url='$url_link' WHERE id='$id' AND id_risk='$id_risk'")->execute();
        
        $this->sendLine($model,$id, $id_risk); // ส่งไปให้ Function sendLine
            Yii::$app->session->setFlash('success', 'ส่งความเสียงไปทบทวนเรียบร้อยแล้ว');
           // return $this->redirect(['view', 'id' => $model->id, 'id_risk' => $model->id_risk]);
          
            return $this->redirect('index.php?r=risk/approve');
        }

        return $this->render('update', [
            'model' => $model,
            'riskse' => $riskse,
            'level' =>$level
        ]);
    }

    /**
     * Deletes an existing Riskregister model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $id_risk
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id, $id_risk)
    {
        $this->findModel($id, $id_risk)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Riskregister model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $id_risk
     * @return Riskregister the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $id_risk)
    {
        if (($model = Riskregister::findOne(['id' => $id, 'id_risk' => $id_risk])) !== null) {
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
}
