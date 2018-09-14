<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "riskregister".
 *
 * @property int $id ID_Riskregister
 * @property int $id_risk ID_Risk
 * @property string $date_report วันรายงาน
 * @property string $time_report เวลารายงาน
 * @property int $duration_id เวรที่เกิด
 * @property int $location_id สถานที่เกิดความเสี่ยง
 * @property string $user_ir_type ประเภทการรายงาน
 * @property int $user_ir แผนกที่รายงานถึง
 * @property int $program_id โปรแกรมความเสี่ยง
 * @property string $level_id ระดับความรุนแรง
 * @property int $riskstore_id ชื่อความเสี่ยง
 * @property string $detail เหตุการ/รายละเอียดเพิ่มเติม
 * @property string $detail_hosxp รายละเอียดข้อมูลคนไข้
 * @property string $affected ผู้เสียหาย/ได้รับผลกระทบ
 * @property string $edit การแก้ปัญหา
 * @property string $problem_basic วิธีแก้ปัญหาเบื้องต้น
 * @property string $image เอกสาร-ภาพประกอบ
 * @property int $inform_id ที่มาของรายงานความเสี่ยง
 * @property string $status_risk สถานะความเสี่ยง
 * @property int $created_by บันทึกโดย
 * @property string $department_id สังกัดแผนก
 * @property int $updated_by อับเดทโดย
 * @property string $create_date วันบันทึก
 * @property string $modify_date วันปรับปรุง
 * @property string $send_date วันที่นำเข้าข้อมูล
 * @property int $send_use ผู้ลงทะเบียน
 * @property string $register_date วันที่ตรวจสอบ
 * @property string $note Note
 * @property int $sendto_team_id ส่งให้ทีม
 * @property string $sendto_department_id ส่งให้แผนก
 * @property string $sendto_member_cid ส่งให้ผู้รับผิดชอบ
 */
class Riskregister extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'riskregister';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_risk', 'date_report', 'time_report', 'user_ir_type', 'level_id', 'riskstore_id', 'inform_id', 'department_id', 'note', 'sendto_team_id', 'sendto_department_id', 'sendto_member_cid'], 'required'],
            [['id_risk', 'duration_id', 'location_id', 'user_ir', 'program_id', 'riskstore_id', 'inform_id', 'created_by', 'updated_by', 'send_use', 'sendto_team_id'], 'integer'],
            [['date_report', 'time_report', 'create_date', 'modify_date', 'send_date', 'register_date'], 'safe'],
            [['detail', 'detail_hosxp', 'problem_basic', 'image'], 'string'],
            [['user_ir_type', 'affected'], 'string', 'max' => 50],
            [['level_id'], 'string', 'max' => 2],
            [['edit'], 'string', 'max' => 10],
            [['status_risk'], 'string', 'max' => 100],
            [['department_id', 'sendto_department_id'], 'string', 'max' => 3],
            [['note'], 'string', 'max' => 255],
            [['sendto_member_cid'], 'string', 'max' => 13],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID_Riskregister',
            'id_risk' => 'ID_Risk',
            'date_report' => 'วันรายงาน',
            'time_report' => 'เวลารายงาน',
            'duration_id' => 'เวรที่เกิด',
            'location_id' => 'สถานที่เกิดความเสี่ยง',
            'user_ir_type' => 'ประเภทการรายงาน',
            'user_ir' => 'แผนกที่รายงานถึง',
            'program_id' => 'โปรแกรมความเสี่ยง',
            'level_id' => 'ระดับความรุนแรง',
            'riskstore_id' => 'ชื่อความเสี่ยง',
            'detail' => 'เหตุการ/รายละเอียดเพิ่มเติม',
            'detail_hosxp' => 'รายละเอียดข้อมูลคนไข้',
            'affected' => 'ผู้เสียหาย/ได้รับผลกระทบ',
            'edit' => 'การแก้ปัญหา',
            'problem_basic' => 'วิธีแก้ปัญหาเบื้องต้น',
            'image' => 'เอกสาร-ภาพประกอบ',
            'inform_id' => 'ที่มาของรายงานความเสี่ยง',
            'status_risk' => 'สถานะความเสี่ยง',
            'created_by' => 'บันทึกโดย',
            'department_id' => 'สังกัดแผนก',
            'updated_by' => 'อับเดทโดย',
            'create_date' => 'วันบันทึก',
            'modify_date' => 'วันปรับปรุง',
            'send_date' => 'วันที่นำเข้าข้อมูล',
            'send_use' => 'ผู้ลงทะเบียน',
            'register_date' => 'วันที่ตรวจสอบ',
            'note' => 'Note',
            'sendto_team_id' => 'ส่งให้ทีม',
            'sendto_department_id' => 'ส่งให้แผนก',
            'sendto_member_cid' => 'ส่งให้ผู้รับผิดชอบ',
        ];
    }

    /**
     * @inheritdoc
     * @return RiskregisterQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RiskregisterQuery(get_called_class());
    }
}
