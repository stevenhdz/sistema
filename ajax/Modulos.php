<?php

	in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
	in_array(2,$valores)?$_SESSION['almacen']=1:$_SESSION['almacen']=0;
	in_array(3,$valores)?$_SESSION['compras']=1:$_SESSION['compras']=0;
	in_array(4,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
	in_array(5,$valores)?$_SESSION['acceso']=1:$_SESSION['acceso']=0;
	in_array(6,$valores)?$_SESSION['consultac']=1:$_SESSION['consultac']=0;
	in_array(7,$valores)?$_SESSION['consultav']=1:$_SESSION['consultav']=0;
	in_array(8,$valores)?$_SESSION['chat']=1:$_SESSION['chat']=0;
	in_array(9,$valores)?$_SESSION['soporte']=1:$_SESSION['soporte']=0;
/*  in_array(10,$valores)?$_SESSION['publicidad']=1:$_SESSION['publicidad']=0;
	in_array(11,$valores)?$_SESSION['estadoSoporte']=1:$_SESSION['estadoSoporte']=0; */