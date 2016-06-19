<?php
        include "../model/Inventario.php";
        include "../model/Usuario.php";
        include "../model/Producto.php";

        $producto = new Producto(2);
        $usuario = new Usuario(113); 
        
        $producto = $producto->getProducto();
        $usuario = $usuario->getUsuario();
        $fecha= date('Y-m-d H:i:s');
        
        
        //creando un nuevo inventario
        $inventario = new Inventario(null,$producto,$usuario,$fecha,5,"proveedor",2500,"descripcion"); 
        
        
        /*
         * llamado a funciones
         */
        
        
       //agregar($inventario);
       // consultar(3);
       //consultarAll();
       bajar($inventario);
        
        
        /*
         * Agregar inventario a la base de datos
         */
        function agregar($i){
            echo("<br>***Agregando inventarios a la base de datos***<br>");
            $inventario=$i->agregarInventario();
            echo 'inventario creado id: '.$inventario->getIdInventario().'<br>';
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
                print $inventario['id'] . "-" . $inventario['fk_producto'] ."<br/>";
            }           
        }
        
        /*
         * Eliminar un inventario
         */
        function bajar($inventario){
            echo("<br>***eliminar la inventario***<br>");
            $resultado=$inventario->bajarInventario();
            echo $resultado->getIdInventario();
        }

?>