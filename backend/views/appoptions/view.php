<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Appoptions */

$this->title = 'Atualizar configurações da aplicação';
//$this->params['breadcrumbs'][] = ['label' => 'Appoptions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="appoptions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'server_url:url',
            'manual_url:url',
            'proxy',
            'domain',
            'ldap',
            'ldap_port',
            'smtp_host',
            'smtp_port',
            'smtp_username',
            'smtp_password',
        ],
    ]) ?>
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <!--<?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?> -->
    </p>

</div>
