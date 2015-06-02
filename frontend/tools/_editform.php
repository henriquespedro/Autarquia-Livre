<?php
/*
 * Copyright (C) 2015 cm0721
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

<div class="btn-toolbar" role="toolbar" aria-label="...">
    <label for="edit_layers">Layer para Edição:</label>
    <select name="edit_layers" id="edit_layers" class="form-control">
<!--        <option value="geoserver" class="all_layers">GeoServer</option>
        <option value="mapserver" class="all_layers">MapServer</option>
        <option value="qgis" class="all_layers">QGIS Server</option>
        <option value="arcgis" class="all_layers">ArcGIS Server</option>-->
    </select>
    <hr>

    <div class="btn-group" role="group" id="btn_group_operations">
        <button class="btn btn-default" id="btn_selecionar_elemento" type="button" data-placement="bottom" title="Selecionar Elemento" ><span class="glyphicon glyphicon-hand-up"></span>&nbsp;</button>
        <button class="btn btn-default" id="btn_novo_elemento" type="button" data-placement="bottom" title="Novo Elemento" ><span class="glyphicon glyphicon-edit"></span>&nbsp;</button>
        <button class="btn btn-default" id="btn_editar_elemento" type="button" data-placement="bottom" title="Editar Elemento" ><span class="glyphicon glyphicon-move"></span>&nbsp;</button>
        <button class="btn btn-default" id="btn_apagar_elemento" type="button" data-placement="bottom" title="Apagar Elemento" ><span class="glyphicon glyphicon-trash"></span>&nbsp;</button>
        <button class="btn btn-default" id="btn_abrir_tabela" type="button" data-placement="bottom" title="Abrir Tabela" ><span class="glyphicon glyphicon-folder-open"></span>&nbsp;</button>
        <button class="btn btn-default" id="btn_abrir_tabela" type="button" data-placement="bottom" title="Guardar Alterações" ><span class="glyphicon glyphicon-floppy-saved"></span>&nbsp;</button>
    </div>
</div>