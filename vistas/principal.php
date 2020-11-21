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
?>
<div class="content-wrapper"> 
    <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="panel-body" style="height: auto; width: auto;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                              <img src="../public/images/nuevo.png" alt="" width="1170" height="540">
                          </div>
                        </form>
                    </div>
                  </div>
              </div>
            </div>
    </section>
</div>
<?php
require 'footer.php';
?>
<!-- js -->
<?php 
}
ob_end_flush();
?>