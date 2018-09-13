<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\bootstrap\ActiveForm;
use miloschuman\highcharts\Highcharts;
use kartik\grid\GridView;
use kartik\widgets\Growl;


/* @var $this yii\web\View */

$this->title = 'โปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล [Hospital Risk Management System]';
?>
<div class="site-index">

<?= Growl::widget([
    'type' => Growl::TYPE_GROWL,
    'title' => 'ยินดีต้อนรับเข้าสู่ระบบ </br> HRMS (Hospital Risk Management System ) โปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล'.' </br>-------------------------------------------------------------'.'</br>',
    'icon' => 'glyphicon glyphicon-volume-up',
    'body' => 'พัฒนาระบบโดย <br>นายวิเชียร นุ่นศรี นักวิชาการคอมพิวเตอร์</br>โรงพยาบาลปากพะยูน จังหวัดพัทลุง',
    //'showSeparator' => true,
    'delay' => 0,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'bottom',
            'align' => 'right',
        ],
    ]
]);
?>
<br>
    <div class="jumbotron">
         <?= Html::img('images/user.png'); ?>
        <h2 style="text-align:center;"> Hospital Risk Management System </h2>
        <p style="text-align:center;">โปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล</p>
        <h5 style="text-align:center;"><?php echo 'Dashboard For User Login';  ?></h5>
    </div>
    <div class="body-content">
        <div class="row">

        </div>
    </div>
</div>
