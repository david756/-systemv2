		<?php 


			function mesasDisponibles(){
						//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

					$query ='SELECT COUNT(*) FROM atenciones AS a INNER JOIN mesas AS m ON (a.fk_mesa=m.id) WHERE(a.fk_estado=1)';
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					   while($rows=mysql_fetch_array($consulta)){ 
				             

			           		$mesasDisponibles=$rows[0];
			           		

				        }

					return $mesasDisponibles;

			}
			function pedidosHoy(){
			
				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

					$fecha=date("Y-m-d");
					$query ='SELECT count(DISTINCT ap.fk_atencion)FROM aten_prod as ap WHERE DATE(hora_pedido)="'.$fecha.'"';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					   while($rows=mysql_fetch_array($consulta)){ 
				             

			           		$pedidosHoy=$rows[0];
			           		

				        }

					return $pedidosHoy;

			}


			function MeserosActivos(){
			
				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

					$fecha=date("Y-m-d");
					$query ='SELECT COUNT(DISTINCT ea.fk_empleado) from empl_atencion as ea INNER JOIN aten_prod as ap on ea.fk_aten_prod=ap.id where DATE(hora_pedido)="'.$fecha.'"';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					   while($rows=mysql_fetch_array($consulta)){ 
				             

			           		$meserosActivos=$rows[0];
			           		

				        }

					return $meserosActivos;

			}
			function VentasCategorias(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT count(c.id) AS cuenta,c.nombre FROM categorias as c INNER JOIN productos AS p ON p.fk_categoria=c.id INNER JOIN
				 aten_prod as ap ON ap.fk_producto=p.id WHERE ap.hora_pedido > DATE_SUB(NOW(), INTERVAL 8 day) GROUP BY c.id ORDER by cuenta DESC LIMIT 0, 5';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}


			function VentasProductos(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT count(ap.id) as cuenta,p.nombre FROM aten_prod as ap inner JOIN productos as p
			 on ap.fk_producto = p.id WHERE ap.hora_pedido > DATE_SUB(NOW(), INTERVAL 8 day) 
			 GROUP BY p.id ORDER by cuenta DESC LIMIT 0, 5';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}

			function VentasUltimasHoras(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT hour(ap.hora_pedido) as hora, count(ap.fk_producto) as cantidad
				 from aten_prod as ap WHERE (ap.hora_pedido)<(DATE_SUB(NOW(), INTERVAL 0 hour)) and (ap.hora_pedido)>(DATE_SUB(NOW(), INTERVAL 7 hour)) 
				 GROUP BY hora';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}

				function VentasUltimasHoras2(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT hour(ap.hora_pedido) as hora, count(ap.fk_producto) as cantidad
				 from aten_prod as ap WHERE (ap.hora_pedido)<(DATE_SUB(NOW(), INTERVAL 24 hour)) and (ap.hora_pedido)>(DATE_SUB(NOW(), INTERVAL 31 hour))
				GROUP BY hora';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}
				
			function VentasUltimasSemanas(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT WEEKDAY(ap.hora_pedido) as diaSemana,  count(ap.fk_producto) as cantidad from aten_prod as ap 
				WHERE WEEK(ap.hora_pedido)=WEEK(DATE_SUB(NOW(), INTERVAL 0 day)) GROUP BY diaSemana';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}
			function VentasUltimasSemanas2(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT WEEKDAY(ap.hora_pedido) as diaSemana,  count(ap.fk_producto) as cantidad from aten_prod as ap 
				WHERE WEEK(ap.hora_pedido)=WEEK(DATE_SUB(NOW(), INTERVAL 7 day)) GROUP BY diaSemana';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}

			//solo para recordar no funcional
			function VentasUltimasSemanas22(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT WEEKDAY(ap.hora_pedido) as diaSemana, count(ap.fk_producto) as cantidad from aten_prod as ap WHERE
				 (ap.hora_pedido > DATE_SUB(NOW(), INTERVAL 8 day)) AND (ap.hora_pedido < DATE_SUB(NOW(), INTERVAL 0 day)) GROUP BY diaSemana';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					

					return $consulta;

				

			}



			function VentasEmpleados(){


				//Conexion a la base de datos 
					if (!isset($conect)) {			
					
				 		if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }

				
				}

				$query ='SELECT count(e.id)as cuenta,e.usuario from empleados as e 
				INNER JOIN empl_atencion as ea on e.id=ea.fk_empleado INNER JOIN aten_prod as ap on ea.fk_aten_prod=ap.id 
				WHERE ap.hora_pedido > DATE_SUB(NOW(), INTERVAL 8 day) group by e.id order by cuenta DESC limit 0,4';
					
					$consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
					
					return $consulta;

				

			}

			

		?>