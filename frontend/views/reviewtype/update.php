<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Reviewtype */

$this->title =''. ' '.'ไอดี : ' . ' ' . $model->id. ' '.'ประเภทการทบทวน : ' . ' ' . $model->reviewtype_name ;
$this->params['breadcrumbs'][] = ['label' => 'ประเภทการทบทวน', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ปรับปรุง';
?>
<div class="reviewtype-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
