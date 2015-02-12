<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ViewersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viewers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'scales') ?>

    <?= $form->field($model, 'init_extent') ?>

    <?php // echo $form->field($model, 'max_extent') ?>

    <?php // echo $form->field($model, 'projection') ?>

    <?php // echo $form->field($model, 'units') ?>

    <?php // echo $form->field($model, 'active')->checkbox() ?>

    <?php // echo $form->field($model, 'author') ?>

    <?php // echo $form->field($model, 'theme') ?>

    <?php // echo $form->field($model, 'create_data') ?>

    <?php // echo $form->field($model, 'modified_dat') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
