<?php
        include "../model/AtencionProducto.php";
        include "../model/Producto.php";
        include "../model/Usuario.php";
        include "../model/Atencion.php";
        
        $producto=new Producto(3);
        $producto=$producto->getProducto();
        $usuario=new Usuario(110);
        $usuario=$usuario->getUsuario();
        $atencion=new Atencion(991974);
        $atencion=$atencion->getAtencion();
        $fecha= date('Y-m-d H:i:s');
        
        //creando un nuevo atencionProducto
        $atencionProducto = new AtencionProducto(null,$producto,$atencion,$usuario,3000,$fecha,1,
                "anexos del producto",$fecha,$fecha,1,$usuario); 
        
        /*
         * llamado a funciones
         */

        //agregar($atencionProducto);
        //consultar(99737902);
        //consultarAll();
        actualizar(99737912,$producto,$atencion,$usuario,7000,$fecha,null,
                "anexos editados",$fecha,$fecha,3,$usuario);
        //eliminar(997379002);

        
        /*
         * Agregar atencionProducto a la base de datos
         */
        function agregar($ap){
            echo("<br>***Agregando atencionProductos a la base de datos***<br>");
            $estado=$ap->createAtencionProducto();
            echo 'atencionProducto creado estado: '.$estado.'<br>';
        }
        

        /*
         * Consultar  atencionProducto agregado
         */
        function consultar($id){
            echo("<br>***Consultar la atencionProducto agregada***<br>");
            $atencionProductoConsulta= new AtencionProducto($id);
            $atencionProducto=$atencionProductoConsulta->getAtencionProducto();
            
            echo 'id: '.$atencionProducto->getIdAtencionProducto().'<br>';
            echo 'producto: '.$atencionProducto->getProducto().'<br>';
            echo 'mesero: '.$atencionProducto->getUsuario().'<br>';
            echo 'atencion: '.$atencionProducto->getAtencion().'<br>';
            echo 'hora pedido: '.$atencionProducto->getHoraPedido().'<br>';
            echo 'hora preparacion: '.$atencionProducto->getHoraPreparacion().'<br>';
            echo 'hora despacho: '.$atencionProducto->getHoraDespacho().'<br>';
            echo 'cantidad: '.$atencionProducto->getCantidad().'<br>';
            echo 'anexos: '.$atencionProducto->getAnexos().'<br>';
            echo 'estado: '.$atencionProducto->getEstado().'<br>';
            echo 'cocinero: '.$atencionProducto->getCocinero().'<br>';
            
            
            
            
        }
                
        /*
         * Consultar todas las atencionProductos
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los atencionProducto***<br>");
            $atencionProductosConsulta= new AtencionProducto();
            $consulta=$atencionProductosConsulta->getAtencionProductos();
            foreach ($consulta as $atencionProducto) {
                print $atencionProducto['ap_id'] . "-" . $atencionProducto['ap_valor'] ."<br/>";
                print $atencionProducto['ea_fk_empleado'] . "-" . $atencionProducto['ap_hora_despacho'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un atencionProducto
         */
        function actualizar($id,$producto,$atencion,$usuario,$valor,$horaPedido,$cantidad,$anexos,
                $horaPreparacion,$horaDespacho,$estado,$cocinero){
            echo("<br>***Actrualizar la atencionProducto***<br>");
            $atencionProductosActualizar= new AtencionProducto($id,$producto,$atencion,$usuario,$valor,$horaPedido,$cantidad,$anexos,
                    $horaPreparacion,$horaDespacho,$estado,$cocinero);
            $resultado=$atencionProductosActualizar->updateAtencionProducto();
            echo $resultado;            
        }
        
        /*
         * Eliminar un atencionProducto
         */
        function eliminar($id){
            echo("<br>***eliminar la atencionProducto***<br>");
            $atencionProductosEliminar= new AtencionProducto($id);
            $resultado=$atencionProductosEliminar->deleteAtencionProducto();
            echo $resultado;
        }

?>