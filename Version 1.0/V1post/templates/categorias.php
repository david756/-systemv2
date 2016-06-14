		<!--
Author: David Hernandez
-->

	<?php
	session_start();
	include '../includes/auth/validarSesiones.php';
	administracion();
	?>
	
<!DOCTYPE HTML>
<html>
<head>
<title>POST Panel de Administración </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Novus Admin Panel Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
<!-- Metis Menu -->
<script src="../js/metisMenu.min.js"></script>
<script src="../js/custom.js"></script>
<link href="../css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">


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
		<div id="page-wrapper">
	


<!--//formulario de registro  -->



<h3 class="title1">Agregar Nueva Categoria</h3>
<div class="sign-up-row widget-shadow">

					<h4 class="title1">Datos de la categoria</h5>

				<form  data-toggle="validator" action ="../includes/crud/agregar.php" method="POST">
												<div class="sign-u">
													<div class="sign-up1">
														<h4>Nombre :</h4>
													</div>

													<div class="form-group">
														<input type="text" name="nombre" class="form-control" id="inputName" placeholder="Bebidas ... " required>
													</div>
													<div class="clearfix"> </div>
												</div>

												<div class="sub_home">

														<input type="text" name ="identificador" value="categoria" style="visibility:hidden" > 
													<button type="submit" class="btn btn-primary disabled">Guardar</button>
													
													<div class="clearfix"> </div>
												</div>
				</form>




				
				</div>














			<div class="main-page">
				<h3 class="title1">Categorias</h3>
				<div class="grid-bottom widget-shadow">
					<table class="table table-bordered table-striped no-margin grd_tble">
						<thead>
								<tr>
								  <th>id</th>
								  <th>Nombre</th>
								  <th>accion</th>
								 </tr>
						</thead>


							<tbody>
								

				
				<?php
				include '../includes/dbconsultas/consulta.php';
				$resultado = consultarCategorias();
				while($rows=mysql_fetch_array($resultado)){ 

						echo'
							<tbody>
								<tr>

								  <td>'.$rows[0].'</td>
								  <td>'.$rows[1].'</td>
								  <td>  <h4> <a href="editar.php?editar=categorias&id='.$rows[0].'&nombre='.$rows[1].'" class="btn btn-primary btn-xs" <span class="btn btn-primary btn-xs">Editar</span></a></h4> </td> 


								</tr>
							</tbody>

						';

				} 
				?> 

							
							</tbody>
					</table>
				</div>
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
      	<script src="../js/validator.min.js"></script>
</body>
</html>