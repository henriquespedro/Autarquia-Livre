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
$load_layer_group = $connection->query('SELECT distinct layer_group FROM layers WHERE viewer_id =' . $row['id'] . ' order by rowid desc');

?>
var layers = [
<?php

while ($row_groups =$load_layer_group->fetchArray(SQLITE3_ASSOC)){
    $view_group = explode("/", $row_groups['layer_group']);
    for ($i = count($view_group)-1; $i > 0; $i--) {
        //checklayer($view_group[$i]);
    }
    
    ?>
    new ol.layer.Group({
                layers: [
                <?php
                $load_layers = $connection->query('SELECT * FROM layers WHERE layer_group ="' . $row_groups['layer_group'] . '" order by rowid desc');
                while ($row_layers = $load_layers->fetchArray(SQLITE3_ASSOC)) {
                ?>
                    new ol.layer.Image({
                        title: '<?php echo $row_layers["name"] ?>',
                        name: '<?php echo $row_layers["name"] ?>',
                        layer: '<?php echo $row_layers["layer"] ?>',
                        visible: <?php echo $row_layers['visible']; ?>,
                        fields: '<?php echo $row_layers["fields"] ?>',
                        source: new ol.source.ImageWMS({
                            url: 'http://sigserver:8080/geoserver/wms',
                            crs: "<?php echo $row_layers['crs'] ?>",
                            params: {'LAYERS': '<?php echo $row_layers["layer"] ?>'},
                            serverType: '<?php echo $row_layers["serverType"] ?>'
                        })
                    }),
                <?php
                }
                ?>
                ],
                name: '<?php echo $row_groups["layer_group"] ?>'
            }),
<?php
}

?>
];

<?php
function checklayer($layers){
?>
    var layer = '<?php echo $layers ?>';
    for (var i=0;i<map.getLayers().getLength();i++) {
        if (map.getLayers().getArray()[i] === layer) { 
            alert ('existe');
        }
    }
<?php
}
?>


function ol3_checkLayer(layer) {
    var res = false;
    for (var i=0;i<map.getLayers().getLength();i++) {
        if (ol3_map.getLayers().getArray()[i] === layer) { //check if layer exists
            res = true; //if exists, return true
        }
    }
    return res;
}