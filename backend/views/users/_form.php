<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <li><a href="#yw0_tab_2" data-toggle="tab">Grupo</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?= $form->field($model, 'name')->textinput() ?>

                <?= $form->field($model, 'username')->passwordinput() ?>

                <?= $form->field($model, 'email')->textinput()?>
                <!--
                <?= $form->field($model, 'create_date')->textInput() ?>

                <?= $form->field($model, 'last_login')->textInput() ?>
                -->
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
