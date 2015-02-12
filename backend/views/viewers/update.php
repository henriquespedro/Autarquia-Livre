<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Viewers */

$this->title = 'Atualizar ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Visualizadores', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Html::encode($this->title);
?>
<div class="viewers-update">

	<!--
    <h1><?= Html::encode($this->title) ?></h1>
	-->
	<div class="row">
        <div class="col-lg-3">
    	<?= $this->render('/menus') ?>
        </div>
        <div class="col-lg-9">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    	</div>
    </div>
    

</div>
