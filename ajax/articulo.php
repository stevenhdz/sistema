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

        //validar que si seleccione una imagen
        if(!file_exists($_FILES['imagen']['tmp_name']) || !is_uploaded_file($_FILES['imagen']['tmp_name']))
        {
            $imagen=$_POST["imagenactual"];
        }
        else{
            $ext = explode(".",$_FILES["imagen"]["name"]);
            //validar tipo de archivos que puede subir
            if($_FILES['imagen']['type'] == "image/jpg" || $_FILES['imagen']['type'] == "image/jpeg" || $_FILES['imagen']['type'] == "image/png")
            {
                //renombrar microtime
                //extension
                //no repetir imagen
                $imagen = round(microtime(true)) . '.' . end($ext);
                //directorio donde se guardara la imagen
                move_uploaded_file($_FILES["imagen"]["tmp_name"],"../files/articulos/".$imagen);
            }
        }

        if(empty($idarticulo)){
            $rspta = $articulo->insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
            echo $rspta ? "articulo registrada": "articulo no registrada";
        }
        else{
            $rspta = $articulo->editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen);
            echo $rspta ? "articulo actualizada": "articulo no se actualizo";
        }

    break;

    case 'desactivar':

        $rspta = $articulo->desactivar($idarticulo);
        echo $rspta ? "articulo desactivada": "articulo no se pudo desactivar";

    break;

    case 'activar':

        $rspta = $articulo->activar($idarticulo);
        echo $rspta ? "articulo activada": "articulo no se pudo activar";

    break;

    case 'mostrar':

        $rspta = $articulo->mostrar($idarticulo);
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
                "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':
                '<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
                ' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
                "1"=>$reg->nombre,
                "2"=>$reg->categoria, //porque tiene el nombre alias categoria en Articulo.php
                "3"=>$reg->codigo,
                "4"=>$reg->stock,
                "5"=>"<img src='../files/articulos/".$reg->imagen."' height='50px' width='50px' >",
                "6"=>($reg->condicion)?'<span class="label bg-green">activado</span>':'<span class="label bg-red">desactivado</span>'
            );
        }
        $results = array(
            "sEcho"=>1, //informacion para el datatables
            "iTotalRecords"=>count($data), //enviamos el total registros datatable
            "iTotalDisplayRedcords"=>count($data), //enviamos el total registros a visualizar
            "aaData"=>$data);
        echo json_encode($results);

    break;

    case 'selectCategoria':
        require_once "../modelos/Categoria.php";
        $categoria = new Categoria();
        $rspta = $categoria->select();

        //recorrer todos los registros almcenados.
        while($reg = $rspta->fetch_object())
            {
                echo '<option value='.$reg->idcategoria.'>'.$reg->nombre.'</option>';
            }

    break;
}

?>