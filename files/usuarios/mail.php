<?php 
//TODO: ENVIAR CORREO 
$mensaje = "CONSTANCIa DE SOPORTE SLTECHNOLOGY";

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );
$from = "stevenhernandezj@gmail.com";
$to = 'stevenhernandezj@gmail.com';
$subject = strtoupper($mensaje);
$message = "d";
$headers = "From:" . $from. "\r\n" .'X-Mailer: PHP/' . phpversion();
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html\r\n";
if (mail($to,$subject,$message, $headers))
    {
        echo "\r\n mensaje enviado";
    }
    else
    {
        echo "\r\n Error: mensaje no enviado";
    }
?>