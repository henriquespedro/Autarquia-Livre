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

<div >
    <label for="text_map">Texto:</label><input type="text" id="text_map" name="text_map" class="form-control">
    <label for="font">Fonte:</label>
    <select name="font" id="font" class="form-control">
        <option value="Arial">Arial</option>
        <option value="Arial Black">Arial Black</option>
        <option value="Arial Narrow">Arial Narrow</option>
        <option value="Calibri">Cablibri</option>
        <option value="Century">Century</option>
        <option value="Tahoma">Tahoma</option>
        <option value="Times New Roman">Times New Roman</option>
        <option value="Verdana">Verdana</option>
    </select>
    <label for="type">Tipo:</label>
    <select name="type" id="type" class="form-control">
        <option value="normal">Normal</option>
        <option value="bold">Negrito</option>
        <option value="italic">Itálico</option>
    </select>
    <label for="size">Tamanho:</label><input type="number" id="size" name="size" min="0" step="5" max="100" class="form-control">
    <label for="color">Cor do texto: </label><input type="color" id="color" name="color" class="form-control">
    <hr>
    <button type="button" class="btn btn-primary" name="label_insert" id="label_insert">Inserir</button>
</div>

<script>
    $("#label_insert").on("click", function () {
        var customStyleFunction = function (feature, resolution) {

            var fontSize = $("#size").val();

            return [new ol.style.Style({
                    text: new ol.style.Text({
                        font: fontSize + 'px ' + $("#font").val(),
                        text: $("#text_map").val(),
                        fill: new ol.style.Fill({
                            color: $("#color").val()
                        }),
                        stroke: new ol.style.Stroke({
                            color: $("#color").val(),
                            width: 1
                        })
                    })
                })];
        };
        map.on('click', function (evt) {
            var label_text = new ol.layer.Vector({
                source: new ol.source.Vector({
                    features: [new ol.Feature({
                            geometry: new ol.geom.Point(evt.coordinate, 'XY'),
                            name: 'Line'
                        })]
                }),
                style: customStyleFunction
            });
            map.addLayer(label_text);
        });
    });
</script>