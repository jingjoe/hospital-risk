<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\RiskregisterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Riskregisters';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="riskregister-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Riskregister', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'id_risk',
            'date_report',
            'time_report',
            'duration_id',
            //'location_id',
            //'user_ir_type',
            //'user_ir',
            //'program_id',
            //'level_id',
            //'riskstore_id',
            //'detail:ntext',
            //'detail_hosxp:ntext',
            //'affected',
            //'edit',
            //'problem_basic:ntext',
            //'image:ntext',
            //'inform_id',
            //'status_risk',
            //'created_by',
            //'department_id',
            //'updated_by',
            //'create_date',
            //'modify_date',
            //'send_date',
            //'send_use',
            //'register_date',
            //'note',
            //'sendto_team_id',
            //'sendto_department_id',
            //'sendto_member_cid',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
