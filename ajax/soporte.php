

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
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$respuesta=isset($_POST["respuesta"])? limpiarCadena($_POST["respuesta"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$tipopago=isset($_POST["tipopago"])? limpiarCadena($_POST["tipopago"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$valorunidad=isset($_POST["valorunidad"])? limpiarCadena($_POST["valorunidad"]):"";
$adjuntar=isset($_POST["adjuntar"])? limpiarCadena($_POST["adjuntar"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':

		if (!file_exists($_FILES['adjuntar']['tmp_name'][$i]) || !is_uploaded_file($_FILES['adjuntar']['tmp_name'][$i]))
		{
			$adjuntar=$_POST["adjuntaractual"];
		}	

		$total = count($_FILES['adjuntar']['tmp_name']);

		for( $i=0 ; $i < $total ; $i++ ) {

			$tmpFilePath = $_FILES['adjuntar']['tmp_name'][$i];
			$ext = explode(".", $_FILES["adjuntar"]["name"][$i]);

			if ($tmpFilePath != ""){
			
				//todo: tipos permidos 
				if ($_FILES['adjuntar']['type'][$i] == "image/jpg" 
					|| $_FILES['adjuntar']['type'][$i] == "image/jpeg"
					|| $_FILES['adjuntar']['type'][$i]== "image/png"
					|| $_FILES['adjuntar']['type'][$i]== "text/plain"
					//TODO: MIME TYPES solo permite antiguos
					|| $_FILES['adjuntar']['type'][$i]== "application/msword"
					)
				{
					$adjuntar = $nombres.'-'.$fechaentrada.rand(). '.' .end($ext);
					$newFilePath = "../files/soporte/" . $adjuntar;
					move_uploaded_file($tmpFilePath, $newFilePath);
				}
			}

		  }

		   /* if (!file_exists($total) || !is_uploaded_file($total))
		{
			$adjuntar=$_POST["adjuntaractual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["adjuntar"]["name"]);
			if ($_FILES['adjuntar']['type'] == "image/jpg" 
            || $_FILES['adjuntar']['type'] == "image/jpeg" 
            || $_FILES['adjuntar']['type'] == "image/png")
			{
				$adjuntar = $nombres.'-'.$fechaentrada. '.' . end($ext);
				move_uploaded_file($_FILES["adjuntar"]["tmp_name"], 
                "../files/soporte/" . $adjuntar);
			}
		}  */
		
		

		if (empty($idsoporte)){
			$rspta=$soporte->insertar($nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal= $valorunidad * $cantidadequipos,$identificador,$correo,$respuesta,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar);
			echo $rspta ? "Registrado" : "No se pudo registrar";

			//TODO: ENVIAR CORREO 
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "stevenhernandezj@gmail.com";
			$to = $correo;
			$subject = "FACTURA SLTECHNOLOGY";
			$message = "$descripcion";
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
			
		}
		else {
			$rspta=$soporte->editar($idsoporte,$nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal= $valorunidad * $cantidadequipos,$identificador,$correo,$respuesta,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar);
			echo $rspta ? "Registro actualizado" : "Registro no actualizado";

			//TODO: ENVIAR CORREO si edita
			ini_set( 'display_errors', 1 );
			error_reporting( E_ALL );
			$from = "stevenhernandezj@gmail.com";
			$to = $correo;
			$subject = "FACTURA SLTECHNOLOGY COPIA";
			$message = "$descripcion";
			$headers = "From:" . $from.'X-Mailer: PHP/' . phpversion();
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
			if($reg->tipo_comprobante=='Ticket'){
				$url='../reportes/exTicket.php?id=';
			}
			else{
				$url='../reportes/exFacturaSoporte.php?id=';
			}

 			$data[]=array(
 				"0"=>($reg->soporte)?'<button class="btn-sm btn-warning" style="color:white" onclick="mostrar('.$reg->idsoporte.')"><i class="fas fa-pencil-ruler"></i></button>':
					 '<button class="btn btn-warning" onclick="mostrar('.$reg->idsoporte.')"><i class="fas fa-pencil-ruler"></i></button>

					 <a href="mailto:'.$reg->correo.'?cc=stevenhernandezj@gmail.com&bcc=&subject=Factura SLTECHNOLOGY&body=
						Señor@ usuario, '.$reg->nombres." ".$reg->apellidos.'%0d%0a%0d%0a
						Con '.$reg->cantidadequipos.' 
						equipos entrados en la fecha '.$reg->fechaentrada.', que vienen de la direccion '.$reg->direccion.'       
						 con el problema/configuracion indicada : '.$reg->descripcion.' tendra un valor a cobrar en su totalidad de $'.$reg->valortotal.'&Attachment=/Applications/MAMP/htdocs/sistema/public/images/bg.jpg
					 "class="btn btn-primary"><i class="fas fa-envelope-square"></i></a>

					 <a href="https://api.whatsapp.com/send?phone=+57
					 '.$reg->telefono.'&text=Hola, 
					 '.$reg->nombres." ".$reg->apellidos.'%20qué%20tal?%20te%20enviamos%20la%20factura%20al%20correo:%20
					 '.$reg->correo.',%20el%20numero%20de%20tu%20servicio%20es,%20
					 '.$reg->idsoporte.'%20que%20tengas%20un%20buen%20dia%20y%20gracias%20por%20acudir%20a%20nosotros%20SOMOS%20SLTECHNOLOGY. 
					 "class="btn btn-success"><i class="fab fa-whatsapp"></i></a>
	

					 <a target="_blank" href="'.$url.$reg->idsoporte.'"> <button class="btn btn-info"><i class="fas fa-file-invoice-dollar"></i></button></a>

					 <a href="https://www.google.com/maps/place/'.$reg->direccion.'"><button class="btn btn-danger"><i class="fas fa-map-marker-alt"></i></button></a>
					 ',
                     "1"=>$reg->nombres." ".$reg->apellidos,
                     "2"=>$reg->fechaentrada,
                     "3"=>$reg->direccion,
                     "4"=>$reg->cantidadequipos,
                     "5"=>'$ '.$reg->valortotal,
                     "6"=>$reg->identificador,
					 "7"=>$reg->correo,
					 "8"=>$reg->respuesta,
                     "9"=>$reg->telefono,
                     "10"=>$reg->tipopago,
					 "11"=>'<textarea type="text" class="form-control" placeholder="Sin descripción" >'.$reg->descripcion.'</textarea>',
                     "12"=>'$ '.$reg->valorunidad,
                 //carpeta usuarios estaran las imagenes
				 "13"=>"
				 <p>$reg->adjuntar</p>
				 <img src='../files/soporte/".$reg->adjuntar."' onclick='this.width=500;this.height=400;' onmouseout='this.width=70;this.height=70;' width='70' height='70' >",
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
