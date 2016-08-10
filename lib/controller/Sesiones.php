<?php

/**
 * Validar sesiones segun los diferentes roles
 * si el usuario esta autorizado para realizar una accion
 * lo deja continuar , de lo contrario , no lo deja acceder
 * 
 * @author David
 */
require_once 'model/Usuario.php';

    function user(){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        if(is_object($usuario)){
             return true;
         }
         die('<script> window.location="login_system.php"; </script>');
    }
    function login (){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        if (is_object($usuario)) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }
    function cocina(){        
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        user();
        if (!($usuario->getPrivilegios()[3]==1 || $usuario->getPrivilegios()[0]==1)) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }
    
    function inventario(){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        user();
        if (!($usuario->getPrivilegios()[4]==1 || $usuario->getPrivilegios()[0]==1)) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }

    function mesero(){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        user();
        if (!($usuario->getPrivilegios()[2]==1 || $usuario->getPrivilegios()[0]==1)) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }
    function caja(){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        user();
        if (!($usuario->getPrivilegios()[1]==1 || $usuario->getPrivilegios()[0]==1)) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }
    function admin(){
        $usuario= new Usuario();
        $usuario=$usuario->getSesion();
        user();
        if (!$usuario->getPrivilegios()[0]==1) {
            die( '<script> window.location="menu_principal.php"; </script>');
        }
    }
   
    
    
