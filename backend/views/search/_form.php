<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Search */
/* @var $form yii\widgets\ActiveForm */
/* @var $dataProvider yii\data\ActiveDataProvider */


$dataProviderParameters = new ActiveDataProvider([
    'query' => $model->getParameters(),
        ]);
?>

<div class="search-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- <?= $form->field($model, 'viewer_id')->textInput() ?> -->
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Parâmetros de Pesquisa</a></li>
            <?php } ?> 
            <li><a href="#yw0_tab_3" data-toggle="tab">Permissões</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'description')->textInput() ?>

                <?= $form->field($model, 'visible')->checkbox() ?>

                <?= $form->field($model, 'sql_search')->textarea(['rows' => 3]) ?>
            </div>
            <div id="yw0_tab_2" class="tab-pane">
                <?php
                ?>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderParameters,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'name:ntext',
                        'type:ntext',
                        // 'setOrder',
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]);
                ?>
            </div>

            <div id="yw0_tab_3" class="tab-pane">

            </div>
        </div>
    </div>

    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
