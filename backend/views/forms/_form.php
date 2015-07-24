<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Datasources;
use app\models\Users;

/* @var $this yii\web\View */
/* @var $model app\models\Forms */
/* @var $form yii\widgets\ActiveForm */

$dataProviderParameters = new ActiveDataProvider([
    'query' => $model->getParameters(),
        ]);

$dataProviderChield = new ActiveDataProvider([
    'query' => $model->getChield(),
        ]);
?>

<div class="forms-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Parâmetros de Pesquisa</a></li>
                <li><a href="#yw0_tab_3" data-toggle="tab">Fichas Filho</a></li>
            <?php } ?> 
            <li><a href="#yw0_tab_4" data-toggle="tab">Edição</a></li>
            <li><a href="#yw0_tab_5" data-toggle="tab">Permissões</a></li>
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?php
                if ($model->isNewRecord) {
                    echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
                } else {
                    echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
                }
                ?>

                <?= $form->field($model, 'name')->textInput() ?>

                <?= $form->field($model, 'description')->textInput() ?>

                <?= $form->field($model, 'html_template')->textInput() ?>

                <?= $form->field($model, 'icon')->textInput() ?>
                
                <?php $items_format = ArrayHelper::map(Datasources::find()->all(), 'id', 'name'); ?>
                <?= $form->field($model, 'datasource_id')->dropDownList($items_format) ?>

                <?= $form->field($model, 'sql_select')->textarea(['rows' => 3]) ?>

            </div>

            <div id="yw0_tab_2" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddParameters();']); ?>
                <div class="modal fade" id="parameters_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddParameters() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=forms-parameters/create&form_id=<?php echo $_GET["id"]?>&viewer_id=<?php $model->viewer_id ?>',
                            success: function (data)
                            {
                                $('#parameters_model').html(data);
                                $('#parameters_model').modal();
                            }
                        });
                    }
                </script>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderParameters,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'label:ntext',
                        'type:ntext',
                        'parameter:ntext',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderParameters, $key, $index) {
                                if ($action === 'update') {
                                    $url = array('forms-parameters/update', 'id' => $dataProviderParameters->id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                                if ($action === 'delete') {
                                    $url = array('forms-parameters/delete', 'id' => $dataProviderParameters->id, 'form_id'=> $dataProviderParameters->form_id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                            }],
                    ],
                ]);
                ?>
            </div>

            <div id="yw0_tab_3" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddChield();']); ?>
                <div class="modal fade" id="chield_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddChield() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=forms-chield/create&form_id=<?php echo $_GET["id"]?>&viewer_id=<?php $model->viewer_id ?>',
                            success: function (data)
                            {
                                $('#chield_modal').html(data);
                                $('#chield_modal').modal();
                            }
                        });
                    }
                </script>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderChield,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        //'id',
                        'template:ntext',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderChield, $key, $index) {
                                if ($action === 'update') {
                                    $url = array('forms-chield/update', 'id' => $dataProviderChield->id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                                if ($action === 'delete') {
                                    $url = array('forms-chield/delete', 'id' => $dataProviderChield->id, 'form_id'=> $dataProviderChield->form_id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                            }],
                    ],
                ]);
                ?>
            </div>

            <div id="yw0_tab_4" class="tab-pane">
                <?= $form->field($model, 'sql_insert')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'sql_update')->textarea(['rows' => 3]) ?>

                <?= $form->field($model, 'sql_delete')->textarea(['rows' => 3]) ?>
            </div>

            <div id="yw0_tab_5" class="tab-pane">
                <?php $dataList = ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'); ?>
                
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
