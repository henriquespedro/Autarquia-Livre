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
var data_tree = [];
var layers = [];
var projection = ol.proj.get('EPSG:3763');
var projectionExtent = projection.getExtent();
<!--alert (projectionExtent);-->
var size = ol.extent.getWidth(view_extent) / 128;
<!--alert(size);-->
// Generate and array of resolutions and matrixIds for this WMTS
var resolutions = new Array(14);
var matrixIds = new Array(14);
<!--console.log(map_resolutions);-->
for (var z = 0; z < 14; ++z) {
    resolutions[z] = size / Math.pow(2, z);
    matrixIds[z] = z;
}

<?php

$load_baselayers = $connection->query('SELECT * FROM layers WHERE viewer_id =' . $row['id'] . ' AND type = "baselayer" order by rowid asc');

 while ($row_baselayers = $load_baselayers->fetchArray(SQLITE3_ASSOC)) {
    $load_base_server = $connection->query('SELECT type, url FROM param_server WHERE id =' . $row_baselayers['serverType'] . ' LIMIT 1');
    if ($base_server = $load_base_server->fetchArray(SQLITE3_ASSOC)) {
        if ($base_server['type'] === 'Mapproxy') {
        ?>
        var NESource = new ol.source.XYZ({
            projection: 'EPSG:3763',
            url: '<?php echo $base_server["url"] ?>/tms/<?php echo $row_baselayers["layer"] ?>/{z}/{x}/{-y}.png',
            <!--crossOrigin: 'null'-->
        });
        layers.push(
        
            new ol.layer.Tile({
            <!--extent: map.getView().calculateExtent(map.getSize()),-->
            title: '<?php echo $row_baselayers["name"] ?>',
            layer: '<?php echo $row_baselayers["layer"] ?>',
            visible: <?php echo $row_baselayers['visible']; ?>,
            show_toc: <?php echo $row_baselayers['show_toc']; ?>,
            opacity: <?php echo $row_baselayers['opacity']; ?>,
            type: 'base',
            <!--extent: view_extent,-->
            source: NESource,
            isBaseLayer: true
            })
        );
        <?php 
        } else {
            ?>
        layers.push(
            new ol.layer.Image({
                title: <?php echo $row_baselayers["name"] ?>,
                layer: <?php echo $row_baselayers["layer"] ?>,
                shwo_toc: '<?php echo $row_baselayers["shwo_toc"] ?>',
                opacity: <?php echo $row_baselayers['opacity']; ?>,
                tiled: 'yes',
                visible: <?php echo $row_baselayers['visible']; ?>,
                source: new ol.source.ImageWMS({
                    url: <?php echo $base_server["url"] ?> + '/wms',
                    crs: <?php echo $row_baselayers["crs"] ?>,
                    params: {'LAYERS': <?php echo $row_baselayers["layer"] ?>},
                })
            })
        );

    <?php
        }
     
    }
 }


$load_layers = $connection->query('SELECT * FROM layers WHERE viewer_id =' . $row['id'] . ' AND type = "operational_layer" order by rowid asc');


 while ($row_layers = $load_layers->fetchArray(SQLITE3_ASSOC)) {
    $load_server = $connection->query('SELECT type, url FROM param_server WHERE id =' . $row_layers['serverType'] . ' LIMIT 1');
    if ($server = $load_server->fetchArray(SQLITE3_ASSOC)) {
     ?>
        layers.push(new ol.layer.Image({
            title: '<?php echo $row_layers["name"] ?>',
            name: '<?php echo $row_layers["name"] ?>',
            layer: '<?php echo $row_layers["layer"] ?>',
            visible: <?php echo $row_layers['visible']; ?>,
            show_toc: <?php echo $row_layers['show_toc']; ?>,
            opacity: <?php echo $row_layers['opacity']; ?>,
            fields: '<?php echo $row_layers["fields"] ?>',
            source: new ol.source.ImageWMS({
                url: '<?php echo $server["url"] ?>/wms',
                crs: "<?php echo $row_layers['crs'] ?>",
                params: {'LAYERS': '<?php echo $row_layers["layer"] ?>'},
                serverType: '<?php echo $server["type"] ?>'
            })
            })
        );
    <?php
    }
    $group = $row_layers['layer_group'];
    $group_explode = explode("/", $group);
    $id_group = '';
    for ($x = 0; $x < count($group_explode); $x++) {
        $value_id = md5($x . $group_explode[$x]);
        if ($x === 0) {
            ?>
                data_tree.push({
                    "id": "<?php echo $value_id; ?>",
                    "parent": "#",
                    "text": "<?php echo $group_explode[$x]; ?>"
                });
            <?php
        } else {
            $last_value_id = md5($x - 1 . $group_explode[$x - 1]);
            $id_group = $value_id;
            ?>
                data_tree.push({
                    "id": "<?php echo $value_id; ?>",
                    "parent": "<?php echo $last_value_id; ?>",
                    "text": "<?php echo $group_explode[$x]; ?>",
                    "state": {"opened": false},
                });
            <?php
        }
    }
    
    $layer_id = md5('layer_' . $row_layers['id']);
    ?>
    data_tree.push({
        "id": "<?php echo $layer_id; ?>",
        "parent": "<?php echo $value_id; ?>",
        "icon": false,
        "text": "<?php echo $row_layers['name']; ?>",
        "state": {"checked": <?php echo $row_layers['visible'] ?>, "selected": <?php echo $row_layers['visible'] ?>},
        "li_attr": {"legend_url": "<?php echo $server["url"] ?>", "layer": "<?php echo $row_layers['layer']; ?>", "title": "<?php echo $row_layers['name']; ?>"}
    });
<?php
}
?>

    var arr = [], data_tree_collection = [];
            $.each(data_tree, function (index, value) {
                if ($.inArray(value.id, arr) == -1) {
                    arr.push(value.id);
                    data_tree_collection.push(value);
                }
            });

            $('#layer_tree').jstree({
                "checkbox": {
                    "tie_selection": false,
                    "keep_selected_style": false
                },
                "plugins": ["search", "dnd", "wholerow", "checkbox"], 'core': {
                    "check_callback" : false, 
                    "multiple": true,
                    "themes": {
                        "icons": true
                    },
                    'data': data_tree_collection
                }});
                
            var to = false;
            $('#tree_search').keyup(function () {
                if(to) { clearTimeout(to); }
                to = setTimeout(function () {
                    var v = $('#tree_search').val();
                    $('#layer_tree').jstree(true).search(v);
                }, 250);
            });

            $('#layer_tree').bind("check_node.jstree", function (e, data) {
                var array = data.instance.get_bottom_checked(data);
                for(k = 0; k < array.length; k++) {
                    var id_layer = array[k].li_attr.layer;
                    map.getLayers().forEach(function (lyr) {
                        if ( id_layer === lyr.get('layer')) {
                            lyr.setVisible(true);
                        }            
                    });
                }
            });

            $('#layer_tree').bind("uncheck_node.jstree", function (e, data) {
                var array = data.instance.get_bottom_checked(data);
                map.getLayers().forEach(function (lyr) {  
                    var result = validate_exist_layer(lyr.get('layer'));
                    if (result === '') {
                        lyr.setVisible(false);
                    }
                });
                function validate_exist_layer(layer) {

                    var result = ''
                    for(k = 0; k < array.length; k++) {
                        var id_layer = array[k].li_attr.layer;
                        if  (id_layer === layer) {
                            result = 'yes';
                            return false;
                        }
                    }
                    return result;
                }
            });

            $("#layer_tree").bind("hover_node.jstree", function (e, data)
            {
                if (data.node.li_attr.layer) {
                    var text = data.node.li_attr.layer;
                    var lagend_url = data.node.li_attr.legend_url;
                    var image = lagend_url +"/wms?TRANSPARENT=true&SERVICE=WMS&VERSION=1.1.1&REQUEST=GetLegendGraphic&EXCEPTIONS=application%2Fvnd.ogc.se_xml&FORMAT=image%2Fjpeg&LAYER=" + text + "&LEGEND_OPTIONS=forceLabels%3Aon%3BfontName%3DVerdana%3BfontSize%3A12";
                    $("#" + data.node.li_attr.id).tooltipster({
                        theme: 'tooltipster-shadow',
                        content: $('<img src="' + image + '">')
                    });
                }
            });


