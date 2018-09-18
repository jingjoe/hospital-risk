<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use kartik\nav\NavX;

use frontend\assets\AppAsset;
use frontend\assets\DatatablesAsset;
use common\widgets\Alert;
use rmrevin\yii\fontawesome\FA;



AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <link rel="shortcut icon" href="<?php echo Yii::$app->request->baseUrl; ?>/images/favicon.ico" type="image/x-icon" />
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="Description" content="Hospital Risk Management System">
    <meta name="KeyWords" content="Risk">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        //'brandLabel' => Yii::$app->name,
        'brandLabel' => '<span class="glyphicon glyphicon-alert"></span>  HOSPITAL-RISK',
        //'brandLabel' => '<img src="logo.png" style="display:inline; vertical-align: top; height:32px;"><b>HRMS</b>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-default navbar-fixed-top',
        ],
    ]);
        $username = '';
            if (!Yii::$app->user->isGuest) {
                $username = '(' . Html::encode(Yii::$app->user->identity->username) . ')';
            }
            if (Yii::$app->user->isGuest) {
                $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ', 'url' => ['/user/security/login']];
                $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-globe"></span> ลงทะเบียนผู้ใช้งาน', 'url' => ['/user/registration/register']];
            } else {
                $submenuItems[] = ['label' => '<span class="glyphicon glyphicon-education"></span> โปรไฟล', 'url' => ['/user/settings/profile'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 99];
                $submenuItems[] = [
                    'label' => '<span class="glyphicon glyphicon-log-out"></span> ออกจากระบบ',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }

            $risk_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-floppy-saved"></span> รายงานความเสี่ยง', 'url' => ['risk/index']];
            $risk_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-bell"></span> ติดตามความเสี่ยง', 'url' => ['risk/follow']];

            $help_mnu_itms[] =['label' => '<span class="glyphicon glyphicon-menu-right"></span> ประวัติการปรับปรุงโปรแกรม','url' => ['/historyview/index']];
            $help_mnu_itms[] =['label' => '<span class="glyphicon glyphicon-menu-right"></span> คู่มือการใช้งาน','url' => ['help/manual']];
            $help_mnu_itms[] =['label' => '<span class="glyphicon glyphicon-menu-right"></span> ความรู้เรื่องความเสี่ยง','url' => ['help/books']];
            $help_mnu_itms[] =['label' => '<span class="glyphicon glyphicon-menu-right"></span> ติดต่อ', 'url' => ['/site/about']];

            if (!Yii::$app->user->isGuest) {
                $risk_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-saved"></span> ตรวจสอบความเสี่ยง', 'url' => ['risk/approve'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 3 ];
                $risk_mnu_itms[] = ['label' => '<span class="glyphicon glyphicon-thumbs-up"></span> ทบทวนความเสี่ยง', 'url' => ['riskreview/index'],
                                        'items' => [['label' => 'มี Risk มาถึงคุณ', 'url'=> ['/riskreview/view1']],
                                                    ['label' => 'มี Risk มาถึงแผนก-ฝ่าย', 'url'=> ['/riskreview/view2']],
                                                    ['label' => 'มี Risk มาถึงทีม', 'url'=> ['/riskreview/view3']],
                                        ],
                    
                                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 3 
                                    ];
            }

            $menuItems = [
                ['label' => '<span class="glyphicon glyphicon-home"></span> หน้าหลัก','url' => ['/site/index']],
                ['label' => '<span class="glyphicon glyphicon-screenshot"></span> จัดการความเสี่ยง', 'items' => $risk_mnu_itms,'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 99],
                ['label' => '<span class="glyphicon glyphicon-list-alt"></span> รายงาน', 'url' => ['/risk/report'],'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->role != 99],
                [
                'label' => '<span class="glyphicon glyphicon-cog"></span> ตั้งค่าระบบ',
                'items' => [
                     //'<li class="divider"></li>',
                     '<li class="dropdown-header">จัดการข้อมูลทั่วไป</li>',
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ข้อมูลโรงพยาบาล','url' => ['hospital/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ฝ่าย','url' => ['departmentgroup/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> แผนก-งาน','url' => ['department/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ตำแหน่ง','url' => ['position/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ทีมนำโรงพยาบาล','url' => ['team/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ข้อมูลบุคลากร','url' => ['member/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> เวรทำการ','url' => ['duration/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ประวัติการปรับปรุง','url' => ['history/index']],
                     '<li class="divider"></li>',
                     //'<li class="dropdown-header">จัดการสมาชิก</li>',
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> จัดการผู้ใช้งาน','url' => ['/user/admin/index']],
                     '<li class="divider"></li>',
                     '<li class="dropdown-header">จัดการข้อมูลความเสี่ยง</li>',
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ประเภทความเสี่ยง','url' => ['type/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> กลุ่มความเสี่ยง','url' => ['riskgroup/index']], 
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ระดับความรุนแรง','url' => ['level/index']],          
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> โปรแกรมความเสี่ยง','url' => ['program/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> คลังความเสี่ยง',  'url' => ['riskstore/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ที่มาของรายงานความเสี่ยง', 'url' => ['inform/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ระดับการทบทวน','url' => ['levelwarning/index']], 
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ประเภทการทบทวน', 'url' => ['reviewtype/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> ผลการทบทวน', 'url' => ['reviewresults/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> สถานที่เกิดความเสี่ยง','url' => ['location/index']],
                        ['label' => '<span class="glyphicon glyphicon-menu-right"></span> สถานะความเสี่ยง', 'url' => ['status/index']],
                ],
                    'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin
                ],
                ['label' => '<span class="glyphicon glyphicon-earphone"></span> ช่วยเหลือ', 'items' => $help_mnu_itms],
                ['label' => '<span class="glyphicon glyphicon-user"></span> ผู้ใช้งาน' . $username, 'items' => $submenuItems],
            ];
   


            echo NavX::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?=\yii2mod\alert\Alert::widget()?>
        <?= $content ?>
    </div>
</div>

<div class="footer">
     <div class="container">
        <p style="text-align:center;">Copyright &copy; <?= date('Y') ?> <a href="#">Hospital Risk Management System.</a> Developed By <?= Html::a('Wichian Nunsri', ['site/about']) ?></p>
    <?php
        $ver = file_get_contents(Yii::getAlias('@webroot/version/version.txt'));
        $ver = explode(',', $ver);
    ?>
    <?php $visit = Yii::$app->db->createCommand("SELECT COUNT(id) FROM session_frontend_user")->queryScalar(); ?>
        <h6><p style="text-align:center;">เวอร์ชั่น  <?= $ver[0] ?>  |  ผู้เยี่ยมชม <?= $visit;?> ครั้ง </p></h6>
    </div>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
