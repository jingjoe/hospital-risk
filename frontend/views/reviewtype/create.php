<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\models\Reviewtype */

$this->title = 'ประเภทการทบทวน';
$this->params['breadcrumbs'][] = ['label' => 'ประเภทการทบทวน', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviewtype-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
