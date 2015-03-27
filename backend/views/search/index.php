<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SearchSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Searches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-index">
            <p>
                <?= Html::a('Nova Pesquisa', ['create'], ['class' => 'btn btn-success']) ?>
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
                    //'sql_search:ntext',
                    // 'visible:boolean',
                    // 'chage_data',
                    // 'setOrder',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]);
            ?>
 


</div>
