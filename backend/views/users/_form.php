<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\models\UsersGroup;
use app\models\Group;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$dataProviderGroups = new ActiveDataProvider([
    'query' => $model->getGroups(),
        ]);
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="container" style="width:auto;">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            <li class="active"><a href="#yw0_tab_1" data-toggle="tab">Informação Geral</a></li>
            <?php if (!$model->isNewRecord) { ?>
                <li><a href="#yw0_tab_2" data-toggle="tab">Grupo</a></li>
            <?php } ?> 
        </ul>
        <div id="my-tab-content" class="tab-content">
            <div id="yw0_tab_1" class="tab-pane active in">
                <?= $form->field($model, 'name')->textinput() ?>

                <?= $form->field($model, 'username')->textinput() ?>
                <?php if ($model->isNewRecord) { ?>
                <?= $form->field($model, 'password')->passwordinput() ?>
                <?php } ?> 
                <?= $form->field($model, 'email')->textinput() ?>

            </div>

            <div id="yw0_tab_2" class="tab-pane">
                <?= Html::button('Novo', [ 'class' => 'btn btn-success', 'onclick' => 'AddGroups();']); ?>
                <div class="modal fade" id="parameters_model" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"></div>

                <script>
                    function AddGroups() {
                        $.ajax({
                            type: 'POST',
                            url: 'index.php?r=users-group/create&id_user=<?php echo $model->id ?>',
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
                    'dataProvider' => $dataProviderGroups,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'id_group:ntext',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{update} {delete}',
                            'urlCreator' => function ($action, $dataProviderGroups, $key, $index) {
                                if ($action === 'delete') {
                                    $url = array('users-group/delete', 'id' => $dataProviderGroups->id, 'id_user' => $dataProviderGroups->id_user);
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
