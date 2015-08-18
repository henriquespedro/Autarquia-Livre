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
    $('#top_tabs').append('<li title="<?php echo $row_tabs['name']; ?>"><a href="#<?php echo $row_tabs['code']; ?>" data-toggle="tab"><?php echo $row_tabs['name']; ?></a></li>');
    $('#content_tabs').append('<div id="<?php echo $row_tabs['code']; ?>" class="tab-pane btn-group"></div>');
    <?php
    $load_tools = $connection->query('SELECT * FROM tools WHERE tabs_id ="' . $row_tabs['code'] . '"');
    while ($row_tools = $load_tools->fetchArray(SQLITE3_ASSOC)) {
        ?>
        $('#<?php echo $row_tabs['code']; ?>').append('<button type="button" onclick="<?php echo $row_tools['code']; ?>()" title="<?php echo $row_tools['description']; ?>" class="btn btn-default bt_size"> <span class="glyphicon" style="background-image:url(../images/<?php echo $row_tools['icon']; ?>);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p ><?php echo $row_tools['name']; ?></p></button>');
        <?php
    }
}
?>

<?php
if (isset($_SESSION['login_username'])) {
    ?>
    $('#top_tabs').append('<li title="Ferramentas de Login/Gestão do Utilizador"><a href="#utilizador_tools" data-toggle="tab" id="tab_user">Utilizador: <?php echo $_SESSION['login_username'] ?></a></li>');
    $('#content_tabs').append('<div id="utilizador_tools" class="tab-pane btn-group"></div>');
    $('#utilizador_tools').html('<button type="button" title="Alterar password"  data-toggle="modal" onclick="change_password()" class="btn btn-default bt_size"> <span class="glyphicon glyphicon-user"/><p>Alterar Password</p></button>');
    $('#utilizador_tools').append('<button type="button" title="Terminar sessão" onclick="document.location.href=&#39;../views/viewer/logout.php&#39;" class="btn btn-default bt_size"> <span class="glyphicon glyphicon-user"/><p>Terminar Sessão</p></button>');
    <?php
}
?>

$('#top_tabs li').first().addClass("active");
$('#content_tabs div').first().addClass("active");