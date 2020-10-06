<?php
session_start(); 
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
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$valorunidad=isset($_POST["valorunidad"])? limpiarCadena($_POST["valorunidad"]):"";
$adjuntar=isset($_POST["adjuntar"])? limpiarCadena($_POST["adjuntar"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['adjuntar']['tmp_name']) || !is_uploaded_file($_FILES['adjuntar']['tmp_name']))
		{
			$adjuntar=$_POST["adjuntaractual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["adjuntar"]["name"]);
			if ($_FILES['adjuntar']['type'] == "image/jpg" || $_FILES['adjuntar']['type'] == "image/jpeg" || $_FILES['adjuntar']['type'] == "image/png")
			{
				$adjuntar = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["adjuntar"]["tmp_name"], "../files/soporte/" . $adjuntar);
			}
		}
		if (empty($idsoporte)){
			$rspta=$soporte->insertar($nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal,$identificador,$codigo,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar);
			echo $rspta ? "Soporte registrado" : "Soporte no se pudo registrar";
		}
		else {
			$rspta=$soporte->editar($idsoporte,$nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal,$identificador,$codigo,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar);
			echo $rspta ? "Soporte actualizado" : "Soporte no se pudo actualizar";
		}
    break;
    

	case 'mostrar':
		$rspta=$soporte->mostrar($idsoporte);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


	case 'listar':
		$rspta=$soporte->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->soporte)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idsoporte.')"><i class="fa fa-pencil"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idsoporte.')"><i class="fa fa-pencil"></i></button>',
                     "1"=>$reg->nombres,
                     "2"=>$reg->apellidos,
                     "3"=>$reg->fechaentrada,
                     "4"=>$reg->direccion,
                     "5"=>$reg->cantidadequipos,
                     "6"=>$reg->valortotal,
                     "7"=>$reg->identificador,
                     "8"=>$reg->codigo,
                     "9"=>$reg->telefono,
                     "10"=>$reg->tipopago,
                     "11"=>$reg->descripcion,
                     "12"=>$reg->valorunidad,
                     "13"=>$reg->adjuntar,
                 //carpeta usuarios estaran las imagenes
 				"14"=>"<img src='../files/soporte/".$reg->adjuntar."' height='50px' width='50px' >",
 				
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	
	

}
?>