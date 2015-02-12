<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FormsChield */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-chield-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'form_id')->textInput() ?>

    <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqlselect')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqlinsert')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqlupdate')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'sqldelete')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
