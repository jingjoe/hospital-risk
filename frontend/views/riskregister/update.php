<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Riskregister */

$this->title = 'Update Riskregister: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Riskregisters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id, 'id_risk' => $model->id_risk]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="riskregister-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
