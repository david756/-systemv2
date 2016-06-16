<?php


/**
 * Clase Mesa
 *
 * @author David
 */
class Mesa {
    
    private $idMesa;
    private $nombre;
    
    function Mesa($idMesa = "def", $nombre = "def") {
        $this->idMesa = $idMesa;
        $this->nombre = $nombre;
    }
        
    function getMesa($id){
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios where idUsuario =".$id;
        $result = $pdo->query($query);
        Database::disconnect();
         return $result;
    }
    
    function getMesas() {
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from usuarios";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
  
     function getIdMesa() {
        return $this->idMesa;
    }

    function getNombre() {
        return $this->nombre;
    }

    function setIdMesa($idMesa) {
        $this->idMesa = $idMesa;
    }

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
