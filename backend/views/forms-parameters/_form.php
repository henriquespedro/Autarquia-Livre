<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsParameters */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-parameters-form">
    <!-- start ActiveForm -->
    <?php $form = ActiveForm::begin(['id' => 'forms-form', 'enableClientValidation' => 'true']); ?>

    <?= $form->field($model, 'form_id')->hiddenInput()->label(false) ?>
    
    <?= $form->field($model, 'label')->textInput() ?>

    <?= $form->field($model, 'type')->dropDownList(['lista_valores'=>'Lista de Valores', 'text'=>'Texto Livre'],['prompt' => '---- Select Type of Parameter ----'])  ?>

    <?= $form->field($model, 'parameter')->textInput() ?>

    <?= $form->field($model, 'description_field')->textInput() ?>

    <?= $form->field($model, 'sqlquery')->textarea(['rows' => 2]) ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

