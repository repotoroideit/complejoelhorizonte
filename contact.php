<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['submit'])) {

    require '/home/c2660440/public_html/PHPMailer/src/Exception.php';
    require '/home/c2660440/public_html/PHPMailer/src/PHPMailer.php';
    require '/home/c2660440/public_html/PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();
        $mail->Host       = 'c1661514.ferozo.com';

        $mail->SMTPAuth   = true;
        $mail->Username   = 'reservas@complejoelhorizonte.com.ar';
        $mail->Password   = 'hUHop7dwe798302';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        $name = $_POST['fullname'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        $mailContent = "
     <!DOCTYPE html>
     <html>
     <head>
         <style>
             body {
                 font-family: Arial, sans-serif;
                 background-color: #f4f4f4;
                 margin: 0;
                 padding: 0;
                 color: #333333;
             }
             .container {
                 width: 100%;
                 padding: 20px;
                 background-color: #ffffff;
                 border-radius: 10px;
                 box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
                 max-width: 600px;
                 margin: 40px auto;
             }
             .header {
                 background-color: #FF724C;
                 color: #ffffff;
                 padding: 20px;
                 text-align: center;
                 border-top-left-radius: 10px;
                 border-top-right-radius: 10px;
             }
             .header h1 {
                 margin: 0;
                 font-size: 24px;
             }
             .content {
                 padding: 20px;
                 font-size: 16px;
                 line-height: 1.6;
             }
             .content p {
                 margin-bottom: 20px;
             }
             .content strong {
                 color: #FF724C;
             }
             .footer {
                 text-align: center;
                 padding: 10px;
                 font-size: 12px;
                 color: #888888;
             }
         </style>
     </head>
     <body>
         <div class='container'>
             <div class='header'>
                 <h1>Nuevo mensaje desde el sitio web</h1>
             </div>
             <div class='content'>
                 <p><strong>Nombre:</strong> $name</p>
                 <p><strong>Email:</strong> $email</p>
                 <p><strong>Mensaje:</strong></p>
                 <p>$message</p>
             </div>
             <div class='footer'>
                 <p>Este es un mensaje automatico enviado desde el formulario de contacto en el sitio web.</p>
             </div>
         </div>
     </body>
     </html>
     ";

        $mail->setFrom('web@complejoelhorizonte.com.ar', 'Contacto WEB');
        $mail->addAddress('reservas@complejoelhorizonte.com.ar');
        $mail->isHTML(true);
        $mail->Subject = 'Contacto WEB - ' . $name;
        $mail->Body    = $mailContent;

        $mail->send();


        header('Location: index.html');
    } catch (Exception $e) {
        echo json_encode([
            "status" => "error",
            "message" => "Error de envío: " . $e->getMessage()
        ]);
    }
}
