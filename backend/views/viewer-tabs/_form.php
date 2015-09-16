<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\Tools;

/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabs */
/* @var $form yii\widgets\ActiveForm */
$dataProviderTools = new ActiveDataProvider([
    'query' => $model->getTools(),
        ]);
?>

<div class="viewer-tabs-form">
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Ferramentas</a></li>
            <?php } ?> 
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?php $form = ActiveForm::begin(); ?>

                <?php
                if ($model->isNewRecord) {
                    echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
                } else {
                    echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
                }
                ?>

                <?= $form->field($model, 'code')->textInput() ?>

                <?= $form->field($model, 'name')->textInput() ?>
            </div>
            <div id="yw0_tab_2" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddTools();']); ?>
                <div class="modal fade" id="tabs_tools_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddTools() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=viewer-tabs-tools/create&tabs_id=<?php echo $_GET["id"] ?>&viewer_id=<?php $model->viewer_id ?>',
                            success: function (data)
                            {
                                $('#tabs_tools_model').html(data);
                                $('#tabs_tools_model').modal();
                            }
                        });
                    }
                </script>

                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderTools,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [
                            'attribute' => 'tools_id',
                            'label' => 'Ferramenta',
                            'format' => 'text', //raw, html
                            'content' => function($data) {
                                return Tools::find()->where("id=".$data->tools_id)->one()->name;
                            }
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderTools, $key, $index) {
                                if ($action === 'update') {
                                    $url = array('viewer-tabs-tools/update', 'id' => $dataProviderTools->id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                                if ($action === 'delete') {
                                    $url = array('viewer-tabs-tools/delete', 'id' => $dataProviderTools->id, 'tabs_id' => $dataProviderTools->tabs_id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                            }],
                            ],
                        ]);
                        ?>

                    </div>
                </div>
            </div>
            <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

                <?php ActiveForm::end(); ?>

</div>
