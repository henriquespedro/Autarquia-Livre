<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Search */

$this->title = 'Atualizar: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Pesquisas', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-update">
<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>


</div>
