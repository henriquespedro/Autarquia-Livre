<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="forms-parameters-form">
    <!-- start ActiveForm -->
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_id')->textInput() ?>

    <?= $form->field($model, 'template')->textInput() ?>

    <?= $form->field($model, 'sqlselect')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'sqlinsert')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'sqlupdate')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'sqldelete')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

