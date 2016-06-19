<?php
        include "../model/Usuario.php";

        //creando un nuevo usuario
        $usuario = new Usuario(null,"nombre","apellido","usuario","pass","genero","telefono"); 
        
        /*
         * llamado a funciones
         */      
        $privilegios=array(1,2,3,4,1);
        //$usuario->setPrivilegios($privilegios);
        //$user=agregar($usuario);
        //consultar(132);
        //consultarAll();
        //actualizar(132, "nombre2","apellido2","usuario2","cont2","genero2","telefono2","def");
        //eliminar(119);
        //searchPriv(132);
        
        /*Crear Privilegios*/
        //$usuarioConsulta= new Usuario(136);
        //$user=$usuarioConsulta->getUsuario();
        //createPriv($user,$privilegios);
        
        
              
        /*
         * Agregar usuario a la base de datos
         */
        function agregar($u){
            echo("<br>***Agregando usuarios a la base de datos***<br>");
            $usuario=$u->createUsuario();
            echo 'usuario creado id: '.$usuario->getIdUsuario().'<br>';
        }
        
        /*
         * Consultar el usuario agregado
         */
        function consultar($id){
            echo("<br>***Consultar el usuario agregada***<br>");
            $usuarioConsulta= new Usuario($id);
            $usuario=$usuarioConsulta->getUsuario();
            echo 'usuario consultado id: '.$usuario->getIdUsuario().'<br>';
            echo 'usuario consultado nombre: '.$usuario->getNombre().'<br>';
            echo 'usuario consultado apellido: '.$usuario->getApellido().'<br>';
            echo 'usuario consultado privilegio: ';
            print_r($usuario->getPrivilegios());
            
        }
        
        
        /*
         * Consultar todas los usuarios
         */
        
        function consultarAll(){
            echo("<br>***Consultar todas los usuario***<br>");
            $usuariosConsulta= new Usuario();
            $consulta=$usuariosConsulta->getUsuarios();
            foreach ($consulta as $usuario) {
                print $usuario['id'] . "-" . $usuario['nombre'] ."<br/>";
            }           
        }
        
        /*
         * Actualizar un usuario
         */
        function actualizar($id,$nombre,$apellido,$usuario,$contrasena,$genero,$telefono,$privilegios){
            echo("<br>***Actrualizar la usuario***<br>");
            $usuariosActualizar= new Usuario($id,$nombre,$apellido,$usuario,$contrasena,$genero,$telefono,$privilegios);
            $resultado=$usuariosActualizar->updateUsuario();
            echo $resultado;            
        }
        
        /*
         * Eliminar un usuario
         */
        function eliminar($id){
            echo("<br>***eliminar la usuario***<br>");
            $usuariosEliminar= new Usuario($id);
            $resultado=$usuariosEliminar->deleteUsuario();
            echo $resultado;
        }
        
        function searchPriv($id){
            echo("<br>***consultar privilegios***<br>");
            $usuarioconsultar= new Usuario($id);
            $privilegiosArray=$usuarioconsultar->searchPrivilegios();
            print_r($privilegiosArray);
        }
        
        function createPriv($usuario,$privilegios){
           $estado= $usuario->createPrivilegios($privilegios);
           if ($estado==1) {
               echo "exito";
           }
           else {
               echo $estado;
           }
           
        }

?>