<?php
        include "../model/Inventario.php";

        //creando un nuevo inventario
        $inventario = new Inventario(null,"producto","usuario","fecha","cantidad","proveedor","costo","descripcion","accion"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($inventario);
        consultar(3);
        consultarAll();
        actualizar(7, "producto","usuario","fecha","cantidad","proveedor","costo","descripcion","accion");
        eliminar(20);
        */
        
        /*
         * Agregar inventario a la base de datos
         */
        function agregar($i){
            echo("<br>***Agregando inventarios a la base de datos***<br>");
            $id=$i->createInventario();
            echo 'inventario creado id: '.$id.'<br>';
        }
        

        /*
         * Consultar el inventario agregado
         */
        function consultar($id){
            echo("<br>***Consultar la inventario agregada***<br>");
            $inventarioConsulta= new Inventario($id);
            $inventario=$inventarioConsulta->getInventario();
            echo 'inventario consultado id: '.$inventario->getIdInventario().'<br>';
            echo 'inventario consultado producto: '.$inventario->getProducto().'<br>';
        }
        
        
        /*
         * Consultar todas los inventarios
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los inventario***<br>");
            $inventariosConsulta= new Inventario();
            $consulta=$inventariosConsulta->getInventarios();
            foreach ($consulta as $inventario) {
                print $inventario['id'] . "-" . $inventario['producto'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un inventario
         */
        function actualizar($id,$producto,$usuario,$fecha,$cantidad,$proveedor,$costo,$descripcion,$accion){
            echo("<br>***Actrualizar la inventario***<br>");
            $inventariosActualizar= new Inventario($id,$producto,$usuario,$fecha,$cantidad,$proveedor,$costo,$descripcion,$accion);
            $resultado=$inventariosActualizar->updateInventario();
            echo $resultado;            
        }
        
        /*
         * Eliminar un inventario
         */
        function eliminar($id){
            echo("<br>***eliminar la inventario***<br>");
            $inventariosEliminar= new Inventario($id);
            $resultado=$inventariosEliminar->deleteInventario();
            echo $resultado;
        }

?>