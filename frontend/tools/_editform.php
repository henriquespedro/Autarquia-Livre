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
        <option value="-" class="all_layers">-</option>
        <option value="contentores_superficiais">Contentores Superficiais</option>
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

<script>
    $("#edit_layers").change(function () {
        var vectorSource = new ol.source.ServerVector({
            format: new ol.format.WFS({
                featureNS: 'http://sig.cm-ourem.pt',
                featureType: $("#edit_layers").val()
            }),
            loader: function (extent, resolution, projection) {
                var url = 'http://websig.cm-ourem.pt/geoserver/wfs?' +
                        'service=WFS&request=GetFeature&' +
                        'version=1.1.0&typename=sig:' + $("#edit_layers").val() + '&' +
                        'srsname=' + view_projection + '&' +
                        'bbox=' + extent.join(',');

                $.ajax({
                    url: url
                })
                        .done(function (response) {
                            vectorSource.addFeatures(vectorSource.readFeatures(response));
                        });
            },
            strategy: ol.loadingstrategy.createTile(new ol.tilegrid.XYZ({
                maxZoom: 19
            })),
            projection: view_projection
        });

        // Vector layer
        var vectorLayer = new ol.layer.Vector({
            title: 'Layers Edição',
            name: 'Layers Edição',
            source: vectorSource,
            style: new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'green',
                    width: 2
                })
            })
        });

        map.addLayer(vectorLayer);
    });

//
//    var select = new ol.interaction.Select();
//
//    var modify = new ol.interaction.Modify({
//        features: select.getFeatures()
//    });

</script>