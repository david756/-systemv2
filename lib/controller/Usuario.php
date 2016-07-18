<?php
/*
 * incluye el modelo mesa, con los metodos y acceso 
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
        crear();
        break;
    case "update":
        actualizar();
        break;
    case "delete":
        eliminar();
        break;
    case "listaUsuarios":
        listaUsuarios();
        break;
    case "cambiarEstado":
        cambiarEstado();
        break;
    case "cambiarClave":
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
        menuPrincipal();
        break;
    case "datosUsuario":
        datosUsuario();
        break; 
    case "notificaciones":
        notificaciones();
        break; 
    case "crearNotificacion":
        crearNotificacion();
        break; 
    case "listaUsuario":
        listaUsuario();
        break; 
    default:
        die ('302:Error, no se encontro dirección');
    }
        
    
    /**
    * Actualizar una mesa
    * @param Post idMesa,nombreMesa recibe id y 
    * nombre actualizado  de la mesa que 
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
    * @param Post nombreMesa recibe nombre de la mesa que 
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
                           <h5 >Cocinero</h5>
                           <a href="cocina.php"><img src="images/comida.png" WIDTH=120 HEIGHT=120
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
?>