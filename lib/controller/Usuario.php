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
    default:
        die ('302:Error, no se encontro dirección');
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
?>