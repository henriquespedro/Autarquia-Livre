<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Layers */

$this->title = 'Update Layers: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Layers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="layers-update">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
