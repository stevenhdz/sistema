<?php

try {
    
if ($files = glob(".export.csv.swp")) {
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