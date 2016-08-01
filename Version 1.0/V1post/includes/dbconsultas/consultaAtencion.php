		<?php 
				

				 function consultarEmpleadosAtencion($idAtencion){
				 	include 'includes/db/serv.php';

					 $query = 'SELECT 
					 DISTINCT	e.usuario
			        

			        FROM empl_atencion AS eat INNER JOIN empleados AS e ON (eat.fk_empleado=e.id)
			        INNER JOIN  aten_prod AS ap ON (eat.fk_aten_prod=ap.id)
			       
			        WHERE(ap.fk_atencion='.$idAtencion.')';

			        	

			          // enviamos la consulta a MySQL
			          $consulta = mysql_query($query, $conect) or die ("Error 1 en: " . mysql_error());

			          	$listado="";

			           while($rows=mysql_fetch_array($consulta)){ 
				             

			           		$listado=$listado.'<li>'.$rows[0].'</li>';
			           		

				        }

				        $listaEmpleados="<ul>".$listado."</ul>";

			          return $listaEmpleados;

 				}



 				 function consultarProductosAtencion($idAtencion){
 				 		include 'includes/db/serv.php';

						//cantidad,producto,anexos,valor unidad,total
 				 		$query = 'SELECT count(*) as cantidad, p.nombre,ap.anexos,ap.valor as precio,(count(*)*ap.valor) as resultado 
 				 		FROM aten_prod AS ap INNER JOIN productos AS p ON (p.id=ap.fk_producto) 
 				 		WHERE(ap.fk_atencion='.$idAtencion.') 
 				 		GROUP BY p.id,ap.valor,ap.anexos';




			         // enviamos la consulta a MySQL
			          $consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());

			          	$listado="";

			           while($rows=mysql_fetch_array($consulta)){ 
				             
			           	 $Producto='<tr><td>'.$rows[0].'</td>'.
					           		'<td>'.$rows[1].'</td>'.
					           		'<td>'.$rows[2].'</td>'.
					           		'<td>'.$rows[3].'</td>' .
					           		'<td>'.$rows[4].'</td></tr>';

			           		$listado=$listado.$Producto;
			           		

				        }

				        $listaProductos=$listado;

			          return $listaProductos;



 				}



 				//consulta atencion: Mesa,Valor,Cajero,descuento,total.
 				function consultarDatosAtencion($idAtencion){
 						include 'includes/db/serv.php';

					$query ='SELECT m.descripcion,sum(ap.valor),a.fk_cajero,(sum(ap.descuento)+a.descuento) as dcto,
					 (sum(ap.valor))as total ,horaPago,ea.descripcion FROM aten_prod AS ap 
					INNER JOIN atenciones AS a ON (ap.fk_atencion=a.id) INNER JOIN mesas AS m ON (m.id=a.fk_mesa) 
					INNER JOIN estados_atencion as ea on ea.id=a.fk_estado
					WHERE(a.id='.$idAtencion.')';

			          // enviamos la consulta a MySQL
			          $consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
			        return $consulta;

 				}

 				//consulta atencion: Mesa,Valor,Cajero,descuento,total.
 				function consultarTodasAtenciones(){
 						include '../includes/db/serv.php';

					$query ='select a.id,m.descripcion,ea.descripcion,a.descripcion_estado,a.descuento,a.horaPago
					from atenciones as a INNER JOIN mesas as m on a.fk_mesa=m.id 
					INNER JOIN estados_atencion as ea on ea.id= a.fk_estado  ' ;

			          // enviamos la consulta a MySQL
			          $consulta = mysql_query($query, $conect) or die ("Error 2 en: " . mysql_error());
			        return $consulta;

 				}



		?>