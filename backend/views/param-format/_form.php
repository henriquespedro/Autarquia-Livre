<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ParamFormat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="param-format-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textinput() ?>

    <?= $form->field($model, 'format')->textinput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
