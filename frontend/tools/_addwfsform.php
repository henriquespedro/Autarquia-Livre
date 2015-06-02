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
<div>
    <label for="wfs_name">Nome:</label><input type="text" id="wfs_name" name="wfs_name" class="form-control">
    <!--<label for="wms_server">Tipo:</label>-->
<!--    <select name="wms_server" id="wms_server" class="form-control">
        <option value="geoserver" class="all_layers">GeoServer</option>
        <option value="mapserver" class="all_layers">MapServer</option>
        <option value="qgis" class="all_layers">QGIS Server</option>
        <option value="arcgis" class="all_layers">ArcGIS Server</option>
    </select>-->
    <label for="wfs_url">Server URL:</label><input type="text" id="wfs_url" name="wfs_url" class="form-control">
    <label for="wfs_layer">Layer:</label><input type="text" id="wfs_layer" name="wfs_layer" class="form-control">
    <hr>
    <button type="button" class="btn btn-primary" name="wfs_insert" id="wfs_insert">Adicionar WMS</button>
</div>

<script>
    $("#wfs_insert").on("click", function () {
        map.addLayer(new ol.layer.Image({
            title: $("#wfs_name").val(),
            name: $("#wfs_name").val(),
            source: new ol.source.ImageWMS({
                url: $("#wfs_url").val(),
                params: {
                    'LAYERS': $("#wfs_layer").val()
                }
//                serverType: $("#wms_server").val()
            })
        }));
    });
</script>
