
<!--
Author: David Hernandez
-->
<?php
 include '../includes/dbconsultas/consultaReportes.php';
 ?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- Bootstrap Core CSS -->
<link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="../css/style.css" rel='stylesheet' type='text/css' />
<!-- font CSS -->
<!-- font-awesome icons -->
<link href="../css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons -->
 <!-- js-->
<script src="../js/jquery-1.11.1.min.js"></script>
<script src="../js/modernizr.custom.js"></script>
<!--webfonts-->

<!--//webfonts--> 
<!--animate-->
<link href="../css/animate.css" rel="stylesheet" type="text/css" media="all">
<script src="../js/wow.min.js"></script>
	<script>
		 new WOW().init();
	</script>
<!--//end-animate-->
<!-- chart -->
<script src="../js/Chart.js"></script>
<!-- //chart -->
<!--Calender-->
<link rel="stylesheet" href="../css/clndr.css" type="text/css" />
<script src="../js/underscore-min.js" type="text/javascript"></script>
<script src= "../js/moment-2.2.1.js" type="text/javascript"></script>
<script src="../js/clndr.js" type="text/javascript"></script>
<script src="../js/site.js" type="text/javascript"></script>
<!--End Calender-->
<!-- Metis Menu -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<link href="../css/custom.css" rel="stylesheet">
</head> 
<body class="cbp-spmenu-push">

	<?php
	session_start();
	include '../includes/auth/validarSesiones.php';
	administracion();
	?>

	<div class="main-content">
		<!--left-fixed -navigation-->
		<div class=" sidebar" role="navigation">
            <div class="navbar-collapse">
				<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
					<ul class="nav" id="side-menu">
						<li>
							<a href="index.php"><i class="fa fa-home nav_icon"></i>Inicio</a>
						</li>
						<li>
							<a href="#"><i class="fa fa-cogs nav_icon"></i>Personal <span class="fa arrow"></span></a>
							<ul class="nav nav-second-level collapse">
								<li>
									<a href="administradores.php">Administradores</a>
								</li>
								<li>
									<a href="empleados.php">Empleados</a>
								</li>
							</ul>
							<!-- /nav-second-level -->
						</li>
						<li>
							<a href="mesas.php"><i class="fa fa-file-text-o nav_icon"></i>Mesas </span></a>
						</li>
						<li>
							<a href="categorias.php"><i class="fa fa-file-text-o nav_icon"></i>Categorias</a>
						</li>
						<li>
							<a href="productos.php"><i class="fa fa-file-text-o nav_icon"></i>Productos</a>
						</li>
						<li>
							<a href="atenciones.php"><i class="fa fa-book nav_icon"></i>Atenciones</a>
						</li>
						<li>
							<a href="reportes.php"><i class="fa fa-bar-chart nav_icon"></i>Reportes</a>
						</li>
					
					</ul>
					<div class="clearfix"> </div>
					<!-- //sidebar-collapse -->
				</nav>
			</div>
		</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<!--logo -->
				<div class="logo">
					<a href="index.php">
						<h1>POST</h1>
						<span>AdminPanel</span>
					</a>
				</div>
				<!--//logo-->
				<!--search-box-->
				<div class="search-box">
					<form class="input">
						<input class="sb-search-input input__field--madoka" placeholder="Buscar..." type="search" id="input-31" />
						<label class="input__label" for="input-31">
							<svg class="graphic" width="100%" height="100%" viewBox="0 0 404 77" preserveAspectRatio="none">
								<path d="m0,0l404,0l0,77l-404,0l0,-77z"/>
							</svg>
						</label>
					</form>
				</div><!--//end-search-box-->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-envelope"></i><span class="badge">0</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>No tiene Mensajes</h3>
									</div>
								</li>
							
								<li>
									<div class="notification_bottom">
										<a href="#">Ver todos los Mensajes</a>
									</div> 
								</li>
							</ul>
						</li>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">0</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>No tiene notificaciones</h3>
									</div>
								</li>
						
								 <li>
									<div class="notification_bottom">
										<a href="#">Ver todas las notificaciones</a>
									</div> 
								</li>
							</ul>
						</li>	
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-tasks"></i><span class="badge blue1">0</span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>No tiene nuevas Tareas</h3>
									</div>
								</li>
								
								<li>
									<div class="notification_bottom">
										<a href="#">ver tareas pendientes</a>
									</div> 
								</li>
							</ul>
						</li>	
					</ul>
					<div class="clearfix"> </div>
				</div>
				<!--notification menu end -->
			<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<div class="user-name">
										
										<?php 

										echo $_SESSION['usuario_administrador_login'];

										?> 
										<span> <br> Más Opciones</span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="#"><i class="fa fa-user"></i>Perfil</a> </li> 
								<li> <a href="../menu.php"><i class="fa fa-sign-out"></i>Volver a Menu</a> </li>
								<li> <a href="../includes/auth/logoutEmpleados.php"><i class="fa fa-sign-out"></i>Cerrar Sesion</a> </li>
							</ul>
						</li>
					</ul>
				</div>

				<div class="clearfix"> </div>	
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->

	<!-- main content start-->

	
<!-- main content start-->

		<div id="page-wrapper">
			<div class="main-page">
				<div class="row-one">
					<div class="col-md-4 widget">
						<div class="stats-left ">
							<h5>Pedidos</h5>
							<h4>Hoy</h4>
						</div>
						<div class="stats-right">
							<label><?php echo pedidosHoy(); ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-mdl">
						<div class="stats-left">
							<h5>Meseros</h5>
							<h4>Activos Hoy</h4>
						</div>
						<div class="stats-right">
							<label><?php echo MeserosActivos(); ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="col-md-4 widget states-last">
						<div class="stats-left">
							<h5>Mesas</h5>
							<h4>Ocupadas</h4>
						</div>
						<div class="stats-right">
							<label><?php echo mesasDisponibles(); ?></label>
						</div>
						<div class="clearfix"> </div>	
					</div>
					<div class="clearfix"> </div>	
				</div>
				<div class="charts">
					<div class="col-md-4 charts-grids widget">
						<h4 class="title">Ventas Semanales</h4>
						<canvas id="bar" height="300" width="400"> </canvas>
					</div>
					<div class="col-md-4 charts-grids widget states-mdl">
						<h4 class="title">Ventas en las ultimas Horas</h4>
						<canvas id="line" height="300" width="400"> </canvas>
					</div>
					<div class="col-md-4 charts-grids widget">
						<h4 class="title">Ventas Meseros (Semanal)</h4>
						<canvas id="pie" height="300" width="400"> </canvas>
					</div>
					<div class="clearfix"> </div>

						
							 <script>

								<?php 
						
									$resultadosemanas =VentasUltimasSemanas(); 
									$resultadosemanas2 =VentasUltimasSemanas2(); 


									for ($i=0; $i <7 ; $i++) { 
									$datossemanas[$i]= 0;
									$datossemanas2[$i]= 0;
									}

									$i = 0;
									
									while ($fila = mysql_fetch_row($resultadosemanas)) { 


									$datossemanas[$fila[0]]= $fila[1];
									
									$i++;

									}

									$i = 0;
									while ($fila2 = mysql_fetch_row($resultadosemanas2)) { 


									$datossemanas2[$fila2[0]]= $fila2[1];
									
									$i++;

									}

								
																		  

									 ?>


								var barChartData = {
									labels : ["Dom","Lun","Mar","Mier","Juev","Vier","Sab"],
									datasets : [
										{
											fillColor : "rgba(79, 82, 186, 0.9)",
											strokeColor : "rgba(79, 82, 186, 0.9)",
											highlightFill: "#4F52BA",
											highlightStroke: "#4F52BA",

											
											data : [
											 <?php echo $datossemanas2[6];
											 ?>,<?php echo $datossemanas2[0]; 
											 ?>,<?php echo $datossemanas2[1]; 
											 ?>,<?php echo $datossemanas2[2]; 
											 ?>,<?php echo $datossemanas2[3]; 
											 ?>,<?php echo $datossemanas2[4]; 
											 ?>,<?php echo $datossemanas2[5];?>]
										},
										{
											fillColor : "rgba(233, 78, 2, 0.9)",
											strokeColor : "rgba(233, 78, 2, 0.9)",
											highlightFill: "#e94e02",
											highlightStroke: "#e94e02",
											data : [<?php echo $datossemanas[6];
											 ?>,<?php echo $datossemanas[0]; 
											 ?>,<?php echo $datossemanas[1]; 
											 ?>,<?php echo $datossemanas[2]; 
											 ?>,<?php echo $datossemanas[3]; 
											 ?>,<?php echo $datossemanas[4]; 
											 ?>,<?php echo $datossemanas[5];?>]
										}
									]
									
								};

								<?php 
						
									$resultadoshoras =VentasUltimasHoras(); 
									$resultadoshoras2 =VentasUltimasHoras2(); 
									$hora1=date("H")+1-7;
									$hora=date("H")+1-7;

									for ($i=0; $i <7 ; $i++) { 
									$datoshoras[$hora]= 0;
									$datoshoras2[$hora]= 0;
						
									$hora++;

									}

							
									
									while ($fila = mysql_fetch_row($resultadoshoras)) { 


									$datoshoras[$fila[0]]= $fila[1];
									
							

									}

									while ($fila2 = mysql_fetch_row($resultadoshoras2)) { 


									$datoshoras2[$fila2[0]]= $fila2[1];
									

									}

								
																		  

									 ?>


								var lineChartData = {
									labels : [
											 <?php echo $hora1;
											 ?>,<?php echo$hora1+1; 
											 ?>,<?php echo $hora1+2; 
											 ?>,<?php echo $hora1+3; 
											 ?>,<?php echo $hora1+4; 
											 ?>,<?php echo $hora1+5; 
											 ?>,<?php echo $hora1+6;?>],
									datasets : [
										{
											fillColor : "rgba(97, 100, 193, 1)",
											strokeColor : "#6164C1",
											pointColor : "rgba(97, 100, 193,1)",
											pointStrokeColor : "#9358ac",
											data : [
											 <?php echo $datoshoras2[$hora1];
											 ?>,<?php echo ($datoshoras2[$hora1+1]); 
											 ?>,<?php echo $datoshoras2[$hora1+2]; 
											 ?>,<?php echo $datoshoras2[$hora1+3]; 
											 ?>,<?php echo $datoshoras2[$hora1+4]; 
											 ?>,<?php echo $datoshoras2[$hora1+5]; 
											 ?>,<?php echo $datoshoras2[$hora1+6];?>]

										},
										{
											fillColor : "rgba(242, 179, 63, 0.9)",
											strokeColor : "#F2B33F",
											pointColor : "rgba(242, 179, 63, 1)",
											pointStrokeColor : "#fff",

											
											data : [
											 <?php echo $datoshoras[$hora1];
											 ?>,<?php echo $datoshoras[$hora1+1]; 
											 ?>,<?php echo $datoshoras[$hora1+2]; 
											 ?>,<?php echo $datoshoras[$hora1+3]; 
											 ?>,<?php echo $datoshoras[$hora1+4]; 
											 ?>,<?php echo $datoshoras[$hora1+5]; 
											 ?>,<?php echo $datoshoras[$hora1+6];?>]

										}
									]
									
								};
									<?php 
						
						$resultado =VentasEmpleados(); 

							for ($i=0; $i <4 ; $i++) { 
							$datos[$i]['cantidad']= 0;
							$datos[$i]['nombre']="No asignado" ;
							}

							$i = 0;
							
							while ($fila = mysql_fetch_row($resultado)) { 

							$datos[$i]['cantidad']= $fila[0];
							$datos[$i]['nombre']= $fila[1];
							$i++;

							}
																  

						 ?>
								var pieData = [
										{
											value: <?php echo $datos[0]['cantidad'];  ?>,
											color:"rgba(233, 78, 2, 1)",
											label: <?php echo ('"'. $datos[0]['nombre'] .'"'); ?>
										},
										{
											value: <?php echo $datos[1]['cantidad'];  ?>,
											color : "rgba(242, 179, 63, 1)",
											label: <?php echo ('"'. $datos[1]['nombre'] .'"'); ?>
										},
										{
											value: <?php echo $datos[2]['cantidad'];  ?>,
											color : "rgba(79, 82, 186, 1)",
											label: <?php echo ('"'. $datos[2]['nombre'] .'"'); ?>
										},
										{
											value: <?php echo $datos[3]['cantidad'];  ?>,
											color : "rgba(88, 88, 88,1)",
											label: <?php echo ('"'. $datos[3]['nombre'] .'"'); ?>
										}
																		
										
									];
								
							new Chart(document.getElementById("line").getContext("2d")).Line(lineChartData);
							new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
							new Chart(document.getElementById("pie").getContext("2d")).Pie(pieData);
							
							</script>
							
				</div>
				<div class="row">
				<?php 
						
						$resultado =VentasCategorias(); 

							for ($i=0; $i <5 ; $i++) { 
							$datos[$i]['cantidad']= 0;
							$datos[$i]['nombre']="No asignado" ;
							}
							$i = 0;
							$suma=0;

							while ($fila = mysql_fetch_row($resultado)) { 

							$datos[$i]['cantidad']= $fila[0];
							$datos[$i]['nombre']= $fila[1];
							$suma=$suma+$fila[0];
							$i++;

							}
							if ($suma==0) {
								$suma=1;
							}

											  

				 ?>
				 
					<div class="col-md-4 stats-info widget">
						<div class="stats-title">
							<h4 class="title">Categorias</h4>
						</div>
						<div class="stats-body">
							<ul class="list-unstyled">
								<li><?php echo  $datos[0]['nombre']; ?> <span class="pull-right"><?php echo  round(($datos[0]['cantidad']/$suma)*100); ?> %</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar green" style=<?php echo ('"width:'.(($datos[0]['cantidad']/$suma)*100).'%"'); ?>;></div> 
									</div>
								</li>
								<li><?php echo  $datos[1]['nombre']; ?> <span class="pull-right"><?php echo  round(($datos[1]['cantidad']/$suma)*100);  ?>%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar yellow" style=<?php echo ('"width:'.(($datos[1]['cantidad']/$suma)*100).'%"'); ?>;></div>
									</div>
								</li>
								<li><?php echo  $datos[2]['nombre']; ?> <span class="pull-right"><?php echo  round(($datos[2]['cantidad']/$suma)*100);  ?>%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar red" style=<?php echo ('"width:'.(($datos[2]['cantidad']/$suma)*100).'%"'); ?>;></div>
									</div>
								</li>
								<li><?php echo  $datos[3]['nombre']; ?> <span class="pull-right"><?php echo  round(($datos[3]['cantidad']/$suma)*100);  ?>%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar blue" style=<?php echo ('"width:'.(($datos[3]['cantidad']/$suma)*100).'%"'); ?>;></div>
									</div>
								</li>
								<li><?php echo  $datos[4]['nombre']; ?> <span class="pull-right"><?php echo  round(($datos[4]['cantidad']/$suma)*100);  ?>%</span>  
									<div class="progress progress-striped active progress-right">
										<div class="bar orange" style=<?php echo ('"width:'.(($datos[4]['cantidad']/$suma)*100).'%"'); ?>;></div>
									</div>
								</li>
								
								
				
							</ul>
						</div>
					</div>
					<div class="col-md-8 stats-info stats-last widget-shadow">
						<?php 
						
						$resultado =VentasProductos(); 

							for ($i=0; $i <5 ; $i++) { 
							$datos[$i]['cantidad']= 0;
							$datos[$i]['nombre']="No asignado" ;
							}
							$i = 0;
							$suma=0;

							while ($fila = mysql_fetch_row($resultado)) { 

							$datos[$i]['cantidad']= $fila[0];
							$datos[$i]['nombre']= $fila[1];
							$suma=$suma+$fila[0];
							$i++;

							}
							if ($suma==0) {
								$suma=1;
							}

											  

				 ?>
						<table class="table stats-table ">
							<thead>
								<tr>
									<th>S.NO</th>
									<th>PRODUCTO</th>
									<th>ESTADO</th>
									<th>VENTAS</th>
								</tr>
							</thead>
							<tbody>


								<tr>
									<th scope="row">1</th>
									<td><?php echo  $datos[0]['nombre']; ?> </td>
									<td><span class="label label-success">Alto</span></td>
									<td><h5><?php echo  round(($datos[0]['cantidad']/$suma)*100); ?> % <i class="fa fa-level-up"></i></h5></td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td><?php echo  $datos[1]['nombre']; ?> </td>
									<td><span class="label label-success">Alto</span></td>
									<td><h5><?php echo  round(($datos[1]['cantidad']/$suma)*100); ?> %<i class="fa fa-level-up"></i></h5></td>
								</tr>
								<tr>
									<th scope="row">3</th>
									<td><?php echo  $datos[2]['nombre']; ?> </td>
									<td><span class="label label-warning">Medio</span></td>
									<td><h5><?php echo  round(($datos[2]['cantidad']/$suma)*100); ?> % <i class="fa fa-level-up"></i></h5></td>
								</tr>
								<tr>
									<th scope="row">4</th>
									<td><?php echo  $datos[3]['nombre']; ?> </td>
									<td><span class="label label-warning">Medio</span></td>
									<td><h5  class="down"><?php echo  round(($datos[3]['cantidad']/$suma)*100); ?> % <i class="fa fa-level-down"></i></h5></td>
								</tr>
								<tr>
									<th scope="row">5</th>
									<td><?php echo  $datos[4]['nombre']; ?> </td>
									<td><span class="label label-danger">Bajo</span></td>
									<td><h5  class="down"><?php echo  round(($datos[4]['cantidad']/$suma)*100); ?> % <i class="fa fa-level-down"></i></h5></td>
								</tr>
							
							</tbody>
						</table>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="row">
					
					
					
						<div class="clearfix"> </div>
					</div>
					<div class="clearfix"> </div>
				</div>
				<div class="row calender widget-shadow">
					<h4 class="title">Calendario</h4>
					<div class="cal1">
						
					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>


		<!--footer-->
		<div class="footer">
		   <p>&copy; 2016 Panel de Administración. Todos Los Derechos Reservados | David Hernandez </p>
		</div>
        <!--//footer-->
	</div>
	<!-- Classie -->
		<script src="../js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!--scrolling js-->
	<script src="../js/jquery.nicescroll.js"></script>
	<script src="../js/scripts.js"></script>
	<!--//scrolling js-->
	<!-- Bootstrap Core JavaScript -->
   <script src="../js/bootstrap.js"> </script>
</body>
</html>