<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Group;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="viewer-group-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_viewer')->textInput() ?>

    <?php $items = ArrayHelper::map(Group::find()->all(), 'id', 'description'); ?>
    <?= $form->field($model, 'id_group')->dropDownList($items,['prompt' => '---- Select Group ----'])  ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
