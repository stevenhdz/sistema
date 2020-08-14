<?php   
//incluir conexion
// para buscar porque no esta en la misma carpeta
require "../config/conexion.php";

class permiso 
{
    //Implementamos constructor
    public function __construct()
    {

    }

    //implementamos un metodo para listar registros
    public function listar()
    {
        $sql="SELECT * FROM permiso";
        return ejecutarConsulta($sql);
    }

    
}


?>