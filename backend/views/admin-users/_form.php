<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AdminUsers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-users-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textinput() ?>

    <?= $form->field($model, 'password')->passwordinput() ?>
    
    <?= $form->field($model, 'email')->textinput() ?>
    
    <?= $form->field($model, 'status')->dropDownList(['10' => 'Ativo', '0' => 'Inativo']) ?>

    <?= $form->field($model, 'create_date')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
