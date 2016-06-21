<?php

/**
 * Clase Atencion
 * @author David
 */
class Atencion {

    //id de la atencion
    private $idAtencion;
    //descripcion del estado de la atencion
    private $descripcionEstado;
    //descuetno de la atencion
    private $descuento;
    //cajero de la atencion
    private $cajero;
    //mesa de la atencion
    private $mesa;
    //hora del pago de la atencion
    private $horaPago;
    //estado de la atencion
    private $estado;

    /**
     * 
     * @param type $idAtencion
     * @param type $descripcionEstado
     * @param type $cajero
     * @param type $mesa
     * @param type $horaPago
     * @param type $estado
     */
    function Atencion($idAtencion = "def", $descripcionEstado = "def", $descuento = "def", $cajero = "def", $mesa = "def", $horaPago = "def", $estado = "def") {
        $this->idAtencion = $idAtencion;
        $this->descripcionEstado = $descripcionEstado;
        $this->descuento = $descuento;
        $this->cajero = $cajero;
        $this->mesa = $mesa;
        $this->horaPago = $horaPago;
        $this->estado = $estado;
    }

    /**
     * Metodo que devuelve una atencion como objeto
     * @return Atencion
     */
    function getAtencion() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from atenciones where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencion);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = New Atencion($result['id'], $result['descripcion_estado'], $result['fk_cajero'], $result['fk_mesa']
                , $result['horaPago'], $result['fk_estado']);
        return $resultado;
    }

    /**
     * Metodo devuelve un array con la lista de todas las atencions
     * @return Array <Atencion>
     */
    function getAtenciones() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from atenciones";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

    /**
     * Metodo que verifica si la atencion tiene productos
     * True: solo si hay atencions que tienen productos
     * False: solo si no hay atencions que tengan productos
     */
    function atencionConProducto() {
        require_once "database.php";
        $estado = true;
        $pdo = Database::connect();
        $query = "select * from atenciones a inner join aten_prod ap on a.id=ap.fk_atencion where a.id=" . $this->idAtencion;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la atencion , estado =false        
        if (empty($result)) {
            $estado = false;
        }
        return $estado;
    }

    /**
     * Metodo que almacena la atencion en la base de datos
     * @return id de la atencion creada
     */
    function createAtencion() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into atenciones set descripcion_estado = ?,descuento = ?,fk_estado = ?,fk_mesa = ?,"
                    . "fk_cajero = ?,horaPago = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->descripcionEstado);
            $stmt->bindParam(2, $this->descuento);
            $stmt->bindParam(3, $this->estado);
            $stmt->bindParam(4, $this->mesa->getIdMesa());
            $stmt->bindParam(5, $this->cajero->getIdUsuario());
            $stmt->bindParam(6, $this->horaPago);

            $resultado = $stmt->execute();
            $this->idAtencion = $pdo->lastInsertId();
            $atencion = new Atencion($this->idAtencion, $this->descripcionEstado, $this->descuento, $this->cajero, $this->mesa, $this->horaPago, $this->estado);
            Database::disconnect();
            if ($resultado) {
                return $atencion;
            } else {
                return "*1* Error al tratar de crear Atencion:  " . $resultado;
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Atencion:  " . $e->getMessage();
        }
    }

    /**
     * Metodo que actualiza la atencion en la base de datos
     * @return string Resultado
     */
    function updateAtencion() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "update atenciones set descripcion_estado = ?,descuento = ?,fk_estado = ?,fk_mesa = ?,"
                    . "fk_cajero = ?,horaPago = ? where id =" . $this->idAtencion;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->descripcionEstado);
            $stmt->bindParam(2, $this->descuento);
            $stmt->bindParam(3, $this->estado);
            $stmt->bindParam(4, $this->mesa->getIdMesa());
            $stmt->bindParam(5, $this->cajero->getIdUsuario());
            $stmt->bindParam(6, $this->horaPago);

            Database::disconnect();
            if ($stmt->execute()) {
                return "exito";
            } else {
                return "*1* Error al tratar de actualizar Atencion";
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de actualizar Atencion: " . $e->getMessage();
        }
    }

    /**
     * Metodo que Elimina la atencion de la base de datos
     * @return string Resultado
     */
    function deleteAtencion() {
        if (!$this->atencionConProducto()) {
            try {
                require_once "database.php";
                $pdo = Database::connect();
                $query = "delete from atenciones where id =?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->idAtencion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*1* Error al tratar de eliminar Atencion";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Atencion:  " . $e->getMessage();
            }
        } else {
            return "*3* Error al tratar de eliminar Atencion: La atencion tiene productos registrados";
        }
    }

    /**
     * Metodo get id de la atencion
     * @return idAtencion
     */
    function getIdAtencion() {
        return $this->idAtencion;
    }

    /**
     * Metodo get descripcion de la atencion
     * @return descripcionEstado
     */
    function getDescripcionEstado() {
        return $this->descripcionEstado;
    }

    /**
     * Metodo get descuento de la atencion
     * @return descuento
     */
    function getDescuento() {
        return $this->descuento;
    }

    /**
     * Metodo get cajero de la atencion
     * @return cajero
     */
    function getCajero() {
        return $this->cajero;
    }

    /**
     * Metodo get mesa de la atencion
     * @return mesa
     */
    function getMesa() {
        return $this->mesa;
    }

    /**
     * Metodo get Hora Pago de la atencion
     * @return horaPago
     */
    function getHoraPago() {
        return $this->horaPago;
    }

    /**
     * Metodo get estado de la atencion
     * @return estado
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * Metodo Set id de la atencion
     * @param type $idAtencion
     */
    function setIdAtencion($idAtencion) {
        $this->idAtencion = $idAtencion;
    }

    /**
     * Metodo Set descripcion de la atencion
     * @param type $descripcionEstado
     */
    function setDescripcionEstado($descripcionEstado) {
        $this->descripcionEstado = $descripcionEstado;
    }

    /**
     * Metodo Set descuento de la atencion
     * @param type $descuento
     */
    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }

    /**
     * Metodo Set cajero de la atencion
     * @param type $cajero
     */
    function setCajero($cajero) {
        $this->cajero = $cajero;
    }

    /**
     * Metodo Set mesa de la atencion
     * @param type $mesa
     */
    function setMesa($mesa) {
        $this->mesa = $mesa;
    }

    /**
     * Metodo Set hora de pago de la atencion
     * @param type $horaPago
     */
    function setHoraPago($horaPago) {
        $this->horaPago = $horaPago;
    }

    /**
     * Metodo Set estado de la atencion
     * @param type $estado
     */
    function setEstado($estado) {
        $this->estado = $estado;
    }

}
