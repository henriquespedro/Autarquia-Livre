<?php
            use kartik\sidenav\SideNav; 
            
            echo SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'heading' => 'Opções',
                'encodeLabels' => false,
                'items' => [
                    ['label' => 'Permissões', 'icon' => 'user', 'url' => Yii::$app->urlManager->createUrl('viewer-group/index')],
                    ['label' => 'Layers', 'icon' => 'book', 'url' => Yii::$app->urlManager->createUrl('layers/index')],
                    ['label' => 'Pesquisas', 'icon' => 'search', 'url' => Yii::$app->urlManager->createUrl('search/index')],
                    ['label' => 'Impressão', 'icon' => 'tags', 'url' => Yii::$app->urlManager->createUrl('print/index')],
                    ['label' => 'Edição Geográfica', 'icon' => 'tags', 'url'=>Yii::$app->urlManager->createUrl('geographic-edit/index')],
                    ['label' => 'Formulários', 'icon' => 'tags', 'url'=>Yii::$app->urlManager->createUrl('forms/index')],
                    ['label' => 'Bookmarks', 'icon' => 'tags', 'url'=>Yii::$app->urlManager->createUrl('bookmarks/index')],
                    [
                        'label' => 'Módulos',
                        'icon' => 'question-sign',
                        'items' => [
                            ['label' => 'Confrontação', 'icon' => 'tags', 'items'=> [
                                ['label' => 'Configuração', 'url'=>Yii::$app->urlManager->createUrl('config-confrontation/index')],
                                ['label' => 'Planos', 'url'=>Yii::$app->urlManager->createUrl('layers-confrontation/index')],
                            ]],
                        ],
                    ],
                    [
                        'label' => 'Histórico',
                        'icon' => 'tags',
                        'items' => [
                            ['label' => 'Edições (em desenvolvimento)', 'url'=>Yii::$app->urlManager->createUrl('edit_history/index')],
                            ['label' => 'Impressões (em desenvolvimento)', 'url'=>Yii::$app->urlManager->createUrl('print_history/index')],
                        ],
                    ],
                ],
            ]);
        ?>