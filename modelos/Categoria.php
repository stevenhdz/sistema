<?php   
//incluir conexion
// para buscar porque no esta en la misma carpeta
require "../config/conexion.php";

class categoria 
{
    //Implementamos constructor
    public function __construct()
    {

    }

    //implementamos un metodo para insertar registros
    public function insertar($nombre,$descripcion)
    {
        $sql="INSERT INTO categoria (nombre,descripcion,condicion)
        values ('$nombre','$descripcion','1')";
        return ejecutarConsulta($sql);
    }

    //implementamos un metodo para insertar registros
    public function editar($idcategoria,$nombre,$descripcion)
    {
        $sql="UPDATE categoria SET nombre='$nombre',descripcion='$descripcion'
        WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }

    //implementamos un metodo para desactivar registros
    public function desactivar($idcategoria)
    {
        $sql="UPDATE categoria SET condicion='0' WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }

    //implementamos un metodo para activar registros
    public function activar($idcategoria)
    {
        $sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
        return ejecutarConsulta($sql);
    }
    
    //implementamos un metodo para mostrar los datos de registro a modificar
    public function mostrar($idcategoria)
    {
        $sql="SELECT * FROM categoria WHERE idcategoria='$idcategoria'";
        return ejecutarConsultaSimpleFila($sql);
    }

    //implementamos un metodo para listar registros
    public function listar()
    {
        $sql="SELECT * FROM categoria";
        return ejecutarConsulta($sql);
    }
}


?>