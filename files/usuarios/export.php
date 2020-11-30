<?php
include '/Applications/MAMP/htdocs/sistema/config/conexion.php';

try {
    $sql = "select * from soporte";
    
    $filename = "soporte-" . date('Y-m-d') . ".csv";
    
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
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
} catch (Exception $th) {
    echo '<h1>'.$th.'</h1>';
}


?>