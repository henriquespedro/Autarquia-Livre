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

include __DIR__ . '/../../connections.php';
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
?>
</script>
<script src="../javascript/map.js"></script>
<script src="../javascript/default.js"></script>
<script type="text/javascript" >
<?php
include_once 'layers.php';
if ($row["theme"] === 'default') {
    include_once 'tabs.php';
    include_once 'pesquisas.php';

    $load_formularios = $connection->query('SELECT * FROM forms WHERE viewer_id =' . $row['id']);

    while ($row_forms = $load_formularios->fetchArray(SQLITE3_ASSOC)) {
        ?>
            $('#modulos').append('<button type="button" onclick="formulario(<?php echo $row_forms['id']; ?>)" title="<?php echo $row_forms['description']; ?>" class="btn btn-default btn-default-menu bt_size"> <span class="glyphicon" style="background-image:url(../images/<?php echo $row_forms['icon']; ?>);background-repeat:no-repeat;background-position:center;width:26px;height:26px;" aria-hidden="true"></span><p ><?php echo $row_forms['name']; ?></p></button>');
        <?php
    }
} elseif ($row["theme"] === 'mobile') {
    include_once 'tabs.php';
    include_once 'pesquisas.php';
    include_once 'formularios.php';
} elseif ($row['theme'] === 'sugestoes') {
    $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/sugestoes.js');
}
?>

</script>


<?php $this->registerJsFile(Yii::$app->request->baseUrl . '/../javascript/tools.js'); ?>