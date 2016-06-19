<?php
        include "../model/AtencionProducto.php";

        //creando un nuevo atencionProducto
        $atencionProducto = new AtencionProducto(null,"producto","atencion","usuario","valor","horaPedido","cantidad",
                "anexos","horaPreparacion","horaDespacho","descuento","estado"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($atencionProducto);
        consultar(3);
        consultarAll();
        actualizar(7, "producto","atencion","usuario","valor","horaPedido","cantidad",
                "anexos","horaPreparacion","horaDespacho","descuento","estado");
        eliminar(20);
        */
        
        /*
         * Agregar atencionProducto a la base de datos
         */
        function agregar($ap){
            echo("<br>***Agregando atencionProductos a la base de datos***<br>");
            $id=$ap->createAtencionProducto();
            echo 'atencionProducto creado id: '.$id.'<br>';
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
        function bajar($id){
            echo("<br>***eliminar la atencionProducto***<br>");
            $atencionProductosEliminar= new AtencionProducto($id);
            $resultado=$atencionProductosEliminar->deleteAtencionProducto();
            echo $resultado;
        }

?>