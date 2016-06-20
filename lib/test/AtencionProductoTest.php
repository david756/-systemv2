<?php
        include "../model/AtencionProducto.php";
        include "../model/Producto.php";
        include "../model/Usuario.php";
        include "../model/Atencion.php";
        
        $producto=new Producto(10);
        $producto=$producto->getProducto();
        $usuario=new Usuario(113);
        $usuario=$usuario->getUsuario();
        $atencion=new Atencion(991970);
        $atencion=$atencion->getAtencion();
        $fecha= date('Y-m-d H:i:s');
        
        //creando un nuevo atencionProducto
        $atencionProducto = new AtencionProducto(null,$producto,$atencion,$usuario,3000,$fecha,1,
                "anexos del producto",$fecha,$fecha,1,$usuario); 
        
        /*
         * llamado a funciones
         */

        //agregar($atencionProducto);
        consultar(99737944);
        //consultarAll();
        //actualizar(7, "producto","atencion","usuario","valor","horaPedido","cantidad",
        //        "anexos","horaPreparacion","horaDespacho","descuento","estado");
        //eliminar(20);

        
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
            echo 'atencionProducto consultado id: '.$atencionProducto->getIdAtencionProducto().'<br>';
            echo 'atencionProducto consultado producto: '.$atencionProducto->getProducto().'<br>';
            echo 'atencionProducto consultado empleado: '.$atencionProducto->getUsuario().'<br>';
            
            
        }
                
        /*
         * Consultar todas las atencionProductos
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los atencionProducto***<br>");
            $atencionProductosConsulta= new AtencionProducto();
            $consulta=$atencionProductosConsulta->getAtencionProductos();
            foreach ($consulta as $atencionProducto) {
                print $atencionProducto['id'] . "-" . $atencionProducto['fk_producto'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un atencionProducto
         */
        function actualizar($id,$producto,$atencion,$usuario,$valor,$horaPedido,$cantidad,$anexos,
                $horaPreparacion,$horaDespacho,$descuento,$estado){
            echo("<br>***Actrualizar la atencionProducto***<br>");
            $atencionProductosActualizar= new AtencionProducto($id,$producto,$atencion,$usuario,$valor,$horaPedido,$cantidad,$anexos,
                    $horaPreparacion,$horaDespacho,$descuento,$estado);
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