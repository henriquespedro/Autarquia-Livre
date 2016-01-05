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

$load_tabs = $connection->query('SELECT * FROM viewer_tabs WHERE viewer_id =' . $row['id']);
if ($row['name'] === 'gestao_urbanistica') {
    while ($row_tabs = $load_tabs->fetchArray(SQLITE3_ASSOC)) {
        ?>
        load_tabs_default("<?php echo $row_tabs['name']; ?>", "<?php echo $row_tabs['code']; ?>");
        <?php
        $load_tools = $connection->query('SELECT tools.* FROM viewer_tabs_tools INNER JOIN viewer_tabs ON viewer_tabs_tools .tabs_id=viewer_tabs.id LEFT JOIN tools ON tools.id = viewer_tabs_tools.tools_id WHERE viewer_tabs.id ="' . $row_tabs['id'] . '"');
        while ($row_tools = $load_tools->fetchArray(SQLITE3_ASSOC)) {
            ?>
            load_tools_default("<?php echo $row_tabs['code']; ?>","<?php echo $row_tools['code']; ?>", "<?php echo $row_tools['description']; ?>", "<?php echo $row_tools['icon']; ?>", "<?php echo $row_tools['name']; ?>");
            <?php
        }
    }

    if (isset($_SESSION['login_username'])) {
        ?>
        session_default("?php echo $_SESSION['login_username'] ?>");
        <?php
    }
    ?>

    $('#top_tabs li').first().addClass("active");
    $('#content_tabs div').first().addClass("active");
    <?php
} elseif ($row['name'] === 'eploc') {

    while ($row_tabs = $load_tabs->fetchArray(SQLITE3_ASSOC)) {
        ?>
        load_tabs_mobile("<?php echo $row_tabs['name']; ?>", "<?php echo $row_tabs['id']; ?>");
        <?php
        $load_tools = $connection->query('SELECT tools.* FROM viewer_tabs_tools INNER JOIN viewer_tabs ON viewer_tabs_tools .tabs_id=viewer_tabs.id LEFT JOIN tools ON tools.id = viewer_tabs_tools.tools_id WHERE viewer_tabs.id ="' . $row_tabs['id'] . '"');
        while ($row_tools = $load_tools->fetchArray(SQLITE3_ASSOC)) {
            ?>
            load_tools_mobile("<?php echo $row_tabs['id']; ?>", "<?php echo $row_tools['code']; ?>()", "<?php echo $row_tools['description']; ?>", "<?php echo $row_tools['icon']; ?>", "<?php echo $row_tools['name'] ?>");
            <?php
        }
    }
    ?>

    <?php
    if (isset($_SESSION['login_username'])) {
        ?>
        session_mobile("<?php echo $_SESSION['login_username'] ?>");
        <?php
    }
}
