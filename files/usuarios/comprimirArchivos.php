<?php


/* primero creamos la función que hace la magia
 * esta funcion recorre carpetas y subcarpetas
 * añadiendo todo archivo que encuentre a su paso
 * recibe el directorio y el zip a utilizar 
 */
function agregar_zip($dir, $zip) {
    //verificamos si $dir es un directorio
    if (is_dir($dir)) {
      //abrimos el directorio y lo asignamos a $da
      if ($da = opendir($dir)) {
        //leemos del directorio hasta que termine
        while (($archivo = readdir($da)) !== false) {
          /*Si es un directorio imprimimos la ruta
           * y llamamos recursivamente esta función
           * para que verifique dentro del nuevo directorio
           * por mas directorios o archivos
           */
          if (is_dir($dir . $archivo) && $archivo != "." && $archivo != "..") {
            echo "<strong>Creando directorio: $dir$archivo</strong><br/>";
            agregar_zip($dir . $archivo . "/", $zip);
   
            /*si encuentra un archivo imprimimos la ruta donde se encuentra
             * y agregamos el archivo al zip junto con su ruta 
             */
          } elseif (is_file($dir . $archivo) && $archivo != "." && $archivo != "..") {
            echo "Agregando archivo: $dir$archivo <br/>";
            $zip->addFile($dir . $archivo, $dir . $archivo);
          }
        }
        //cerramos el directorio abierto en el momento
        closedir($da);
      }
    }
  }
   
  //fin de la función
  //creamos una instancia de ZipArchive
  $zip = new ZipArchive();
   
  /*directorio a comprimir
   * la barra inclinada al final es importante
   * la ruta debe ser relativa no absoluta
   */
  $dir = '/Applications/MAMP/htdocs/sistema/files/usuarios/';
   
  //ruta donde guardar los archivos zip, ya debe existir
  $rutaFinal = "archivos";
   
  if(!file_exists($rutaFinal)){
    mkdir($rutaFinal);
  }

  $fecha = date('Y-m-d');

    $nombre  = 'archivos';
  $archivoZip = $fecha."-".$nombre.".zip";
   
  if ($zip->open($archivoZip, ZIPARCHIVE::CREATE) === true) {
    agregar_zip($dir, $zip);
    $zip->close();
   
    //Muevo el archivo a una ruta
    //donde no se mezcle los zip con los demas archivos
    rename($archivoZip, "$rutaFinal/$archivoZip");
   
    //Hasta aqui el archivo zip ya esta creado
    //Verifico si el archivo ha sido creado
    if (file_exists($rutaFinal. "/" . $archivoZip)) {
      echo "Proceso Finalizado!! <br/><br/>
                  Descargar: <a href='$rutaFinal/$archivoZip'>$archivoZip</a>";
    } else {
      echo "Error, archivo zip no ha sido creado!!";
    }
  }



?>