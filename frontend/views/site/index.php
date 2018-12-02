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
    'title' => 'ยินดีต้อนรับเข้าสู่ระบบ </br> HRMS (Hospital Risk Management System) โปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล'.' </br>-------------------------------------------------------------'.'</br>',
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

<div class="alert alert-info alert-dismissible fade in" role="alert"> 
    <!-- คิวรี่จากฐาน ข้อมูลผู้ใช้งาน -->
        <?php  
            $by = Yii::$app->db->createCommand("SELECT member_name,r.role_name 
                    FROM user u 
                    INNER JOIN user_role r ON r.role_id=u.role
                    INNER JOIN member m ON m.cid collate utf8_general_ci=u.cid collate utf8_general_ci 
                    WHERE u.id=$user_ir  ")->queryOne(); 
            $member =  $by['member_name'];
            $role =  $by['role_name'];
        ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button> 
    <h4><span class="glyphicon glyphicon-gift" aria-hidden="true"></span> โปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล (Hospital Risk Management System)</h4> 
    <button class="btn btn-warning" type="button"> ยินดีต้อนรับ <?php echo $member; ?> </button>
    <button class="btn btn-danger" type="button"> สิทธิการใช้งาน <?php echo $role; ?> </button>  
</div>
<div class="body-content">
<!--row1     -->
  
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="alert alert-success">
                   
                    <div class="caption">
                        <h3><span class="glyphicon glyphicon-warning-sign"> Risk..มาถึงคุณ</span></h3>
                        <div class="progress">
                            <?php foreach ($touse as $use) { ?>
                            <div class="progress-bar progress-bar-dange" role="progressbar" aria-valuenow="<?php echo $use['cc']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $use['cc']; ?>%"><?php echo $use['cc']; ?></div>
                        </div>    
                    </div>
                        <div class="text-right"> สถานะ..<font color="red"><?php echo $use['status_risk']; ?></font></div>
                        <?php } ?> 
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="alert alert-info">
                    <div class="caption">
                        <h3><span class="glyphicon glyphicon-warning-sign"> Risk..มาถึงแผนก</span></h3>
                        <?php foreach ($todep as $dep) { ?>
                        <div class="progress">
                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?php echo $dep['cc']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $dep['cc']; ?>%"><?php echo $dep['cc']; ?></div>
                        </div>
                    </div>
                        <div class="text-right"> สถานะ..<font color="red"><?php echo $dep['status_risk']; ?></font></div>
                        <?php } ?> 
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="alert alert-warning">
                    <div class="caption">
                        <h3><span class="glyphicon glyphicon-warning-sign"> Risk..มาถึงทีม</span></h3>
                        <?php foreach ($toteam as $team) { ?>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $team['cc']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $team['cc']; ?>%"><?php echo $team['cc']; ?></div>
                        </div>
                    </div>
                        <div class="text-right"> สถานะ..<font color="red"><?php echo $team['status_risk']; ?></font></div>
                        <?php } ?> 
                </div>
            </div>
            <div class="col-md-3 col-sm-4">
                <div class="alert alert-danger">
                    <div class="caption">
                        <h3><span class="glyphicon glyphicon-warning-sign"> Risk..ทั้งหมด</span></h3>
                        <?php foreach ($toall as $all) { ?>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?php echo $all['cc']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $all['cc']; ?>%"><?php echo $all['cc']; ?></div>         
                        </div>
                    </div>
                        <div class="text-right"> สถานะ..<font color="red"></font></div>
                        <?php } ?> 
                </div>
            </div>
        </div>
<!--row2     -->

<div class="row">
    <div class="col-sm-8">
        <div class="panel panel-danger"> 
            <div class="panel-heading"> 
                <h3 class="panel-title"><span class="glyphicon glyphicon-signal"></span> อุบัติการณ์ความเสี่ยงแยกตามสถานะ</h3> 
            </div> 
            <div class="panel-body"> 
                <div style='display: none'>
                    <?=
                    Highcharts::widget([
                        'scripts' => [
                            'highcharts-more'
                        ]
                    ]);
                    ?>
                </div>
                <div id="container"></div>
                <?php
                $categ = [];
                for ($i = 0; $i < count($risk_st); $i++) {
                    $categ[] = $risk_st[$i]['st'];
                }
                $js_categ = implode("','", $categ);

                $data_cc = [];
                for ($i = 0; $i < count($risk_st); $i++) {
                    $data_cc[] = $risk_st[$i]['c'];
                }
                $js_cc = implode(",", $data_cc);



                $this->registerJs(" $(function () {
                                        $('#container').highcharts({
                                            chart: {
                                               height:325,
                                               width: 700
                                            }, 
                                            title: {
                                                text: '',
                                                x: -20 //center
                                            },
                                            subtitle: {
                                                text: '',
                                                x: -20
                                            },
                                            xAxis: {
                                                  categories: ['$js_categ'],
                                            },
                                            yAxis: {
                                                title: {
                                                    text: ''
                                                },
                                                plotLines: [{
                                                    value: 0,
                                                    width: 1,
                                                    color: '#808080'
                                                }]
                                            },
                                            tooltip: {
                                                valueSuffix: ''
                                            },
                                            legend: {
                                                layout: 'vertical',
                                                align: 'right',
                                                verticalAlign: 'middle',
                                                borderWidth: 0
                                            },
                                            credits: {
                                                enabled: false
                                            },
                                            series: [{
                                                type: 'column',
                                                name: 'จำนวน',
                                                data: [$js_cc]
                                            }],


                                        });
                                    });
                         ");
                ?>  

            </div> 
        </div>
    </div>
    <!-- คิวรี่จากฐาน ระดับความเสี่ยง 4 ระดับ-->
        <?php
                $a = Yii::$app->db->createCommand("SELECT COUNT(id) FROM riskregister WHERE created_by=$user_ir AND level_id BETWEEN 'A' AND 'B' ")->queryScalar();
                $c = Yii::$app->db->createCommand("SELECT COUNT(id) FROM riskregister WHERE created_by=$user_ir AND level_id BETWEEN 'C' AND 'D' ")->queryScalar();
                $e = Yii::$app->db->createCommand("SELECT COUNT(id) FROM riskregister WHERE created_by=$user_ir AND level_id BETWEEN 'E' AND 'F' ")->queryScalar();
                $h = Yii::$app->db->createCommand("SELECT COUNT(id) FROM riskregister WHERE created_by=$user_ir AND level_id BETWEEN 'H' AND 'I' ")->queryScalar();  
        ?>

    <div class="col-sm-4">
        <div class="list-group"> 
            <a href="#" class="list-group-item active"> 
                <h3 class="center-block text-center">อุบัติการณ์ความเสี่ยงทั้งหมด</h3> 
            </a> 
            <a href="#" class="list-group-item"> 
                <h6 class="list-group-item-heading">รุนแรงน้อง A-B</h6> 
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?= $a ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $a ?>%"><?= $a ?></div>
                </div>
            </a> 
            <a href="#" class="list-group-item"> 
                <h6 class="list-group-item-heading">รุนแรงปานกลาง C-D</h6> 
                <div class="progress">
                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?= $c ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $c ?>%"><?= $c ?></div>
                </div> 
            </a> 
            <a href="#" class="list-group-item"> 
                <h6 class="list-group-item-heading">รุนแรงมาก E-F</h6> 
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $e ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $e ?>%"><?= $e ?></div>
                </div> 
            </a> 
            <a href="#" class="list-group-item"> 
                <h6 class="list-group-item-heading">ร้ายแรง H-I</h6> 
                <div class="progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="<?= $h ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $h ?>%"><?= $h ?></div>
                </div>
            </a> 
        </div>
    </div>

</div>
 <!-- End row2     -->  
</div>
</div>


<?= \bluezed\scrollTop\ScrollTop::widget() ?>