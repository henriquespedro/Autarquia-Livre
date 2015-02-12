<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AppoptionsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="appoptions-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'server_url') ?>

    <?= $form->field($model, 'manual_url') ?>

    <?= $form->field($model, 'proxy') ?>

    <?= $form->field($model, 'domain') ?>

    <?php // echo $form->field($model, 'ldap') ?>

    <?php // echo $form->field($model, 'ldap_port') ?>

    <?php // echo $form->field($model, 'smtp_host') ?>

    <?php // echo $form->field($model, 'smtp_port') ?>

    <?php // echo $form->field($model, 'smtp_username') ?>

    <?php // echo $form->field($model, 'smtp_password') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
