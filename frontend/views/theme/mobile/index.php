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
    <nav class="navbar navbar-inverse" role="navigation">
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
            <ul class="nav pull-right navbar-nav" id="top_buttons">

            </ul>
        </div>
    </nav>
</div>
<!--<div class="container-fluid fill">-->
<div class="container-fluid fill">
    <div class="row">
        <div id="panel" class="col-md-3" >
            <div style="width:auto;">
                <ul id="options_list" class="nav nav-tabs">
                    <li class="active" title="Lista de Temas" id="tree_list"><a href="#tree_table" data-toggle="tab"><span class="glyphicon glyphicon-list-alt"></span></a></li>
                    <li title="Legenda" id="legend_list" ><a href="#legend" data-toggle="tab"><span class="glyphicon glyphicon-bookmark"></span> </a></li>
                    <li  title="Opções" id="option_list"><a href="#options" data-toggle="tab"><span class="glyphicon glyphicon-cog"></span></a></li>
                </ul>
                <div id="content_spinner" class="tab-content">
                    <div id="tree_table" class="tab-pane active tree"></div>
                    <div id="legend" class="tab-pane"></div>
                    <div id="options" class="tab-pane"></div>
                </div>
            </div>


        </div>
        <div class="col-md-9" style="height: auto">
            <div id="map" class="map content_border" contextmenu="menu_options">
                <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/map.js'); ?>
                <!--<script src="javascript/map.js" type="text/javascript"></script>-->
                <!-- create the menu -->
                <menu type="context" id="menu_options">
                    <menuitem label="Refresh" onclick="window.location.reload();" icon="ico_reload.png"></menuitem>
                    <menuitem label="Export Map" onclick="exportar_mapa()" icon="ico_export_map.png"></menuitem>
                    <menuitem label="Print" onclick="imprimir_plantas()" icon="ico_print.png"></menuitem>
                    <menuitem label="Open StreetView" onclick="" icon="ico_streetview.png"></menuitem>
                    <menuitem label="Get Informations" onclick="obter_informacoes()" icon="ico_info.png"></menuitem>
                    <menu label="Share on...">
                        <menuitem label="Twitter" icon="ico_twitter.png" onclick="window.open('//twitter.com/intent/tweet?text=' + window.location.href);"></menuitem>
                        <menuitem label="Facebook" icon="ico_facebook.png" onclick="window.open('//facebook.com/sharer/sharer.php?u=' + window.location.href);"></menuitem>
                        <menuitem label="Email This Page" icon="ico_email.png" onclick="window.location = 'mailto:?body=' + window.location.href;"></menuitem>
                    </menu>

                </menu>

            </div>
            <div class="btn-toolbar" style="position:absolute; left: 60px; top:10px" role="toolbar" aria-label="...">
                <div class="btn-group" role="group"><!--data-toggle="button" --> 
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Vista Inicial" onclick="extensao_total()"><span class="glyphicon glyphicon-globe"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Mover Mapa" onclick="arrastar_mapa()"><span class="glyphicon glyphicon-hand-up"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Vista Anterior" onclick="vista_anterior()"><span class="glyphicon glyphicon-arrow-left"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Vista Seguinte" onclick="vista_seguinte()"><span class="glyphicon glyphicon-arrow-right"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Obter Informações" onclick="obter_informacoes()"><span class="glyphicon glyphicon-info-sign"></span>&nbsp;</button>
                    <button class="btn btn-default" type="button" data-placement="bottom" title="Imprimir Planta de Localização" onclick="imprimir_plantas()"><span class="glyphicon glyphicon-print"></span>&nbsp;</button>
                    <div><span class="label label-default">Ação corrente: <span id="corrent_action"></span> </span></div>
                </div>
            </div>
            <!--<button  onclick='removeTopLayer()'>Remove Top Layer</button>-->
        </div>

    </div>
    <div class="row" id="button">

    </div>
</div><!-- /.container-fluid -->
<div id="search_div" hidden></div>
