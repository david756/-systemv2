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
    //Estado de la mesa
    private $estado;

    /**
     * Metodo constructor de la clase Mesa
     * @param type $idMesa
     * @param type $descripcion
     */
    function Mesa($idMesa = "def", $descripcion = "def", $estado = "def") {
        $this->idMesa = $idMesa;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    /**
     * 
     * @param type $id
     * @return Mesa
     */
    function getMesa() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from mesas where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idMesa);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = New Mesa($result['id'], $result['descripcion'], $result['fk_estado']);
        return $resultado;
    }
    
    /**
     * Metodo que devuelve una mesa y su disponibilidad,[disponible ocupada].
     * @param type $id
     * @return Mesa
     * retorna 1 ocupada o 2 pago ,3 cortesia ,4 aplazado
     */
    function getMesaDisponiblidad() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT atenciones.fk_estado as disponibilidad FROM mesas inner join"
                . " atenciones on mesas.id = atenciones.fk_mesa WHERE mesas.id=? "
                . "ORDER BY atenciones.fk_estado ASC LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idMesa);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result['disponibilidad'];
    }

    /**
     * Metodo devuelve un array con la lista de todas las mesas
     * @return Array <Mesa>
     */
    function getMesas() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select m.id,m.descripcion,em.descripcion as estado from mesas m inner join estado_mesas em "
                . "on m.fk_estado=em.id order by m.id asc";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

    /**
     * Metodo que verifica si se han hecho atenciones en la mesa
     * True: solo si hay atenciones en la mesa
     * False: solo si no hay atenciones en la mesa
     */
    function mesaAtenciones() {
        require_once "database.php";
        $estado = true;
        $pdo = Database::connect();
        $query = "select * from mesas m inner join atenciones a on m.id=a.fk_mesa where m.id=" . $this->idMesa;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la mesa , estado =false        
        if (empty($result)) {
            $estado = false;
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
            $query = "insert into mesas set descripcion = ?,fk_estado = 1";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->descripcion);
            $resultado = $stmt->execute();
            $this->idMesa = $pdo->lastInsertId();
            $mesa = new Mesa($this->idMesa, $this->descripcion,1);
            Database::disconnect();
            if ($resultado) {
                return $mesa;
            } else {
                return "*101 Error al tratar de crear Mesa";
            }
        } catch (Exception $e) {
            echo "*102 Error al tratar de crear Mesa";
        }
    }

    /**
     * Metodo que actualiza la mesa en la base de datos
     * @return string Resultado
     */
    function updateMesa() {

            try {
                require_once "database.php";
                $pdo = Database::connect();
                //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $query = "update mesas set descripcion = ? where id =" . $this->idMesa;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->descripcion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*101* Error al tratar de actualizar Mesa";
                }
            } catch (Exception $e) {
                echo "*102* Error al tratar de actualizar Mesa: " . $e->getMessage();
            }
        } 
        
       /**
     * Metodo que cambia el estado de una mesa en la base de datos
     * @return string Resultado
     */
    function cambiarEstado() {
        $mesasActualizar= new Mesa($this->idMesa);
        $resultado=$mesasActualizar->getMesa();
        if ($resultado->getEstado()==1) {
            $estado=2;
        }
         else {
            $estado=1;
        }
            try {
                require_once "database.php";
                $pdo = Database::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $query = "update mesas set fk_estado = ? where id =" . $this->idMesa;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $estado);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*101* Error al tratar de cambiar estado a Mesa";
                }
            } catch (Exception $e) {
                echo "*102* Error al tratar cambiar estado a Mesa: " . $e->getMessage();
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
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*101* Error al tratar de eliminar Mesa";
                }
            } catch (Exception $e) {
                echo "*102* Error al tratar de eliminar Mesa:  " . $e->getMessage();
            }
        } else {
            return "*103* Error al tratar de eliminar Mesa: La mesa ya tiene atenciones registradas";
        }
    }
    
    /**
     * Metodo que cambia el estado de la mesa en la base de datos
     * @return string Resultado
     */
    function cambiarEstadoMesa($nuevoEstado) {
            try {
                require_once "database.php";
                $pdo = Database::connect();
                $query = "update mesas set fk_estado = ? where id =" . $this->idMesa;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $nuevoEstado);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*101* Error al tratar de actualizar Mesa";
                }
            } catch (Exception $e) {
                echo "*102* Error al tratar de actualizar Mesa: " . $e->getMessage();
            }
        } 
        
     /**
     * Metodo que retorn el total de mesas ocupadas en el momento
     * @return string Resultado
     */
    function totalOcupadas() {
            
                require_once "database.php";
                $pdo = Database::connect();
                $query = "SELECT COUNT(*) total FROM atenciones as a WHERE(a.fk_estado=1)";
                $stmt = $pdo->prepare($query);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                Database::disconnect();
                return  $result;
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
     * que obtiene el estado de una mesa
     * @return String
     */
    function getEstado() {
        return $this->estado;
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
    
    /**
     * Metodo setEstado de la clase Mesa
     * @param type $estado
     */
    function setEstado($estado) {
        $this->estado = $estado;
    }

}
