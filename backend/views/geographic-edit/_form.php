<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;
use app\models\ParamServer;

/* @var $this yii\web\View */
/* @var $model app\models\GeographicEdit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geographic-edit-form">

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

    <?= $form->field($model, 'featureNS')->textInput() ?>

    <?php $items_server = ArrayHelper::map(ParamServer::find()->all(), 'id', 'name'); ?>
    <?= $form->field($model, 'serverType')->dropDownList($items_server) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
