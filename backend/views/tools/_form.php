<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tools-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tabs_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'name')->textinput() ?>

    <?= $form->field($model, 'description')->textinput() ?>

    <?= $form->field($model, 'code')->textinput() ?>

    <?= $form->field($model, 'icon')->textinput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
