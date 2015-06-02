<?php
/*
 * Copyright (C) 2015 Autarquia-Livre
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */
?>
<div>
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!--        <div>
                    <a class="navbar-brand" id="site_name" href="#"></a>
                </div>-->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_options">
                <span class="sr-only">Ferramentas</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="site_name" href="#"></a>

        </div>
        <div class="collapse navbar-collapse top" id="top_options">
            <ul class="nav navbar-nav">
                <div class="container" style="width:auto;">
                    <ul id="top_tabs" class="nav nav-tabs" data-tabs="tabs">

                    </ul>
                    <div id="content_tabs" class="tab-content">

                    </div>
                </div>
            </ul>
        </div>
    </nav>
</div>
<!--<div class="container-fluid fill">-->
<div class="container-fluid fill">
    <div class="row">
        <div id="panel" class="col-md-2 " >
            <div style="width:auto;">
                <ul class="nav nav-tabs">
                    <li class="active" title="Lista de Temas"><a href="#tree_table" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span></a></li>
                    <li title="Legenda"><a href="#legend" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> </a></li>
                    <li  title="Opções"><a href="#options" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
                </ul>
                <div id="content_spinner" class="tab-content">
                    <div id="tree_table" class="tab-pane active tree"></div>
                    <div id="legend" class="tab-pane"></div>
                    <div id="options" class="tab-pane"></div>
                </div>
            </div>


        </div>
        <div class="col-md-10">
            <div id="map" class="map content_border" >
                <?php // $this->registerJsFile(Yii::$app->request->baseUrl.'/../javascript/map.js'); ?>
                <script src="javascript/map.js" type="text/javascript"></script>
            </div>
        </div>

    </div>
    <div class="row" id="button">
        
    </div>
</div><!-- /.container-fluid -->