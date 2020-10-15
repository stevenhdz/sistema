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
require('FacturaSoporte.php');

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

$rsptav = $soporte->listar1($_GET["id"]);
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

$pdf->fact_dev( "$regv->nombres $regv->apellidos", '- Factura #'."$regv->idsoporte" );
$pdf->temporaire( "" );
$pdf->addDate( $regv->fechaentrada);

$pdf->addClientAdresse(
"Nombres: ".utf8_decode($regv->nombres." ".$regv->apellidos),
"Direccion: ".utf8_decode($regv->direccion), 
"Identificador: ".$regv->identificador,
"Correo: ".$regv->correo,
"Telefono: ".$regv->telefono);

$cols=array( "NOMBRES"=>23,
             "DESCRIPCION"=>60,
             "TIPO ENTIDAD"=>27,
             "CORREO"=>25,
             "TELEFONO"=>24,
             "TOTAL"=>25);
$pdf->addCols( $cols);
$cols=array( "NOMBRES"=>"L",
             "DESCRIPCION"=>"L",
             "TIPO ENTIDAD"=>"C",
             "CORREO"=>"R",
             "TELEFONO" =>"R",
             "TOTAL"=>"C");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
$y= 89;


$rsptad = $soporte->listar1($_GET["id"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "NOMBRES"=> "$regd->nombres $regd->apellidos",
                "DESCRIPCION"=> utf8_decode("$regd->descripcion"),
                "TIPO ENTIDAD"=> "$regd->identificador",
                "CORREO"=> "$regd->correo",
                "TELEFONO" => "$regd->telefono",
                "TOTAL"=> "$regd->valortotal");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
require_once "Letras.php";
$V=new EnLetras(); 
$con_letra=strtoupper($V->ValorEnLetras($regv->valortotal,"PESOS COP"));
$pdf->addCadreTVAs("".$con_letra);

//Mostramos el impuesto
$pdf->addTVAs( $regv->impuesto = 19, $regv->valortotal,"$ ");
$pdf->addCadreEurosFrancs("IVA"." $regv->impuesto %");
$pdf->Output('Factura de servicio','I');


}
else
{
  echo 'No tiene permiso para visualizar el reporte';

}
}
ob_end_flush();
?>