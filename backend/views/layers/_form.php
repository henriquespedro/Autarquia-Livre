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
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Permissões</a></li>
            <?php } ?> 
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?php
                if ($model->isNewRecord) {
                    echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
                } else {
                    echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
                }
                ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'layer')->textInput() ?>

                <?php $items_format = ArrayHelper::map(ParamFormat::find()->all(), 'format', 'name'); ?>
                <?= $form->field($model, 'layer_type')->dropDownList($items_format, ['prompt' => '---- Select Layer Format ----']) ?>

                <?= $form->field($model, 'visible')->checkbox() ?>

                <?= $form->field($model, 'show_toc')->checkbox() ?>

                <?= $form->field($model, 'opacity')->textInput() ?>

                <?php $items = ArrayHelper::map(ParamCoordinates::find()->all(), 'code', 'name'); ?>
                <?= $form->field($model, 'crs')->dropDownList($items, ['prompt' => '---- Select Coordinates System ----']) ?>

                <?= $form->field($model, 'style')->textInput() ?>

                <?php $items_server = ArrayHelper::map(ParamServer::find()->all(), 'type', 'name'); ?>
                <?= $form->field($model, 'serverType')->dropDownList($items_server, ['prompt' => '---- Select Server Type ----']) ?>


                <?= $form->field($model, 'type')->dropDownList(['operational_layer' => 'Operational Layer', 'baselayer' => 'BaseLayer'], ['prompt' => '---- Select Layer Type ----']) ?>

                <?= $form->field($model, 'icon')->textInput() ?>
            </div>

            <div id="yw0_tab_2" class="tab-pane">
                <?php $dataList = ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'); ?>
                <?= html::activeCheckBoxList($model, 'name', $dataList); ?>
            </div>
        </div>
    </div>   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
