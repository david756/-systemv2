<?php
/*
 * incluye el modelo usuario, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Usuario.php";
/**
 * recibe por POST el metodo segun
 * el proceso que valla a realizar
 */
if (isset($_POST["metodo"])) {
    $metodo=$_POST["metodo"];
}
//si no recibe metodo
 else {
    die ('301:Error, no existe dirección');
}

/**
 * Direcciona al metodo que se recibe
 */
switch ($metodo) {
    case "create":
        verificarAdmin();
        crear();        
        break;
    case "update":
        verificarUser();
        actualizar();
        break;
    case "update2":
        verificarAdmin();
        actualizar2();
        break;
    case "delete":
        verificarAdmin();
        eliminar();
        break;
    case "listaUsuariosAdm":
        verificarAdmin();
        listaUsuariosAdm();
        break;
    case "listaUsuariosEmp":
        verificarAdmin();
        listaUsuariosEmp();
        break;
    case "cambiarEstado":
        verificarAdmin();
        cambiarEstado();
        break;
    case "cambiarClave":
        verificarUser();
        cambiarClave();
        break;
    case "crearSesion":
        crearSesion();
        break;
    case "validarSesion":
        validarSesion();
        break;    
    case "cerrarSesion":
        cerrarSesion();
        break; 
    case "menuPrincipal":
        verificarUser();
        menuPrincipal();
        break;
    case "datosUsuario":
        verificarUser();
        datosUsuario();
        break; 
    case "notificaciones":
        verificarUser();
        notificaciones();
        break; 
    case "crearNotificacion":
        verificarUser();
        crearNotificacion();
        break; 
    case "listaUsuario":
        verificarUser();
        listaUsuario();
        break; 
    default:
        die ('302:Error, no se encontro dirección');
    }
        
    /**
 * Crear un usuario
 * @param Post nombreUsuario recibe nombre del usuario que 
 * va a crear
    */
   function crear(){
   $nombre = $_POST["nombre_usuario"];
   $apellido = $_POST["apellido_usuario"];
   $username = $_POST["usuario_usuario"];
   $clave = $_POST["clave_usuario"];    
   $genero = $_POST["genero_usuario"];
   $telefono = $_POST["telefono_usuario"];
   $privilegios = json_decode($_POST['privilegios_usuario']);   
   
   $usuario = new Usuario(null,$nombre,$apellido,$username,$clave,$genero,$telefono,1,$privilegios);
   $respuesta = $usuario->createUsuario();
    if (is_object($respuesta)) {
        echo "exito";
     } else {
       echo $respuesta;
    }
   }
   /**
    * Actualizar una usuario
    * @param Post idUsuario,nombreUsuario recibe id y 
    * nombre actualizado  de la usuario que 
    * va a crear
    */
   function actualizar2(){
        $id=$_POST["id_usuario"];
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];        
        $telefono = $_POST["telefono"];
        $genero = $_POST["genero"];
        $privilegios = json_decode($_POST['privilegios']);
        
        $userNew= new Usuario($id, $nombre, $apellido, null
                ,null, $genero, $telefono ,1);
        
        $resultado=$userNew->updateUsuario();

        if ($resultado=="Exito") {
            $estado=$userNew->createPrivilegios($privilegios);
               if ($estado==1) {
                   echo "Exito";
               }
               else {
                   echo $estado;
               }
        } else {
            echo $resultado;
        }
   }

   /**
    * Cambia el estado de la usuario a activo o bloqueado
    * @param Post idUsuario
    */
   function cambiarEstado(){
   $id=$_POST["id_usuario"];
   $usuariosActualizar= new Usuario($id);
   $resultado=$usuariosActualizar->cambiarEstado();

   if ($resultado=="Exito") {
       echo "Exito";
   } else {
       echo $resultado;
   }
   }

   /**
    * Eliminar una usuario
    * @param Post idUsuario,recibe id de la
    *  usuario que va a eliminar
    */
   function eliminar(){
   $id=$_POST["id_usuario"];
   $usuario = new Usuario($id);
   $respuesta = $usuario->deleteUsuario();
   if (is_object($respuesta)) {
      echo "Exito";
   } else {
       echo $respuesta;
   }
   }

   /**
    * Lista de  usuarios Administradores
    * @Return lista de usuarios Administradores
    * formato HTML tabla
    */
   function listaUsuariosAdm(){

       $usuariosConsulta= new Usuario();
       $consulta=$usuariosConsulta->getUsuarios();  
       
       foreach ($consulta as $usuario) {
           if ($usuario['fk_estado']==1){
               $claseEstado="success";
               $iconAccion="ban";
           }
           else {
               $claseEstado="danger";
               $iconAccion="check";
           }
           
           $userPriv= new Usuario($usuario['id']);
           $userPriv=$userPriv->getUsuario();
           $userPriv=$userPriv->getPrivilegios();
           
           if ($userPriv[0]==1) {
               $userPriv =json_encode($userPriv);
               echo '<tr>
                <td>'.$usuario['id'].'</td>
                <td>'.$usuario['nombre'].'</td>
                <td>'.$usuario['apellido'].'</td>
                <td>'.$usuario['telefono'].'</td>
                <td><button type="button" class="btn btn-'.$claseEstado.' btn-xs">'.$usuario['estado'].'</button></td>
                <td>'.$usuario['usuario'].'</td>
                <td><h4> 
                    <a class="fa fa-'.$iconAccion.'" onclick="bloquearUsuario('.$usuario["id"].')"></a>    
                    <a class="fa fa-edit" onclick="modalEditarUsuario('.$usuario["id"].',\''.$usuario["nombre"].'\',\''.$usuario["apellido"].'\',\''.$usuario["usuario"].'\',\''.$usuario["genero"].'\',\''.$usuario["telefono"].'\',\''.$userPriv.'\')"></a>  
                    <a class="fa fa-remove" onclick="modalEliminarUsuario('.$usuario['id'].')"></a>
                </h4></td>
                </tr>';
               
                }          
           }    
       }
       
    /**
    * Lista de  usuarios Empleados
    * @Return lista de usuarios empleados
    * formato HTML tabla
    */
   function listaUsuariosEmp(){

       $usuariosConsulta= new Usuario();
       $consulta=$usuariosConsulta->getUsuarios();  
       
       foreach ($consulta as $usuario) {
           if ($usuario['fk_estado']==1){
               $claseEstado="success";
               $iconAccion="ban";
           }
           else {
               $claseEstado="danger";
               $iconAccion="check";
           }
           
           $userPriv= new Usuario($usuario['id']);
           $userPriv=$userPriv->getUsuario();
           $userPriv=$userPriv->getPrivilegios();
           
           if ($userPriv[0]==0) {
               $userPriv =json_encode($userPriv);
               echo '<tr>
                <td>'.$usuario['id'].'</td>
                <td>'.$usuario['nombre'].'</td>
                <td>'.$usuario['apellido'].'</td>
                <td>'.$usuario['telefono'].'</td>
                <td><button type="button" class="btn btn-'.$claseEstado.' btn-xs">'.$usuario['estado'].'</button></td>
                <td>'.$usuario['usuario'].'</td>
                <td><h4> 
                    <a class="fa fa-'.$iconAccion.'" onclick="bloquearUsuario('.$usuario["id"].')"></a>    
                    <a class="fa fa-edit" onclick="modalEditarUsuario('.$usuario["id"].',\''.$usuario["nombre"].'\',\''.$usuario["apellido"].'\',\''.$usuario["usuario"].'\',\''.$usuario["genero"].'\',\''.$usuario["telefono"].'\',\''.$userPriv.'\')"></a>  
                    <a class="fa fa-remove" onclick="modalEliminarUsuario('.$usuario['id'].')"></a>
                </h4></td>
                </tr>';
               
             }          
           }    
       }
    /**
    * Actualizar un usuario
     * solo actualiza el usuario de la sesion actual
    * @param Post idUsuario,nombreUsuario recibe id y 
    * nombre actualizado  de la usuario que 
    * va a crear
    */
   function actualizar(){
        $nombre=$_POST["nombre"];
        $apellido=$_POST["apellido"];        
        $telefono = $_POST["telefono"];
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $userNew= new Usuario($usuario->getIdUsuario(), $nombre, $apellido, $usuario->getUserName()
                ,null, $usuario->getGenero(), $telefono ,1,null);
        $resultado=$userNew->updateUsuario();

    if ($resultado=="Exito") {
        echo "Exito";
    } else {
        echo $resultado;
    }
    }
    /**
    * Crear una sesion
    * @param Post nombreUsuario recibe nombre de la usuario que 
    * va a crear
    */
    function crearSesion(){
        $usuario = $_POST["usuario"];
        $clave = $_POST["clave"];

        $usuario = new Usuario(null, null, null, $usuario,
                $clave, null,null,null,null);
        $user = $usuario->getUsuarioClave();

        if ($user!=null) {    
            $userSesion=$user->crearSesion($user);
            if ($userSesion=="Exito") {
                echo "Exito";
            }
            else {
                   echo $userSesion;
               }

        } else {
            echo "304:Error de usuario o contraseña";
        }
     }
     
     /**
     * Cerrar una sesion
     */
    function cerrarSesion(){
        $usuario = new Usuario();
        $resultado = $usuario->cerrarSesion();
        echo $resultado;
     }
     
     /**
     * Get sesion
     * Obtener la Sesion activa en el momento
     */
    function getSesion(){
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        return $usuario;
     }
     
     /**
     * Muestra el menu principal segun los privilegios del usuario
     * @return html listado de privilegios para el menu 
      * principal
     */
    function menuPrincipal(){        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $usuario=$usuario->getUsuario();
        if (is_object($usuario)) {
            if ($usuario->getPrivilegios()[0]==1) {
                $privilegios=array(1,1,1,1,1);
                $usuario->setPrivilegios($privilegios);
                echo '<div class="col-md-3 col-sm-6" align="center">
                           <h5 >Administrador</h5>
                           <a href="admin_inicio.php"><img src="images/admin.png" WIDTH=120 HEIGHT=120
                           class="img-responsive" alt="Responsive image"></a><br>
                  </div>';
            }
            if ($usuario->getPrivilegios()[1]==1) {
            echo '<div class="col-md-3 col-sm-6" align="center">
                           <h5>Cajero</h5>
                           <a href="caja.php"><img src="images/caja.png" WIDTH=120 HEIGHT=120
                           class="img-responsive" alt="Responsive image"></a><br>
                  </div>';
            }
            if ($usuario->getPrivilegios()[2]==1) {
            echo '<div class="col-md-3 col-sm-6" align="center">
                           <h5 >Mesero</h5>
                           <a href="pedido_mesas.php"><img src="images/nPedido.png" WIDTH=120 HEIGHT=120
                           class="img-responsive" alt="Responsive image"></a><br>
                  </div>';
            }
            if ($usuario->getPrivilegios()[3]==1) {
            echo '<div class="col-md-3 col-sm-6" align="center">
                           <h5 >Cocina</h5>
                           <a href="cocina.php"><img src="images/pedido.png" WIDTH=120 HEIGHT=120
                           class="img-responsive" alt="Responsive image"></a><br>
                  </div>';
            }
            if ($usuario->getPrivilegios()[4]==1) {
            echo '<div class="col-md-3 col-sm-6" align="center">
                           <h5 >Inventario</h5>
                           <a href="inventario.php"><img src="images/inventario.png" WIDTH=120 HEIGHT=120
                           class="img-responsive" alt="Responsive image"></a><br>
                  </div>';
            }            
        }
        else {
            echo '301:Error no se pudo cargar el contenido ,intente nuevamente.';
            }
     }
     
     /**
     * Muestra los datos de usuario en formato json ,incluyendo los privilegios
     * @return json listado de datos de usuario
     */
     function datosUsuario(){
        $data = array();
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $usuario=$usuario->getUsuario();
        $data['nombre'] = $usuario->getNombre();
        $data['apellido'] = $usuario->getApellido();
        $data['telefono'] = $usuario->getTelefono();
        $data['username'] = $usuario->getUserName();
        $data['estado'] = $usuario->getEstado();        
        $data['privilegios'] = $usuario->getPrivilegios();
        echo json_encode($data);
     }
          
     /**
     * Muestra las notificaciones que le han llegado a un usuario
     * @return html notificaciones de usuario
     */
     function notificaciones(){
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (is_object($usuario)) {
             $notificaciones=$usuario->notificaciones();
            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            foreach ($notificaciones as $n) {  
               $f = date_create($n['fecha']);
               $fecha= date_format($f,'d')." de ".$meses[date_format($f,'n')-1]. " del ".date_format($f,'Y'). " - ". date_format($f,'g:i a');

                //// $date = date_create($n['fecha']);
               // $fecha= date_format($date, 'd-m-Y g:i a');
               // $fecha= strftime("%A %d de %B del %Y");

                print '<li class="media event">
                        <a class="pull-left border-aero profile_thumb">
                          <i class="fa fa-user green"></i>
                        </a>
                        <div class="message_wrapper">
                          <b>'.$n['usuario'].'</b>
                          <p> <small>'.$fecha.'</small></p>
                          <h5> '.$n['mensaje'].'</h5>
                          <br />
                        </div>
                      </li>';
            }
        }
        else  {
            echo 'No se encuentran datos de usuario';
        }
       
     }
     
     function listaUsuario(){
         $usuario = new Usuario();
         $lista=$usuario->getUsuarios();
         foreach ($lista as $l) { 
            print ' <option value="'.$l['id'].'">'.$l['usuario'].'</option>';
        }
     }
     
    /**
    * Crear una notificacion
    * @param Post datos de notificacion recibe usuario destino ,
    * mensaje
    */
    function crearNotificacion(){
        $destino = $_POST["destino"];
        $mensaje = $_POST["mensaje"];

        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $estado=$usuario->crear_notificacion($destino,$mensaje);

        if ($estado=="Exito") {
            echo "Exito";
        } else {
            echo $estado;
        }
    }
    
    function cambiarClave(){
        $claveAntigua = $_POST["claveAntigua"];
        $claveNueva =$_POST["claveNueva"];
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $estado=$usuario->cambiarClave($claveAntigua,$claveNueva);
        
        if ($estado=="Exito") {
            echo "Exito";
        } else {
            echo $estado;
        }        
    }
    
    /**
    * confirma que exista la sesion de usuario y que sea administrador
    * para poder realizar cambios propios de este privilegio
    */
    function verificarAdmin(){        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (!is_object($usuario)) {
            die ('Por favor inicie sesion para continuar');
        }
        if ($usuario->getPrivilegios()[0]!=1) {
           die('no esta autorizado para realizar esta accion');
        }
    }
    
    /**
    * confirma que exista la sesion de usuario y que sea empleado
    * para poder realizar cambios propios de este privilegio
    */
    function verificarUser(){
        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (!is_object($usuario)) {
            die ('Por favor inicie sesion para continuar');
        }
    }
?>