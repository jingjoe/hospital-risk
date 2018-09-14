<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Riskregister */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riskregister-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_risk')->textInput() ?>

    <?= $form->field($model, 'date_report')->textInput() ?>

    <?= $form->field($model, 'time_report')->textInput() ?>

    <?= $form->field($model, 'duration_id')->textInput() ?>

    <?= $form->field($model, 'location_id')->textInput() ?>

    <?= $form->field($model, 'user_ir_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_ir')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput() ?>

    <?= $form->field($model, 'level_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'riskstore_id')->textInput() ?>

    <?= $form->field($model, 'detail')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'detail_hosxp')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'affected')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'problem_basic')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'image')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'inform_id')->textInput() ?>

    <?= $form->field($model, 'status_risk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'department_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <?= $form->field($model, 'create_date')->textInput() ?>

    <?= $form->field($model, 'modify_date')->textInput() ?>

    <?= $form->field($model, 'send_date')->textInput() ?>

    <?= $form->field($model, 'send_use')->textInput() ?>

    <?= $form->field($model, 'register_date')->textInput() ?>

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sendto_team_id')->textInput() ?>

    <?= $form->field($model, 'sendto_department_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sendto_member_cid')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
