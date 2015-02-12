<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchParametersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search-parameters-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'search_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'require')->checkbox() ?>

    <?= $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'sqlquery') ?>

    <?php // echo $form->field($model, 'value_field') ?>

    <?php // echo $form->field($model, 'description_field') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
