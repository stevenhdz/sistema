<!-- valida si ya esta iniciada la sesion para no tener que iniciar. -->

<?php




if(strlen(session_id())< 1)
      session_start();
      require_once "../ajax/soporte.php";
?>


<!-- en ajax se realiza los if por orden -->
<!DOCTYPE html>
<html lenguaje="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SLTECHNOLOGY</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

     <!-- material icon -->
    <link  href="../public/css/icon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.1.1/css/all.min.css"/>

    <!-- datatables -->
    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/datatables/responsive.dataTables.min.css">

    <!-- select bootstrap personalizado -->
    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">

    <!-- texteditor -->
    <link rel="stylesheet" href="../public/css/trix.css">

    


  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="../vistas/principal.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>SL</b>TE</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>SLTECHNOLOGY</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- traido desde ajax -->
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen'];?>" class="user-image" alt="User Image">
                  <span class="hidden-xs" id="nickname"><?php echo $_SESSION['nombre'];?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen'];?>" width="100" height="100" class="user-image" alt="User Image">
                    <p>
                      Cuenta: <span class="hidden-xs"><?php echo $_SESSION['nombre'];?></span>
                      <small><span class="hidden-xs"><?php echo $_SESSION['cargo'];?></span></small>
                      <small><span class="hidden-xs"><?php echo $_SESSION['telefono'];?></span></small>
                      <small><span class="hidden-xs"><?php echo $_SESSION['email'];?></span></small>
                      <small hidden="hidden"><span id="im" class="hidden-xs"><?php echo $_SESSION['imagen'];?></span></small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat"><i class="fa fa-sign-out" aria-hidden="true"></i>Cerrar sesion</a>
                    </div>
                  </li>
                </ul>
              </li>

              <!-- Idioms-->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle pull-right" data-toggle="dropdown">
                  <!-- traido desde ajax -->
                  <span class="hidden-xs lenguaje" key="Idioms"><?php echo Idioms;?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <!-- Menu Footer-->
                  <li class="user-footer">    
                    <div class="pull-left">
                      <button class="translate" id="es"><img src="../public/images/spain.png" width="30" height="30"></button>
                      <button class="translate" id="en"><img src="../public/images/usa.png" width="30" height="30"></button>
                    </div>
                  </li>
                </ul>
              </li>
              <!-- fin idioms -->

             
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <?php
             if($_SESSION['escritorio']==1)
                {  
                    echo'<li>
                      <a href="escritorio.php">
                      <i class="fas fa-bars"></i>

                      <span>Escritorio</span>
                      </a>
                    </li>';
                }
            ?> 
                
                <?php
             if($_SESSION['almacen']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-warehouse"></i>
                      <span>Almacén</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                      <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                    </ul>
                  </li>';
                }
            ?>  

              <?php
             if($_SESSION['compras']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-shopping-cart"></i>
                      <span>Compras</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                      <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
                    </ul>
                  </li>';
                }
            ?>  
            
             <?php
             if($_SESSION['ventas']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-cart-arrow-down"></i>
                      <span>Ventas</span>
                       <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                      <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
                    </ul>
                  </li> ';
                }
            ?>  

<?php
             if($_SESSION['acceso']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-universal-access"></i>
                        <span>Acceso</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                      <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>  
                    </ul>
                  </li>';
                }
            ?>  
            
            <?php
             if($_SESSION['consultac']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-shopping-bag"></i>
                        <span>Consulta Compras</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
                    </ul>
                  </li>';
                }
            ?>  
            <?php
             if($_SESSION['consultav']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                      <i class="fas fa-shopping-bag"></i>
                      <span>Consulta Ventas</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
                    </ul>
                  </li>';
                }
            ?>  

            <?php
             if($_SESSION['chat']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fas fa-comment-alt"></i>
                    <span>Chat</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="chat.php"><i class="fa fa-circle-o"></i> Chat General</a></li>
                    </ul>
                  </li>';
                }
            ?> 

          <?php
             if($_SESSION['soporte']==1)
                {  
                    echo'<li class="treeview">
                    <a href="#">
                    <i class="fab fa-fort-awesome"></i>
                    <span class="lenguaje" key="Form Support">Soporte</span>
                      <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="soporte.php"><i class="fa fa-circle-o"></i>Soporte</a></li>
                    </ul>
                  </li>';
                }
            ?> 

            
          

            <li>
              <a href="#">
              <i class="fas fa-hands-helping"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">Pagina</small>
              </a>
            </li>
            <li>
              <a href="#">
              <i class="fas fa-address-card"></i> <span>Acerca</span>
                <small class="label pull-right bg-yellow">Pagina</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>