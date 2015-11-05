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

while ($row_tabs = $load_tabs->fetchArray(SQLITE3_ASSOC)) {
    ?>
    var tab_name = "<?php echo $row_tabs['name']; ?>";
    if (tab_name === 'Pesquisas') {
        $("#top_tabs").append('<li id="top_tab_<?php echo $row_tabs['id']; ?>"  class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><?php echo $row_tabs['name']; ?><span class="caret"></span></a><ul id="search_ul" class="dropdown-menu" ><li id="divider_search" role="presentation" class="divider"></li><li role="presentation"><a style="font-size: 12px" role="menuitem" tabindex="-1" href="javascript:clear_results_search()" >Apagar Resultados</a></li></ul></li>');

    } else {
    
        $('#top_tabs').append('<li id="top_tab_<?php echo $row_tabs['id']; ?>" class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button"><?php echo $row_tabs['name']; ?><span class="caret"></span></a><ul id="tab_<?php echo $row_tabs['id']; ?>" class="dropdown-menu"></ul></li>');
    }
    <?php
    $load_tools = $connection->query('SELECT tools.* FROM viewer_tabs_tools INNER JOIN viewer_tabs ON viewer_tabs_tools .tabs_id=viewer_tabs.id LEFT JOIN tools ON tools.id = viewer_tabs_tools.tools_id WHERE viewer_tabs.id ="' . $row_tabs['id'] . '"');
    while ($row_tools = $load_tools->fetchArray(SQLITE3_ASSOC)) {
        ?>
        var name = "<?php echo $row_tools['name'] ?>";
        var layout_id = "<?php echo $row_tabs['id']; ?>";
        var funcao = "<?php echo $row_tools['code']; ?>()";
        var description = "<?php echo $row_tools['description']; ?>";
        var icon = "<?php echo $row_tools['icon']; ?>";
        if (name === 'Pesquisas') {
        $("#tab_" + layout_id).append('<div style="display:inline;" class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" id="pesquisas"  title="' + description + '" data-toggle="dropdown"><span class="glyphicon" style="background-image:url(imagens/' + icon + ');background-repeat:no-repeat;background-position:center;width:20px;height:20px;"aria-hidden="true"></span><span class="caret"></span></button><ul id="search_ul" class="dropdown-menu" role="menu" aria-labelledby="menu1"></ul></div>');
        } else {
        $("#tab_" + layout_id).append("<li><a href='javascript:" + funcao + "'  tabindex='-1' style='font-size: 12px;'><span class='glyphicon' style='background-image:url(imagens/simple/" + icon + ");background-repeat:no-repeat;background-position:center;width:12px;height:12px;'aria-hidden='true'></span>  " + description + "</a></li>");
        }
        <?php
    }
}
?>
