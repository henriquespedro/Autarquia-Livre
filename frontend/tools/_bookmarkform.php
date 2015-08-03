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

$connection = new SQLite3(__DIR__ . '/../../data/data.db');
$resultbookmarks = $connection->query('SELECT * FROM bookmarks WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');

?>
<div id="content_draw" class="list-group">
    <label>Bookmarks</label>
    <?php
    while ($row = $resultbookmarks->fetchArray(SQLITE3_ASSOC)) {
        ?>
        <a href="#" zoom="<?php echo $row['zoom'] ?>" stx ="<?php echo $row['x_coordinate'] ?>" sty ="<?php echo $row['y_coordinate'] ?>" class="list-group-item"><?php echo $row['name'] ?></a>
        <?php
    }
    ?>
</div>

<script>
    $(".list-group-item").on("click", function (event) {
        var coordinates_bbox = [parseFloat($(this).attr('stx')), parseFloat($(this).attr('sty'))];
        if (coordinates_bbox === '') {
            alert('Não é possível ir para o local pretendido')
        } else {
            map.getView().setCenter(coordinates_bbox);
            map.getView().setZoom($(this).attr('zoom'));
        }

    });
</script>