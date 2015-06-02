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
<div id="locate_coordinates">
    <label for="coordinates_systems">Sistema de Coordenadas</label>
    <select name="coordinates_systems" id="coordinates_systems" class="form-control">
        <option value="3763">ETRS89 / Portugal TM06</option>
        <option value="27493">Datum 73 Hayford Gauss IPCC</option>
        <option value="102165">Lisboa Hayford Gauss IPCC</option>
        <option value="102164">Lisboa Hayford Gauss IGeoE</option>
        <option value="4326">WGS 84</option>
    </select><hr>
    <div>
        <input type="hidden" id="get_coordinates">
        <label for="coordinate_x">X: </label>
        <input type="text" name="coordinate_x" id="coordinate_x" class="form-control"><br>
        <label for="coordinate_y">Y: </label>
        <input type="text" name="coordinate_y" id="coordinate_y" class="form-control"><br>
    </div><hr>
    <!--<button type="button" class="btn btn-primary" name="cancel" id="cancel">Cancelar</button>-->
    <button type="button" class="btn btn-primary" name="locate" id="locate">Localizar</button>
</div>

<script>
    $("#locate").on("click", function (event) {

        var coordinates_bbox = [parseFloat($("#coordinate_x").val()), parseFloat($("#coordinate_y").val())];
        var position;
        if (coordinates_bbox === '') {
            alert('Não é possível ir para o local pretendido')
        } else {
            if ('EPSG:' + $("#coordinates_systems").val() === view_projection) {
                position = coordinates_bbox;
                map.getView().setCenter(position);
            } else {
                position = ol.proj.transform(coordinates_bbox, 'EPSG:' + $("#coordinates_systems").val(), view_projection);
                map.getView().setCenter(position);
            }
            map.getOverlays().clear();
            map.addOverlay(new ol.Overlay({
                position: position,
                element: $('<img src="../images/marker.png">')
            }));
            map.getView().setZoom(15);
        }
    });
</script>