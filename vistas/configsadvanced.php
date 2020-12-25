<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['configuracion avanzada']==1)
{ 
?>

<div class="content-wrapper">
   <section class="content">
      <div class="row">
         <div class="col-lg-12">
            <div class="box">
               <div class="box-header with-border">
                  <h1 class="box-title">Configuracion avanzada</h1>
                  <div class="box-tools pull-right">
                  </div>
               </div>
               <form action="../files/usuarios/import.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <input placeholder="Archivo" class="form-control" type="text" name='archivo'> <br>
                           <button class="btn btn-primary" type="submit">Importar</button>
                        </div>
                     </div>
                  </div>
               </form>
               <form action="../files/usuarios/export.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <button class="btn btn-primary" type="submit">Exportar</button>
                        </div>
                     </div>
                  </div>
               </form>
               <form action="../files/usuarios/comprimirArchivos.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <button class="btn btn-primary" type="submit">Comprimir</button>
                        </div>
                     </div>
                  </div>
               </form>
               <form action="../files/usuarios/descargar.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <input placeholder="Archive" class="form-control" type="text" name='archive'> <br>
                           <input placeholder="Root" class="form-control" type="text" name='root'> <br>
                           <button class="btn btn-primary" type="submit">Descargar backup</button>
                        </div>
                     </div>
                  </div>
               </form>
               <form action="../files/usuarios/borrarArchivos.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <input placeholder="Extencion" class="form-control" type="text" name='extencion'> <br>
                           <button class="btn btn-primary" type="submit">Eliminar Backup</button>
                        </div>
                     </div>
                  </div>
               </form>
               <form action="../files/usuarios/execute.php" method='POST'>
                  <div class="container-fluid">
                     <div class="row">
                        <div class="form-group col-lg-6 col-md-6 col-sm-3 col-xs-12">
                           <br>
                           <button class="btn btn-primary" type="submit">Prueba respuesta server</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </section>
</div>

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/soporte.js"></script>
<?php 
}
ob_end_flush();
?>