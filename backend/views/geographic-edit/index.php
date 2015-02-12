<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\GeographicEditSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Edição Geográfica';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="geographic-edit-index">


    <div class="row">
        <div class="col-lg-3">
        <?= $this->render('/menus') ?>
        </div>
        <div class="col-lg-9">
        
        <p>
            <?= Html::a('Nova Layer', ['create'], ['class' => 'btn btn-success']) ?>
        </p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    //'id',
                    //'viewer_id',
                    'name:ntext',
                    'layer:ntext',
                    //'type:ntext',
                    // 'chage_data',
                    // 'setOrder',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>
