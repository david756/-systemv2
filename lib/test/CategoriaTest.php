<?php
        include "../model/Categoria.php";

        //creando una nueva categoria
        $categoria = new Categoria(null,"categoria Prueba 1");    
        
        /*
         * llamado a funciones
         */
        
        
        //agregar($categoria);
        //consultar(6);
        //consultarAll();
        actualizar(1, "sapos Rellenos");
       // eliminar(3);
        
        
        /*
         * Agregar categoria a la base de datos
         */
        function agregar($c){
            echo("<br>***Agregando categorias a la base de datos***<br>");
            $categoria=$c->createCategoria();
            echo 'categoria creada id: '.$categoria->getIdCategoria().'<br>';
        }
        

        /*
         * Consultar la categoria agregada
         */
        function consultar($id){
            echo("<br>***Consultar la categoria agregada***<br>");
            $categoriaConsulta= new Categoria($id);
            $categoria=$categoriaConsulta->getCategoria();
            echo 'categoria consultada id: '.$categoria->getIdCategoria().'<br>';
            echo 'categoria consultada nombre: '.$categoria->getNombre().'<br>';
        }
        
        
        /*
         * Consultar todas las categorias
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas las categoria***<br>");
            $categoriasConsulta= new Categoria();
            $consulta=$categoriasConsulta->getCategorias();
            foreach ($consulta as $categoria) {
                print $categoria['id'] . "-" . $categoria['nombre'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar una categoria
         */
        function actualizar($id,$nombre){
            echo("<br>***Actrualizar la categoria***<br>");
            $categoriasActualizar= new Categoria($id,$nombre);
            $resultado=$categoriasActualizar->updateCategoria();
            echo $resultado;
            
        }
        /*
         * Eliminar una categoria
         */
        function eliminar($id){
            echo("<br>***eliminar la categoria***<br>");
            $categoriasEliminar= new Categoria($id);
            $resultado=$categoriasEliminar->deleteCategoria();
            echo $resultado;
        }

?>