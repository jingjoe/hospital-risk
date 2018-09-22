<?php

use yii\helpers\Html;
//use yii\widgets\DetailView;
use kartik\detail\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Riskreview */

$this->title =''.'รายละเอียดการทบทวนความเสี่ยงของคุณ : ' . ' ' . $model->loginname ;
$this->params['breadcrumbs'][] = ['label' => 'ทบทวนความเสี่ยง', 'url' => ['riskreview/todep']];
//$this->params['breadcrumbs'][] = ''. ' '.'RiskID : ' . ' ' . $model->risk_id. ' '.'RegisterID : ' . ' ' . $model->riskregister_id. ' '.'RsikVisit : ' . ' ' . $model->riskvisit. ' '.'ผู้ทบทวน : ' . ' ' . $model->loginname ;
?>
<div class="riskreview-view">
    <div class="risk-view">
     <div class="alert alert-success alert-dismissible fade in" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> 
        <h4><span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> <?= Html::encode($this->title) ?></h4> 
    </div>
    
            <div class="box-tools pull-left">
            
                    <?= Html::a('<i class="glyphicon glyphicon-pencil">แก้ไขการทบทวน</i>', ['update', 'id' => $model->id,'riskregister_id' => $model->riskregister_id, 'riskvisit' => $model->riskvisit], ['class' => 'btn btn-primary']) ?>
                    <?=
                    Html::a('<i class="glyphicon glyphicon-trash">ลบ</i>', ['delete', 'id' => $model->id, 'riskvisit' => $model->riskvisit], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'คุณแน่ใจหรือว่าต้องการลบรายการนี้หรือไม่?',
                            'method' => 'post',
                        ],
                    ])
                    ?>
            </div>
            <div class="box-tools pull-right">
                <?= Html::a('<i class="glyphicon glyphicon-off">ยืนยันการจำหน่วย</i>', ['riskreview/conf', 'id' => $model->id, 'riskregis_id' => $model->riskregister_id,'riskvisit' => $model->riskvisit], ['class' => 'btn btn-warning']) ?>
            </div>
   
<br><br>
    <?= DetailView::widget([
             'model' => $model,
                'hover' => true,
                'hideAlerts' => true,
                'enableEditMode' => true,
                'mode' => DetailView::MODE_VIEW,
                'hAlign' => 'left',

        'attributes' => [
            [
            'group' => true,
            'label' => '<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span> ผลการทบทวนรายงานความเสี่ยงของคุณ...',
            'rowOptions' => ['class' => 'success']
            ],
    // cal_1  
            [
                 'columns' => [
                     [
                         'label' => 'RiskID/RiskregisterID',
                         'value'=>$model->risk_id. ' /  '. $model->riskregister_id,
                         'labelColOptions' => ['style' => 'width: 20%'],
                         'valueColOptions'=>['style'=>'width:10%'],
                         'displayOnly' => true,
                     ],
                     [
                         'attribute' => 'riskvisit',
                         'format' => 'raw',
                         //'label' => 'เลขทบทวน',
                         'value' => $model->riskvisit,
                         'labelColOptions' => ['style' => 'width: 10%'],
                         'valueColOptions' => ['style' => 'width:30%'],
                         'displayOnly' => true,
                     ],
                    [
                        'label' => 'วันที่เวลาทบทวน',
                        'value'=>$model->review_date. '  '. $model->review_time.'  '.'น.',
                        'labelColOptions' => ['style' => 'width: 15%'],
                        'valueColOptions'=>['style'=>'width:50%'],
                        'displayOnly' => true,
                    ],

                 ],
             ],
        // cal_2        
            [
                'columns' => [
                    [
                        'attribute' => 'files',
                        'format' => 'raw',
                        //'label' => 'ผู้ลงทะเบียน',
                        'value' => !$model->files?'':Html::a('ดาวน์โหลด', ['/riskreview/download','type'=>'files','id'=>$model->id,'riskvisit'=>$model->riskvisit,
                        'labelColOptions' => ['style' => 'width: 20%'],
                        'valueColOptions' => ['style' => 'width:60%'],
                        'displayOnly' => true,
                    ])],
                    [
                        'attribute' => 'hits',
                        'format' => 'html',
                        //'label' => 'ผู้ลงทะเบียน',
                        'value' => $model->hits,
                        'labelColOptions' => ['style' => 'width: 10%'],
                        'valueColOptions' => ['style' => 'width:10%'],
                        'displayOnly' => true,
                    ],
       
                ],
            ],
        // cal_3    
            [
                'columns' => [
                    [
                        //'attribute'=>'detail',
                        'label'=>'บันทึกการทบทวน',
                        'format'=>'raw',
                        'value'=>'<span class="text-justify"><em>' . $model->notereview . '</em></span>',
                        'labelColOptions' => ['style' => 'width: 20%'],
                        'type'=>DetailView::INPUT_TEXTAREA, 
                        'options'=>['rows'=>4]
                    ],
                ],
            ],
        // cal_4 
            [
                'columns' => [
                    [
                        //'attribute'=>'detail',
                        'label'=>'ผู้ร่วมทบทวน',
                        'format'=>'raw',
                        'value'=>'<span class="text-justify"><em>' . $model->review_cid . '</em></span>',
                        'labelColOptions' => ['style' => 'width: 20%'],
                        'type'=>DetailView::INPUT_TEXTAREA, 
                        'options'=>['rows'=>4]
                    ],
                ],
            ],
        // cal_5 
            [

                  'columns' => [
                      [
                          'attribute' => 'reviewresultsname',
                          'format' => 'raw',
                          //'label' => 'ผลการทวบทวน',
                          'value' => $model->reviewresultsname,
                          'labelColOptions' => ['style' => 'width: 20%'],
                          'valueColOptions' => ['style' => 'width:80%'],
                          'displayOnly' => true,
                      ],

                  ],
              ],

        // cal_6
            [
                'columns' => [
                    [
                        'label' => 'ทบทวนโดย/อับเดทโดย',
                        'value'=>$model->loginname. ' / '. $model->updatename ,
                        'labelColOptions' => ['style' => 'width: 20%'],
                        'valueColOptions'=>['style'=>'width:20%'],
                        'displayOnly' => true,
                    ],
                    [
                        'label' => 'ทบทวนซ้ำ',
                        'value'=>$model->repeat,
                        'labelColOptions' => ['style' => 'width: 10%'],
                        'valueColOptions'=>['style'=>'width:5%'],
                        'displayOnly' => true,
                    ], 
                    [
                        'label' => 'สถานนะการจำหน่าย',
                        'value'=>$model->discharge,
                        'valueColOptions'=>['style'=>'width:5%'],
                        'displayOnly' => true,
                    ], 
                    [
                        'label' => 'สถานนะ',
                        'value'=>$model->status_risk,
                        'labelColOptions' => ['style' => 'width: 10%'],
                        'valueColOptions'=>['style'=>'width:30%'],
                        'displayOnly' => true,
                    ],
                ],
            ],
        ],
    ]) ?>

</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>