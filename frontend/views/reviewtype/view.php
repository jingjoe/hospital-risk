<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reviewtype */

$this->title =''. ' '.'ไอดี : ' . ' ' . $model->id. ' '.'ประเภทการทบทวน : ' . ' ' . $model->reviewtype_name ;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทการทบทวน', 'url' => ['index']];
?>
<div class="reviewtype-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'reviewtype_name',
            'create_date',
            'modify_date',
            'loginname',
            'updatename',
        ],
    ]) ?>

</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>