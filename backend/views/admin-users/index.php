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
            //'password:ntext',
            //'create_date',
            'last_login',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>