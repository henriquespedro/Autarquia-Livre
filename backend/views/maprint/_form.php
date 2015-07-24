<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Maprint */
/* @var $form yii\widgets\ActiveForm */

$dataProviderScales = new ActiveDataProvider([
    'query' => $model->getMaprintScales(),
        ]);
$dataProviderLayouts = new ActiveDataProvider([
    'query' => $model->getMaprintLayouts(),
        ]);
?>

<div class="maprint-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Layout's</a></li>
                <li><a href="#yw0_tab_3" data-toggle="tab">Escalas</a></li>
            <?php } ?> 
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

                <?= $form->field($model, 'description_font')->textInput() ?>

                <?= $form->field($model, 'layer')->textInput() ?>

                <?= $form->field($model, 'chage_data')->hiddenInput()->label(false) ?>

                <?= $form->field($model, 'setOrder')->hiddenInput()->label(false) ?>
            </div>
            <div id="yw0_tab_2" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddLayout();']); ?>
                <div class="modal fade" id="layout_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddLayout() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=maprint-layouts/create&maprint_id=<?php echo $_GET["id"] ?>&viewer_id=<?php $model->viewer_id ?>',
                            success: function (data)
                            {
                                $('#layout_model').html(data);
                                $('#layout_model').modal();
                            }
                        });
                    }
                </script>
                <?=
                GridView::widget([
                    'dataProvider' => $dataProviderLayouts,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'label:ntext',
                        'layout:ntext',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderLayouts, $key, $index) {
                                if ($action === 'update') {
                                    $url = array('maprint-layouts/update', 'id' => $dataProviderLayouts->id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                                if ($action === 'delete') {
                                    $url = array('maprint-layouts/delete', 'id' => $dataProviderLayouts->id, 'maprint_id' => $dataProviderLayouts->maprint_id, 'viewer_id' => $_GET['viewer_id']);
                                    return $url;
                                }
                            }],
                            ],
                        ]);
                        ?>
                    </div>
                    <div id="yw0_tab_3" class="tab-pane">
                        <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddScale();']); ?>
                        <div class="modal fade" id="scales_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                        <script>
                            function AddScale() {
                                $.ajax({
                                    type: 'POST',
                                    url: 'index.php?r=maprint-scales/create&maprint_id=<?php echo $_GET["id"] ?>&viewer_id=<?php $model->viewer_id ?>',
                                    success: function (data)
                                    {
                                        $('#scales_model').html(data);
                                        $('#scales_model').modal();
                                    }
                                });
                            }
                        </script>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProviderScales,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'label:ntext',
                                'scale:ntext',
                                [
                                    'class' => 'yii\grid\ActionColumn',
                                    'template' => '{update} {delete}',
                                    'urlCreator' => function ($action, $dataProviderScales, $key, $index) {
                                        if ($action === 'update') {
                                            $url = array('maprint-scales/update', 'id' => $dataProviderScales->id, 'viewer_id' => $_GET['viewer_id']);
                                            return $url;
                                        }
                                        if ($action === 'delete') {
                                            $url = array('maprint-scales/delete', 'id' => $dataProviderScales->id, 'maprint_id' => $dataProviderScales->maprint_id, 'viewer_id' => $_GET['viewer_id']);
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
