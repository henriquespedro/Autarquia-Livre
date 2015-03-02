<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\GeographicEdit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="geographic-edit-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- ?= $form->field($model, 'viewer_id')->textInput() ?> -->
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <li><a href="#yw0_tab_2" data-toggle="tab">Utilizadores</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                    <?= $form->field($model, 'name')->textInput() ?>

                    <?= $form->field($model, 'layer')->textInput() ?>

                    <?= $form->field($model, 'type')->dropDownList(['line'=>'Line', 'polygon'=>'Polygon', 'point'=>'Point'],['prompt' => '---- Select geometry layer ----'])  ?>
            </div>
            <div id="yw0_tab_2" class="tab-pane">
                <?php $dataList=ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'); ?>
                <?= html::activeCheckBoxList($model,'name', $dataList); ?>
            </div>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
