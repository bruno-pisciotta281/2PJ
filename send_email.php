<?php
// Inclua os arquivos do PHPMailer
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $servico = $_POST['servico'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'brunopisciotta43@gmail.com'; // Seu endereço de email SMTP
        $mail->Password = 'hgui nqui cfod kqqw'; // Sua senha de email SMTP
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom('bruno.pisciotta43@gmail.com', 'Bruno Pisciotta');
        $mail->addAddress('bruno.pisciotta@novotemporh.com.br', 'Breno'); // Substitua pelo e-mail do cliente

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = "Novo pedido de orçamento de $nome";
        $mail->Body = "
            <h1>Novo pedido de orçamento</h1>
            <p><strong>Nome:</strong> $nome</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Serviço:</strong> $servico</p>
            <p><strong>Mensagem:</strong> $mensagem</p>
        ";
        $mail->AltBody = "Nome: $nome\nEmail: $email\nServiço: $servico\nMensagem:\n$mensagem";

        $mail->send();
        echo 'Email enviado com sucesso!';
    } catch (Exception $e) {
        echo "Falha ao enviar o email. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
