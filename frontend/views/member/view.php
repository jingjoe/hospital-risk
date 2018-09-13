<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Member */

$this->title = $model->id;
$this->title =''. ' '.'ชื่อ : ' . ' ' . $model->member_name. ' '.'แผนก : ' . ' ' . $model->departname ;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลบุคลากร', 'url' => ['index']];
?>
<div class="member-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
           // 'id',
            [
            'format'=>'raw',
            'attribute'=>'img',
            'value'=>Html::img($model->photoViewer,['class'=>'img-thumbnail','style'=>'width:150px;'])
            ],
            'member_name',
            'cid',
            'departname',
            'positionname',
            'teamname',
            'create_date',
            'modify_date',
            'loginname',
            'updatename'
        ],
    ]) ?>

</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>