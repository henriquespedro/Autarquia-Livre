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
?>
<script type="text/javascript" >
    $(document).attr("title", "<?php echo $row['description']; ?>");
    $("#site_name").html('<?php echo $row['description']; ?>');
    //                var map_resolutions = [69, 30, 17, 5, 2, 1, 0.5, 0.2];

    var view_extent = [<?php echo $row['init_extent']; ?>];
    var view_units = '<?php echo $row['units']; ?>';
    var view_projection = '<?php echo $row['projection']; ?>';
    var map_resolutions = [];
<?php
$view_scales = explode(",", $row['scales']);

for ($i = 0; $i < count($view_scales); $i++) {
    ?>
        var scale_value = parseFloat(<?php echo $view_scales[$i]; ?>);
        map_resolutions[<?php echo $i ?>] = 1 / ((1 / scale_value) * 39.37 * 72);
        $('#select_scales').append('<option value="<?php echo $view_scales[$i]; ?>">1:<?php echo $view_scales[$i]; ?></option>');
    <?php
}
?>
</script>
<?php
$load_tabs = $connection->query('SELECT * FROM viewer_tabs WHERE viewer_id =' . $row['id']);
$load_search = $connection->query('SELECT * FROM search WHERE viewer_id =' . $row['id'] . ' and visible = 1');
$load_formularios = $connection->query('SELECT * FROM forms WHERE viewer_id =' . $row['id']);
?>
<script>
<?php
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
while ($row_search = $load_search->fetchArray(SQLITE3_ASSOC)) {
    ?>
        $('#search').append('<button type="button" onclick="search_<?php echo $row_search['id']; ?>()" title="<?php echo $row_search['description']; ?>" class="btn btn-default bt_size " data-toggle="button"> <span class="glyphicon" style="background-image:url(../images/appbar.map.folds.svg);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p ><?php echo $row_search['name']; ?></p></button>');
        $('#search_div').append('<div id="search_div_<?php echo $row_search['id']; ?>"></div>');
        function search_<?php echo $row_search['id']; ?>() {
            change_active_option();
            $("#options").html($("#search_div_<?php echo $row_search['id']; ?>").html());
        }
    <?php
    $load_search_paramenters = $connection->query('SELECT * FROM search_parameters WHERE search_id =' . $row_search['id'] . '');

    while ($row_search_parameters = $load_search_paramenters->fetchArray(SQLITE3_ASSOC)) {
        if ($row_search_parameters['type'] === 'Lista_Valores') {
            ?>
                $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $row_search_parameters['id'] ?>" ><label for="search_parameter_<?php echo $row_search_parameters['id'] ?>"><?php echo $row_search_parameters['name'] ?>:</label><select class="form-control" onchange="function_search_<?php echo $row_search_parameters['id'] ?>(this)" name="search_parameter_<?php echo $row_search_parameters['id'] ?>" id="search_parameter_<?php echo $row_search_parameters['id'] ?>"><option value="1">one</option><option value="2">two</option></select></div>');

                function function_search_<?php echo $row_search_parameters['id'] ?>(select) {
                    $.ajax({
                        url: 'search.php',
                        type: 'post',
                        dataType: "json",
                        data: {'corrent_parameter_id': <?php echo $row_search_parameters['id'] ?>, 'search_parameter_id': <?php echo ($row_search_parameters['id'] + 1) ?>, 'searh_parameter_value': select.value},
                        success: function (data) {
                            $('#search_parameter_<?php echo ($row_search_parameters['id'] + 1) ?>').append('<option value="' + data["value"] + '">' + data["description"] + '</option>');
                        }
                    });
                }

            <?php
        } else {
            ?>
                $('#search_div_<?php echo $row_search['id']; ?>').append('<div id="div_search_parameter_<?php echo $row_search_parameters['id'] ?>" ><label for="search_parameter_<?php echo $row_search_parameters['id'] ?>"><?php echo $row_search_parameters['name'] ?>:</label><input type="text" class="form-control" name="search_parameter_<?php echo $row_search_parameters['id'] ?>" id="search_parameter_<?php echo $row_search_parameters['id'] ?>"/></div>');
            <?php
        }
    }
    ?>

    <?php
}
while ($row_forms = $load_formularios->fetchArray(SQLITE3_ASSOC)) {
    ?>
        $('#modulos').append('<button type="button" onclick="formulario(<?php echo $row_forms['id']; ?>)" title="<?php echo $row_forms['description']; ?>" class="btn btn-default bt_size"> <span class="glyphicon" style="background-image:url(../images/<?php echo $row_forms['icon']; ?>);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p ><?php echo $row_forms['name']; ?></p></button>');
    <?php
}
?>
    $('#top_tabs').append('<button type="button" title="Iniciar sessão no site" class="btn btn-default btn_config" data-toggle="modal" data-target="#LoginModal"><span class="glyphicon glyphicon-user"/> Iniciar Sessão</button>');
    $('#top_tabs li').first().addClass("active");
    $('#content_tabs div').first().addClass("active");
</script>

<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/tools.js'); ?>

<!-- Modal -->
<div id="LoginModal"  class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Iniciar Sessão</h4>
            </div>
            <div class="modal-body">
                <form class="contact" name="contact">
                    <div class="form-group">
                        <label for="username" class="control-label">Utilizador:</label>
                        <input type="text" class="form-control" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password:</label>
                        <input type="Password" class="form-control" id="password">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <input class="btn btn-success" type="submit" value="Login!" id="submit">
                <a href="#" class="btn btn-info" data-dismiss="modal">Cancelar</a>
            </div>
        </div>
    </div>
</div>