<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ParamCoordinates;
use app\models\ParamFormat;
use app\models\ParamServer;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Layers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layers-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    if ($model->isNewRecord) {
        echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
    } else {
        echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
    }
    ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'layer')->textInput() ?>

    <?= $form->field($model, 'fields')->textInput() ?>

    <?php $items_format = ArrayHelper::map(ParamFormat::find()->all(), 'format', 'name'); ?>
    <?= $form->field($model, 'layer_type')->dropDownList($items_format) ?>

    <?= $form->field($model, 'visible')->checkbox() ?>

    <?= $form->field($model, 'show_toc')->checkbox() ?>

    <?= $form->field($model, 'opacity')->textInput() ?>

    <?php $items = ArrayHelper::map(ParamCoordinates::find()->all(), 'code', 'name'); ?>
    <?= $form->field($model, 'crs')->dropDownList($items) ?>

    <?= $form->field($model, 'style')->textInput() ?>

    <?php $items_server = ArrayHelper::map(ParamServer::find()->all(), 'id', 'name'); ?>
    <?= $form->field($model, 'serverType')->dropDownList($items_server) ?>


    <?= $form->field($model, 'type')->dropDownList(['operational_layer' => 'Operational Layer', 'baselayer' => 'BaseLayer']) ?>

    <?= $form->field($model, 'icon')->textInput() ?>
    <
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
