<?php
        include "../model/Usuario.php";

        //creando un nuevo usuario
        $usuario = new Usuario(null,"nombre","apellido","usuario","contrasena","genero","telefono"); 
        
        /*
         * llamado a funciones
         */
        
        /*
        agregar($usuario);
        consultar(3);
        consultarAll();
        actualizar(7, "nombre","apellido","usuario","contrasena","genero","telefono");
        eliminar(20);
        */
        
        /*
         * Agregar usuario a la base de datos
         */
        function agregar($u){
            echo("<br>***Agregando usuarios a la base de datos***<br>");
            $id=$u->createUsuario();
            echo 'usuario creado id: '.$id.'<br>';
        }
        

        /*
         * Consultar el usuario agregado
         */
        function consultar($id){
            echo("<br>***Consultar la usuario agregada***<br>");
            $usuarioConsulta= new Usuario($id);
            $usuario=$usuarioConsulta->getUsuario();
            echo 'usuario consultado id: '.$usuario->getIdUsuario().'<br>';
            echo 'usuario consultado nombre: '.$usuario->getNombre().'<br>';
            echo 'usuario consultado nombre: '.$usuario->getPrivilegios().'<br>';
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
        function actualizar($id,$nombre,$apellido,$usuario,$contraseña,$genero,$telefono,$privilegios){
            echo("<br>***Actrualizar la usuario***<br>");
            $usuariosActualizar= new Usuario($id,$nombre,$apellido,$usuario,$contraseña,$genero,$telefono,$privilegios);
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

?>