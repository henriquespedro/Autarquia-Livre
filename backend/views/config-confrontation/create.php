<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ConfigConfrontation */

$this->title = 'Novo configuração';
$this->params['breadcrumbs'][] = ['label' => 'Configurações - Confrontação', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
