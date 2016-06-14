

	<?php 



          // incluimos la conexión
          require("../db/serv.php");
          // creamos la consulta
 
          //0=nombre producto,1=descripcion prod,2=anexos,3=mesa,4=hora,5=empleado,6=estado,7=idProducto,8=idAtenProd,9=idEstadoProd,10=horaPreparacion
          $query = "SELECT p.nombre,p.descripcion,ap.anexos,m.descripcion,ap.hora_pedido,e.usuario,ep.descripcion,p.id,ap.id,ep.id,ap.hora_preparacion
                              FROM atenciones AS a INNER JOIN  estados_atencion AS ea ON 
                              (a.fk_estado=ea.id)
                              INNER JOIN  aten_prod AS ap ON (ap.fk_atencion=a.id)
                              INNER JOIN  productos AS p ON (p.id=ap.fk_producto)
                              INNER JOIN  categorias AS  c ON (p.fk_categoria=c.id)
                              INNER JOIN  empl_atencion AS eat ON (eat.fk_aten_prod=ap.id)
                              INNER JOIN  empleados AS e ON (e.id=eat.fk_empleado)
                              INNER JOIN  mesas AS m ON (m.id=a.fk_mesa)
                              INNER JOIN  estados_prod AS ep ON (ep.id=ap.fk_estadoProd)
                              WHERE(ep.id=1 OR ep.id=2)
                              ORDER BY ap.hora_pedido ASC ";



          // enviamos la consulta a MySQL
          $consulta = mysql_query($query, $conect);

          $texto=null;
          $accion="nada";
          $horaActual=time();
         $clase= "";

        while($rows=mysql_fetch_array($consulta)){ 
              //si atenProd = pedido

                
             if ($rows[9]==2) {
                  
                  $rows[4]=$rows[10];


            }


              $date = new DateTime($rows[4]);
              $horaPedido= $date->format('U');

              $diferencia=round(($horaActual-$horaPedido)/60)+1;
            

                          



            if ($rows[9]==1) {
              $accion="Preparar";
               $progreso='<h5 > <span class="timeprogress">'.$diferencia.'</span> Minutos <i class="fa fa-level-up"></i></h5>';
                $estado='<span class="label label-success">'.$rows[6].'</span>';
                $clase= "";
                if($diferencia>'10'){
                 $clase="danger";
                }


            }
            else if ($rows[9]==2) {
             $accion="Despachar";
               $progreso='<div><h5 class="down"> <span class="timeprogress">'.$diferencia.'</span>  Minutos <i class="fa fa-level-down"></i></h5></div>';
                $estado='<span class="label label-warning">'.$rows[6].'</span>';
                 $clase="info";

            

            }

           $texto = '<tr class="'.$clase.'"> 
                      <td > '.$rows[0].'</td> 
                      <td>'.$rows[2].'</td>
                      <td>'.$rows[3].'</td>
                      <td >'.$progreso.'</td>
                      <td>'.$rows[5].'</td>
                      <td>'.$estado.'</td>
                      <td><h4><button id="pedido-'.$rows[8].'"  onclick="cambiarEstado('.$rows[8].','.$rows[9].')" class="label label-default">'.$accion.'</button></h4></td>
                     ';
          echo $texto ;

          } 


           
    ?>