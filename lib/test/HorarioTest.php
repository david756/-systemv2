<?php
        include "../model/Horario.php";

        //creando un nuevo horario
        $horario = new Horario(null,"fecha","accion","usuario"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($horario);
        consultar(3);
        consultarAll();
        actualizar(7,"fecha","accion","usuario");
        eliminar(20);
        */
        
        /*
         * Agregar horario a la base de datos
         */
        function agregar($u){
            echo("<br>***Agregando horarios a la base de datos***<br>");
            $id=$u->createHorario();
            echo 'horario creado id: '.$id.'<br>';
        }
        

        /*
         * Consultar el horario agregado
         */
        function consultar($id){
            echo("<br>***Consultar la horario agregada***<br>");
            $horarioConsulta= new Horario($id);
            $horario=$horarioConsulta->getHorario();
            echo 'horario consultado id: '.$horario->getIdHorario().'<br>';
            echo 'horario consultado fecha: '.$horario->getFecha().'<br>';
            echo 'horario consultado accion: '.$horario->getAccion().'<br>';
            echo 'horario consultado usuario: '.$horario->getUser().'<br>';
        }
        
        
        /*
         * Consultar todas los horarios
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los horario***<br>");
            $horariosConsulta= new Horario();
            $consulta=$horariosConsulta->getHorarios();
            foreach ($consulta as $horario) {
                print $horario['id'] . "-" . $horario['fk_accion'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un horario
         */
        function actualizar($id,$fecha,$accion,$usuario){
            echo("<br>***Actrualizar la horario***<br>");
            $horariosActualizar= new Horario($id,$fecha,$accion,$usuario);
            $resultado=$horariosActualizar->updateHorario();
            echo $resultado;            
        }
        
        /*
         * Eliminar un horario
         */
        function eliminar($id){
            echo("<br>***eliminar la horario***<br>");
            $horariosEliminar= new Horario($id);
            $resultado=$horariosEliminar->deleteHorario();
            echo $resultado;
        }

?>