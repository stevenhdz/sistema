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
if ($_SESSION['soporte']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Soporte <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                              <th></th>
                            <th>nombres</th>
                            <th>apellidos</th>
                            <th>fechaentrada</th>
                            <th>direccion</th>
                            <th>cantidadequipos</th>
                            <th>valortotal</th>
                            <th>identificador</th>
                            <th>codigo</th>
                            <th>telefono</th>
                            <th>tipopago</th>
                            <th>descripcion</th>
                            <th>valorunidad</th>
                            <th>adjuntar</th>
                            <th></th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th></th>
                            <th>nombres</th>
                            <th>apellidos</th>
                            <th>fechaentrada</th>
                            <th>direccion</th>
                            <th>cantidadequipos</th>
                            <th>valortotal</th>
                            <th>identificador</th>
                            <th>codigo</th>
                            <th>telefono</th>
                            <th>tipopago</th>
                            <th>descripcion</th>
                            <th>valorunidad</th>
                            <th>adjuntar</th>
                            <th></th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idsoporte" id="idsoporte">
                            <input type="text" class="form-control" name="nombres" id="nombres" maxlength="100" placeholder="Nombres" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Apellidos(*):</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="256" placeholder="Apellidos" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>FechaEntrada(*):</label>
                            <input type="datetime" class="form-control" name="fechaentrada" id="fechaentrada">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Telefono:</label>
                            <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256" placeholder="Telefono">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Direccion:</label>
                            <input type="text" class="form-control" name="direccion" id="direccion" maxlength="256" placeholder="Direccion">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>TipoPago:</label>
                            <input type="text" class="form-control" name="tipopago" id="tipopago" maxlength="256" placeholder="Tipopago">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>CantidadEquipos:</label>
                            <input type="number" class="form-control" name="cantidadequipos" id="cantidadequipos" maxlength="256" placeholder="CantidadEquipos" >
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripcion:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>ValorTotal:</label>
                            <input type="text" class="form-control" name="valortotal" id="valortotal" maxlength="256" placeholder="Valortotal">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Valorunidad:</label>
                            <input type="text" class="form-control" name="valorunidad" id="valorunidad" maxlength="256" placeholder="Valorunidad">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Identificador:</label>
                            <input type="text" class="form-control" name="identificador" id="identificador" maxlength="256" placeholder="Identificador">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Adjuntar:</label>
                            <input type="file" class="form-control" name="adjuntar" id="adjuntar">
                            <input type="hidden" name="adjuntaractual" id="adjuntaractual">
                            <img src="" width="150px" height="120px" id="adjuntarmuestra">
                          </div>
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/soporte.js"></script>
<?php 
}
ob_end_flush();
?>