<?php
$archive = $_POST['archive'];
$root = $_POST['root'];
$archivo="$root/$archive";
header("Content-Length: " . filesize ($archivo) ); 
header("Content-type: application/*"); 
header("Content-disposition: attachment; filename=".basename($archivo));
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
$filepath = readfile($archivo);
?>