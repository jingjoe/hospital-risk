<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;

use yii\helpers\VarDumper;
use yii\helpers\Url;
use kartik\widgets\FileInput;

// add model select2
use frontend\models\Department;
use frontend\models\Position;
use frontend\models\Team;




?>

<div class="member-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'] ]); ?>

            <?= $form->field($model, 'member_name')->textInput(['placeholder' => 'คำนำหน้า ชื่อ นามสกุล','maxlength' => true]) ?>
            
            <?= $form->field($model, 'cid')->textInput(['placeholder'=>'เลขบัตรประจำตัวประชาชน','maxlength' => true]) ?>
            
            <?= $form->field($model, 'department_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Department::find()->all(),'id','depart_name'),
                'options' => ['placeholder' => 'กรุณาเลือกแผนก'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
    
            <?= $form->field($model, 'position_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Position::find()->all(),'id','position_name'),
                'options' => ['placeholder' => 'กรุณาเลือกตำแหน่ง'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
    
            <?= $form->field($model, 'team_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Team::find()->all(),'id','team_name'),
                'options' => ['placeholder' => 'กรุณาเลือกทีมนำ'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);
            ?>
        <div class="row">
            <div class="col-md-4 col-xs-12">
                <div class="well text-center">
                    <?= Html::img($model->getPhotoViewer(), ['style' => 'width:100px;', 'class' => 'img-rounded']); ?>
                </div>
            </div>
            <div class="col-md-8 col-xs-12">
                <?= $form->field($model, 'img')->fileInput() ?>
                <p class="help-block">รองรับนามสกุล png,jpg ขนาดไฟล์ กว้าง:150px ,สูง:150px</p>
            </div>
        </div>

    <div class="form-group">
        <?= Html::submitButton('<i class="glyphicon glyphicon-floppy-save"></i> ' . ($model->isNewRecord ? 'บันทึก' : 'แก้ไข'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-warning') . ' btn-lg btn-block']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?= \bluezed\scrollTop\ScrollTop::widget() ?>