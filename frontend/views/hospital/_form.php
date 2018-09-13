<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Hospital */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hospital-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($model, 'hoscode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hosname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
 
    <?= $form->field($model, 'tel')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999-999999',]) ?>

    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999-9999999',]) ?>

    <?= $form->field($model, 'fax')->widget(\yii\widgets\MaskedInput::className(), ['mask' => '999-999999',]) ?>

    <?= $form->field($model, 'email')->widget(\yii\widgets\MaskedInput::className(), [
                'name' => 'input-36',
                'clientOptions' => [
                    'alias' => 'email',
                ],
            ])
    ?>

    <?= $form->field($model, 'website')->widget(\yii\widgets\MaskedInput::className(), [
                'name' => 'input-35',
                'clientOptions' => [
                    'alias' => 'url',
                ],
            ])
            ?>

    <?= $form->field($model, 'active_code')->textarea(['rows' => 2]) ?>

     <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-save"></i> ' . ($model->isNewRecord ? 'บันทึก' : 'แก้ไข'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-warning') . ' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
