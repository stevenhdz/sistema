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
              <div class="col-md-fix">
                  <div class="box">
                   
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="toast-header">
    <img src="../public/images/mascara.png" width="30" height="30" class="rounded mr-2" alt="...">
    <strong class="mr-auto">Admin</strong>
    <small>
      hace:
        <script type="text/javascript"> 
          var d = new Date();
          document.write(d.getMinutes());
        </script>
      minutos
    </small>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    <pre><span class="hidden-xs"><?php echo $_SESSION['nombre'];?></span>, El Chat sera eliminado en cada 24 hrs</pre>
  </div>
</div>

                  <div id="messages"></div>
                    <form>
                        <input class="form-control" type="text" id="message" autocomplete="off" autofocus />
                        <button class="btn btn-primary" type="submit">
                            <i class="fa fa-paper-plane" aria-hidden="true"></i>
                        </button>
                    </form>
    
    
                    <!--Fin centro -->
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