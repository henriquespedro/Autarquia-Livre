<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viewer-group-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
    } else {
        echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
    }
    ?>

    <?php $items = ArrayHelper::map(Group::find()->all(), 'id', 'description'); ?>
    <?= $form->field($model, 'group_id')->dropDownList($items, ['prompt' => '---- Select Group ----']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
