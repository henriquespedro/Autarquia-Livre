<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LayersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="layers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'viewer_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'layer') ?>

    <?= $form->field($model, 'layer_type') ?>

    <?php // echo $form->field($model, 'visible')->checkbox() ?>

    <?php // echo $form->field($model, 'show_toc')->checkbox() ?>

    <?php // echo $form->field($model, 'opacity') ?>

    <?php // echo $form->field($model, 'crs') ?>

    <?php // echo $form->field($model, 'style') ?>

    <?php // echo $form->field($model, 'serverType') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'chage_data') ?>

    <?php // echo $form->field($model, 'setOrder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
