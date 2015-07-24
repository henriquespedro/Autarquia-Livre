<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Search */

$this->title = 'Atualizar: ' . ' ' . $model->search_name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Pesquisas', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = $model->search_name;
?>
<div class="search-update">
<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>


</div>
