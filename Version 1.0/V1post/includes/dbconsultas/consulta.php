<?php 
				
				 function consultarEmpleados(){

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
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM empleados where admin='null' "; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	



 function consultarPerfilEmpleados(){

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
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM perfil_empleados "; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	


 				function consultarAdministradores(){

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


				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM empleados where admin=1 "; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	






				function consultarMesas(){

				//Conexion a la base de datos 


					if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('/includes/db/serv.php')) {
  						 	include '/includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }
  						  else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM mesas"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	

 				function consultarMesasLibres(){

				//Conexion a la base de datos 


					if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('/includes/db/serv.php')) {
  						 	include '/includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }
  						  else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT me.id, me.descripcion FROM mesas as me WHERE me.id not in
				 (SELECT m. id FROM atenciones AS a INNER JOIN mesas AS m ON 
				 	(a.fk_mesa=m.id) INNER JOIN estados_atencion AS ea ON (a.fk_estado=ea.id) WHERE (ea.id=1))"; 

				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	





				function consultarEstadoMesa($mesa){

				//Conexion a la base de datos 


					if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('/includes/db/serv.php')) {
  						 	include '/includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }
  						  else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta='SELECT ea.id,a.id FROM atenciones AS a INNER JOIN mesas AS m ON (a.fk_mesa=m.id)
							INNER JOIN estados_atencion AS ea ON (a.fk_estado=ea.id)
							WHERE (m.id='.$mesa.')'; 
				$resultado=mysql_query($consulta,$conect); 
				$estadoMesa="disponible";
						while($rows=mysql_fetch_array($resultado)){ 
                  			if ($rows[0]==1) {
                  				
                  					$estadoMesa=$rows[1];

                  			}
               			
                  	}

                  return $estadoMesa;

            } 

            function consultarAtencionPorMesa($mesa){

				//Conexion a la base de datos 


					if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('/includes/db/serv.php')) {
  						 	include '/includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }
  						  else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta='SELECT m.descripcion,a.id FROM mesas as m 
				INNER JOIN atenciones as a on a.fk_mesa=m.id WHERE (m.id='.$mesa.' and a.fk_estado=1)'; 

				$resultado=mysql_query($consulta,$conect); 
				
                  return $resultado;

            } 





				function consultarCategorias(){

				//Conexion a la base de datos 

					if (file_exists('./includes/db/serv.php')) {
				 			 include './includes/db/serv.php';
				 		}
  						 else if (file_exists('/includes/db/serv.php')) {
  						 	include '/includes/db/serv.php';
  						 }
  						 else if (file_exists('../db/serv.php')) {
  						 	include '../db/serv.php';
  						 }
  						   else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }

			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM categorias"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	


 				function consultarProductos(){

				//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
					}
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM productos"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	

 				function consultarProductosInventario(){

				//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
  						 else if (file_exists('../includes/db/serv.php')) {
  						 	include '../includes/db/serv.php';
  						 }
					}
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM productos where productos.inventario=1"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	


				function consultarEstadoIngreso(){

				//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
					}
			


					$estado_anterior=2;
					$id_empleado=$_SESSION['id_empleado_login'];
					$consulta='SELECT * FROM horarios  where fk_empleado="'.$id_empleado.'"  ORDER BY fecha DESC' ; 

					$resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());

					
					
						$rows=mysql_fetch_array($resultado);

								if (isset($rows[3])) {

										$estado_anterior=$rows[3];
								}

						return $estado_anterior;
			 		
			 		}	

			 		function consultarListaIngresos($id_empleado_new){
			 						//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
					}

			 				$consulta='SELECT e.usuario,h.fecha,a.descripcion FROM horarios 
			 				AS h INNER JOIN empleados AS e ON (h.fk_empleado=e.id) INNER JOIN acciones AS
			 				 a ON (a.id=h.fk_accion) WHERE e.id="'.$id_empleado_new.'" ORDER BY h.fecha DESC LIMIT 0, 10' ; 

			 			 $resultado=mysql_query($consulta,$conect) or die ("Error 1 en: " . mysql_error());
			 			 return $resultado;

			 		}



 				function consultarAtenciones(){

				//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }
  						 else if (file_exists('../includes/db/serv.php')) {
  						 include '../includes/db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
					}
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM atenciones"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	
function consultarAtenProd(){

				//Conexion a la base de datos 


					if (!isset($conect)) {

						 if (file_exists('/includes/db/serv.php')) {
 						include '/includes/db/serv.php';
 						}

 						else if (file_exists('../db/serv.php')) {
  						 include '../db/serv.php';
  						 }
  						 else if (file_exists('../includes/db/serv.php')) {
  						 include '../includes/db/serv.php';
  						 }

  						 else if (file_exists('includes/db/serv.php')) {
  						 include 'includes/db/serv.php';
  						 }
					}
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM aten_prod"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	


 				function consultarPerfiles(){

				//Conexion a la base de datos 


 					if (!isset($conect)) {
 						include '../includes/db/serv.php';
 					}

				
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta="SELECT * FROM perfiles"; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}	


 				function consultarDetalleAtencion($idAtencion){

				//Conexion a la base de datos 


 					if (!isset($conect)) {
 						include 'includes/db/serv.php';
 					}

				
			
				////Obteniendo registros de la base de datos a traves de una consulta SQL 
				$consulta='SELECT ap.id,ap.valor,ap.anexos,ap.hora_pedido,ap.hora_preparacion,
				ap.hora_despacho,ep.descripcion,p.nombre,p.valor,p.descripcion,e.usuario,ea.descripcion,c.nombre,ap.descuento 
				FROM aten_prod AS ap INNER JOIN atenciones as a on ap.fk_atencion=a.id 
				INNER JOIN estados_atencion as ea on ea.id =a.fk_estado
				INNER JOIN productos as p on p.id=ap.fk_producto 
				INNER JOIN empl_atencion as ema ON ema.fk_aten_prod=ap.id 
				INNER JOIN empleados as e ON e.id=ema.fk_empleado 
				INNER JOIN estados_prod as ep ON ep.id= ap.fk_estadoProd
				INNER JOIN categorias as c ON c.id = p.fk_categoria
				where a.id ='.$idAtencion; 
				$resultado=mysql_query($consulta,$conect); 

				return $resultado;
 				}



				?>