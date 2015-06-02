<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GeographicEdit */

$this->title = 'Atualizar Editar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->viewer_id, 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = ['label'=>'Edição Geográfica', 'url'=> array('index', 'viewer_id' => $model->viewer_id)];
$this->params['breadcrumbs'][] = $model->name;
?>
<div class="geographic-edit-update">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
