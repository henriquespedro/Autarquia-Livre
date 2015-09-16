<?php

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Administração',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => 'Utilizadores', 'visible' => !Yii::$app->user->isGuest, 'items' => [
                        ['label' => 'Utilizadores', 'url' => Yii::$app->urlManager->createUrl('users/index')],
                        ['label' => 'Grupos', 'url' => Yii::$app->urlManager->createUrl('group/index')],
                    ]],
                ['label' => 'Parâmetros', 'visible' => !Yii::$app->user->isGuest, 'items' => [
                        ['label' => 'Sistemas de Coordenadas', 'url' => ['/param-coordinates/index']],
                        ['label' => 'Formato Layers', 'url' => ['/param-format/index']],
                        ['label' => 'Servidores', 'url' => ['/param-server/index']],
                        ['label' => 'Ferramentas', 'url' => ['/tools/index']],
                    ]],
                ['label' => 'Configurações', 'visible' => !Yii::$app->user->isGuest, 'items' => [
                        ['label' => 'Aplicação', 'url' => ['/appoptions/view', 'id' => '1']],
                        ['label' => 'Fonte de dados', 'url' => ['/datasources/index']],
                        ['label' => 'Administradores', 'url' => ['/admin-users/index']],
                    ]],
            ];
            if (Yii::$app->user->isGuest) {
                $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
            } else {
                $menuItems[] = [
                    'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                    'linkOptions' => ['data-method' => 'post']
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">

                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <div class="row">
                    <div class="col-lg-3">
                        <?= $this->render('/menus') ?>
                    </div>
                    <div class="col-lg-9">
                        <?= $content ?>
                    </div>
                </div>



            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; Autarquia Livre <?= date('Y') ?></p>
                <!-- <p class="pull-right"><?= Yii::powered() ?></p> -->
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
