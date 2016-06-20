<?php

/**
 * Clase AtencionProducto
 * @author David
 */
class AtencionProducto {
    //id de la atencionProducto
    private $idAtencionProducto;
    //producto del estado de la atencionProducto
    private $producto;
     //atencion de la atencionProducto
    private $atencion;
    //Empleado de la atencionProducto
    private $usuario;
    //valor de la atencionProducto
    private $valor;
    //hora del pago de la atencionProducto
    private $horaPedido;
    //cantidad de productos de la atencionProducto
    private $cantidad;
    //anexo de la atencionProducto
    private $anexos;
    //hora preparacion de la atencionProducto
    private $horaPreparacion; 
    //hora de despacho de la atencionProducto
    private $horaDespacho;
    //estado de la atencionProducto
    private $estado;
    //cocinero de la atencionProducto
    private $cocinero;
     
    function AtencionProducto($idAtencionProducto="def", $producto="def", $atencion="def",
            $usuario="def", $valor="def", $horaPedido,$cantidad="def", $anexos="def", 
            $horaPreparacion="def", $horaDespacho="def", $estado="def", $cocinero="def") {
        
        $this->idAtencionProducto = $idAtencionProducto;
        $this->producto = $producto;
        $this->atencion = $atencion;
        $this->usuario = $usuario;
        $this->valor = $valor;
        $this->horaPedido = $horaPedido;
        $this->cantidad = $cantidad;
        $this->anexos = $anexos;
        $this->horaPreparacion = $horaPreparacion;
        $this->horaDespacho = $horaDespacho;
        $this->estado = $estado;
        $this->cocinero = $cocinero;
    }

    /**
     * 
     * @param type $id
     * @return AtencionProducto
     */    
    function getAtencionProducto(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from aten_prod ap left join empl_atencion ea on ap.id=ea.fk_empleado where ap.id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencionProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect(); 
        $resultado= New AtencionProducto($result['id'], $result['fk_producto'], $result['fk_atencion'], $result['fk_empleado']
                , $result['valor'], $result['hora_pedido'], null, $result['anexos'], $result['hora_preparacon'], $result['hora_despacho']
                , $result['fk_estadoProd'], $result['fk_cocinero']);
        return $resultado;
    }
    /**
     * Metodo devuelve un array con la lista de todas las atencionProductos
     * @return Array <AtencionProducto>
     */
    function getAtencionProductos() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from aten_prod ap left join empl_atencion ea on ap.id=ea.fk_empleado";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
          
    /**
     * Metodo que almacena la atencionProducto en la base de datos
     * crea la tabla aten_prod y empl_atencion
     * @return id de la atencionProducto creada
     */
    function createAtencionProducto() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into aten_prod set descripcion_estado = ?,descuento = ?,fk_estado = ?,fk_mesa = ?,"
                    . "fk_cajero = ?,horaPago = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->descripcionEstado);
            $stmt->bindParam(2, $this->descuento);
            $stmt->bindParam(3, $this->estado);
            $stmt->bindParam(4, $this->mesa->getIdMesa());
            $stmt->bindParam(5, $this->cajero->getIdUsuario());
            $stmt->bindParam(6, $this->horaPago);    
            
            $resultado=$stmt->execute();
            $this->idAtencionProducto = $pdo->lastInsertId();
            $atencionProducto=new AtencionProducto($this->idAtencionProducto,$this->descripcionEstado,
                    $this->descuento,$this->cajero,$this->mesa,
                    $this->horaPago,$this->estado);
            Database::disconnect();
            if ($resultado) {
                return $atencionProducto;
            } else {
                return "*1* Error al tratar de crear AtencionProducto:  ".$resultado;
            }           
            
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear AtencionProducto:  " . $e->getMessage();
        }
    }
    
    /**
     * Metodo que actualiza la atencionProducto en la base de datos
     * @return string Resultado
     */
    function updateAtencionProducto() {
            try {
                 require_once "database.php";
                 $pdo = Database::connect();
                 $query = "update aten_prod set descripcion_estado = ?,descuento = ?,fk_estado = ?,fk_mesa = ?,"
                    . "fk_cajero = ?,horaPago = ? where id =".$this->idAtencionProducto;
                 $stmt = $pdo->prepare($query);
                 $stmt->bindParam(1, $this->descripcionEstado);
                 $stmt->bindParam(2, $this->descuento);
                 $stmt->bindParam(3, $this->estado);
                 $stmt->bindParam(4, $this->mesa->getIdMesa());
                 $stmt->bindParam(5, $this->cajero->getIdUsuario());
                 $stmt->bindParam(6, $this->horaPago); 
        
                 Database::disconnect();
                         if ($stmt->execute()){                        
                             return "exito";
                         } else {
                             return "*1* Error al tratar de actualizar AtencionProducto";
                         }            
             } catch (Exception $e) {
                 echo "*2* Error al tratar de actualizar AtencionProducto: " . $e->getMessage();
             }
     
    }
    /**
     * Metodo que Elimina la atencionProducto de la base de datos
     * @return string Resultado
     */
    function deleteAtencionProducto() {  
        if (!$this->atencionProductoConProducto()) {
            try {
            require_once "database.php";          
                    $pdo = Database::connect();            
                    $query = "delete from aten_prod where id =?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->idAtencionProducto);
                    Database::disconnect();
                    if ($stmt->execute()){                        
                        return "exito";
                    } else {
                        return "*1* Error al tratar de eliminar AtencionProducto";
                    } 
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar AtencionProducto:  " . $e->getMessage();
            }
        }
        else {
            return "*3* Error al tratar de eliminar AtencionProducto: La atencionProducto tiene productos registrados";
        }
    }
    /**
     * Metodo get id de la atencionProducto
     * @return idAtencionProducto
     */
    function getIdAtencionProducto() {
        return $this->idAtencionProducto;
    }
    
    /**
     * Metodo get descripcion de la atencionProducto
     * @return descripcionEstado
     */
    function getDescripcionEstado() {
        return $this->descripcionEstado;
    }
    /**
     * Metodo get descuento de la atencionProducto
     * @return descuento
     */
    function getDescuento() {
        return $this->descuento;
    }
    
    /**
     * Metodo get cajero de la atencionProducto
     * @return cajero
     */

    function getCajero() {
        return $this->cajero;
    }
    
    /**
     * Metodo get mesa de la atencionProducto
     * @return mesa
     */

    function getMesa() {
        return $this->mesa;
    }
    
    /**
     * Metodo get Hora Pago de la atencionProducto
     * @return horaPago
     */
    function getHoraPago() {
        return $this->horaPago;
    }
    
    /**
     * Metodo get estado de la atencionProducto
     * @return estado
     */
    function getEstado() {
        return $this->estado;
    }
    /**
     * Metodo Set id de la atencionProducto
     * @param type $idAtencionProducto
     */
    function setIdAtencionProducto($idAtencionProducto) {
        $this->idAtencionProducto = $idAtencionProducto;
    }
    /**
     * Metodo Set descripcion de la atencionProducto
     * @param type $descripcionEstado
     */
    function setDescripcionEstado($descripcionEstado) {
        $this->descripcionEstado = $descripcionEstado;
    }
    /**
     * Metodo Set descuento de la atencionProducto
     * @param type $descuento
     */
    function setDescuento($descuento) {
        $this->descuento = $descuento;
    }
    /**
     * Metodo Set cajero de la atencionProducto
     * @param type $cajero
     */
    function setCajero($cajero) {
        $this->cajero = $cajero;
    }
    
    /**
     * Metodo Set mesa de la atencionProducto
     * @param type $mesa
     */
    function setMesa($mesa) {
        $this->mesa = $mesa;
    }
    
    /**
     * Metodo Set hora de pago de la atencionProducto
     * @param type $horaPago
     */
    function setHoraPago($horaPago) {
        $this->horaPago = $horaPago;
    }
     
    /**
     * Metodo Set estado de la atencionProducto
     * @param type $estado
     */
    function setEstado($estado) {
        $this->estado = $estado;
    }


    
}
