<?php

try {
    
$extension = $_POST['extencion'];

if ($files = glob("$extension")) {
    foreach ($files as $file) {
        if(is_file($file))
        unlink($file);
        echo 'eliminado';
    }
}else{
    echo 'No hay elementos';
}
   
} catch (Exception $th) {
    echo $th;
}

?>