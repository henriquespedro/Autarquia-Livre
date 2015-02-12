<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ViewerGroup */

$this->title = 'Adicionar Grupo ao Visualizador';
$this->params['breadcrumbs'][] = ['label' => 'Permissões Visualizador', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewer-group-create">

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
