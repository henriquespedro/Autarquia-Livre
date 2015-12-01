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

$load_search = $connection->query('SELECT * FROM search WHERE viewer_id =' . $row['id'] . ' and visible = 1');


while ($row_search = $load_search->fetchArray(SQLITE3_ASSOC)) {
    $connection_param = $row_search['datasource_id'];
    include __DIR__ .'/../../connections.php';
    ?>
        $('#search').append('<button type="button" onclick="search_<?php echo $row_search['id']; ?>()" title="<?php echo $row_search['description']; ?>" class="btn btn-default btn-default-menu bt_size "> <span class="glyphicon" style="background-image:url(../images/appbar.map.folds.svg);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p ><?php echo $row_search['search_name']; ?></p></button>');
        $('#search_div').append('<div id="all_param_search<?php echo $row_search['id']; ?>"><form id="search_div_<?php echo $row_search['id']; ?>"></form></div>');
        function search_<?php echo $row_search['id']; ?>() {
            change_active_option();
            $("#options").html($("#all_param_search<?php echo $row_search['id']; ?>").html());
        }
    <?php
    $array_search_Parametros = array();
    $load_search_paramenters = $connection->query('SELECT * FROM search_parameters WHERE search_id =' . $row_search['id'] . '');
    if ($load_search_paramenters) {
        $search_param_values = array();
        $inc = 0;
        while ($row_search_param = $load_search_paramenters->fetchArray(SQLITE3_ASSOC)) {
            $search_param_values[$inc] = $row_search_param;
            $inc++;
        }
        for ($i = 0; $i < count($search_param_values); $i++) {
            array_push($array_search_Parametros, $search_param_values[$i]['value_field']);
            $search_param_id = $search_param_values[$i]['id'];
            $name = $search_param_values[$i]['name'];
            $campo_interno = $search_param_values[$i]['value_field'];
            $campo_descricao = $search_param_values[$i]['description_field'];
            $sql_query = $search_param_values[$i]['sqlquery'];
            $type = $search_param_values[$i]['type'];

            if ($type == 'text') {
                ?>
        $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $search_param_id ?>" ><label for="search_parameter_<?php echo $campo_interno ?>"><?php echo $name ?>:</label><input type="text" class="form-control" name="search_parameter_<?php echo $campo_interno ?>" id="search_parameter_<?php echo $campo_interno ?>"/></div>');
                <?php
            } elseif ($type == 'values_list') {

                $count = count($search_param_values);

                if ($count == 0 || $i == 0) {
                    $query_param_init_values = pg_query($conn, $sql_query);
                    $search  = array('&'    , '"'     , "'"    , '<'   , '>'    );
                    $replace = array('&amp;', '&quot;', '&#39;', '&lt;', '&gt;' ); 
                    ?>
                    $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $search_param_id ?>" ><label for="search_parameter_<?php echo $campo_interno ?>"><?php echo $name ?>:</label><select class="form-control" onchange="<?php echo $campo_interno ?>_Select(this)" name="search_parameter_<?php echo $campo_interno ?>" id="search_parameter_<?php echo $campo_interno ?>"></select></div>');
                    function <?php echo $campo_interno ?>_Select() {
                        var sql_replace = "<?php echo $search_param_values[$i + 1]['sqlquery'] ?>";

                        <?php
                        for ($k = 0; $k < count($array_search_Parametros); ++$k) {
                            ?>
                            var <?php echo $array_search_Parametros[$k] ?> = document.getElementById("search_parameter_<?php echo $array_search_Parametros[$k] ?>").value;
                            sql_replace = sql_replace.replace("$<?php echo $array_search_Parametros[$k] ?>", <?php echo $array_search_Parametros[$k] ?>);

                        <?php } ?>

                        var query = sql_replace;

                        $.getJSON('../views/viewer/query.php', {query: query, connection_param: <?php echo $connection_param ?>},
                        function (data) {
                            /* Apaga todos os valores da Combobox */
                            $("#search_parameter_<?php echo $search_param_values[$i + 1]['value_field'] ?>").empty();

                            /* Adiciona os novos valores */
                            var sel = document.getElementById("search_parameter_<?php echo $search_param_values[$i + 1]['value_field'] ?>");
                            $.each(data, function (key, val) {
                                var opt = document.createElement('option');
                                opt.innerHTML = val.<?php echo $search_param_values[$i + 1]['description_field']; ?>;
                                opt.value = val.<?php echo $search_param_values[$i + 1]['value_field']; ?>;
                                
                                sel.appendChild(opt);
                            });
                            document.getElementById("search_parameter_<?php echo $search_param_values[$i + 1]['value_field'] ?>").selectedIndex = -1;

                        });
                     };
                    <?php while ($row_param_init_values = pg_fetch_array($query_param_init_values)): ?>
                        $('#search_parameter_<?php echo $campo_interno ?>').append('<option value="<?php echo $row_param_init_values[$campo_interno]; ?>"><?php echo str_replace($search, $replace, $row_param_init_values[$campo_descricao]); ?></option>');
                    <?php endwhile;
                    
                    
                } elseif ($i + 1 === count($search_param_values)) {
                    ?>
                    $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $search_param_id ?>" ><label for="search_parameter_<?php echo $campo_interno ?>"><?php echo $name ?>:</label><select class="form-control" name="search_parameter_<?php echo $campo_interno ?>" id="search_parameter_<?php echo $campo_interno ?>"></select></div>');
                    <?php
                } elseif ($i < count($search_param_values)) {
                    ?>
                    $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $search_param_id ?>" ><label for="search_parameter_<?php echo $campo_interno ?>"><?php echo $name ?>:</label><select class="form-control" onchange="<?php echo $campo_interno ?>_Select(this)" name="search_parameter_<?php echo $campo_interno ?>" id="search_parameter_<?php echo $campo_interno ?>"></select></div>');
                    <?php
                }
            }
        }

    } else {
        ?>
                $("#search_div_<?php echo $row_search['id']; ?>").append('<label>Ocorreu um erro ao obter os parâmetros de pesquisa</label>');
        <?php
    }
    
    ?>
                $("#search_div_<?php echo $row_search['id']; ?>").append('<hr><input type="button" id="cancelar" name="cancelar" class="btn btn-default" style ="float:middle" value="Cancelar" title ="Cancelar Pesquisa"/><button onclick="function_get_result(&quot;search_div_<?php echo $row_search['id']; ?>&quot;,&quot;<?php echo $row_search['id']; ?>&quot;,&quot;<?php echo $connection_param ?>&quot)" type="button" id="get_result_search" name="get_result_search" class="btn btn-default" style="float: right;" title="Pesquisar">Pesquisar</button>');
    <?php
}
?>
                $('#search').append('<button type="button" onclick="clear_results_search()" title="Apagar Resultados" class="btn btn-default btn-default-menu bt_size "> <span class="glyphicon" style="background-image:url(../images/appbar.close.svg);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p>Apagar Resultados</p></button>');

                <!--<script>-->
function function_get_result (form_id, search_id, connection_param) {
    $.ajax({
        type: 'POST',
        url: '../views/viewer/query.php',
        dataType: 'json',
        data: $('#'+form_id).serialize() + "&search_id=" + search_id +"&search_result=" + "&connection_param=" + connection_param,
        success: function (data) {
            search_vector_result.getSource().clear();
            
            if (data.length === 1) {
                $('#'+form_id).html('<table id="table_search_results" style="width:100%" class="table table-condensed table-hover"><thead><tr><th>Campo</th><th>Valor</th></tr><thead><tbody></tbody></table>');
                $.each(data[0], function (index, value) {
                    if (!(index == 'wkt' || index == 'st_x_y')){
                        $('#table_search_results').append('<tr><td><b>'+ index +'</b></td><td>'+ value +'</td>');
                    } else if (index === 'wkt') {
                        search_vector_result.getSource().addFeature(format.readFeature(value));
                    }
                    else if (index === 'st_x_y' ){
                        var extent = value.replace("(", "[");
                        extent = extent.replace(")", "]");
                                               
                        $('#'+form_id).append('<button type="button" onclick="map.getView().fitExtent('+extent+', map.getSize());" class="btn btn-default" style="float: right;" title="Visualizar o resultado no mapa">Visualizar no mapa</button><br><hr>');
                    }
                })
            } else if (data.length > 1){
                $('#'+form_id).html('');
                for (i = 0; i < data.length; i++) {
                    $('#'+form_id).append('<table id="table_search_results_'+ i +'" style="width:100%" class="table table-condensed table-hover"><thead><tr><th>Campo</th><th>Valor</th></tr><thead><tbody></tbody></table>');
                    $.each(data[i], function (index, value) {
                        if (!(index == 'wkt' || index == 'st_x_y')){
                            $('#table_search_results_'+i).append('<tr><td><b>'+ index +'</b></td><td>'+ value +'</td>');
                        } else if (index === 'wkt' ){
                            search_vector_result.getSource().addFeature(format.readFeature(value));
                        }    
                        else if (index === 'st_x_y' ){
                            var extent = value.replace("(", "[");
                            extent = extent.replace(")", "]");
                            $('#'+form_id).append('<button type="button" onclick="map.getView().fitExtent('+extent+', map.getSize());" class="btn btn-default" style="float: right;" title="Visualizar o resultado no mapa">Visualizar no mapa</button><br><hr>');
                        }
                    })
                    
                }
            } else {
                alert('A pesquisa não devolveu resultados!!');
            }
            map.addLayer(search_vector_result);
        },
        error: function(){
            alert('Ocorreu um erro a realizar a pesquisa!!!');
          }
    });   
};
