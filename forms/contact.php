<?php
$receiving_email_address = 'info@rumbomed.com';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $phone   = strip_tags(trim($_POST["phone"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    $recipient = $receiving_email_address;
    $email_subject = "CONTACTO RUMBOMED: $subject";
    
    $email_content = "Nombre: $name\nTeléfono: $phone\nEmail: $email\nAsunto: $subject\n\nMensaje:\n$message";

    $headers = "From: Web Rumbomed <info@rumbomed.com>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    if (mail($recipient, $email_subject, $email_content, $headers)) {
        header("Location: gracias.html"); 
        exit;
    } else {
        echo "Error al enviar.";
    }
}