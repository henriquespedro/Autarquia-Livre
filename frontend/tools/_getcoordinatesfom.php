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
<div id="get_coordinates">
    <label for="transform_coordinates">Sistema de Coordenadas</label>
    <select name="transform_coordinates" id="transform_coordinates" class="form-control">
        <option value="3763">ETRS89 / Portugal TM06</option>
        <option value="27493">Datum 73 Hayford Gauss IPCC</option>
        <option value="20791">Lisboa Hayford Gauss IPCC</option>
        <option value="20790">Lisboa Hayford Gauss IGeoE</option>
        <option value="4326">WGS 84</option>
    </select><hr>
    <div>
        <input type="hidden" id="get_coordinates">
        <label for="coordinate_x">X: </label>
        <input type="text" name="coordinate_x" id="coordinate_x" class="form-control"><br>
        <label for="coordinate_y">Y: </label>
        <input type="text" name="coordinate_y" id="coordinate_y" class="form-control"><br>
    </div><hr>
</div>

<script>

    var init_coordinate_x, init_coordinate_y;
    map.on('click', function (evt) {
        $("#transform_coordinate").val(3763);
//        $("#transform_coordinate>option[value='3763']").attr('selected', 'selected');
        init_coordinate_x = evt.coordinate[0];
        init_coordinate_y = evt.coordinate[1];
        $("#coordinate_x").val(evt.coordinate[0]);
        $("#coordinate_y").val(evt.coordinate[1]);
        $("#get_coordinates").val(evt.coordinate);

    });

    $("#transform_coordinates").change(function () {
        var newESPG = 'EPSG:' + $("#transform_coordinates").val();
        var lonlat = ol.proj.transform([init_coordinate_x, init_coordinate_y], 'EPSG:3763', newESPG);
        $("#coordinate_x").val(lonlat[0]);
        $("#coordinate_y").val(lonlat[1]);
    });

</script>