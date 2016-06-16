<?php
/**
 * Clase Mesa *
 * @author David
 */
class Mesa {
    
    //Id de mesa
    private $idMesa;
    //Nombre de la mesa
    private $descripcion;
    
   /**
    * Metodo constructor de la clase Mesa
    * @param type $idMesa
    * @param type $nombre
    */
    function Mesa($idMesa = "def", $descripcion = "def") {
        $this->idMesa = $idMesa;
        $this->descripcion = $descripcion;
    }
    /**
     * 
     * @param type $id
     * @return Mesa
     */    
    function getMesa($id){
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from mesas where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();               
        return $result;
    }
    /**
     * Metodo devuelve un array con la lista de todas las mesas
     * @return Array <Mesa>
     */
    function getMesas() {
        include "database.php";
        $pdo = Database::connect();
        $query = "select * from mesas";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
    
    /**
     * Metodo que almacena la mesa en la base de datos
     * @return id de la mesa creada
     */
    function createMesa() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into mesas set descripcion = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->descripcion);
            $resultado=$stmt->execute();
            $id = $pdo->lastInsertId();
            Database::disconnect();
            if ($resultado) {
                return $id;
            } else {
                return "*1* Error al tratar de crear Mesa:  ".$resultado;
            }           
            
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Mesa:  " . $e->getMessage();
        }
    }
    
    /**
     * Metodo que actualiza la mesa en la base de datos
     * @return string Resultado
     */
    function updateMesa() {
       if (!mesaAtenciones()) {
            try {
                 include "database.php";
                 $pdo = Database::connect();

                 $query = "update mesas set nombre = ? where id =".$this->idMesa;
                 $stmt = $pdo->prepare($query);
                 $stmt->bindParam(1, $this->descripcion);
                 $resultado=$stmt->execute();
                 Database::disconnect();
                         if ($resultado) {                        
                             return "exito";
                         } else {
                             return "*1* Error al tratar de actualizar Mesa:  ".$resultado;
                         }            
             } catch (Exception $e) {
                 echo "*2* Error al tratar de actualizar Mesa: " . $e->getMessage();
             }
       }
        else {
            return "*3* Error al tratar de eliminar Mesa: La mesa ya tiene atenciones registradas";
        }
    }
    /**
     * Metodo que Elimina la mesa de la base de datos
     * @return string Resultado
     */
    function deleteMesa() {  
        if (!mesaAtenciones()) {
            try {
            include "database.php";
          
            $pdo = Database::connect();
            
                    $query = "delete from mesas where id =?where id =".$this->idMesa;
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->idMesa);
                    $resultado=$stmt->execute();
                    Database::disconnect();
                    if ($resultado) {                        
                        return "exito";
                    } else {
                        return "*1* Error al tratar de eliminar Mesa:  ".$resultado;
                    } 
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Mesa:  " . $e->getMessage();
            }
        }
        else {
            return "*3* Error al tratar de eliminar Mesa: La mesa ya tiene atenciones registradas";
        }
    }
     /**
      * Metodo que verifica si se han hecho atenciones en la mesa
      */
     function mesaAtenciones(){         
        include "database.php";
        $estado=true;
        $pdo = Database::connect();
        $query = "select * from mesas m inner join atenciones a on m.id=a.fk_mesa where m.id=".$this->idMesa;
        $result = $pdo->query($query);
        Database::disconnect();
        //si no hay atenciones en la mesa , estado =false
        if (empty($result)) {
            $estado=false;
        }
        return $estado;         
     }
        
    /**
     * Metodo que obtiene el id de una mesa
     * @return String
     */
     function getIdMesa() {
        return $this->idMesa;
    }
    /**
     * que obtiene el nombre de una mesa
     * @return String
     */
    function getNombre() {
        return $this->descripcion;
    }
    /**
     * Metdo set id de la clase Mesa
     * @param type $idMesa
     */
    function setIdMesa($idMesa) {
        $this->idMesa = $idMesa;
    }
    /**
     * Metodo setNombre de la clase Mesa
     * @param type $nombre
     */
    function setNombre($nombre) {
        $this->descripcion = $nombre;
    }

}
