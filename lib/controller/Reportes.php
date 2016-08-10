<?php
   
    /**
     * Reporte mesas ocupadas
     */
    function mesasOcupadas(){
    require_once 'Model/Mesa.php';
    $mesas = new Mesa();
    $respuesta = $mesas->totalOcupadas()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }
    
    }
    /**
     * Reporte meseros activos
     */
    function meserosActivos(){
    require_once 'Model/Usuario.php';
    $user = new Usuario();
    $respuesta = $user->meserosActivos()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }
    }
    /**
     * Reporte pedidos hoy
     */
    function pedidosHoy(){
    require_once 'Model/Atencion.php';
    $atencion = new Atencion();
    $respuesta = $atencion->pedidosHoy()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }
    }
    /**
     * Reporte ingresos hoy
     */
    function ingresosHoy(){
    require_once 'Model/Atencion.php';
    $atencion = new Atencion();
    $respuesta = $atencion->ingresosHoy()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else if ($respuesta==null) {
        echo "00";
    }
    else{
        echo "Error";
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
            die ('0');
        }
        if ($usuario->getPrivilegios()[0]!=1) {
           die('0');
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
            die ('0');
        }
    }
?>