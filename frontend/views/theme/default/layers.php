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

$load_layer_group = $connection->query('SELECT distinct layer_group FROM layers WHERE viewer_id =' . $row['id'] . ' order by rowid desc');

?>
var layers = [
<?php

while ($row_groups =$load_layer_group->fetchArray(SQLITE3_ASSOC)){
//    $view_group = explode("/", $row_groups['layer_group']);
//    for ($i = count($view_group)-1; $i > 0; $i--) {
//        //checklayer($view_group[$i]);
//    }
    
    ?>
    new ol.layer.Group({
                layers: [
                <?php
                $load_layers = $connection->query('SELECT * FROM layers WHERE layer_group ="' . $row_groups['layer_group'] . '" order by rowid desc');
                while ($row_layers = $load_layers->fetchArray(SQLITE3_ASSOC)) {
                    $load_server = $connection->query('SELECT type, url FROM param_server WHERE id =' . $row_layers['serverType'] . ' LIMIT 1');
                        if ($server = $load_server->fetchArray(SQLITE3_ASSOC)) {
                            ?>
                            new ol.layer.Image({
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
                            }),
                            <?php
                        }
                
                }
                ?>
                ],
                name: '<?php echo $row_groups["layer_group"] ?>'
            }),
<?php
}

?>
];
