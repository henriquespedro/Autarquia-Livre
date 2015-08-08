<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\UsersGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="modal-dialog our-modal-dialog">
    <div class="modal-content">
        <div class="modal-header our-modal-header">
            <button type="button" class="close" data-dismiss="modal" ><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title our-modal-title" id="myModalLabel">Adicionar Novo Parâmetro</h4>
        </div>
        <div class="modal-body our-modal-body">

            <?php $form = ActiveForm::begin(); ?>
            
            <?= $form->field($model, 'id_user')->hiddenInput(array('value' => $_GET['id_user']))->label(false) ?>
            
            <?php $groups = ArrayHelper::map(Group::find()->all(), 'id', 'group'); ?>
            <?= $form->field($model, 'id_group')->dropDownList($groups) ?>

            <div class="modal-footer our-modal-footer">
                <div class="form-group our-form-group">
                    <!--<div class="form-group">-->
                    <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
