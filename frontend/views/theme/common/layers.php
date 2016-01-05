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

$load_baselayers = $connection->query('SELECT * FROM layers WHERE viewer_id =' . $row['id'] . ' AND type = "baselayer" order by rowid asc');
$load_layers = $connection->query('SELECT * FROM layers WHERE viewer_id =' . $row['id'] . ' AND type = "operational_layer" order by rowid asc');


while ($row_baselayers = $load_baselayers->fetchArray(SQLITE3_ASSOC)) {
    $load_base_server = $connection->query('SELECT type, url FROM param_server WHERE id =' . $row_baselayers['serverType'] . ' LIMIT 1');
    if ($base_server = $load_base_server->fetchArray(SQLITE3_ASSOC)) {
        ?>
        load_baselayers('<?php echo $base_server['type'] ?>', '<?php echo $row_baselayers["id"] ?>', '<?php echo $row_baselayers["name"] ?>', '<?php echo $row_baselayers["layer"] ?>', <?php echo $row_baselayers['visible']; ?>, <?php echo $row_baselayers['show_toc']; ?>, <?php echo $row_baselayers['opacity']; ?>, '<?php echo $base_server["url"] ?>', '<?php echo $row_baselayers['crs']; ?>');
        <?php
    }
}

while ($row_layers = $load_layers->fetchArray(SQLITE3_ASSOC)) {
    $load_server = $connection->query('SELECT type, url FROM param_server WHERE id =' . $row_layers['serverType'] . ' LIMIT 1');
    if ($server = $load_server->fetchArray(SQLITE3_ASSOC)) {
        ?>
        load_layers('<?php echo $row_layers["id"] ?>','<?php echo $row_layers["name"] ?>','<?php echo $row_layers["layer"] ?>','<?php echo $row_layers["fields"] ?>',<?php echo $row_layers["visible"] ?>,'<?php echo $row_layers["crs"] ?>',<?php echo $row_layers["opacity"] ?>,<?php echo $row_layers["show_toc"] ?>,'<?php echo $server["url"] ?>','<?php echo $row_layers["type"] ?>');
        <?php
    }
    $group = $row_layers['layer_group'];
    $group_explode = explode("/", $group);
    $id_group = '';
    for ($x = 0; $x < count($group_explode); $x++) {
        $value_id = md5($x . $group_explode[$x]);
        if ($x === 0) {
            ?>
            tree_data('<?php echo $value_id; ?>', '#', '<?php echo $group_explode[$x]; ?>', true, false, '', '', '');

            <?php
        } else {
            $last_value_id = md5($x - 1 . $group_explode[$x - 1]);
            $id_group = $value_id;
            ?>
            tree_data('<?php echo $value_id; ?>', '<?php echo $last_value_id; ?>', '<?php echo $group_explode[$x]; ?>', true, false, '', '', '');
            <?php
        }
    }

    $layer_id = md5('layer_' . $row_layers['id']);
    ?>
    tree_data('<?php echo $layer_id; ?>', '<?php echo $value_id; ?>', '<?php echo $row_layers['name']; ?>', false, <?php echo $row_layers['visible'] ?>, '<?php echo $server["url"] ?>', '<?php echo $row_layers['layer']; ?>', '<?php echo $row_layers['name']; ?>');

    <?php
}
?>




