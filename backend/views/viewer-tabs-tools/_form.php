<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Tools;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabsTools */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viewer-tabs-tools-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tabs_id')->hiddenInput()->label(false) ?>

    <?php $items = ArrayHelper::map(Tools::find()->all(), 'id', 'name'); ?>
    <?= $form->field($model, 'tools_id')->dropDownList($items) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
