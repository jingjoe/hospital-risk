<?php

use yii\helpers\Html;
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
<br><br>
    <div class="jumbotron">
        <?= Html::img('images/pyh.png'); ?>
        <h5 style="text-align:center;"><?php echo 'Dashboard For Guest';  ?></h5>
    </div>
</div>
