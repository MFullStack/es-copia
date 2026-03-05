<?php
// --- CONFIGURACIÓN NUEVO FORMULARIO CABECERA---
$to_email = 'info@rumbomed.com'; // Reemplaza esto con tu dirección de correo real
$subject = 'Nueva Solicitud de Reserva de Experiencia'; // Asunto del correo
$headers = "From: webmaster@rumbomed.com\r\n"; // Reemplaza esto con una dirección válida de tu dominio
$headers .= "Reply-To: " . $_POST['nombre_cliente'] . " <" . "no-reply@rumbomed.com" . ">\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// --- RECOGER DATOS DEL FORMULARIO ---
// Usamos $_POST porque en el HTML definimos method="POST"
$categoria = isset($_POST['categoria']) ? htmlspecialchars($_POST['categoria']) : 'No especificada';
$actividad = isset($_POST['actividad']) ? htmlspecialchars($_POST['actividad']) : 'No especificada';
$fecha     = isset($_POST['fecha_solicitud']) ? htmlspecialchars($_POST['fecha_solicitud']) : 'No especificada';
$nombre    = isset($_POST['nombre_cliente']) ? htmlspecialchars($_POST['nombre_cliente']) : 'No especificado';

// --- CONSTRUIR EL CUERPO DEL CORREO (Formato HTML) ---
$email_body = "
<html>
<head>
<title>Nueva Reserva Web</title>
</head>
<body>
  <h2>Detalles de la Solicitud de Reserva:</h2>
  <p><strong>Nombre del Cliente:</strong> $nombre</p>
  <p><strong>Categoría Seleccionada:</strong> $categoria</p>
  <p><strong>Actividad Seleccionada:</strong> $actividad</p>
  <p><strong>Fecha Deseada:</strong> $fecha</p>
  <hr>
  <p>Este es un mensaje automático enviado desde tu formulario web.</p>
</body>
</html>
";

// --- ENVIAR EL CORREO ---
if (mail($to_email, $subject, $email_body, $headers)) {
    // Redirigir al usuario a una página de éxito
    header('Location: gracias.html');
    exit;
} else {
    // Redirigir a una página de error si falla el envío
    header('Location: error.html');
    exit;
}
?>
<?php
