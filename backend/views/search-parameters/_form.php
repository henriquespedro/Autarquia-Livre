<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchParameters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="search-parameters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'search_id')->textInput() ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'require')->checkbox() ?>

    <?= $form->field($model, 'type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqlquery')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'value_field')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_field')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
