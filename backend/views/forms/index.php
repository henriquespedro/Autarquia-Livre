<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FormsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Formulários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forms-index">

    <p>
        <?= Html::a('Novo Formulário', ['create'], ['class' => 'btn btn-success']) ?>
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>

</div>
