<?php
error_reporting(0);
?>

<?php
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}
include __DIR__ . '/../connections.php';


foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}


$arrayParametros = array();
$resultGet = $connection->query('SELECT * FROM forms WHERE id = "' . $form . '"');
if (!$resultGet) {
    echo "Erro ao obter informação da base de dados!";
} else {

    $srccount = 0;
    $result = array();
    while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {
        $srccount++;
        $result = $row;
        $pagina = $result['html_template'];
        $sqlGetSelect = $result['sql_select'];
        $sqldelete = $result['sql_delete'];
        $sqlupdate = $result['sql_update'];
        $sqlinsert = $result['sql_insert'];
        $chave = $result['id'];
        $connection_param = $result['datasource_id'];
    }

    if ($srccount === 0) {
        echo 'O módulo que prentende aceder não existe!';
    } else {
        if (!@file_exists('../forms_templates/' . $pagina)) {
            echo 'A ficha que pretende aceder não existe!';
        } else {
            include __DIR__ . '/../connections.php';
            $parametroscount = 0;
            $resultGet = $connection->query('SELECT * FROM forms_parameters WHERE form_id = "' . $form . '" ORDER BY id asc');
            if (!$resultGet) {
                echo "Erro ao obter informação da base de dados!";
            } else {
                ?>
                <div id="search_page" style="text-align:center;">
                    <form action="" id="form_search" method="post">
                        <input type="hidden" name="form" id="form" value="<?php echo $_REQUEST['form'] ?>"> 
                        <?php
                        $valor_parametros = array();
                        $k = 0;
                        while ($row = $resultGet->fetchArray(SQLITE3_ASSOC)) {
                            $valor_parametros[$k] = $row;
                            $k++;
                        }
                        for ($i = 0; $i < count($valor_parametros); $i++) {
                            array_push($arrayParametros, $valor_parametros[$i]['parameter']);
                            $parametro = $valor_parametros[$i]['parameter'];
                            $campo_descricao = $valor_parametros[$i]['description_field'];
                            $campo_interno = $valor_parametros[$i]['parameter'];
                            $sql_query = $valor_parametros[$i]['sqlquery'];
                            $tipo = $valor_parametros[$i]['type'];
                            $label = $valor_parametros[$i]['label'];
                            if ($i + 1 <= count($valor_parametros)) {
                                $parametro2 = $valor_parametros[$i + 1]['parameter'];
                                $campo_descricao2 = $valor_parametros[$i + 1]['description_field'];
                                $campo_interno2 = $valor_parametros[$i + 1]['parameter'];
                                $sql_query2 = $valor_parametros[$i + 1]['sqlquery'];
                            }

                            if ($tipo == 'caixa_texto') {
                                ?>
                                <label for="<?php echo $parametro; ?>" ><?php echo $label; ?>: </label>
                                <input type=text class="form-control" id="<?php echo $parametro; ?>" name='<?php echo $parametro; ?>'>
                                <?php
                            } elseif ($tipo == 'lista_valores') {

                                $count = count($valor_parametros);

                                if ($count == 0 || $i == 0) {
                                    $querySelectFicha = pg_query($conn, $sql_query);
                                    ?>
                                    <div>
                                        <label for="<?php echo $parametro; ?>"><?php echo $label ?>:</label>
                                        <select class="form-control" id="<?php echo $parametro; ?>" name="<?php echo $parametro; ?>" onchange="<?php echo $parametro; ?>Select()">
                                            <option class="class" value=""></option>
                                            <?php while ($row = pg_fetch_array($querySelectFicha)): ?>
                                                <option class='class' value="<?php echo $row[$parametro]; ?>"><?php echo $row[$campo_descricao]; ?></option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>

                                    <?php
                                } elseif ($i + 1 === count($valor_parametros)) {
                                    ?>
                                    <div>
                                        <label for="<?php echo $parametro; ?>"><?php echo $label ?>:</label>
                                        <select class="form-control" id="<?php echo $parametro ?>" name="<?php echo $parametro ?>">
                                        </select>
                                    </div>
                                    <?php
                                } elseif ($i < count($valor_parametros)) {
                                    ?>
                                    <div>
                                        <label for="<?php echo $parametro; ?>"><?php echo $label ?>:</label>
                                        <select class="form-control"  id="<?php echo $parametro ?>" name="<?php echo $parametro ?>" onchange="<?php echo $parametro ?>Select()">
                                        </select>
                                    </div>
                                    <?php
                                }

                                if ($i + 1 < count($valor_parametros)) {
                                    ?>
                                    <script type="text/javascript">

                                        function <?php echo $parametro ?>Select() {
                                            var sql_replace = "<?php echo $sql_query2 ?>";

                            <?php
                            for ($k = 0; $k < count($arrayParametros); ++$k) {
                                ?>
                                                var <?php echo $arrayParametros[$k] ?> = document.getElementById("<?php echo $arrayParametros[$k] ?>").value;
                                                sql_replace = sql_replace.replace("$<?php echo $arrayParametros[$k] ?>", <?php echo $arrayParametros[$k] ?>);

                            <?php }
                            ?>

                                            var query = sql_replace;
                                            var sql_query_Parametros = "<?php echo $parametrosFinais ?>";
                                            var sql_query2 = "<?php echo $parametrosFinais ?>";
                                            var parametrosFinais = "<?php echo $parametrosFinais ?>";
                                            var campo_interno2 = "<?php echo $campo_interno2 ?>";

                                            $.getJSON('../views/forms/query.php', {query: query, connection_param: <?php echo $connection_param ?>},
                                            function (data) {
                                                /* Apaga todos os valores da Combobox */
                                                $("#<?php echo $parametro2 ?>").empty();

                                                /* Adiciona os novos valores */
                                                var sel = document.getElementById("<?php echo $parametro2 ?>");
                                                $.each(data, function (key, val) {
                                                    var opt = document.createElement('option');
                                                    opt.innerHTML = val.<?php echo $campo_descricao2; ?>;
                                                    opt.value = val.<?php echo $campo_interno2; ?>;
                                                    sel.appendChild(opt);
                                                });
                                                document.getElementById('<?php echo $parametro2 ?>').selectedIndex = -1;

                                            });
                                        }
                                    </script>
                                    <?php
                                }
                            }
                        }
                        ?>
                        <hr>
                        <input type="button" id="forms_search" name="forms_search" class="btn btn-default" style="float:middle" value="Pesquisar" title="Pesquisar" />
                        <input type="button" id="novo" name="novo" class="btn btn-default" value="Novo registo" title="Novo registo" />
                    </form>
                </div>
                <?php
            }
            ?>

            <div id="html_page" style="display:none; position: absolute;">
                <form action="" id="form_page" method="post" >
                    <input type="hidden" id="ValorFunction" name="ValorFunction"/>
                    <div>
                        <!-- Validação se o modulo existe, se existir mostra, senão dá erro -->
                        <?php
                        include ('../forms_templates/' . $pagina);
                        ?>
                    </div>

                    <!-- Ferramentas gerais disponiveis nas fichas de Síntese -->
                    <hr>
                    <div class="btn-group" role="group" id="buttons">
                        <button type="button" id="voltar" name="voltar" class="btn btn-default" title="Voltar à pesquisa">Voltar</button>
                        <button type="button" id="apagar" name="apagar" class="btn btn-default" onclick="return confirm('Tem a certeza que deseja Apagar o registo?')" title="Apagar registo">Apagar Registo</button>
                        <button type="button" id="guardar" name="guardar" class="btn btn-default"  onclick="return confirm('Tem a certeza que deseja Guardar?')" title="Guardar registo">Guardar Registo</button>
                        <button type="button" id="print" name="print" class="btn btn-default" title="Imprimir">Imprimir</button>
                    </div>
                </form>
            </div>

            <?php
        }
    }
}
?>
<script>

    $("#voltar").click(function () {
        formulario(<?php echo $form ?>);
    });

    $("#apagar").click(function () {
        $.ajax({
            type: 'POST',
            url: '../views/forms/search_query.php',
            dataType: 'json',
            data: $('#form_page').serialize() + "&forms_delete=&connection_param=<?php echo $connection_param ?>",
            success: function (data) {
                alert('Registo apagado com sucesso!!!');
            }, error: function () {
                alert('Ocorreu um erro a apagar o registo!!!');
            }
        });
    });
    $("#novo").click(function () {
        document.getElementById('ValorFunction').value = "Novo";
        document.getElementById('search_page').style.display = 'none';
        document.getElementById('html_page').style.display = 'block';
    });

    $("#guardar").click(function () {
        $.ajax({
            type: 'POST',
            url: '../views/forms/search_query.php',
            dataType: 'json',
            data: $('#form_page').serialize() + "&forms_save=&connection_param=<?php echo $connection_param ?>",
            success: function (data) {
                alert('Registo alterado com sucesso!!!');
            }, error: function () {
                alert('Ocorreu um erro a guardar o registo!!!');
            }
        });
    });


    $("#forms_search").click(function () {
        $.ajax({
            type: 'POST',
            url: '../views/forms/search_query.php',
            dataType: 'json',
            data: $('#form_search').serialize() + "&forms_search=&connection_param=<?php echo $connection_param ?>",
            success: function (data) {
                if (data.length > 0) {
                    $.each(data[0], function (index, value) {
                        if ($("#form_" + index + "").length)
                        {
                            $("#form_" + index + "").val(value);
                        }
                    });
                    var guardar = document.getElementById("guardar");
                    var novo = document.getElementById("novo");
                    var apagar = document.getElementById("apagar");
                    var length = data[0].length;
                    if (length === 0) {
                        apagar.disabled = true;
                        novo.disabled = true;
                        guardar.disabled = false;
                        document.getElementById('ValorFunction').value = "Novo";
                        //document.getElementById('idseq').removeAttribute('readonly');
                        //form_submit.value = "Novo";
                    } else {
                        apagar.disabled = false;
                        novo.disabled = false;
                        guardar.disabled = false;
                        document.getElementById('ValorFunction').value = "Editar";
                        //document.getElementById('idseq').removeAttribute('readonly');
                    }
                    document.getElementById('search_page').style.display = 'none';
                    document.getElementById('html_page').style.display = 'block';

                } else {
                    alert('A pesquisa não devolveu resultados!!');
                }
            }
        });
    });
</script>