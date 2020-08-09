<?php 
require_once "../modelos/Articulo.php";

$articulo = new Articulo();

//validar si existe la variable, envio a limpiar si no lo reeemplazo por vacio

$idarticulo=isset($_POST["idarticulo"])? limpiarCadena($_POST["idarticulo"]):"";
$idcategoria=isset($_POST["idcategoria"])? limpiarCadena($_POST["idcategoria"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$stock=isset($_POST["stock"])? limpiarCadena($_POST["stock"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";
$imagen=isset($_POST["imagen"])? limpiarCadena($_POST["imagen"]):"";

switch ($_GET["op"]){
    case 'guardaryeditar':

        if(empty($idarticulo)){
            $rspta = $articulo->insertar($nombre,$descripcion);
            echo $rspta ? "Categoria registrada": "categoria no registrada";
        }
        else{
            $rspta = $articulo->editar($idcategoria,$nombre,$descripcion);
            echo $rspta ? "Categoria actualizada": "categoria no se actualizo";
        }

    break;

    case 'desactivar':

        $rspta = $articulo->desactivar($idcategoria);
        echo $rspta ? "Categoria desactivada": "categoria no se pudo desactivar";

    break;

    case 'activar':

        $rspta = $articulo->activar($idcategoria);
        echo $rspta ? "Categoria activada": "categoria no se pudo activar";

    break;

    case 'mostrar':

        $rspta = $articulo->mostrar($idcategoria);
        //codificar el resultado utilizando json
        echo json_encode($rspta);

    break;

    case 'listar':

        $rspta = $articulo->listar();
        //vamos a declarar un array
        $data = array();
        
        //recorrer todos los registros uno a uno
        while($reg=$rspta->fetch_object()){
            $data[]=array(
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="desactivar('.$reg->idcategoria.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idcategoria.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idcategoria.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->descripcion,
                "3"=>($reg->condicion)?'<span class="label bg-green">activado</span>':'<span class="label bg-red">desactivado</span>'
            );
        }
        $results = array(
            "sEcho"=>1, //informacion para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros datatable
            "iTotalDisplayRedcords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

    break;
}

?>