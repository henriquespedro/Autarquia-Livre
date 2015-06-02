<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formulários';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Formulários';
?>
<div class="forms-index">

    <p>
        <?= Html::a('Novo Formulário', ['create', 'viewer_id' => $_GET['viewer_id'],'id' => ''], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            //'viewer_id',
            'name:ntext',
            'description:ntext',
            'html_template:ntext',
            // 'sql_select:ntext',
            // 'sql_insert:ntext',
            // 'sql_update:ntext',
            // 'sql_delete:ntext',
            // 'icon:ntext',
            // 'chage_data',
            // 'setOrder',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('forms/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('forms/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
        ],
    ]);
    ?>

</div>
