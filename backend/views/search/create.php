<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Search */

$this->title = 'Nova Pesquisa';
$this->params['breadcrumbs'][] = ['label' => 'Pesquisas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="search-create">

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>
</div>
