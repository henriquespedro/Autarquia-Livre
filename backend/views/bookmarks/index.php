<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookmarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookmarks';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Bookmarks';
?>
<div class="bookmarks-index">


    <p>
        <?= Html::a('Novo Bookmark', ['create', 'viewer_id' => $_GET['viewer_id']], ['class' => 'btn btn-success']) ?>
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
            //'x_coordinate:ntext',
            // 'y_coordinate:ntext',
            // 'chage_data',
            // 'setOrder',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('bookmarks/update', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('bookmarks/delete', 'id' => $model->id, 'viewer_id' => $model->viewer_id);
                        return $url;
                    }
                }],
        ],
    ]);
    ?>



</div>
