<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SearchParameters */
/* @var $form yii\widgets\ActiveForm */
?>

<!--Adicionado Para o Ajax Model-->
<!-- modal dialog for display pop up login -->
<div class="modal-dialog our-modal-dialog">
    <div class="modal-content">
        <div class="modal-header our-modal-header">
            <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title our-modal-title" id="myModalLabel">Adicionar Novo Parâmetro</h4>
        </div>
        <div class="modal-body our-modal-body">
            <!--<div class="forms-parameters-form">-->
            <!-- start ActiveForm -->
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'search_id')->textInput() ?>

            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'require')->checkbox() ?>

            <?= $form->field($model, 'type')->dropDownList(['values_list'=>'Lista de Valores', 'text'=>'Texto Livre'],['prompt' => '---- Select Type of Parameter ----'])  ?>
            
            <?= $form->field($model, 'value_field')->textInput() ?>
            
            <?= $form->field($model, 'description_field')->textInput() ?>

            <?= $form->field($model, 'sqlquery')->textarea(['rows' => 2]) ?>

            <div class="modal-footer our-modal-footer">
                <div class="form-group our-form-group">
                    <!--<div class="form-group">-->
                    <?= Html::submitButton($model->isNewRecord ? 'Aplicar Alterações' : 'Guardar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
