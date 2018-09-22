<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\RiskreviewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="riskreview-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'risk_id') ?>

    <?= $form->field($model, 'riskregister_id') ?>

    <?= $form->field($model, 'riskvisit') ?>

    <?= $form->field($model, 'active') ?>

    <?php // echo $form->field($model, 'review_date') ?>

    <?php // echo $form->field($model, 'review_time') ?>

    <?php // echo $form->field($model, 'token_upload') ?>

    <?php // echo $form->field($model, 'files') ?>

    <?php // echo $form->field($model, 'notereview') ?>

    <?php // echo $form->field($model, 'reviewtype_id') ?>

    <?php // echo $form->field($model, 'reviewresults_id') ?>

    <?php // echo $form->field($model, 'join_review') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'create_date') ?>

    <?php // echo $form->field($model, 'modify_date') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
