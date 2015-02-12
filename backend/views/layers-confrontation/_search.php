<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LayersConfrontationSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layers-confrontation-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'confrontation_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'layer') ?>

    <?= $form->field($model, 'description_field') ?>

    <?php // echo $form->field($model, 'regulement_field') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
