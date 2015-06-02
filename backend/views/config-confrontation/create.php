<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConfigConfrontation */

$this->title = 'Novo configuração';
$this->params['breadcrumbs'][] = ['label'=>'Visualizador', 'url'=> array('viewers/update', 'id'=> $_GET['viewer_id'], 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = ['label'=>'Configuração - Confrontações', 'url'=> array('index', 'viewer_id' => $_GET['viewer_id'])];
$this->params['breadcrumbs'][] = 'Nova';
?>
<div class="config-confrontation-create">

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
