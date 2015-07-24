<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MaprintFields */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="maprint-fields-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
    } else {
        echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
    }
    ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'code_field')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(['text' => 'Texto', 'numeric' => 'Numérico']) ?>

    <?= $form->field($model, 'validation')->checkbox() ?>

    <?= $form->field($model, 'required')->checkbox() ?>

    <?= $form->field($model, 'setOrder')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
