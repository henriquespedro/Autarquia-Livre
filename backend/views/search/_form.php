<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\Datasources;
use app\models\Users;

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
                <?php
                if ($model->isNewRecord) {
                    echo $form->field($model, 'viewer_id')->hiddenInput(array('value' => $_GET['viewer_id']))->label(false);
                } else {
                    echo $form->field($model, 'viewer_id')->hiddenInput()->label(false);
                }
                ?>
                <?= $form->field($model, 'search_name')->textInput() ?>

                <?= $form->field($model, 'description')->textInput() ?>

                <?= $form->field($model, 'visible')->checkbox() ?>
                
                <?= $form->field($model, 'datasource_id')->dropDownList(ArrayHelper::map(Datasources::find()->all(), 'id', 'name')) ?>
                
                <?= $form->field($model, 'sql_search')->textarea(['rows' => 3]) ?>
            </div>
            <div id="yw0_tab_2" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddParameters();']); ?>
                <div class="modal fade" id="parameters_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddParameters() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=search-parameters/create&search_id=<?php echo $_GET["id"]?>&viewer_id=<?php $model->viewer_id ?>',
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
                        'name:ntext',
                        'type:ntext',
                        // 'setOrder',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderParameters, $key, $index) {
                                if ($action === 'update') {
                                    $url = array('search-parameters/update', 'id' => $dataProviderParameters->id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                                if ($action === 'delete') {
                                    $url = array('search-parameters/delete', 'id' => $dataProviderParameters->id, 'search_id'=> $dataProviderParameters->search_id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                            }],
                            ],
                        ]);
                        ?>
                    </div>

                    <div id="yw0_tab_3" class="tab-pane">
                        <?php $dataList = ArrayHelper::map(Users::find()->asArray()->all(), 'id', 'username'); ?>
                        
                    </div>
                </div>
            </div>

            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Guardar' : 'Aplicar Alterações', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>

            <?php ActiveForm::end(); ?>

</div>
