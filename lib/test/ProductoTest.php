<?php
        include "../model/Producto.php";
        include "../model/Categoria.php";

        
        //creando un nuevo producto
        $categoria = new Categoria(1,"categoria Prueba 1");
        $categoria=$categoria->createCategoria();
        $producto = new Producto(null,"nombre",10,"descripcion",$categoria,1,0); 
               
        /*
         * llamado a funciones
         */

        agregar($producto);
        //consultar(11);
        //consultarAll();
        //actualizar(11,"nombre2",20,"descripcion2",$categoria,2,1);
        //eliminar(11);

        /*
         * Agregar producto a la base de datos
         */
        function agregar($p){
            echo("<br>***Agregando productos a la base de datos***<br>");
            $producto=$p->createProducto();
            echo 'producto creado id: '.$producto->getIdProducto().'<br>';
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
        function actualizar($id,$nombre,$valor,$descripcion,$categoria,$estado,$stock){
            echo("<br>***Actrualizar la producto***<br>");
            $productosActualizar= new Producto($id,$nombre,$valor,$descripcion,$categoria,$estado,$stock);
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