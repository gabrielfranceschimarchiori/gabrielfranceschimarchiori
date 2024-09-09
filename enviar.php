<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Informações do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Configurações do PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configurações do servidor SMTP (Gmail)
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Servidor SMTP do Google
        $mail->SMTPAuth = true;
        $mail->Username = 'gabriel@franceschi.com.br'; // Seu e-mail
        $mail->Password = 'SUA_SENHA'; // Senha do seu e-mail ou senha de aplicativo do Google
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587; // Porta SMTP

        // Destinatário
        $mail->setFrom('gabriel@franceschi.com.br', 'Franceschi');
        $mail->addAddress($email, $nome);

        // Conteúdo do e-mail
        $mail->isHTML(true);
        $mail->Subject = 'Cadastro Confirmado - Acesso ao Conteúdo Restrito';
        $mail->Body = "<h1>Olá, $nome!</h1><p>Obrigado por se cadastrar. Agora você tem acesso aos conteúdos exclusivos do nosso app.</p>";

        // Enviar e-mail
        $mail->send();
        echo 'E-mail enviado com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar e-mail: {$mail->ErrorInfo}";
    }
}
?>
