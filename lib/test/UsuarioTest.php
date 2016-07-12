<?php
        include "../model/Usuario.php";

        //creando un nuevo usuario
        $usuario = new Usuario(null,"nombre","apellido","usuario","pass","genero","telefono",1); 
        
        /*
         * llamado a funciones
         */ 
        //0-Admin,1-cajero,2-mesero,3-cocinero,4inventario
        //posicion 0 reservado para admin 0=no , 1=si
        //posicion 1-4 para otros perfiles,no hay orden
        $privilegios=array(0,4,3);
        $usuario->setPrivilegios($privilegios);
        //$user=agregar($usuario);
        //consultar(145);
        //consultarAll();
        //actualizar(145, "nombre2","apellido2","usuario2","cont2","genero2","telefono2",2,"def");
        eliminar(146);
        //searchPriv(145);
        
        /*Crear Privilegios*/
        //$usuarioConsulta= new Usuario(145);
        //$user=$usuarioConsulta->getUsuario();
        //actualiza los privilegios (borra todos y crea)
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
        function actualizar($id,$nombre,$apellido,$usuario,$contrasena,$genero,$telefono,$estado,$privilegios){
            echo("<br>***Actrualizar la usuario***<br>");
            $usuariosActualizar= new Usuario($id,$nombre,$apellido,$usuario,$contrasena,$genero,$telefono,$estado,$privilegios);
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