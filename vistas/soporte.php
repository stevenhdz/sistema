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
            <h1 class="box-title">Soporte <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                  class="fa fa-plus-circle"></i> Agregar</button>
            </h1>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table-fix table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Acciones</th>
                <th>Nombres</th>
                <th>Fecha Entrada</th>
                <th>Direccion</th>
                <th>Cantidad equipos</th>
                <th>Total a cobrar</th>
                <th>Identidad</th>
                <!-- <th>Codigo</th> -->
                <th>Contacto</th>
                <th>Medio de pago</th>
                <th>Descripcion</th>
                <th>Precio individual</th>
                <th>Anexo</th>
                <th>Visor</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Acciones</th>
                <th>Nombres</th>
                <th>Fecha Entrada</th>
                <th>Direccion</th>
                <th>Cantidad equipos</th>
                <th>Total a cobrar</th>
                <th>Identidad</th>
                <!-- <th>Codigo</th> -->
                <th>Contacto</th>
                <th>Medio de pago</th>
                <th>Descripcion</th>
                <th>Precio individual</th>
                <th>Anexo</th>
                <th>Visor</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Nombre(*):</label>
                    <input type="hidden" name="idsoporte" id="idsoporte">
                    <input type="text" class="form-control" name="nombres" id="nombres" maxlength="100"
                      placeholder="Nombres">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Apellidos(*):</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="256"
                      placeholder="Apellidos">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Fecha Entrada(*):</label>
                    <input type="datetime-local" class="form-control" name="fechaentrada" id="fechaentrada">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256"
                      placeholder="Telefono">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Direccion:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="256"
                      placeholder="Direccion">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Tipo Pago:</label>


                    <div class="input-group mb-3">
                      <select type="text" class="form-control" name="tipopago" id="tipopago" maxlength="256"
                        placeholder="Tipopago" class="custom-select" id="inputGroupSelect02">
                        <option selected>Elige...</option>
                        <option value="1">Efectivo</option>
                        <option value="2">Transferencia</option>
                        <option value="3">Otro</option>
                      </select>
                      <div class="input-group-append">
                        <label class="input-group-text" for="inputGroupSelect02">Opciones</label>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Cantidad Equipos:</label>
                    <input type="number" class="form-control" name="cantidadequipos" id="cantidadequipos"
                      maxlength="256" placeholder="CantidadEquipos">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Total a cobrar:</label>
                    <input type="text" class="form-control" name="valortotal" id="valortotal" maxlength="256"
                      placeholder="Valortotal">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Valor Unidad:</label>
                    <input type="text" class="form-control" name="valorunidad" id="valorunidad" maxlength="256"
                      placeholder="Valorunidad">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Identificador:</label>
                    <input type="text" class="form-control" name="identificador" id="identificador" maxlength="256"
                      placeholder="Identificador">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Descripcion:</label>

                   

                    <!--ckeditor -->
                    <script src="//cdn.ckeditor.com/4.15.0/standard/ckeditor.js"></script>



                    <textarea type="text" class="form-control" name="descripcion" id="descripcion" maxlength="2500"
                      placeholder="Descripción" rows="10"></textarea>
                    <textarea style="visibility:hidden;" type="text" class="form-control" name="descripcion" id="descripcion1" maxlength="2500"
                      placeholder="Descripción" rows="1" ></textarea>
                      

                    <script type="text/javascript">
                      CKEDITOR.replace('descripcion');

                      timer = setInterval(updateDiv, 1);
                      function updateDiv() {
                        var editorText = CKEDITOR.instances.descripcion.getData();
                        $('#descripcion1').html(editorText);
                      }
                    </script>

                    

                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label>Adjuntar:</label>
                    <input type="file" class="form-control" name="adjuntar" id="adjuntar">
                    <br>


                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#staticBackdrop">
                      Ver Contenido
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false"
                      tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Contenido</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-dialog modal-dialog-scrollable modal-body">
                            <input type="hidden" name="adjuntaractual" id="adjuntaractual">
                            <br>
                            <img src="" width="460px" height="500px" id="adjuntarmuestra">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          </div>
                        </div>
                      </div>
                    </div>


                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i>
                      Guardar</button>
                    <button class="btn btn-danger" onclick="cancelarform()" type="button"><i
                        class="fa fa-arrow-circle-left"></i> Cancelar</button>
                  </div>
                </div>
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