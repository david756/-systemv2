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
        $resultado = New Atencion($result['id'], $result['descripcion_estado'],$result['descuento'], $result['fk_cajero'], $result['fk_mesa']
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
                return "Exito";
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
     * retorna la atencion actual de la mesa, si la mesa no tiene una atencion
     * en el momento, retorna la atencion vacia.
     * @return array disponibilidad de la mesa, id de la atencion
     */
    function atencionMesa(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT atenciones.fk_estado as disponibilidad,atenciones.id as"
                . " idAtencion FROM mesas inner join"
                . " atenciones on mesas.id = atenciones.fk_mesa WHERE mesas.id=? "
                . "ORDER BY atenciones.fk_estado ASC LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->mesa->getIdMesa());
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }
    
    /**
     * retorna el nombre de la mesa,el subtotal,descuento, valor total de la atencion, cajero
     * horaPago,descripcion de la atencion 
     * @return total de la atencion
     */
    function getDatosAtencion(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT m.descripcion as mesa,sum(ap.valor) as subtotal,a.fk_cajero as cajero,"
                . "(a.descuento) as dcto, (sum(ap.valor)-(a.descuento))as total ,"
                . "horaPago,horaInicio,ea.descripcion estadoAtencion FROM items AS ap INNER JOIN atenciones"
                . " AS a ON (ap.fk_atencion=a.id) INNER JOIN mesas AS m ON (m.id=a.fk_mesa)"
                . " INNER JOIN estados_atencion as ea on ea.id=a.fk_estado WHERE(a.id=?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencion);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }
    
    /**
     * retorna el nombre de la mesa,el subtotal,descuento, valor total de la atencion, cajero
     * horaPago,descripcion de la atencion 
     * @return total de la atencion
     */
    function pedidoCompleto(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select COUNT(i.fk_producto) cantidad,p.nombre,i.anexos,p.valor subtotal,"
                . "(COUNT(i.fk_producto)*p.valor) total from atenciones a INNER JOIN"
                . " items i on a.id=i.fk_atencion INNER JOIN productos p on"
                . " p.id=i.fk_producto WHERE a.id=? GROUP by i.fk_producto,i.anexos";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencion);
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();
        return $result;
    }
    
    function agregarDescuento($descuento){
        try {
                require_once "database.php";
                $pdo = Database::connect();
                $query =  "UPDATE atenciones SET descuento = ? WHERE atenciones.id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $descuento);
                $stmt->bindParam(2, $this->idAtencion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*1* Error al tratar de eliminar Atencion";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Atencion:  " . $e->getMessage();
            }
    }
    
     function pagar($detalle){
        try {
                require_once "database.php";
                $fecha= date('Y-m-d H:i:s');
                $usuario=$this->getCajero()->getIdUsuario();
                $pdo = Database::connect();
                $query =  "UPDATE atenciones SET fk_estado = 2,descripcion_estado = ?,horaPago =?,fk_cajero=? WHERE atenciones.id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $detalle);
                $stmt->bindParam(2, $fecha);
                $stmt->bindParam(3, $usuario);
                $stmt->bindParam(4, $this->idAtencion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*1* Error al tratar pagar Atencion";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar pagar Atencion:  " . $e->getMessage();
            }
    }
    function aplazar($detalle){
        try {
                require_once "database.php";
                $fecha= date('Y-m-d H:i:s');
                $usuario=$this->cajero->getIdUsuario();
                $pdo = Database::connect();
                $query =  "UPDATE atenciones SET fk_estado = 4,descripcion_estado = ?,horaPago =?,fk_cajero=? WHERE atenciones.id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $detalle);
                $stmt->bindParam(2, $fecha);
                $stmt->bindParam(3, $usuario);
                $stmt->bindParam(4, $this->idAtencion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*1* Error al tratar aplazar Atencion";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar aplazar Atencion:  " . $e->getMessage();
            }
    }
    function cortesia($detalle){
        try {   
                require_once "database.php";
                $usuario=$this->getCajero()->getIdUsuario();
                $fecha= date('Y-m-d H:i:s');
                $pdo = Database::connect();
                $query =  "UPDATE atenciones SET fk_estado = 3,descripcion_estado = ?,horaPago =?,fk_cajero=? WHERE atenciones.id = ?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $detalle);
                $stmt->bindParam(2, $fecha);
                $stmt->bindParam(3, $usuario);
                $stmt->bindParam(4, $this->idAtencion);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*1* Error al tratar agregar cortesia a Atencion";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de agregar cortesia a Atencion:  " . $e->getMessage();
            }
    }
    
    /**
     *  
     * @return resultado con los pedidos de caja de las ultimas horas
     */
    function pedidosCaja(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT m.descripcion as mesa,SUM(ap.valor)"
                . " as total,a.id,a.fk_estado as estado,ea.descripcion"
                . ",a.descuento as descuento,a.horaInicio,a.horaPago "
                . "FROM atenciones AS a INNER JOIN estados_atencion AS ea ON"
                . " (a.fk_estado=ea.id) INNER JOIN items AS ap ON (ap.fk_atencion=a.id)"
                . " INNER JOIN productos AS p ON (p.id=ap.fk_producto) INNER JOIN "
                . "categorias AS c ON (p.fk_categoria=c.id) INNER JOIN atencion_empleados AS "
                . "eat ON (eat.fk_item=ap.id) INNER JOIN usuarios AS e ON (e.id=eat.fk_usuario) "
                . "INNER JOIN mesas AS m ON (m.id=a.fk_mesa) INNER JOIN estado_items AS ep ON "
                . "(ep.id=ap.fk_estado_item) WHERE (a.horaInicio)<(DATE_SUB(NOW(), INTERVAL 0 hour))"
                . " and (a.horaInicio)>(DATE_SUB(NOW(), INTERVAL 10 hour)) "
                . "group by m.descripcion,a.id ORDER BY a.horaInicio DESC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();
        return $result;
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
