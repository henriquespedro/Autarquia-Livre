<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\ParamCoordinates;
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
    
    <?php $items = ArrayHelper::map(ParamCoordinates::find()->all(), 'code', 'name'); ?>
    <?= $form->field($model, 'projection')->dropDownList($items,['prompt' => '---- Select Coordinates System ----'])  ?>

    <?= $form->field($model, 'units')->dropDownList(['m'=>'Meters', 'km'=>'kilometers', 'ml'=>'Miles'],['prompt' => '---- Select Map Units ----'])  ?>

    <?= $form->field($model, 'active')->checkbox() ?>

    <?= $form->field($model, 'theme')->dropDownList(['default'=>'Default', 'mobile'=>'Mobile'], ['prompt' => '---- Select Theme ----'])  ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicações Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
