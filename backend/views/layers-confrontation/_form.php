<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LayersConfrontation */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layers-confrontation-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
    } else {
        echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
    }
    ?>
    <?= $form->field($model, 'confrontation_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'layer')->textInput() ?>

    <?= $form->field($model, 'description_field')->textInput() ?>

    <?= $form->field($model, 'regulement_field')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
