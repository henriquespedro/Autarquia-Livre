<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Appoptions */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appoptions-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'server_url')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'manual_url')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'proxy')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'domain')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'ldap')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'ldap_port')->textInput() ?>

    <?= $form->field($model, 'smtp_host')->textInput(['maxlength' => 150]) ?>

    <?= $form->field($model, 'smtp_port')->textInput() ?>

    <?= $form->field($model, 'smtp_username')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'smtp_password')->textInput(['maxlength' => 100]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
