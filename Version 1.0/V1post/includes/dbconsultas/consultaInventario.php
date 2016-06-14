		<?php 
				

				 function consultarInventario(){
				 	include 'includes/db/serv.php';

				 	$query = 'SELECT p.nombre as producto, sum(i.cantidad) as cantidad_ingresados , (SELECT count(ap.fk_producto) as cantidad_Vendidos from aten_prod as ap WHERE ap.fk_producto=i.fk_producto GROUP BY ap.fk_producto) as cantidad_vendidos , (SELECT sum(i2.cantidad) as cantidad_eliminados from inventarios as i2 WHERE i2.fk_accion=2 and i2.fk_producto=i.fk_producto GROUP BY i2.fk_producto) as cantidad_eliminados from inventarios as i inner join productos as p  on p.id=i.fk_producto WHERE i.fk_accion=1 GROUP BY i.fk_producto
				';
					
			          $consulta = mysql_query($query, $conect) or die ("Error 3 en consulta : " . mysql_error());
			          $texto="";

			          while($rows=mysql_fetch_array($consulta)){ 

			          	
				         $texto =$texto.'<tr> 
	                      <td>'.$rows[0].'</td> 
	                      <td>'.$rows[1].'</td>
	                      <td>'.$rows[2].'</td>
	                      <td>'.$rows[3].'</td>
	                      <td>'.($rows[1]-$rows[3]-$rows[2]).'</td>		                                            
	                      </tr>';
			          }

				        
			           return $texto;

 				}


 				 

		?>