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
  <section class="content-fix">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title lenguaje" key="Form Support">Soporte</h1>
            <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                  class="fa fa-plus-circle"></i> Agregar</button>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th class="lenguaje" key="Actions">Acciones Preferidas por el usuario</th>
                <th class="lenguaje" key="Name">Nombres</th>
                <th class="lenguaje" key="Admission Date">Fecha Entrada</th>
                <th class="lenguaje" key="Address">Direccion</th>
                <th class="lenguaje" key="Number of Computer Equipment">Cantidad equipos</th>
                <th class="lenguaje" key="Total to Pay">Total a cobrar</th>
                <th class="lenguaje" key="Identifier">Identidad</th>
                <th class="lenguaje" key="Mail">Correo</th>
                <th class="lenguaje" key="Answer">Respuesta</th>
                <th class="lenguaje" key="Cell Phone">Contacto</th>
                <th class="lenguaje" key="Payment Type">Medio de pago</th>
                <th class="lenguaje" key="Description">Descripcion</th>
                <th class="lenguaje" key="Unit Value">Precio individual</th>
                <th class="lenguaje" key="Visor">Visor</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th class="lenguaje" key="Actions">>Acciones Preferidas por el usuario</th>
                <th class="lenguaje" key="Name">Nombres</th>
                <th class="lenguaje" key="Admission Date">Fecha Entrada</th>
                <th class="lenguaje" key="Address">Direccion</th>
                <th class="lenguaje" key="Number of Computer Equipment">Cantidad equipos</th>
                <th class="lenguaje" key="Total to Pay">Total a cobrar</th>
                <th class="lenguaje" key="Identifier">Identidad</th>
                <th class="lenguaje" key="Mail">Correo</th>
                <th class="lenguaje" key="Answer">Respuesta</th>
                <th class="lenguaje" key="Cell Phone">Contacto</th>
                <th class="lenguaje" key="Payment Type">Medio de pago</th>
                <th class="lenguaje" key="Description">Descripcion</th>
                <th class="lenguaje" key="Unit Value">Precio individual</th>
                <th class="lenguaje" key="Visor">Visor</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Name">Nombre(*):</label>
                    <input type="hidden" name="idsoporte" id="idsoporte">
                    <input type="text" class="form-control" name="nombres" id="nombres" minlength="3" maxlength="100"
                      placeholder="Nombres" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Last Names">Apellidos(*):</label>
                    <input type="text" class="form-control" name="apellidos" id="apellidos" maxlength="256"
                      placeholder="Apellidos" required>
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Admission Date">Fecha Entrada(*):</label>
                    <input type="datetime-local" class="form-control" name="fechaentrada" id="fechaentrada" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Cell Phone">Telefono:</label>
                    <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256"
                      placeholder="Telefono">
                    <!-- <input type="text" class="form-control" name="telefono" id="telefono" maxlength="256"
                      placeholder="Telefono" pattern="[A-Za-z]{3,100}" required oninput="check_text(this);">
                      <script type="text/javascript">
                        function check_text(input) {  
                            if (input.validity.patternMismatch){  
                                input.setCustomValidity("Debe ingresar al menos 3 LETRAS");  
                            }  
                            else {  
                                input.setCustomValidity("");  
                            }                 
                        }  </script> -->

                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Address">Direccion:</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" maxlength="256"
                      placeholder="Direccion">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Payment Type">Tipo Pago:</label>


                    <div class="input-group mb-3">
                      <select type="text" class="form-control" name="tipopago" id="tipopago" maxlength="256"
                        placeholder="Tipopago" class="custom-select" id="inputGroupSelect02">
                        <option selected>Elige...</option>
                        <option value="Efectivo">Efectivo</option>
                        <option value="Transferencia">Transferencia</option>
                        <option value="Otro">Otro</option>
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
                    <label class="lenguaje" key="Number of Computer Equipment">Cantidad Equipos:</label>
                    <input type="number" class="form-control" name="cantidadequipos" id="cantidadequipos"
                      maxlength="256" placeholder="CantidadEquipos" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Total to Pay">Total a cobrar:</label>
                    <input type="text" class="form-control" name="valortotal" id="valortotal" maxlength="256"
                      placeholder="Valortotal">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Unit Value">Valor Unidad:</label>
                    <input type="text" class="form-control" name="valorunidad" id="valorunidad" maxlength="256"
                      placeholder="Valorunidad">
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Identifier">Identificador:</label>
                    <div class="input-group mb-3">
                      <select type="text" class="form-control" name="identificador" id="identificador" maxlength="256"
                        placeholder="Identificador" class="custom-select" id="inputGroupSelect02">
                        <option selected>Elige...</option>
                        <option value="Persona natural">Persona natural</option>
                        <option value="Empresa">Empresa</option>
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
                    <label class="lenguaje" key="Mail">Mail:</label>
                    <input type="email" class="form-control" name="correo" id="correo" maxlength="256"
                      placeholder="Correo" required>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Answer">Respuesta:</label>
                    <input type="text" class="form-control" name="respuesta" id="respuesta" maxlength="256"
                      placeholder="Respuesta">
                  </div>
                </div>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Description">Descripcion:</label>
                    <input type="text" class="form-control" name="descripcion" id="descripcion"
                      placeholder="Descripción" rows="2" cols="4">
                    <!-- trix editor -->
                    <trix-editor input="descripcion" type="text" class="form-control" placeholder="Descripción">
                    </trix-editor>
                  </div>
                  <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <label class="lenguaje" key="Attach">Adjuntar:</label>
                    <input type="file" class="form-control" name="adjuntar[]" id="adjuntar" enctype="multipart/form-data" multiple>
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