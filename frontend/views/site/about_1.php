<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'ทีมพัฒนาระบบ HRMS';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="panel panel-success">
    <div class="panel-heading"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"></span> ทีมพัฒนาโปรแกรมบริหารความเสี่ยงสำหรับโรงพยาบาล HRMS.</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <colgroup>
                    <col class="col-md-1">
                    <col class="col-md-10">
                </colgroup>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
               <!--row1-->
                    <tr>
                        <th scope="row">
                            <?php echo Html::img('@web/images/user1.jpg') ?> &nbsp;&nbsp; &nbsp;
                        </th>
                        <td>
                            <h3><b> Project Manager</b></h3> 
                            <b>  นายสำราญ ทองศรีชุม </b> ตำแหน่ง : เจ้าพนักงานพัสดุชำนาญงาน (หัวหน้าฝ่ายบริหารทั่วไป)<br>
                            <b>  ติดต่อ : <?= Html::a(' โรงพยาบาลปากพะยูน อำเภอปากพะยูน จังหวัดพัทลุง', 'http://pakphayunhospital.net', ['target' => '_blank']) ?>  E-mail : <a href="mailto:#">samran_pk@hotmail.com </a> Phone : 065-0687220
                        </td>
                    </tr>
                <!--row2-->
                    <tr>
                        <th scope="row">
                            <?php echo Html::img('@web/images/user2.jpg') ?> &nbsp;&nbsp; &nbsp;
                        </th>
                        <td>
                            <h3><b> Development And Office Admin</b></h3> 
                            <b>  นางมัสลิน สร้อยละเอียด </b> ตำแหน่ง : นักวิชาการพัสดุ<br>
                            <b>  ติดต่อ : <?= Html::a(' โรงพยาบาลปากพะยูน อำเภอปากพะยูน จังหวัดพัทลุง', 'http://pakphayunhospital.net', ['target' => '_blank']) ?>  E-mail : <a href="mailto:#">godgrand0322@gmail.com </a> Phone : 094-2232436
                        </td>
                    </tr>
                <!--row3-->
                    <tr>
                        <th scope="row">
                            <?php echo Html::img('@web/images/user3.jpg') ?> &nbsp;&nbsp; &nbsp;
                        </th>
                        <td>
                            <h3><b> Development And Office Admin</b></h3> 
                            <b>  นางจินตนา มีเสน </b> ตำแหน่ง : เจ้าพนักงานพัสดุ<br>
                            <b>  ติดต่อ : <?= Html::a(' โรงพยาบาลปากพะยูน อำเภอปากพะยูน จังหวัดพัทลุง', 'http://pakphayunhospital.net', ['target' => '_blank']) ?>  E-mail : <a href="mailto:#">aojintana@gmail.com </a> Phone : 086-6878354
                        </td>
                    </tr>
                <!--row4-->
                    <tr>
                        <th scope="row">
                            <?php echo Html::img('@web/images/user4.jpg') ?> &nbsp;&nbsp; &nbsp;
                        </th>
                        <td>
                            <h3><b> Development And Programer</b></h3> 
                            <b>  นายวิเชียร นุ่นศรี </b> ตำแหน่ง : นักวิชาการคอมพิวเตอร์<br>
                            <b>  ติดต่อ : <?= Html::a(' โรงพยาบาลปากพะยูน อำเภอปากพะยูน จังหวัดพัทลุง', 'http://pakphayunhospital.net', ['target' => '_blank']) ?>  E-mail : <a href="mailto:#">wichian.joe@gmail.com </a> Phone : 087-2888200 <br>
                            <b>  ความรู้ความสามารถ : </b> Web Application ,Web Server ,Linux Server ,Windows Server ,MySQL ,Network design ,Computer technical officer ,Graphic design   <br>
                        </td>
                    </tr>
                <!--row5-->
                    <tr>
                        <th scope="row">
                            <?php echo Html::img('@web/images/user5.jpg') ?> &nbsp;&nbsp; &nbsp;
                        </th>
                        <td>
                            <h3><b> Development And Programer</b></h3> 
                            <b>  นางสาวลักขณา พรหมวงค์ </b> ตำแหน่ง : เจ้าพนักงานเครื่องคอมพิวเตอร์<br>
                            <b>  ติดต่อ : <?= Html::a(' โรงพยาบาลปากพะยูน อำเภอปากพะยูน จังหวัดพัทลุง', 'http://pakphayunhospital.net', ['target' => '_blank']) ?>  E-mail : <a href="mailto:#">boom.lukknana@gmail.com </a> Phone : 088-3392009
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div>


<?= \bluezed\scrollTop\ScrollTop::widget() ?>