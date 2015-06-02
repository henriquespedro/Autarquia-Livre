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
<!--<div style="width:auto;">
    <ul id="identify_options" class="nav nav-tabs">
        <li class="active" title="Identificar" id="identify_tool"><a href="#identify" data-toggle="tab">Layers a Identificar</a></li>
        <li title="Resultados" id="results_tool" ><a href="#results" data-toggle="tab">Resultados</a></li>
    </ul>
    <div id="content_spinner_info" class="tab-content">
        <div id="identify" class="tab-pane active tree ">
            
        </div>
        <div id="results" class="tab-pane">

        </div>
    </div>
</div>-->
<div>
    <label for="info_list_layers">Layers:</label>
    <select name="info_list_layers" id="info_list_layers" class="form-control">
        <option value="all_layers" class="all_layers">   Todas as Layers</option>
    </select>

    <hr>
    <button type="button" class="btn btn-primary" name="identificar" id="identificar">Obter Informações</button>
</div>

<script>
    var count = 0;
    map.getLayers().forEach(function (lyr) {
        $('#info_list_layers').append('<option value="' + (count++) + '">' + lyr.get('name') + '</option>');
    });

    var mylist = $('#info_list_layers');
    var listitems = mylist.children().get();
    listitems.sort(function (a, b) {
        var compA = $(a).text().toUpperCase();
        var compB = $(b).text().toUpperCase();
        return (compA < compB) ? -1 : (compA > compB) ? 1 : 0;
    })
    $.each(listitems, function (idx, itm) {
        mylist.append(itm);
    })
</script>

<script>
    $("#identificar").on("click", function () {
        map.on('singleclick', function (evt) {
            var coord = evt.coordinate;
            spawnPopup(coord);
        });
        function spawnPopup(coord) {
//            var popup = $("<div class='popup'></div>");
//            var overlay = new ol.Overlay(/** @type {olx.OverlayOptions} */ ({
//                element: popup,
//                autoPan: true,
//                autoPanAnimation: {
//                    duration: 250
//                }
//            }));
//            map.addOverlay(overlay);
//            overlay.setPosition(coord);
            var viewProjection = map.getView().getProjection();
            var viewResolution = map.getView().getResolution();
            var layer_select = $("#info_list_layers").val();
            var url = layers[layer_select].getSource().getGetFeatureInfoUrl(coord, viewResolution, viewProjection, {
                'INFO_FORMAT': 'application/json'
            });
            if (url) {
                console.log(url)
                $.ajax({
                    url: url,
                    success: function (data) {
                        console.log(data)

                    }
                });

//                $.getJSON(url, function (d) {
//                    console.log(d);
//                })
            } else {
                console.log("Uh Oh, something went wrong.");
            }
        }
    });
</script>