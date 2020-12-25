<?php

include '/Applications/MAMP/htdocs/sistema/config/conexion.php';
if(!$conexion){
    die("imposible conectarse: ".mysqli_error($conexion));
}
if (@mysqli_connect_errno()) {
    die("Connect failed: ".mysqli_connect_errno()." : ". mysqli_connect_error());
}
   $archivo = $_POST['archivo'];
   $producto = fopen ("/Applications/MAMP/htdocs/sistema/files/usuarios/archivos/$archivo" , "r" );
   $i=0;
   while (($datos=fgetcsv($producto,1000,";")) !== FALSE){
    $i++; if($i==1) continue; // saltar la 1
      $linea[] = array('idsoporte'=>$datos[0],
      'nombres'=>$datos[1],
      'apellidos'=>$datos[2],
      'fechaentrada'=>$datos[3],
      'direccion'=>$datos[4],
      'cantidadequipos'=>$datos[5],
      'valortotal'=>$datos[6],
      'identificador'=>$datos[7],
      'respuesta'=>$datos[8],
      'telefono'=>$datos[9],
      'tipopago'=>$datos[10],
      'descripcion'=>$datos[11],
      'valorunidad'=>$datos[12],
      'adjuntar'=>$datos[13],
      'correo'=>$datos[14]);
    }
   
   fclose ($producto);

   $insertados=0;
   $errores=0;
   $actualizados=0;
   

   foreach($linea as $indice=>$value){
    $idsoporte=$value["idsoporte"];
    $nombres=$value["nombres"];
    $apellidos=$value["apellidos"];
    $fechaentrada=$value["fechaentrada"];
    $direccion=$value["direccion"];
    $cantidadequipos=$value["cantidadequipos"];
    $valortotal=$value["valortotal"];
    $identificador=$value["identificador"];
    $respuesta=$value["respuesta"];
    $telefono=$value["telefono"];
    $tipopago=$value["tipopago"];
    $descripcion=$value["descripcion"];
    $valorunidad=$value["valorunidad"];
    $adjuntar=$value["adjuntar"];
    $correo=$value["correo"];

    $conexion->query($sql);
    $sql=mysqli_query($conexion,"select * from soporte where idsoporte='$idsoporte'");//Consulta a la tabla productos
	$num=mysqli_num_rows($sql);//Cuenta el numero de registros devueltos por la consulta
	if ($num==0)//Si es == 0 inserto
	{
	$sql = "insert into soporte (idsoporte,nombres,apellidos,fechaentrada,direccion,cantidadequipos,valortotal,identificador,respuesta,telefono,tipopago,descripcion,valorunidad,adjuntar,correo) values('$idsoporte','$nombres','$apellidos','$fechaentrada','$direccion','$cantidadequipos','$valortotal','$identificador','$respuesta','$telefono','$tipopago','$descripcion','$valorunidad','$adjuntar','$correo')";
    
    if ($insert = mysqli_query($conexion,$sql)){
        $insertados+=1;
     }else{
        $errores+=1;
     }
  }else{
     $sql="update soporte set nombres = '$nombres',apellidos = '$apellidos',fechaentrada = '$fechaentrada',direccion = '$direccion',cantidadequipos = '$cantidadequipos',valortotal = '$valortotal',identificador = '$identificador',respuesta = '$respuesta',telefono = '$telefono',tipopago = '$tipopago',descripcion = '$descripcion',valorunidad = '$valorunidad',adjuntar = '$adjuntar',correo ='$correo' where idsoporte='$idsoporte'";

    


     if ($update = mysqli_query($conexion,$sql)){
        $actualizados+=1;
     }else{
        $errores+=1;
     }
  }
}
echo "Registros insertados: ".number_format($insertados,2)." <br/>";
echo "Registros actualizados: ".number_format($actualizados,2)." <br/>";
echo "Errores: ".number_format($errores,2)." <br/>";

$filename = "soporte-" . date('Y-m-d').".csv";

    unlink('/Applications/MAMP/htdocs/sistema/files/usuarios/archivos/'.str_replace("-","",$filename));

    
?>