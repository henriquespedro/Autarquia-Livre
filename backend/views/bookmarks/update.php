<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bookmarks */

$this->title = 'Update Bookmark: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Bookmarks', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title ;
?>
<div class="bookmarks-update">

<?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
