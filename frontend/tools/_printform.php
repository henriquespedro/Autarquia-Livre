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

include __DIR__ . '/../views/connections.php';
$resultprint = $connection->query('SELECT * FROM maprint WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
$printfields = $connection->query('SELECT * FROM maprint_fields WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
?>
<div id="list_maprint">
    <table style="width:100%" class="table table-condensed table-hover" data-click-to-select="true">

        <thead>
            <tr>
                <th data-field="select" data-checkbox="true"></th>
                <th data-field="planta" data-align="right">Planta</th>
                <th data-field="escala" data-align="center">Escala</th>
                <th data-field="layout" data-align="">Layout</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $resultprint->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <tr>
                    <td style="vertical-align: middle"><input type="checkbox" class="checkbox" /></td>
                    <td style="vertical-align: middle" width="45%"><?php echo $row['name'] ?></td>
                    <td width="25%">
                        <select class="form-control" id="scales">
                            <?php
                            $print_scales = $connection->query('SELECT * FROM maprint_scales WHERE maprint_id = ' . $row["id"]);
                            while ($row_scales = $print_scales->fetchArray(SQLITE3_ASSOC)) {
                                ?>
                                <option value="<?php echo $row_scales['scale'] ?>"><?php echo $row_scales['label'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td  width="35%">
                        <select class="form-control" id="layouts">
                            <?php
                            $print_layout = $connection->query('SELECT * FROM maprint_layouts WHERE maprint_id = ' . $row["id"]);
                            while ($row_layout = $print_layout->fetchArray(SQLITE3_ASSOC)) {
                                ?>
                                <option value="<?php echo $row_layout['layout'] ?>"><?php echo $row_layout['label'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td style="display:none;"><?php echo $row['description'] ?></td>
                    <td style="display:none;"><?php echo $row['description_font'] ?></td>
                    <td style="display:none;"><?php echo $row['layer'] ?></td>
                    <?php
                    $load_print_server = $connection->query('SELECT url FROM param_server WHERE id =' . $row['serverType'] . ' LIMIT 1');
                    if ($print_server = $load_print_server->fetchArray(SQLITE3_ASSOC)) {
                        ?>
                        <td style="display:none;"><?php echo $print_server['url'] ?></td>
                        <?php
                    }
                    ?>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <button type="button" class="btn btn-primary" id="next_fields_print" onclick="next_fields()">Seguinte</button>
    <div id="error_print"></div>
</div>
<div id="fields_print" style="display:none">
    <form data-toggle="validator" id="form_fields_print" role="form">
        <?php
        while ($row = $printfields->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <div class="form-group">
                <label for="<?php echo $row['code_field'] ?>" class="control-label"><?php echo $row['name'] ?></label>
                <input type="<?php echo $row['type'] ?>" class="form-control" id="<?php echo $row['code_field'] ?>" aria-required="<?php echo $row['required'] ?>" >
                <div class="help-block with-errors"></div>
            </div>
            <?php
        }
        ?>
    </form>
    <hr>
    <button type="button" class="btn btn-primary" id="back_list_print" onclick="back_list()">Anterior</button>
    <button type="button" class="btn btn-primary" id="next_results_print" onclick="next_results()">Seguinte</button>
</div>

<div id="results_print" style="display:none">

    <br><label>Plantas para Impressão</label><br><br>
    <div id="result_list">
        <ul id="ul_result_list">
        </ul>
    </div>
    <hr>
    <div id="result_notes">
        <p align="justify">
            A plantas de localização são disponibilizadas em formato <abbr title="Portable document format">pdf</abbr>, caso não possua um leitor para este formato, pode realizar download <a href="https://get.adobe.com/pt/reader" target="black"><b>aqui</b></a>.
        </p>
    </div>
    <hr>
    <button type="button" class="btn btn-primary" id="next_results_print" onclick='imprimir_plantas()'>Voltar</button>
</div>

<script>
    var list_layouts = [];
    function next_fields() {
        $('table input:checked').each(function () {
            var row = $(this).parents('tr');
            list_layouts.push({planta: row.find('td:nth-child(2)').text(), escala: row.find('td:nth-child(3) select').val(), layout: row.find('td:nth-child(4) select').val(), description_font: row.find('td:nth-child(5)').text(), description: row.find('td:nth-child(6)').text(), layer: row.find('td:nth-child(7)').text(), print_server: row.find('td:nth-child(8)').text()});
        });

        if (list_layouts.length === 0) {
            $("#error_print").html('<div class="alert alert-info" role="alert">É obrigatónio escolher pelo menos uma planta!!</div>');
        } else {
            $('#list_maprint').hide();
            $('#fields_print').show();
        }
    }

    function back_list() {
        list_layouts = [];
        $('#list_maprint').show();
        $('#fields_print').hide();
    }

    function next_results() {
        var params = '';
        $('#form_fields_print').find('div >input').each(function () {
            params += '%22' + $(this).attr('id') + '%22:%22' + $(this).val() + '%22,';
        });
        $('#fields_print').hide();
        $('#results_print').show();


        var MapCenter = null;
        MapCenter = map.getView().getCenter();

        for (i = 0; i < list_layouts.length; i++) {
            var geoserver_url = list_layouts[i].print_server + '/pdf/print.pdf';
            var date = new Date();
            var milliseconds = date.getTime();
            var seconds = milliseconds / 10000;

            var layers = '{type:%22WMS%22,format:%22image/png%22,layers:[%22' + list_layouts[i].layer + '%22], baseURL:%22' + list_layouts[i].print_server + '/wms%22,styles:[%22%22], customParams :{BUFFER:0,TRANSPARENT:true}}';


//            var features_origin = drawLayer.getSource().getArray();
//            var format_print = new ol.format.GeoJSON({projection: 'EPSG:3763'});
//            var results_geojson = format_print.writeFeatures(features_origin);
//
//            function replaceByValue() {
//                var results_geojson_obj = JSON.parse(results_geojson);
//                for (var k = 0; k < results_geojson_obj.features.length; ++k) {
//                    results_geojson_obj.features[k].properties = {"name": "EPSG:3763"};
//                }
//                results_geojson = JSON.stringify(results_geojson_obj);
//            }
//            
//            replaceByValue();
//            var vectorsLayers = '{type:"Vector",styles:{"":{fill: false, fillColor:"#FF0000",stroke-width:"3",strokeWidth: 3, strokeColor: "#FF0000",fillOpacity: 0.0}},geoJson:' + results_geojson + '}';
            
            

            var print_url = geoserver_url + '?spec={%22outputFilename%22:%22Planta_SIG' + seconds + '%22,'
                    + '%22layout%22: %22' + $.trim(list_layouts[i].layout) + '%22,'
                    + '%22dpi%22:300,'
                    + '%22titulo%22:%22' + list_layouts[i].planta + '%22,'
                    + params
                    + '%22fonte%22:%22' + list_layouts[i].description_font + '%22,'
                    + '%22srs%22: %22EPSG:3763%22, '
                    + '%22units%22: %22m%22 ,'
                    + '%22layers%22:[' + layers + '], '
//                    + '%22layers%22:[' + layers + ',' + escape(vectorsLayers) + '], '
                    + '%22pages%22: [ '
                    + '{ '
                    + '%22center%22: [' + MapCenter[0] + ',' + MapCenter[1] + '],'
                    + '%22scale%22: ' + $.trim(list_layouts[i].escala) + ','
                    + '%22rotation%22: 0,'
                    + ' }'
                    + '],}"';

            $("#ul_result_list").append('<li><p><strong><a href="' + print_url + '" title="' + list_layouts[i].description + '">' + list_layouts[i].planta + '</a></strong></p></li>');
        }
    }
</script>