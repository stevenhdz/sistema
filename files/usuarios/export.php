<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include '/Applications/MAMP/htdocs/sistema/config/conexion.php';

try {

    $sql = "select * from soporte";
    
    $filename = "soporte-" . date('Y-m-d').".csv";
    
    $query = $conexion->query($sql);
    
    if($query->num_rows > 0){
        while($r  = $query->fetch_object()){
            
                echo $r->idsoporte.";";
                echo $r->nombres.";";
                echo $r->apellidos.";";
                echo $r->fechaentrada.";";
                echo $r->direccion.";";
                echo $r->cantidadequipos.";";
                echo $r->valortotal.";";
                echo $r->identificador.";";
                echo $r->respuesta.";";
                echo $r->telefono.";";
                echo $r->tipopago.";";
                echo $r->descripcion.";";
                echo $r->valorunidad.";";
                echo $r->adjuntar.";";
                echo $r->correo."\n";
        }
    }else{
        echo 'No exportado';
    }
    
    header('Content-Type: application/csv');
    header('Content-Disposition: attachment; filename="' . str_replace("-","",$filename). '";');
    
    $var = '/Users/alexanderjimenez/downloads/'.str_replace("-","",$filename);
    
    if(isset($var)){

        $carpeta = 'archivos';
        $root = __dir__.'/'.$carpeta;
            copy('/Users/alexanderjimenez/downloads/'.str_replace("-","",$filename),'/Applications/MAMP/htdocs/sistema/files/usuarios/archivos/'.str_replace("-","",$filename));
          
        }

} catch (Exception $th) {
    echo '<h1>'.$th.'</h1>';
}



?>