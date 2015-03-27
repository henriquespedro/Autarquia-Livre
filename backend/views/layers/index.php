<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LayersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Layers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="layers-index">


    <p>
        <?= Html::a('Nova Layer', ['create'], ['class' => 'btn btn-success']) ?>
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
            'layer:ntext',
            //'layer_type:ntext',
            // 'visible:boolean',
            // 'show_toc:boolean',
            // 'opacity',
            // 'crs:ntext',
            // 'style:ntext',
            // 'serverType:ntext',
            'type:ntext',
            // 'icon:ntext',
            // 'chage_data',
            // 'setOrder',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>


</div>
