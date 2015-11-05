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

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#top_options">
                <span class="sr-only">Ferramentas</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" id="site_name" href="#"></a>

        </div>
        <div class="collapse navbar-collapse" id="top_options">
            <div class="navbar-form navbar-right" id="top_tabs" >
                <button class="btn btn-info" onclick="add_sugestao()" id="bt_registar_ocorrencia">Registar Sugestão</button>
                <div class="form-group">
                    <input type="text" class="form-control" id="codigo_ocorrencia" placeholder="Código da Ocorrência">
                </div>
                <button class="btn btn-success" id="bt_search_ocorrencias">Pesquisar</button>

            </div>
        </div>
    </nav>
</div>
<div class="container-fluid fill">
    <div class="row">

        <div class="col-md-12"  id="map_panel">
            <div id="map" style="height: 93vh" class="map content_border" contextmenu="menu_options">
                <?php $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/map.js'); ?>
                <!-- create the menu -->
                <menu type="context" id="menu_options">
                    <menuitem label="Refresh" onclick="window.location.reload();" icon="ico_reload.png"></menuitem>
                    <menuitem label="Open StreetView" onclick="streetview()" icon="ico_streetview.png"></menuitem>
                    <menu label="Share on...">
                        <menuitem label="Twitter" icon="ico_twitter.png" onclick="window.open('//twitter.com/intent/tweet?text=' + window.location.href);"></menuitem>
                        <menuitem label="Facebook" icon="ico_facebook.png" onclick="window.open('//facebook.com/sharer/sharer.php?u=' + window.location.href);"></menuitem>
                        <menuitem label="Email This Page" icon="ico_email.png" onclick="window.location = 'mailto:?body=' + window.location.href;"></menuitem>
                    </menu>

                </menu>

            </div>
            <div class="btn-toolbar" style="position:absolute; left: 60px; top:10px" role="toolbar" aria-label="...">
                <div class="btn-group" role="group"><!--data-toggle="button" --> 
                    <button class="btn btn-default_toolbar" id="btn_vista_inicial" type="button" data-placement="bottom" title="Vista Inicial" onclick="extensao_total()"><span class="glyphicon glyphicon-globe"></span>&nbsp;</button>
                    <button class="btn btn-default_toolbar" type="button" data-placement="bottom" title="Mover Mapa" onclick="arrastar_mapa()"><span class="glyphicon glyphicon-hand-up"></span>&nbsp;</button>
                    <button class="btn btn-default_toolbar" type="button" data-placement="bottom" title="Aproximar Mapa" onclick="aproximar_map()"><span class="glyphicon glyphicon-zoom-in"></span>&nbsp;</button>
                    <button class="btn btn-default_toolbar" type="button" data-placement="bottom" title="Afastar Mapa" onclick="afastar_map()"><span class="glyphicon glyphicon-zoom-out"></span>&nbsp;</button>
                    <select class="btn btn-default_toolbar form-control" data-placement="bottom" id="select_scales" style="width: 110px">
                    </select>
                    <div><span class="label label-default">Ação corrente: <span id="corrent_action"></span> </span></div>
                </div>
            </div>
            <div id="mouse_coordinates_text" class="mouse_coordinates_text">
                <p style="margin: -2px 0px 2px"><font size="1"><b>&nbsp;ETRS89 / Portugal TM06 </b></font><span id="mouse3763" class="label label-info">0 / 0</span><font size="1"><b> WGS84 </b></font><span id="mouse4326" class="label label-info">0 / 0</span><font size="1"><b> WGS84 Degrees Minutes Seconds (DMS) </b></font><span id="mouse4326_hdms" class="label label-info">0 / 0</span></p>
            </div>

        </div>

    </div>
    <div class="row" id="button">

    </div>
</div><!-- /.container-fluid -->
<div id="search_div" hidden></div>
<div id="streetview_div" title="Google StreetView"></div>
<div id="formularios_div" title=""></div>
<div id="modal_sugestoes"></div>

<div class="modal fade"  id="modal_sugestoes_info" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width: auto;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <p class="modal-title" id="myModal_info_search_lLabel" style="font-family:Helvetica; font-size:x-large; color:#0099CC; font-weight:bold;"><span id="codigo_ocorrencia_view"></span> - <span id="situacao_ocorencia_view"></span></p>
                <span style="font-family:Helvetica; font-size:large; color:#0099CC; font-weight:bold;"  id="categoria_ocorrencias_view"></span>
            </div>
            <div class="modal-body" id="myModal_info_search">
                <table>
                    <tbody>
                        <tr>
                            <td> <p style="font-family:Helvetica; font-size:12px; font-weight:bold; color: gray;">Coordenadas: <span style="font-family: Helvetica Neue; font-size: 12px; font-weight: normal; color: #555" id="coordenadas_ocorrencias_view"></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td  width="550px"  style="max-width: 550px"> 
                                <p style="font-family:Helvetica; font-size:12px; font-weight:bold; color: gray;">Descrição:</p>
                                <textarea class="form-control input-sm" rows="4" cols="15" style="max-width: 550px; background-color: #FFF" id="descricao_ocorrencia_view" readonly></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td> 
                                <br>
                                <p style="font-family:Helvetica; font-size:12px; font-weight:bold; color: gray;">Data Registo: <span style="font-family: Helvetica Neue; font-size: 12px; font-weight: normal; color: #555" id="data_registo_ocorrencias_view"></span></p>
                            </td>
                        </tr>
                        <tr>
                            <td> <p style="font-family:Helvetica; font-size:12px; font-weight:bold; color: gray;">Data Ultima Atualização: <span style="font-family: Helvetica Neue; font-size: 12px; font-weight: normal; color: #555" id="ultima_atualizacao_ocorrencias_view"></span></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


