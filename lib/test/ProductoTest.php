<?php
        include "../model/Producto.php";

        //creando un nuevo producto
        $producto = new Producto(null,"nombre","valor","descripcion","categoria"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($producto);
        consultar(3);
        consultarAll();
        actualizar(7,"nombre","valor","descripcion","categoria");
        eliminar(20);
        */
        
        /*
         * Agregar producto a la base de datos
         */
        function agregar($u){
            echo("<br>***Agregando productos a la base de datos***<br>");
            $id=$u->createProducto();
            echo 'producto creado id: '.$id.'<br>';
        }
        

        /*
         * Consultar el producto agregado
         */
        function consultar($id){
            echo("<br>***Consultar la producto agregada***<br>");
            $productoConsulta= new Producto($id);
            $producto=$productoConsulta->getProducto();
            echo 'producto consultado id: '.$producto->getIdProducto().'<br>';
            echo 'producto consultado nombre: '.$producto->getNombre().'<br>';
        }
        
        
        /*
         * Consultar todas los productos
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los producto***<br>");
            $productosConsulta= new Producto();
            $consulta=$productosConsulta->getProductos();
            foreach ($consulta as $producto) {
                print $producto['id'] . "-" . $producto['nombre'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un producto
         */
        function actualizar($id,$nombre,$valor,$descripcion,$categoria){
            echo("<br>***Actrualizar la producto***<br>");
            $productosActualizar= new Producto($id,$nombre,$valor,$descripcion,$categoria);
            $resultado=$productosActualizar->updateProducto();
            echo $resultado;            
        }
        
        /*
         * Eliminar un producto
         */
        function eliminar($id){
            echo("<br>***eliminar la producto***<br>");
            $productosEliminar= new Producto($id);
            $resultado=$productosEliminar->deleteProducto();
            echo $resultado;
        }

?>