<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = 'Update Layers: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Lista de Layers', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="layers-update">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
