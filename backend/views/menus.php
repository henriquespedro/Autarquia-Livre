<?php
            use kartik\sidenav\SideNav; 

            
            echo SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'heading' => 'Opções',
                'encodeLabels' => false,
                'items' => [
                    ['label' => 'Permissões', 'icon' => 'user', 'url' => array('viewer-group/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Layers', 'icon' => 'book', 'url' => array('layers/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Pesquisas', 'icon' => 'search', 'url' => array('search/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Impressão', 'icon' => 'tags', 'url' => array('print/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Edição Geográfica', 'icon' => 'tags', 'url'=> array('geographic-edit/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Formulários', 'icon' => 'tags', 'url'=> array('forms/index', 'viewer_id' => $_GET['viewer_id'])],
                    ['label' => 'Bookmarks', 'icon' => 'tags', 'url'=> array('bookmarks/index', 'viewer_id' => $_GET['viewer_id'])],
                    [
                        'label' => 'Módulos',
                        'icon' => 'question-sign',
                        'items' => [
                            ['label' => 'Confrontação', 'icon' => 'tags', 'items'=> [
                                ['label' => 'Configuração', 'url'=> array('config-confrontation/index', 'viewer_id' => $_GET['viewer_id'])],
                                ['label' => 'Planos', 'url'=> array('layers-confrontation/index', 'viewer_id' => $_GET['viewer_id'])],
                            ]],
                        ],
                    ],
                    [
                        'label' => 'Histórico',
                        'icon' => 'tags',
                        'items' => [
                            ['label' => 'Edições (em desenvolvimento)', 'url'=> array('edit_history/index', 'viewer_id' => $_GET['viewer_id'])],
                            ['label' => 'Impressões (em desenvolvimento)', 'url'=>array('print_history/index', 'viewer_id' => $_GET['viewer_id'])],
                        ],
                    ],
                ],
            ]);
        ?>