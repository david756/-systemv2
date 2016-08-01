

  <?php 


          // incluimos la conexión
          require("../db/serv.php");
          // creamos la consulta
          $query = "SELECT 

m.descripcion ,SUM(ap.valor),a.id,a.fk_estado,ea.descripcion,(sum(ap.descuento)+a.descuento) as dcto

FROM atenciones AS a INNER JOIN  estados_atencion AS ea ON 

(a.fk_estado=ea.id)

INNER JOIN  aten_prod AS ap ON (ap.fk_atencion=a.id)
INNER JOIN  productos AS p ON (p.id=ap.fk_producto)
INNER JOIN  categorias AS  c ON (p.fk_categoria=c.id)
INNER JOIN  empl_atencion AS eat ON (eat.fk_aten_prod=ap.id)
INNER JOIN  empleados AS e ON (e.id=eat.fk_empleado)
INNER JOIN  mesas AS m ON (m.id=a.fk_mesa)
INNER JOIN  estados_prod AS ep ON (ep.id=ap.fk_estadoProd)

WHERE (ap.hora_pedido)<(DATE_SUB(NOW(), INTERVAL 0 hour)) and (ap.hora_pedido)>(DATE_SUB(NOW(), INTERVAL 12 hour))


group by m.descripcion,a.id 
ORDER BY ap.hora_pedido DESC";



          // enviamos la consulta a MySQL
          $consulta = mysql_query($query, $conect);

          $texto=null;

        while($rows=mysql_fetch_array($consulta)){ 

            $accion="detalles";
            if ($rows[3]==2 OR $rows[3]==3 OR $rows[3]==4 ) {
               $accion="Detalles";
            }


           $texto = '<tr> 
                      <td>'.$rows[0].'</td> 
                      <td>'.($rows[1]-$rows[5]).'</td>
                      <td><a href="detalleAtencion.php?idAtencion='.$rows[2].' "><button> '.$accion.' </button></a></td>
                      <td>'.$rows[4].'</td>
                                            
                      </tr>';

          echo $texto ;


          } 


           
    ?>