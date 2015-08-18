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
session_start();
include __DIR__ . '/../views/connections.php';

if (isset($_POST['password_nova'])) {
    $salt = uniqid('', true);
    $password = sha1($_POST['password_nova'] . $salt);
    $connection->query('UPDATE users SET password ="' . $password . '" , salt = "' . $salt . '" WHERE username ="' . $_POST['username'] . '"');
    // Enter the Code you want to execute after the form has been submitted
    // Dispaly Success or failure Message if any 
} else {
    ?>
    <script type="text/javascript">
        $(function () {
            $('#form_change_password').on('submit', function (e) {
                e.preventDefault();
                if ($('#password_nova').val() === $('#repetir_password_nova').val()) {
                    $.ajax({
                        type: 'post',
                        url: '../tools/_changepasswordform.php',
                        data: $('#form_change_password').serialize(),
                        success: function () {
                            $("#error_print").html('<div class="alert alert-info" role="alert">Password alterada com sucesso!!</div>');

                        }
                    });
                } else {
                    $("#error_print").html('<div class="alert alert-info" role="alert">A nova password não é identica á repetição!!</div>');
                }
            });
        });

    </script>
    <div>
        <form method="post" id="form_change_password" name="form_change_password">
            <input type="hidden" name="username" id="username" class="form-control" value="<?php echo $_SESSION['login_username'] ?>"><br>
            <!--            <label for="password_atual">Password Atual: </label>
                        <input type="password" name="password_atual" id="password_atual" class="form-control"><br>-->
            <label for="password_nova">Password Nova: </label>
            <input type="password" name="password_nova" id="password_nova" class="form-control"><br>
            <label for="repetir_password_nova">Repetir Password Nova: </label>
            <input type="password" name="repetir_password_nova" id="repetir_password_nova" class="form-control"><br>
            <hr>
            <button type="submit" class="btn btn-primary" name="alterar_password" id="alterar_password">Alterar</button>
        </form>
        <div id="error_print"></div>
    </div>

    <?php
}


