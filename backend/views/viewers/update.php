<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Viewers */
$this->title = 'Atualizar ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $model->id, 'viewer_id' => $model->id)];
$this->params['breadcrumbs'][] = $model->description;

?>
<div class="viewers-update">

    <!--
<h1><?= Html::encode($this->title) ?></h1>
    -->


    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>





</div>
