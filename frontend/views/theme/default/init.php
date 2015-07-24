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
include __DIR__ .'/../../connections.php';
?>

<script type="text/javascript" >
    $(document).attr("title", "<?php echo $row['description']; ?>");
    $("#site_name").html('<?php echo $row['description']; ?>');

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

include_once 'layers.php';
include_once 'tabs.php';
include_once 'pesquisas.php';
include_once 'formularios.php';
?>

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
                <form action="" id="login_form" >
                    <div class="form-group">
                        <label for="username" class="control-label">Utilizador:</label>
                        <input type="text" class="form-control" name="username" id="username">
                    </div>
                    <div class="form-group">
                        <label for="password" class="control-label">Password:</label>
                        <input type="Password" class="form-control" name="password" id="password">
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-success" type="submit" value="Login!" id="login_submit" name="login_submit">
                        <a href="#" class="btn btn-info" data-dismiss="modal">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $('#login_form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: "../views/viewer/login.php",
            type: "POST",
            data: $('#login_form').serialize() + '&login_submit=',
            success: function (data) {
                if (data === "Sucesso") {
                    $('#LoginModal').modal('hide');
                    alert(data);
                } else {
                    alert(data);
                }
            },
            error: function () {
                alert('Ocorreu um erro ao validar o utilizador! Por favor, volte a tentar mais tarde!');
            }
        });
    });
</script>
