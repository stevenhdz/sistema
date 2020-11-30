<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/conexion.php";

Class Soporte
{
	//Implementamos nuestro constructor
	public function __construct()
	{
	}

	

	//Implementamos un método para insertar registros
	public function insertar($nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal,$identificador,$correo,$respuesta,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar)
	{
		$sql="INSERT INTO soporte (nombres,apellidos,fechaentrada,direccion,cantidadequipos,valortotal,identificador,correo,respuesta,telefono,tipopago,descripcion,valorunidad,adjuntar)
		VALUES ('$nombres','$apellidos','$fechaentrada','$direccion','$cantidadequipos','$valortotal','$identificador','$correo','$respuesta','$telefono','$tipopago','$descripcion','$valorunidad','$adjuntar')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsoporte,$nombres,$apellidos,$fechaentrada,$direccion,$cantidadequipos,$valortotal,$identificador,$correo,$respuesta,$telefono,$tipopago,$descripcion,$valorunidad,$adjuntar)
	{
		$sql="UPDATE soporte SET nombres='$nombres',apellidos='$apellidos',fechaentrada='$fechaentrada',direccion='$direccion',cantidadequipos='$cantidadequipos',valortotal='$valortotal',
        identificador='$identificador',correo='$correo',respuesta='$respuesta',telefono='$telefono',tipopago='$tipopago',descripcion='$descripcion',valorunidad='$valorunidad',adjuntar='$adjuntar' WHERE idsoporte='$idsoporte'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsoporte)
	{
		$sql="SELECT * FROM soporte WHERE idsoporte='$idsoporte'";
		return ejecutarConsultaSimpleFila($sql);
	}
	//Implementar un método para mostrar los datos de un registro a modificar
	public function listar()
	{
		$sql="SELECT * FROM soporte";
		return ejecutarConsulta($sql);		
	}
	

	public function listar1($idsoporte){
		$sql="SELECT * FROM soporte WHERE idsoporte='$idsoporte'";
		return ejecutarConsulta($sql);
	}

	
}

?>