<?php
//Activamos el almacenamiento en el buffer
ob_start();
if (strlen(session_id()) < 1) 
  session_start();

if (!isset($_SESSION["nombre"]))
{
  echo 'Debe ingresar al sistema correctamente para visualizar el reporte';
}
else
{
if ($_SESSION['soporte']==1)
{
//Incluímos el archivo Factura.php
require('Factura.php');

//Establecemos los datos de la empresa
$logo = "mascara.png";
$ext_logo = "png";
$empresa = "SLTECHNOLOGY";
$documento = "1017*******";
$direccion = "Medellin, Colombia";
$telefono = "3023571736";
$email = "stevenhernandezj@gmail.com";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/Soporte.php";
$soporte= new Soporte();
$rsptav = $soporte->listar($_GET["id"]);
//Recorremos todos los valores obtenidos
$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
$pdf->fact_dev( "$regv->identificador ", '- Factura #'."$regv->idsoporte" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fechaentrada);

$pdf->addClientAdresse(utf8_decode($regv->nombres." ".$regv->apellidos),
"Direccion: ".utf8_decode($regv->direccion), 
"Identificador: ".$regv->identificador,
"Correo: ".$regv->correo,
"Telefono: ".$regv->telefono);

$cols=array( "CODIGO"=>23,
             "DESCRIPCION"=>78,
             "CANTIDAD"=>22,
             "P.U."=>25,
             "DSCTO"=>20,
             "SUBTOTAL"=>22);
$pdf->addCols( $cols);
$cols=array( "CODIGO"=>"L",
             "DESCRIPCION"=>"L",
             "CANTIDAD"=>"C",
             "P.U."=>"R",
             "DSCTO" =>"R",
             "SUBTOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
$y= 89;


$rsptad = $soporte->listar($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "CODIGO"=> "$regd->cliente",
                "DESCRIPCION"=> utf8_decode("$regd->direccion"),
                "CANTIDAD"=> "$regd->identificador",
                "P.U."=> "$regd->correo",
                "DSCTO" => "$regd->telefono",
                "SUBTOTAL"=> "$regd->valortotal");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->valortotal,"PESOS COP"));
$pdf->addCadreTVAs("---".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto, $regv->valortotal,"$ ");
$pdf->addCadreEurosFrancs("IGV"." $regv->impuesto %");
$pdf->Output('Reporte de Venta','I');


}
else
{
  echo 'No tiene permiso para visualizar el reporte';

}
}
ob_end_flush();
?>