
		<?php
		  include 'includes/auth/validarSesiones.php';
		  perfil();
		?>


<!DOCTYPE HTML>
<html>
		<head>
			<title>Seleccion Perfil</title>
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
			<!-- Bootstrap Core CSS -->
			<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
			<!-- Custom CSS -->
			<link href="css/style.css" rel='stylesheet' type='text/css' />
			<style type="text/css">		  

			/***** radio-box *****/
			/* radio-box grupo 01*/
			li.radio_01 { width: auto;}

			li.radio_01 input[type=radio] { display: none;}
			li.radio_01 input[type=radio] + label { 
			  color: #000; 
			  display: block; 
			  float: left;
			  width: auto; 
			  height: 143px;
			  text-indent: -1000em;
			}

			li.radio_01 input[type=radio].primero + label       { background: url(images/radio_01.png) 0px 0px no-repeat; width: 140px; }
			li.radio_01 input[type=radio].primero:checked + label   { background: url(images/radio_01.png) 0px -140px no-repeat; }

			li.radio_01 input[type=radio].ultimo + label      { background: url(images/radio_01.png) 100% 0px no-repeat; width: 140px; }
			li.radio_01 input[type=radio].ultimo:checked + label  { background: url(images/radio_01.png) 100% -140px no-repeat; }

			</style>
			<!-- font CSS -->
			<!-- font-awesome icons -->
			<link href="css/font-awesome.css" rel="stylesheet"> 
			<!-- //font-awesome icons -->
			 <!-- js-->
			<script src="js/jquery-1.11.1.min.js"></script>
			<script src="js/modernizr.custom.js"></script>
			<!--webfonts-->
			<!--//webfonts--> 
			<!--animate-->
			<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
			<script src="js/wow.min.js"></script>
				<script>
					 new WOW().init();
				</script>
			<!--//end-animate-->
			<!-- Metis Menu -->
			<script src="js/metisMenu.min.js"></script>
			<script src="js/custom.js"></script>
			<script type="text/javascript">
			      
			           function toggle2(elemento) {
			          if(elemento.value=="Administrador") {
			              document.getElementById("opc_admin").style.display = "block";
			              document.getElementById("opc_empl").style.display = "none";
			              

			           }else if(elemento.value=="Empleado"){
			                   document.getElementById("opc_admin").style.display = "none";
			                   document.getElementById("opc_empl").style.display = "block";
			                
			               
			           }

			      }

			</script>

			<link href="css/custom.css" rel="stylesheet">
			<!--//Metis Menu -->

			<!--//Script para el teclado en pantalla -->

			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
					<!-- Bootstrap -->
					<link rel="stylesheet" href="css/bootstrap.min.css">
					<link rel="stylesheet" href="css/bootstrap-theme.min.css">
					<!-- jQuery.NumPad -->
					<script src="js/jquery.numpad.js"></script>
					<link rel="stylesheet" href="css/jquery.numpad.css">
					<script type="text/javascript">
						// Set NumPad defaults for jQuery mobile. 
						// These defaults will be applied to all NumPads within this document!
						$.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
						$.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
						$.fn.numpad.defaults.displayTpl = '<input type="password" class="form-control" />';
						$.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
						$.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
						$.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
						
						// Instantiate NumPad once the page is ready to be shown
						$(document).ready(function(){
							$('#text-basic').numpad();
							$('#password').numpad({
								displayTpl: '<input class="form-control" type="password" />',
								hidePlusMinusButton: true,
								hideDecimalButton: true	
							});
							$('#numpadButton-btn').numpad({
								target: $('#numpadButton')
							});
							$('#numpad4div').numpad();
							$('#numpad4column .qtyInput').numpad();
						});
					</script>

		</head> 


<body class="cbp-spmenu-push">

	<div class="main-content">
		<div id="page-wrapper-center">
			<div class="main-page">
				<h3 class="title1">Seleccion de el Perfil</h3>
				<div class="grids widget-shadow">
				<?php if (isset($_GET['error']))
						{echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times</span></button> Error ! eL usuario no coincide con la contraseña</div>';} ?>


						<form action ="includes/auth/validarEmpleados.php" method="POST">
								<div class="form-group">
										<div class="row">
												<div class="col-md-6 grid_box1">
						                 		 <ul>
							                   		 <li class="radio_01"> 
							                     	 <input type="radio" name="radio_01"  id="radio_01_01" class="primero"
							                     	  onclick="toggle2(this)" value="Empleado" checked="true" /><label  for="radio_01_01">&#160;</label>
							                    	 </li> 
						                		 </ul>
												</div>
												<div class="col-md-6">
								                    <ul>
								                      <li class="radio_01"> 
								                        <input type="radio" name="radio_01"  id="radio_02_01"class="ultimo" 
								                        onclick="toggle2(this)" value="Administrador" /><label for="radio_02_01">&#160;</label>
								                      </li> 
								                    </ul>		
												</div>
											<div class="clearfix"> </div>
										</div>
									</div>




								<div  id="opc_admin" style="display:none" class="form-group">
										<div class="row">
												<div class="col-md-12 grid_box1">														
												            <?php
												            include 'includes/dbconsultas/consulta.php';
												            $resultado = consultarAdministradores();
												            while($rows=mysql_fetch_array($resultado)){ 
												                echo'
																<label  class="label-image">
																<img src="images/perfil.png">
												                <input type="radio"   name="administrador" value='.$rows[0].'> ' .$rows[5] .'
																</label><br>
												                ';
												            	} 														            
												           ?>
												</div>
												<div class="clearfix"> </div>
											</div>
									</div>




									<div id="opc_empl" style="display:block" class="form-group">
											<div class="row">
													<div class="col-md-12 grid_box1">
														   <?php												                
												            $resultado = consultarEmpleados();
												            while($rows=mysql_fetch_array($resultado)){ 
												                echo'
												                <div class="col-md-4 grid_box1">
																<label  class="label-image">
																		<img src="images/perfil.png">
												                		<input type="radio" name="empleado" value=' .$rows[0].'> '.$rows[5] .'
																</label>
																</div>
												                ';
												            } 												            
												           ?>
													</div>													
													<div class="clearfix"> </div>
												</div>
									</div>

									<div class="form-group">
											<div class="row">
													<div class="col-md-12 grid_box1">
														<div class="col-md-10 grid_box1">
																<input type="password" name="clave" id="numpadButton" class="form-control1" placeholder="clave" >
														</div>
														<div class="col-md-2 grid_box1">
																<span class="input-group-btn">
																	<input  class="form-control1"  id="numpadButton-btn" value ="boton" type="button">
																</span>
														</div>
													</div>									
												</div>
									</div>
									<div class="form-group">
												<div class="row">
													<div class="col-md-6 grid_box1">
														<input type="submit"  class="form-control1" id="blue" value="INGRESAR AL MENU">
													</div>
													<div class="col-md-6">
														<input type="submit" class="form-control1" id="blue" name="pedido" value="INGRESAR A PEDIDOS">
													</div>
													<div class="clearfix"> </div>
												</div>
									</div>	

								</form>
					
								<div class="form-group">
									<div class="row">
										<div class="col-md-2 grid_box1">
											 <a href="includes/auth/logout.php"><button class="form-control1">Salir del sistema</button></a>
										</div>									
										<div class="clearfix"> </div>
									</div>
								</div>						
			</div>
				
		
		   </div>
		</div>
	</div>

		<!--footer-->
		<div class="footer">
		   <p>&copy; 2016 Post Premium. Todos Los Derechos Reservados | David Hernandez </p>
		</div>
        <!--//footer-->
	
		<!-- Classie -->
			<script src="js/classie.js"></script>
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
			<script src="js/jquery.nicescroll.js"></script>
			<script src="js/scripts.js"></script>
			<!--//scrolling js-->
			<!-- Bootstrap Core JavaScript -->
		   <script src="js/bootstrap.js"> </script>
	</body>
</html>