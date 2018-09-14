<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\db\Query;

use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RiskSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'ตรวจสอบความเสี่ยง';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-index">   
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            //'filterModel' => $searchModel,
            'headerRowOptions' => ['style' => 'background-color:#cccccc'],
            'panel'=>[
                'type'=>GridView::TYPE_DEFAULT,
                //'before'=>Html::button('<i class="glyphicon glyphicon-send"></i> รายงานความเสี่ยง',  ['value' => Url::to(['risk/create']), 'title' => 'รายงานความเสี่ยง', 'class' => 'showModalButton btn btn-success']),
                //'before'=>Html::a('<i class="glyphicon glyphicon-send"></i> รายงานความเสี่ยง', ['create'], ['class' => 'btn btn-success']),
                //'heading'=>'สถานที่เกิดความเสี่ยง',
                //'after' => 'วันที่ประมวลผล '.date('Y-m-d H:i:s').' น.',
                //'footer'=>true
            ],
            'responsive' => true,
            'hover'=>true,
            'floatHeader' => true,  // header เลื่อนตาม
            'pager' => [
                    'options'=>['class'=>'pagination'],   // set clas name used in ui list of pagination
                    'prevPageLabel' => 'ก่อนหน้า',   // Set the label for the "previous" page button
                    'nextPageLabel' => 'ถัดไป',   // Set the label for the "next" page button
                    'firstPageLabel'=>'เริ่มต้น',   // Set the label for the "first" page button
                    'lastPageLabel'=>'สุดท้าย',    // Set the label for the "last" page button
                    'nextPageCssClass'=>'ถัดไป',    // Set CSS class for the "next" page button
                    'prevPageCssClass'=>'ก่อนหน้า',    // Set CSS class for the "previous" page button
                    'firstPageCssClass'=>'เริ่มต้น',    // Set CSS class for the "first" page button
                    'lastPageCssClass'=>'สุดท้าย',    // Set CSS class for the "last" page button
                    'maxButtonCount'=>10,    // Set maximum number of page buttons that can be displayed
            ], 
            'exportConfig' => [
                   GridView::CSV => ['label' => 'Export as CSV', 'filename' => 'risk_'.date('Y-d-m')],
                   GridView::PDF => ['label' => 'Export as PDF', 'filename' => 'risk_'.date('Y-d-m')],
                   GridView::EXCEL=> ['label' => 'Export as EXCEL', 'filename' => 'risk_'.date('Y-d-m')],
                   GridView::TEXT=> ['label' => 'Export as TEXT', 'filename' => 'risk_'.date('Y-d-m')],
                ],
        // set your toolbar
            'toolbar' =>  [
                ['content' => 
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['risk/approve'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'รีเซ็ต')])
                ],
                '{toggleData}',
                '{export}',
            ],
        // set export properties
            'export' => [
                'fontAwesome' => true
            ],
            'pjax' => true,
            'pjaxSettings' => [
                'neverTimeout' => true,
                'beforeGrid' => '',
                'afterGrid' => '',
            ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
            'header' => 'ระดับ',
            'attribute' => 'level_id'
            ],
            'date_report',
            [
            'header' => 'เวลา',
            'attribute' => 'time_report'
            ],
            [
            'header' => 'เวร',
            'attribute' => 'durationname'
            ],
            
           // 'programname',
           
             //'time_report',
            [
                    'attribute' => 'storename',
                    'format' => 'raw',
                    'contentOptions' => [
                        'style'=>'max-width:1000px; overflow: auto; white-space: normal; word-wrap: break-word;'
                    ],
            ],
            //'detail_hosxp:ntext',
            //'departgroupname',
            //'departname',
            [
                    'attribute' => 'departname',
                    'format' => 'raw',
                    'contentOptions' => [
                        'style'=>'max-width:1000px; overflow: auto; white-space: normal; word-wrap: break-word;'
                    ],
            ],
            //'locationname',
            //'irdepname',
            //'user_ir_type',
            //'user_ir',
            //'program_id',
            //'affected',
            [
            'header' => 'แก้ปัญหา',
            'attribute' => 'edit'
            ],
            //'problem_basic:ntext',
            //'image:ntext',
            //'inform_id',
           // 'status_risk',
            //'loginname',
            [
                'label' => 'สถานะ',
                'attribute' => 'status_risk',
                'format' => 'raw',
                'filter' => false,
                'hAlign' => 'center',
                'vAlign' => 'middle',
                #'format' => ['decimal', 2],
                'value' => function($data) {
                        if ($data['status_risk'] == 'ตรวจสอบ') {
                            return '<i class="glyphicon glyphicon-ok"></i>';
                        } else {
                            return '<i class="glyphicon glyphicon-remove"></i> รอ...ตรวจสอบ';
                        }
                    },
            ],
                              [
                //'attribute' => 'ลงทะเบียน',
               'label' => 'Register',
                'format' => 'raw',
                'value' => function($data) {
                    return
                        Html::a('<i class="glyphicon glyphicon-send"></i> Send', ['riskregister/send','id' => $data->id], ['class' => 'btn btn-danger btn-xs']);
                }
            ],
           
            //'created_by',
            //'updated_by',
            //'create_date',
            //'modify_date',

           // ['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Action', 
                //'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{update}',
                'visibleButtons' => [
                    'update' => function ($model) {
                        return $model->status_risk == 'ลงทะเบียน';
                    },

                ], 
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons'=>[
                    'update'=>function($url,$model,$key){                        
                        return  Html::a('<i class="glyphicon glyphicon-check"></i> Approve', ['riskregister/update', 'id' => $model->id], ['class' => 'btn btn-primary btn-xs']);
                    },
                  ]
            ],

        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <h4><b class="text-red">หมายเหตุ : </b></h4>
    <ol>
        <li class="list-group-item-info"> หลังจากกด send ข้อมูลจากตาราง risk จะ ถูก insert ไปยังตาราง riskregister
            [มีฟิวเพิ่ม User_import,date_import,status_approve,data_approve,date_approve,sendto_user,sentto_tem,sendto_dep และ update status_risk='ตรวจสอบ']
            ,และ insert ฟิว status_risk='ตรวจสอบ' where id=id </li>
    </ol>
</div>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>