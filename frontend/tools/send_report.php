<?php
include __DIR__ . '/../views/connections.php';

/**
 * @copyright (c) 2015, Pedro Henriques
 * @return string Mensagem enviada ou não
 * @param string $SMTP_HOST - Nome do servidor de smtp de envio (tb pode ser da gmail)
 * @param string $SMTP_PORT - Porta do servidor de email
 * @param string $SMTP_UNAME - Email de um utilizador com acesso ao mail, não tem que ter obrigariamente que ser admin, pode ser um email criado exclusivamente para os script's
 * @param string $SMTP_PWORD - Password do email anterior
 */
$resultConfigMail = $connection->query('SELECT smtp_host, smtp_port, smtp_username, smtp_password FROM config LIMIT 1');
while ($rowmail = $resultConfigMail->fetchArray(SQLITE3_ASSOC)) {
    define("SMTP_HOST", $rowmail['smtp_host']);
    define("SMTP_PORT", $rowmail['smtp_port']);
    define("SMTP_UNAME", $rowmail['smtp_username']);
    define("SMTP_PWORD", $rowmail['smtp_password']);
    
    //Email para envio
    $EMAIL_RECEPTOR = $rowmail['smtp_username'];
}
include "classes/class.phpmailer.php";


// Ciclo para receber os valores enviados por url através do Ficheiro Javascript da aplicação e para definir automaticamente a variavel e o respectivo valor 
foreach ($_REQUEST as $key => $value) {
    $$key = $value;
}

// Estruturação da Mensagem em HTML
$message = '<html><body>';
$message .= '<img src="http://www.w3.org/TR/html5/images/HTML5_Logo.png" alt="Autarquia Livre" /><br><br>';
$message .= 'Foi submetido com sucesso o registo de problemas/erros na aplicação:<br>';
$message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
$message .= "<tr style='background: #eee;'><td><strong>Tipo:</strong> </td><td>" . $type . "</td></tr>";
$message .= "<tr style='background: #ccc;'><td><strong>Nome:</strong> </td><td>" . $name. "</td></tr>";
$message .= "<tr><td><strong>Mensagem:</strong> </td><td>" . $mensagem . "</td></tr>";
$message .= "</table>";
$message .= "</body></html>";


// Envio do email
$mail = new PHPMailer; //Construtor
$mail->IsSMTP();


$mail->Host = SMTP_HOST;
$mail->Port = SMTP_PORT;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth = true;
$mail->Username = SMTP_UNAME;
$mail->Password = SMTP_PWORD;
$mail->AddAddress($EMAIL_RECEPTOR); //Endereço destinatário
//$mail->AddReplyTo($EMAIL_RECEPTOR); //Endereço de resposta
$mail->SetFrom($EMAIL_RECEPTOR, $name); //Endereço de envio

$mail->Subject = "Registo de problemas/erros no visualizador"; //Subject od your mail
$mail->MsgHTML($message); //Put your body of the message you can place html code here
$send = $mail->Send(); //Enviar o email

if ($send) {
    echo 'success';
}
?>
