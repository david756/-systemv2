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
    * @param type $descripcion
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
    function getMesa(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from mesas where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idMesa);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect(); 
        $resultado= New Mesa($result['id'], $result['descripcion']);
        return $resultado;
    }
    /**
     * Metodo devuelve un array con la lista de todas las mesas
     * @return Array <Mesa>
     */
    function getMesas() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from mesas";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
      /**
      * Metodo que verifica si se han hecho atenciones en la mesa
       * True: solo si hay atenciones en la mesa
       * False: solo si no hay atenciones en la mesa
      */
     function mesaAtenciones(){         
        require_once "database.php";
        $estado=true;
        $pdo = Database::connect();
        $query = "select * from mesas m inner join atenciones a on m.id=a.fk_mesa where m.id=".$this->idMesa;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la mesa , estado =false        
        if (empty($result)) {
            $estado=false;
        }
        return $estado;         
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
      
       if (!$this->mesaAtenciones()) {
            try {
                 require_once "database.php";
                 $pdo = Database::connect();
                 $query = "update mesas set descripcion = ? where id =".$this->idMesa;
                 $stmt = $pdo->prepare($query);
                 $stmt->bindParam(1, $this->descripcion);
                 Database::disconnect();
                         if ($stmt->execute()){                        
                             return "exito";
                         } else {
                             return "*1* Error al tratar de actualizar Mesa";
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
        if (!$this->mesaAtenciones()) {
            try {
            require_once "database.php";          
                    $pdo = Database::connect();            
                    $query = "delete from mesas where id =?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->idMesa);
                    Database::disconnect();
                    if ($stmt->execute()){                        
                        return "exito";
                    } else {
                        return "*1* Error al tratar de eliminar Mesa";
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
    function getDescripcion() {
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
     * @param type $descripcion
     */
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

}
