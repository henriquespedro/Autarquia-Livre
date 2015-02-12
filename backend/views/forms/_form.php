<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="forms-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
           <?php if (!$model ->isNewRecord) { ?>
            <li><a href="#yw0_tab_2" data-toggle="tab">Parâmetros de Pesquisa</a></li>
            <li><a href="#yw0_tab_3" data-toggle="tab">Fichas Filho</a></li>
            <?php } ?> 
            <li><a href="#yw0_tab_4" data-toggle="tab">Edição</a></li>
            <li><a href="#yw0_tab_5" data-toggle="tab">Permissões</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?= $form->field($model, 'viewer_id')->textInput() ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'description')->textInput() ?>

                <?= $form->field($model, 'html_template')->textInput() ?>

                <?= $form->field($model, 'icon')->textInput() ?>

                <?= $form->field($model, 'sql_select')->textarea(['rows' => 3]) ?>

            </div>

            <div id="yw0_tab_2" class="tab-pane">

            </div>

            <div id="yw0_tab_3" class="tab-pane">

            </div>

            <div id="yw0_tab_4" class="tab-pane">
                <?= $form->field($model, 'sql_insert')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'sql_update')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'sql_delete')->textarea(['rows' => 3]) ?>
            </div>

            <div id="yw0_tab_5" class="tab-pane">

            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
