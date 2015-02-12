<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsParameters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-parameters-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_id')->textInput() ?>

    <?= $form->field($model, 'type')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'parameter')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'label')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description_field')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqlquery')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
