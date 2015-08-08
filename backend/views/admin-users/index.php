<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminUsersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Administradores Locais';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-users-index">

    <p>
        <?= Html::a('Novo Administrador', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'username:ntext',
            'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'update') {
                        $url = array('update', 'id' => $model->id);
                        return $url;
                    }
                    if ($action === 'delete') {
                        $url = array('delete', 'id' => $model->id);
                        return $url;
                    }
                }],
        ],
    ]); ?>

</div>
