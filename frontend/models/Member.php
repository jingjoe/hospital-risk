<?php

namespace frontend\models;

use Yii;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \yii\web\UploadedFile;

use frontend\models\Department;
use frontend\models\Position;
use frontend\models\Team;

use dektrium\user\models\User;

/**
 * This is the model class for table "member".
 *
 * @property integer $id
 * @property string $member_name
 * @property string $member_status
 * @property integer $department_id
 * @property integer $position_id
 * @property string $create_date
 * @property string $modify_date
 * @property integer $created_by
 * @property integer $updated_by
 */
class Member extends \yii\db\ActiveRecord
{
     public $upload_foler = 'personal';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_name','cid','department_id', 'position_id'], 'required'],
            [['department_id', 'position_id', 'team_id','created_by', 'updated_by'], 'integer'],
            [['create_date', 'modify_date'], 'safe'],
            [['member_name'], 'string', 'max' => 60],
            [['cid'],'string', 'max' => 13],
            [['img'], 'file',
                'skipOnEmpty' => true,
                'extensions' => 'png,jpg'
            ]
        ];
    }

    public function behaviors()
    {
        return [
            [
            'class' => TimestampBehavior::className(),
            'createdAtAttribute' => 'create_date',
            'updatedAtAttribute' => 'modify_date',
            'value' => new Expression('NOW()'),
            ],
            [  
            'class' => BlameableBehavior::className(),
            'createdByAttribute' => 'created_by',
            'updatedByAttribute' => 'updated_by',],  
        ];
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cid' => 'เลขบัตร 13 หลัก',
            'member_name' => 'ชื่อ-นามสกุล',
            'department_id' => 'สังกัดแผนก',
            'position_id' => 'ตำแหน่ง',
            'img' => 'รูปประจำตัว',
            'team_id' => 'ทีมนำ',
            'create_date' => 'วันบันทึก',
            'modify_date' => 'วันปรับปรุง',
            'created_by' => 'บันทึกโดย',
            'updated_by' => 'อับเดทโดย',
        // เพิ่มฟิวล์ใหม่ จาก funtion get  relation   User
            'loginname' => 'ผู้บันทึก',
            'updatename' => 'ผู้อับเดท',
        //เพิ่มฟิวล์ใหม่ จาก funtion get  relation  Department 
             'departname' => 'แผนก',
        //เพิ่มฟิวล์ใหม่ จาก funtion get  relation  Position
             'positionname' => 'ตำแหน่ง',
        //เพิ่มฟิวล์ใหม่ จาก funtion get  relation  Team 
             'teamname' => 'ทีมนำ',
            
       //เพิ่มฟิวล์ใหม่ จาก funtion get  relation  Member
             'membername' => 'ชื่อ',
        ];
    }
    
    // get ชื่อแผนก  
    public function getDepart() {
        return @$this->hasOne(Department::className(), ['id' => 'department_id']);
    }

    public function getDepartname() {
        return @$this->depart->depart_name;
    }
    
   // get ชื่อตำแหน่ง
    public function getPosition() {
        return @$this->hasOne(Position::className(), ['id' => 'position_id']);
    }

    public function getPositionname() {
        return @$this->position->position_name;
    }
    
  // get ชื่อทีมนำ
    public function getTeam() {
        return @$this->hasOne(Team::className(), ['id' => 'team_id']);
    }

    public function getTeamname() {
        return @$this->team->team_name;
    }
    // get ชื่อผู้บันทึก
    public function getLogin() {
        return @$this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function getLoginname() {
        return @$this->login->username;
    }
    // get ชื่อผู้อับเดท
    public function getUpdate() {
        return @$this->hasOne(User::className(), ['id' => 'updated_by']);
    }
    public function getUpdatename() {
        return @$this->update->username;
    }
    
    // get member_name to profile   
    public static function GetList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'cid', 'member_name');
    }

    public static function getMemberName($cid)
    {
        if (($model = Member::findOne($cid)) !== null) {
            return $model->member_name;
        } else {
            return '';
        }
    }
 // upload image
    public function upload($model,$attribute)
    {
        $img  = UploadedFile::getInstance($model, $attribute);
          $path = $this->getUploadPath();
        if ($this->validate() && $img !== null) {

            $fileName = md5($img->baseName.time()) . '.' . $img->extension;
            //$fileName = $photo->baseName . '.' . $photo->extension;
            if($img->saveAs($path.$fileName)){
              return $fileName;
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }

    public function getUploadPath(){
      return Yii::getAlias('@webroot').'/'.$this->upload_foler.'/';
    }

    public function getUploadUrl(){
      return Yii::getAlias('@web').'/'.$this->upload_foler.'/';
    }

    public function getPhotoViewer(){
      return empty($this->img) ? Yii::getAlias('@web').'/images/none.png' : $this->getUploadUrl().$this->img;
    }
}
