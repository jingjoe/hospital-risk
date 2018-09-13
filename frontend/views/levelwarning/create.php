<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Levelwarning */

$this->title = 'บันทึกข้อมูลระดับการแจ้งเตือน';
$this->params['breadcrumbs'][] = ['label' => 'ระดับการแจ้งเตือน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="levelwarning-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
