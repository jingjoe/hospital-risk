
<?php

use yii\helpers\Url;

$this->title = Yii::t('app', 'คู่มือการใช้งานโปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล สำหรับผู้ดูแลระบบ');
$this->params['breadcrumbs'][] = ['label' => 'คู่มือการใช้งาน', 'url' => ['manual']];
$this->params['breadcrumbs'][] = $this->title;

?>

<?= \yii2assets\pdfjs\PdfJs::widget([
        'width'=>'100%',
        'height'=> '100vh',
        'url'=> Url::base().'/documents/manuals/manual2.pdf'
]); ?>

<?= \bluezed\scrollTop\ScrollTop::widget() ?>
