<?php
        include "../model/Mesa.php";

        //creando una nueva mesa
        $categoria = new Mesa(null,"mesa Prueba 1");    
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($mesa);
        consultar(3);
        consultarAll();
        actualizar(7, "mesa .. actualizada");
        eliminar(20);
        */
        
        /*
         * Agregar mesa a la base de datos
         */
        function agregar($m){
            echo("<br>***Agregando mesas a la base de datos***<br>");
            $id=$m->createMesa();
            echo 'mesa creada id: '.$id.'<br>';
        }
        

        /*
         * Consultar la mesa agregada
         */
        function consultar($id){
            echo("<br>***Consultar la mesa agregada***<br>");
            $mesaConsulta= new Mesa($id);
            $mesa=$mesaConsulta->getMesa();
            echo 'mesa consultada id: '.$mesa->getIdMesa().'<br>';
            echo 'mesa consultada nombre: '.$mesa->getDescripcion().'<br>';
        }
        
        
        /*
         * Consultar todas las mesas
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas las mesa***<br>");
            $mesasConsulta= new Mesa();
            $consulta=$mesasConsulta->getMesas();
            foreach ($consulta as $mesa) {
                print $mesa['id'] . "-" . $mesa['descripcion'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar una mesa
         */
        function actualizar($id,$descripcion){
            echo("<br>***Actrualizar la mesa***<br>");
            $mesasActualizar= new Mesa($id,$descripcion);
            $resultado=$mesasActualizar->updateMesa();
            echo $resultado;
            
        }
        /*
         * Eliminar una mesa
         */
        function eliminar($id){
            echo("<br>***eliminar la mesa***<br>");
            $mesasEliminar= new Mesa($id);
            $resultado=$mesasEliminar->deleteMesa();
            echo $resultado;
        }

?>