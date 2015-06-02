<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = 'Adicionar Layer';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Lista de Layers', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Nova';
?>
<div class="layers-create">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
