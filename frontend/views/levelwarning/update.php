<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Levelwarning */

$this->title ='ปรับปรุงข้อมูล : '. ' '.'ไอดี : ' . ' ' . $model->id. ' '.'ระดับการแจ้งเตือน : ' . ' ' . $model->warning_name;
$this->params['breadcrumbs'][] = ['label' => 'ข้อมูลระดับการแจ้งเตือน', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'ปรับปรุง';
?>
<div class="levelwarning-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
