<?php
        include "../model/Atencion.php";

        //creando una nueva atencion
        $atencion = new Atencion(null,"descripcion","cajero","mesa","horaPago","estado"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($atencion);
        consultar(3);
        consultarAll();
        actualizar(7, "descripcion","cajero","mesa","horaPago","estado");
        eliminar(20);
        */
        
        /*
         * Agregar atencion a la base de datos
         */
        function agregar($u){
            echo("<br>***Agregando atencion a la base de datos***<br>");
            $id=$u->createAtencion();
            echo 'atencion creada id: '.$id.'<br>';
        }
        

        /*
         * Consultar la atencion agregada
         */
        function consultar($id){
            echo("<br>***Consultar la atencion agregada***<br>");
            $atencionConsulta= new Atencion($id);
            $atencion=$atencionConsulta->getAtencion();
            echo 'atencion consultado id: '.$atencion->getIdAtencion().'<br>';
            echo 'atencion consultado mesa: '.$atencion->getMesa().'<br>';
        }
        
        
        /*
         * Consultar todas los atencions
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas las atenciones***<br>");
            $atencionsConsulta= new Atencion();
            $consulta=$atencionsConsulta->getAtenciones();
            foreach ($consulta as $atencion) {
                print $atencion['id'] . "-" . $atencion['fk_mesa'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar una atencion
         */
        function actualizar($id,$descripcion,$cajero,$mesa,$horaPago,$estado){
            echo("<br>***Actrualizar la atencion***<br>");
            $atencionActualizar= new Atencion($id,$descripcion,$cajero,$mesa,$horaPago,$estado);
            $resultado=$atencionActualizar->updateAtencion();
            echo $resultado;            
        }
        
        /*
         * Eliminar una atencion
         */
        function eliminar($id){
            echo("<br>***eliminar la atencion***<br>");
            $atencionEliminar= new Atencion($id);
            $resultado=$atencionEliminar->deleteAtencion();
            echo $resultado;
        }

?>