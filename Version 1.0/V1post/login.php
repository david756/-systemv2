<!--
Author: David Hernandez
<!-login-page -->


<?php
	
	include 'includes/auth/validarSesiones.php';
	login();

?>

<!DOCTYPE html>
<html>
<head>
		<title>Ingresar </title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		
		<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
		<!-- Bootstrap Core CSS -->
		<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
		<!-- Custom CSS -->
		<link href="css/style.css" rel='stylesheet' type='text/css' />
		<!-- font CSS -->
		<!-- font-awesome icons -->
		<link href="css/font-awesome.css" rel="stylesheet"> 
		<!-- //font-awesome icons -->
		 <!-- js-->
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/modernizr.custom.js"></script>
		<!--webfonts-->
		<link href='css/fonts-google.css' rel='stylesheet' type='text/css'>
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
		<link href="css/custom.css" rel="stylesheet">
		<!--//Metis Menu -->
</head> 
<body>
<d>


	
			<div class="content">
				<div id="page-wrapper-center">
					<div class="main-page login-page ">
						<h3 class="title1">Ingresar al sistema</h3>
						<?php if (isset($_GET['error']))
						{echo '<div class="alert alert-danger"><button class="close" data-dismiss="alert"><span>&times</span></button> Error ! eL usuario no coincide con la contraseña</div>';} ?>
							
					
						
						<div class="widget-shadow">
							<div class="login-top">
								<h4>Bienvenido a POST PREMIUM !</h4>
						</div>
							<div class="login-body">
							<form method="post" action="includes/auth/validar.php">
								 <h5>Nombre del Establecimiento: </h5>
								 <input maxlength="6" type="text" NAME ="establecimiento" value="cafe">
								 <h5>Clave:</h5>
								 <input  maxlength="6" type="password"NAME ="clave">					
								 <input type="submit" value="INGRESAR">
								  
							 </form>
							</div>
						</div>
					</div>
				</div>
			</div>


</d>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
