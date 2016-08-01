

	<?php 

    include '../class/atencion.php';
    include '../db/serv.php';
    //require '../../lib/Pusher.php';

   

	if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 


        include '../dbconsultas/consulta.php';
        include '../crud/agregarAtencion.php';

        $resultado = consultarProductos();
        $cad=($_POST['cadena']);

        //se cra atencion en la base de datos 
        $idMesa= $cad['idMesa'];
        //si la mesa esta ocupada , retorna el id de la atencion actual.
        $idAtencion=consultarEstadoMesa($idMesa);

        if ($idAtencion=="disponible") {
            $idAtencion=agregarAtencion($idMesa);           
        }

       
        
        $mesa=$idMesa;

                while($rows=mysql_fetch_array($resultado)){ 

                        //si existe $rows[0]=idProducto
                        if (isset($cad[$rows[0]])) {
                           

                                //se ingresa producto la cantidad de veces a la base de datos.
                                for ($i=0; $i < $cad[$rows[0]][0]  ; $i++) { 

                                //se crea aten_prod en la base de datos

                                // se consulta el valor actual del producto
                                $resultadoV = mysql_query("SELECT valor FROM productos WHERE id=$rows[0]",$conect)or die ("Error 1 en: " . mysql_error());
                                $rowsV=mysql_fetch_array($resultadoV);

                                $valor=$rowsV[0];
                           
                               
                                $idAtencionProducto=agregarAtencionProducto($rows[0],$idAtencion,$valor);

                               
                                $idEmpleado=null;

                               
                                if (isset($_SESSION['id_administrador_login'])) {

                                  $idEmpleado=$_SESSION['id_administrador_login'];

                                }
                                elseif (isset($_SESSION['id_empleado_login'])) {
                                   
                                    $idEmpleado=$_SESSION['id_empleado_login'];
                                }


                                 //se crea emp_atencion en la base de datos
                                agregarEmpleadoAtencion($idEmpleado,$idAtencionProducto);


                                }
                               

                        }
                        

                }

                                //se envia en tiempo real señal a la cocina y a la caja
                                      $options = array(
                                        'encrypted' => true
                                      );
                                      $pusher = new Pusher(
                                        '865d004d72d3fc5d9cec',
                                        'cc78660620e96fd3ce1d',
                                        '173507',
                                        $options
                                      );

                                      $data['message'] = 'hello world';
                                      $pusher->trigger('test_channel', 'my_event', $data);
      
                                   


    ?>