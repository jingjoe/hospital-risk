<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Risk */

$this->title = 'รายงานความเสี่ยง';
$this->params['breadcrumbs'][] = ['label' => 'ความเสี่ยง', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="risk-create">
    <div class="panel panel-success">
        <div class="panel-heading"><span class="glyphicon glyphicon-time" aria-hidden="true"></span> <?= Html::encode($this->title) ?></div>
        <div class="panel-body">
            <?=
            $this->render('_form', [
                'model' => $model,
                'riskse' => $riskse,
                'level' => $level,
            ])
            ?>
        </div>
    </div>
</div>
