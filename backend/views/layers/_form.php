<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Layers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layers-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
           <?php if (!$model ->isNewRecord) { ?>
            <li><a href="#yw0_tab_2" data-toggle="tab">Permissões</a></li>
            <?php } ?> 
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?= $form->field($model, 'viewer_id')->textInput() ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'layer')->textInput() ?>

                <?= $form->field($model, 'layer_type')->dropDownList(['prompt' => '---- Select Layer Format ----']) ?>

                <?= $form->field($model, 'visible')->checkbox() ?>

                <?= $form->field($model, 'show_toc')->checkbox() ?>

                <?= $form->field($model, 'opacity')->textInput() ?>

                <?= $form->field($model, 'crs')->dropDownList(['prompt' => '---- Select Coordinates System ----']) ?>

                <?= $form->field($model, 'style')->textInput() ?>

                <?= $form->field($model, 'serverType')->dropDownList(['prompt' => '---- Select Server Type ----']) ?>

                <?= $form->field($model, 'type')->dropDownList(['prompt' => '---- Select Layer Type ----']) ?>

                <?= $form->field($model, 'icon')->textInput() ?>
            </div>

            <div id="yw0_tab_2" class="tab-pane">

            </div>
         </div>
    </div>   
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
