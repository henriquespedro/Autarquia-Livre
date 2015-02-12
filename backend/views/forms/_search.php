<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'viewer_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'html_template') ?>

    <?php // echo $form->field($model, 'sql_select') ?>

    <?php // echo $form->field($model, 'sql_insert') ?>

    <?php // echo $form->field($model, 'sql_update') ?>

    <?php // echo $form->field($model, 'sql_delete') ?>

    <?php // echo $form->field($model, 'icon') ?>

    <?php // echo $form->field($model, 'chage_data') ?>

    <?php // echo $form->field($model, 'setOrder') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
