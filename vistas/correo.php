<?php
require_once "../modelos/Soporte.php";

$soporte=new Soporte();

$idsoporte=isset($_POST["idsoporte"])? limpiarCadena($_POST["idsoporte"]):"";
$nombres=isset($_POST["nombres"])? limpiarCadena($_POST["nombres"]):"";
$apellidos=isset($_POST["apellidos"])? limpiarCadena($_POST["apellidos"]):"";
$fechaentrada=isset($_POST["fechaentrada"])? limpiarCadena($_POST["fechaentrada"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$cantidadequipos=isset($_POST["cantidadequipos"])? limpiarCadena($_POST["cantidadequipos"]):"";
$valortotal=isset($_POST["valortotal"])? limpiarCadena($_POST["valortotal"]):"";
$identificador=isset($_POST["identificador"])? limpiarCadena($_POST["identificador"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$respuesta=isset($_POST["respuesta"])? limpiarCadena($_POST["respuesta"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$valorunidad=isset($_POST["valorunidad"])? limpiarCadena($_POST["valorunidad"]):"";
$adjuntar=isset($_POST["adjuntar"])? limpiarCadena($_POST["adjuntar"]):"";

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );
    $from = "stevenhernandezj@gmail.com";
    $to = $correo;
    $subject = "Checking PHP mail";
    $message = "PHP mail works just fine";
    $headers = "From:" . $from;
    mail($to,$subject,$message, $headers);
    echo "The email message was sent.";


 
?>