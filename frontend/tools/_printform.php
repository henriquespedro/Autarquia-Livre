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
$resultprint = $connection->query('SELECT * FROM maprint WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
$printfields = $connection->query('SELECT * FROM maprint_fields WHERE viewer_id = (SELECT id FROM viewers WHERE name = "' . $_POST["page"] . '") ORDER BY setOrder ASC');
?>
<!-- data-height="299" -->
<!--data-url="data1.json"--> 
<div id="list_maprint">
    <table style="width:100%" class="table table-condensed table-hover" data-click-to-select="true">

        <thead>
            <tr>
                <th data-field="select" data-checkbox="true"></th>
                <th data-field="planta" data-align="right">Planta</th>
                <th data-field="escala" data-align="center">Escala</th>
                <th data-field="layout" data-align="">Layout</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $resultprint->fetchArray(SQLITE3_ASSOC)) {
                ?>
                <tr>
                    <td style="vertical-align: middle"><input type="checkbox" class="checkbox" onclick="getRow(this)"/></td>
                    <td style="vertical-align: middle" width="45%"><?php echo $row['name'] ?></td>
                    <td width="30%">
                        <select class="form-control" id="scales">
                            <option value="2000">2000</option>
                        </select>
                    </td>
                    <td  width="30%">
                        <select class="form-control" id="layouts">
                            <option value="A4_Vertical">A4</option>
                        </select>
                    </td>
                    <td style="display:none;"><?php echo $row['description'] ?></td>
                    <td style="display:none;"><?php echo $row['description_font'] ?></td>
                    <td style="display:none;"><?php echo $row['layer'] ?></td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
    <hr>
    <button type="button" class="btn btn-primary" id="next_fields_print" onclick="next_fields()">Seguinte</button>
</div>
<div id="fields_print" style="display:none">
    <form data-toggle="validator" role="form">
        <?php
        while ($row = $printfields->fetchArray(SQLITE3_ASSOC)) {
            ?>
            <div class="form-group">
                <label for="field_<?php echo $row['id'] ?>" class="control-label"><?php echo $row['name'] ?></label>
                <input type="<?php echo $row['type'] ?>" class="form-control" id="field_<?php echo $row['id'] ?>" aria-required="<?php echo $row['required'] ?>" >
                <div class="help-block with-errors"></div>
            </div>
            <?php
        }
        ?>
    </form>
    <hr>
    <button type="button" class="btn btn-primary" id="back_list_print" onclick="back_list()">Anterior</button>
    <button type="button" class="btn btn-primary" id="next_results_print" onclick="next_results()">Seguinte</button>
</div>

<div id="results_print" style="display:none">

    <label>Plantas para Impressão</label><br><br>

    <div id="result_list">
        <ul>
            <li>Planta TopoCadastral</li>
            <!--            <li>Planta PDM - Ordenamento</li>
                        <li>Planta PUF - Zonamento</li>-->
        </ul>
    </div>

    <div id="result_notes">
        <p align="justify">
            A plantas de localização são disponibilizadas em formato <abbr title="Portable document format">pdf</abbr>, caso não possua um leitor para este formato, pode realizar download <a href="https://get.adobe.com/pt/reader" target="black"><b>aqui</b></a>.
        </p>
    </div>
    <hr>
    <button type="button" class="btn btn-primary" id="next_results_print" onclick='imprimir_plantas()'>Voltar</button>
</div>


<script>
    function next_fields() {
        value_check = 0;
        $('td .checkbox').each(function () {
            if (this.checked) {
                value_check = 1;
            }
        });
        if (value_check === 0) {
            $('#list_maprint').append('<div class="alert alert-info" role="alert">É obrigatónio escolher pelo menos uma planta!!</div>');
        } else {
            $('#list_maprint').hide();
            $('#fields_print').show();
        }
    }

    function back_list() {
        $('#list_maprint').show();
        $('#fields_print').hide();
    }

    function next_results() {
        $('#fields_print').hide();
        $('#results_print').show();
    }
</script>