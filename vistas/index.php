<?php
//redireccionar a la vista login
//no permisos para administrar carpeta sistemas
header ("location: http://$_SERVER[HTTP_HOST]/");
die();
?>