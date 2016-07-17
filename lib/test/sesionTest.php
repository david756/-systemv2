<?php
    include "../model/Usuario.php";
    if(!isset($_SESSION)){session_start();}
    $usuario= new Usuario();
    
    //crear sesion
    
    /**
    $usuario = new Usuario(null, null, null, "aa",
                "aa", null,null,null,null);
    $user = $usuario->getUsuarioClave();
    //solo funciona si el usuari existe, si $user != null
    $userSesion=$user->crearSesion($user);
    print $userSesion;
    **/
    
    //cerrar sesion.
    
    /**
    $resultado = $usuario->cerrarSesion();
    echo $resultado;
    **/
    
    
    //obtener sesion
    
    
    $usuario= $usuario->getSesion();
    echo $usuario->getNombre();
    
    
    //obtener sesion metodo 2
    /**
    if(isset($_SESSION['usuario'])){
        $user=$_SESSION['usuario'];
        echo $user->getNombre();
    }
    else{
        echo 'no se encontro sesion';
    }
    **/
    
    
    
    
?>
