<?php

use yii\helpers\Html;
use yii\widgets\DetailView;



/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */

$this->title =''. ' '.'โปรแกรมความเสี่ยง : ' . ' ' . $model->programname. ' '.'ความเสี่ยง : ' . ' ' . $model->storename ;
$this->params['breadcrumbs'][] = ['label' => 'ความเสี่ยง', 'url' => ['index']];
?>
<div class="risk-view">
     <div class="alert alert-success alert-dismissible fade in" role="alert"> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> 
        <h4><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?= Html::encode($this->title) ?></h4> 
    </div>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'date_report',
                    'time_report',
                    'durationname',
                    'locationname',
                    'user_ir_type',
                    /*
                  [
                    'attribute'=>'user_ir_type',
                   'filter'=> frontend\models\Risk::itemsAlias('irtype'),
                   'value'=>function($model){
                     return $model->irtypename;
                   }
                   ], */

                    'irdepname',
                    'programname',
                    'storename',
                    'levelname',
                    'detail:ntext',
                    'detail_hosxp:ntext',
                    'affected',
                    'edit',
                    'problem_basic:ntext',
                    //'image:ntext',
                    [
                    'format'=>'raw',
                    'attribute'=>'image',
                    'value'=>$model->getPhotosViewer()
                    ],
                    'informname',
                    'status_risk',
                    'loginname',
                    'updatename',
                    'create_date',
                    'modify_date',
                ],
            ]) ?>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>