<?php

//validacion para que no accedan a la vista por url
ob_start();
session_start();

if(!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{

require 'header.php';
if($_SESSION['chat']==1)
{
?>



<link rel="stylesheet" href="../public/css/style.css" />

<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class=" row">
      <div class="col-md-12">
        <div class="box">

          <div class="box-header with-border">
            <h1 class="box-title">Chat</h1>
            <div class="box-tools pull-right">
            </div>
          </div>

          <div class="container-fluid">
            <div class="row">
              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div id="messages"></div>
              </div>
            </div>
          </div>
          <form>
            <div class="input-group mb-3">
              <input type="text" class="form-control" placeholder="Escribir aqui..." aria-label="Escribir aqui..."
                aria-describedby="button-addon2" autofocus autocomplete="off" id="message">
              <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit">Enviar</button>
              </div>
            </div>
          </form>
        </div>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->



<?php

}
else
{
  require 'noacceso.php';
}
require 'footer.php';

?>
<script type="text/javascript" src="scripts/chat.js"></script>
<?php
}
//liberar bufer
ob_end_flush();
?>