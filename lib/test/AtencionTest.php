<?php
        include "../model/Atencion.php";
        include "../model/Usuario.php";
        include "../model/Mesa.php";
        

        $mesa   = new Mesa(54);
        $mesa   =$mesa->getMesa();        
        $cajero = new Usuario(146);
        $cajero =$cajero->getUsuario();
        $fecha= date('Y-m-d H:i:s');
        //creando una nueva atencion
        $atencion = new Atencion(null,"descripcion del estado",5000,$cajero,$mesa,$fecha,1); 
        
        /*
         * llamado a funciones
         */
        
        
       //agregar($atencion);
       //consultar(15);
       //consultarAll();
       //actualizar(991977, "descripcion 2",3000,$cajero,$mesa,$fecha,2);
       //eliminar(991977);
   
        
        /*
         * Agregar atencion a la base de datos
         */
        function agregar($a){
            echo("<br>***Agregando atencion a la base de datos***<br>");
            $atencion=$a->createAtencion();
            echo 'atencion creada id: '.$atencion->getIdAtencion().'<br>';
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
        function actualizar($id,$descripcion,$descuento,$cajero,$mesa,$horaPago,$estado){
            echo("<br>***Actrualizar la atencion***<br>");
            $atencionActualizar= new Atencion($id,$descripcion,$descuento,$cajero,$mesa,$horaPago,$estado);
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