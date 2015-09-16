<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ViewerTabsTools */

$this->title = 'Create Viewer Tabs Tools';
$this->params['breadcrumbs'][] = ['label' => 'Viewer Tabs Tools', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="viewer-tabs-tools-create">


    <?= $this->render('_create', [
        'model' => $model,
    ]) ?>

</div>
