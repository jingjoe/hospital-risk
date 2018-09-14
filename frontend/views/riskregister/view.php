<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\Models\Riskregister */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Riskregisters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riskregister-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'id_risk' => $model->id_risk], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id, 'id_risk' => $model->id_risk], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'id_risk',
            'date_report',
            'time_report',
            'duration_id',
            'location_id',
            'user_ir_type',
            'user_ir',
            'program_id',
            'level_id',
            'riskstore_id',
            'detail:ntext',
            'detail_hosxp:ntext',
            'affected',
            'edit',
            'problem_basic:ntext',
            'image:ntext',
            'inform_id',
            'status_risk',
            'created_by',
            'department_id',
            'updated_by',
            'create_date',
            'modify_date',
            'send_date',
            'send_use',
            'register_date',
            'note',
            'sendto_team_id',
            'sendto_department_id',
            'sendto_member_cid',
        ],
    ]) ?>

</div>
