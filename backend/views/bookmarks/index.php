<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookmarksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bookmarks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookmarks-index">


    <p>
        <?= Html::a('Novo Bookmark', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>



</div>
