<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use yii\widgets\Pjax;

use yii\db\Query;

use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'ทบทวนความเสี่ยง risk มาถึงแผนก';
//$this->params['breadcrumbs'][] = $this->title;
?>
<!--<?= $prior; ?> -->
<div class="riskregister-index">
    <div class="alert alert-warning alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <strong>Note !</strong>     RV1=ทบทวนทันที,RV2=ทบทวนภายใน 1 วัน,RV3=ทบทวนภายใน 3 วัน,RV4=ทบทวนภายใน 7 วัน,RV5=ทบทวนภายใน 14 วัน,RV5=ทบทวนภายใน 1 เดือน
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
            'dataProvider' => $dataProvider2,
            //'filterModel' => $searchModel,
            'headerRowOptions' => ['style' => 'background-color:#cccccc'],
            'panel'=>[
                'type'=>GridView::TYPE_DEFAULT,
                //'before'=>Html::a('<i class="glyphicon glyphicon-send"></i> รายงานความเสี่ยง', ['risk/create'], ['class' => 'btn btn-success', 'title' => 'รายงานความเสี่ยง']) .' '.Html::a('<i class="glyphicon glyphicon-search"></i> รายงานความเสี่ยง', ['risk/searchrisk'], ['class' => 'btn btn-warning' , 'title' => 'ค้นหาชื่อความเสี่ยง']),
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
                   GridView::CSV => ['label' => 'Export as CSV', 'filename' => 'riskreview_todep'.date('Y-d-m')],
                   GridView::PDF => ['label' => 'Export as PDF', 'filename' => 'riskreview_todep'.date('Y-d-m')],
                   GridView::EXCEL=> ['label' => 'Export as EXCEL', 'filename' => 'riskreview_todep'.date('Y-d-m')],
                   GridView::TEXT=> ['label' => 'Export as TEXT', 'filename' => 'riskreview_todep'.date('Y-d-m')],
                ],
        // set your toolbar
            'toolbar' =>  [
                ['content' => 
                    Html::a('<i class="glyphicon glyphicon-repeat"></i>', ['riskreview/todep'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'รีเซ็ต')])
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
            'header' => 'การทบทน',
            'attribute' => 'repeat_code'
            ],
            [
                'attribute' => 'storename',
                'format' => 'raw',
                'contentOptions' => [
                    'style'=>'max-width:1000px; overflow: auto; white-space: normal; word-wrap: break-word;'
                ],
            ],
            [
            'header' => 'ระดับ',
            'attribute' => 'level_id'
            ],
               'loginname',
            [
                'attribute' => 'departname',
                'format' => 'raw',
                'contentOptions' => [
                    'style'=>'max-width:1000px; overflow: auto; white-space: normal; word-wrap: break-word;'
                ],
            ],
            [
            'header' => 'วันที่ยืนยัน',
            'attribute' => 'register_date'
            ],
            [
            'header' => 'ผู้ส่งทบทวน',
            'attribute' => 'send_use'
            ],


            //['class' => 'yii\grid\ActionColumn'],
            [
                'class' => 'kartik\grid\ActionColumn',
                'header' => 'Action', 
                //'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'{view} {create}',
                //'visible'=> Yii::$app->user->isGuest ? false : true,
                'visible'=> Yii::$app->user->isGuest ? false : true,
                'buttons'=>[
                    'view'=>function ($url,$model2,$key) {
                        return Html::a('<i class="glyphicon glyphicon-eye-open"></i> เปิดดู', ['riskregister/viewdep', 'id' => $model2->id,'id_risk' => $model2->id_risk], ['class' => 'btn btn-success btn-xs']);
                    },
                    'create'=>function($url,$model2,$key){                        
                        return  Html::a('<i class="glyphicon glyphicon-repeat"></i> ทบทวน', ['riskreview/create', 'risk_id' => $model2->id,'riskregister_id' => $model2->id_risk], ['class' => 'btn btn-danger btn-xs']);
                    },
                  ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>