<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */
/* @var $form yii\widgets\ActiveForm */
?>

<!--Adicionado Para o Ajax Model-->
<!-- modal dialog for display pop up login -->
<div class="modal-dialog our-modal-dialog">
    <div class="modal-content">
        <div class="modal-header our-modal-header">
            <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title our-modal-title" id="myModalLabel">Adicionar Escala</h4>
        </div>
        <div class="modal-body our-modal-body">
            <!--<div class="forms-parameters-form">-->
            <!-- start ActiveForm -->
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'maprint_id')->hiddenInput(array('value' => $_GET['maprint_id']))->label(false) ?>
            
            <?= $form->field($model, 'label')->textInput() ?>
            
            <?= $form->field($model, 'scale')->textInput() ?>

            <div class="modal-footer our-modal-footer">
                <div class="form-group our-form-group">
                    <!--<div class="form-group">-->
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
