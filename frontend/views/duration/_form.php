<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Duration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="duration-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'duration_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-save"></i> ' . ($model->isNewRecord ? 'บันทึก' : 'แก้ไข'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-warning') . ' btn-lg btn-block']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
