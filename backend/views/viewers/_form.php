<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Viewers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viewers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => 200]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'scales')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'init_extent')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'max_extent')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'projection')->dropDownList(['prompt' => '---- Select Projection System ----'])  ?>

    <?= $form->field($model, 'units')->dropDownList(['prompt' => '---- Select Map Units ----'])  ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'theme')->dropDownList(['prompt' => '---- Select Theme ----'])  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicações Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
