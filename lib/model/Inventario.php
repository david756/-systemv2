<?php
/**
 * Clase Inventario *
 * @author David
 */
class Inventario {
    
    //Id de inventario
    private $idInventario;
    //Nombre de la inventario
    private $producto;
    //Nombre de la inventario
    private $user;
    //Nombre de la inventario
    private $fecha;
    //Nombre de la inventario
    private $cantidad;
    //Nombre de la inventario
    private $proveedor;
    //Nombre de la inventario
    private $costo;
    //Nombre de la inventario
    private $descripcion;
    //Nombre de la inventario
    private $accion;
    //fecha inicio de la consulta del inventario
    private $fechaInicio;
    //fecha final de la consulta del inventario
    private $fechaFin;
    
    
   /**
    * Metodo constructor de la clase Inventario 
     * @param type $idInventario
     * @param type $producto
     * @param type $user
     * @param type $fecha
     * @param type $cantidad
     * @param type $proveedor
     * @param type $costo
     * @param type $descripcion
     * @param type $accion
     */
    function Inventario($idInventario="def", $producto="def", $user="def", 
            $fecha="def", $cantidad="def",$proveedor="def", $costo="def", 
            $descripcion="def", $accion="def") {
       $this->idInventario = $idInventario;
       $this->producto = $producto;
       $this->user = $user;
       $this->fecha = $fecha;
       $this->cantidad = $cantidad;
       $this->proveedor = $proveedor;
       $this->costo = $costo;
       $this->descripcion = $descripcion;
       $this->accion = $accion;
   }

    /**
     * 
     * @param type $id
     * @return Inventario
     */    
    function getInventario(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from inventarios where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idInventario);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect(); 
        $resultado= New Inventario($result['id'], $result['fk_producto'], $result['fk_empleado'],
                $result['fecha'], $result['cantidad'], $result['proveedor'],
                $result['costo'], $result['descripcion'], $result['fk_accion']);
        return $resultado;
    }
    
    
    /**
     * Metodo devuelve un array con la lista de inventarios en formato
     * especifico.
     * fecha,usuario,cantidad,accion,descripcion,unidad,total,proveedor
     * @return Array <Inventario>
     **/  
    function getListaInventario(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT i.fecha as fecha,u.usuario as usuario,i.cantidad,"
                . " ai.descripcion as accion,i.descripcion as descripcion,i.costo as unidad,"
                . "(i.cantidad*i.costo) as total,i.proveedor as proveedor FROM inventarios i "
                . "LEFT JOIN usuarios u ON i.fk_empleado=u.id LEFT JOIN accion_inventarios ai "
                . "on i.fk_accion=ai.id WHERE i.fk_producto=? "
                . "and i.fecha BETWEEN ? AND ? order by fecha desc";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->producto);
        $stmt->bindParam(2, $this->getFechaInicio());
        $stmt->bindParam(3, $this->getFechaFin());
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();         
        return $result;
    }
    
    /**
     * Metodo devuelve la lista de items vendidos en formato
     * especifico.
     * fecha,usuario,descripcion,unidad,total
     * @return Array <Inventario>
     **/  
    function getListaItemsVendidos(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT i.hora_pedido as fecha,u.usuario as usuario,a.descripcion_estado,"
                . "i.valor,(i.valor) as total FROM items i left JOIN atenciones a"
                . " on i.fk_atencion=a.id left JOIN atencion_empleados ae "
                . "on i.id=ae.fk_item LEFT JOIN usuarios u on ae.fk_usuario=u.id "
                . "WHERE i.fk_producto=? and a.fk_estado <>1 "
                . "and a.horaPago BETWEEN ? AND ?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->producto);
        $stmt->bindParam(2, $this->getFechaInicio());
        $stmt->bindParam(3, $this->getFechaFin());
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();         
        return $result;
    }
    
    /**
     * Metodo devuelve un array con la lista de todas las inventarios
     * @return Array <Inventario>
     */
    function getInventarios() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from inventarios";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
    
    /**
     * Metodo que almacena la inventario en la base de datos
     * @return id de la inventario creada
     */
    function agregarInventario() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into inventarios set fecha = ?,cantidad = ?,proveedor = ?,"
                    . "costo = ?,descripcion= ?,fk_producto = ?,fk_accion = 1,fk_empleado = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->fecha);
            $stmt->bindParam(2, $this->cantidad);
            $stmt->bindParam(3, $this->proveedor);
            $stmt->bindParam(4, $this->costo);
            $stmt->bindParam(5, $this->descripcion);
            $stmt->bindParam(6, $this->producto->getIdProducto());
            $stmt->bindParam(7, $this->user->getIdUsuario());
            
            $resultado=$stmt->execute();
            $this->idInventario = $pdo->lastInsertId();
            $inventario=new Inventario($this->idInventario,
                    $this->producto->getIdProducto(),$this->user->getIdUsuario(),
                    $this->fecha,$this->cantidad,$this->proveedor,$this->costo,$this->descripcion,$this->accion);
            Database::disconnect();
            if ($resultado) {
                return $inventario;
            } else {
                return "*1* Error al tratar de crear Inventario:  ".$resultado;
            }           
            
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Inventario:  " . $e->getMessage();
        }
    }
    
    /**
     * Metodo que Elimina la inventario de la base de datos
     * @return string Resultado
     */
    function bajarInventario() {  
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into inventarios set fecha = ?,cantidad = ?,"
                    . "descripcion = ?,fk_producto = ?,fk_accion=2,fk_empleado = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->fecha);
            $stmt->bindParam(2, $this->cantidad);
            $stmt->bindParam(3, $this->descripcion);
            $stmt->bindParam(4, $this->producto->getIdProducto());
            $stmt->bindParam(5, $this->user->getIdUsuario());
            
            $resultado=$stmt->execute();
            $this->idInventario = $pdo->lastInsertId();
            $inventario=new Inventario($this->idInventario,
                    $this->producto->getIdProducto(),$this->user->getIdUsuario(),
                    $this->fecha,$this->cantidad,null,null,$this->descripcion,$this->accion);
            Database::disconnect();
            if ($resultado) {
                return $inventario;
            } else {
                return "*1* Error al tratar de eliminar Inventario:  ".$resultado;
            }           
            
        } catch (Exception $e) {
            echo "*2* Error al tratar de eliminar Inventario:  " . $e->getMessage();
        }
    }
    /**
     * Retorna las unidades disponibles de este producto
     * en el inventario
     * @return type resultado
     */
    function getDisponibles(){
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "SELECT p.nombre as producto, sum(i.cantidad) as cantidad_ingresados "
                    . ", (SELECT sum(i2.cantidad) as cantidad_eliminados"
                    . " from inventarios as i2 WHERE i2.fk_accion=2 and i2.fk_producto=i.fk_producto"
                    . " GROUP BY i2.fk_producto) as cantidad_eliminados from inventarios as i "
                    . "inner join productos as p on p.id=i.fk_producto WHERE i.fk_accion=1 "
                    . "and i.fk_producto=? GROUP BY i.fk_producto ";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->producto->getIdProducto());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            $cantidad_ingresados=$result['cantidad_ingresados'];
            $cantidad_eliminados=$result['cantidad_eliminados']; 
            $data = array();
            $data['cantidad_ingresados'] =$cantidad_ingresados;
            $data['cantidad_eliminados'] = $cantidad_eliminados;
            return $data;
        } catch (Exception $e) {
            return "*1* error al obtener unidades disponibles de inventario ";
        }
    }
    /**
     * Retorna las unidades vendidas de este producto
     * @return type resultado
     */
    function getCantidadVendidos(){
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "SELECT count(ap.fk_producto) as cantidad_Vendidos from items as ap "
                    . "inner join atenciones as a on ap.fk_atencion=a.id WHERE"
                    . " a.fk_estado<>1 and ap.fk_producto=? GROUP BY ap.fk_producto";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->producto->getIdProducto());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            $cantidad_vendidos=$result['cantidad_Vendidos'];
            return $cantidad_vendidos;
        } catch (Exception $e) {
            return "*1* error al obtener unidades disponibles de inventario ";
        }
    }
    /**
     * retorna el valor promedio de venta de  determinado producto
     * en el inventario
     * @return type resultado
     */
    function getValorPromedio(){
         try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "SELECT AVG (items.valor) as promedio from items INNER JOIN "
                    . "atenciones on items.fk_atencion=atenciones.id"
                    . " WHERE fk_producto=? and atenciones.fk_estado<>1";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->producto->getIdProducto());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            $promedio=0+$result['promedio'];
            return $promedio;
        } catch (Exception $e) {
            return "*1* error al obtener unidades disponibles de inventario ";
        }
    }
    /**
     * retorna el costo promedio de compra de determinado producto
     * en el inventario
     * @return type resultado
     */
    function getCostoPromedio(){
         try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "SELECT AVG(costo) as promedio FROM inventarios"
                    . " WHERE fk_accion = 1 and fk_producto=?";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->producto->getIdProducto());
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            Database::disconnect();
            $promedio=0+$result['promedio'];
            return $promedio;
        } catch (Exception $e) {
            return "*1* error al obtener promedio de costo de inventario ";
        }
    }
    
    /**
     * Metodo que obtiene el id de una inventario
     * @return idInventario
     */
    function getIdInventario() {
        return $this->idInventario;
    }
     /**
     * Metodo que obtiene el producto del inventario
     * @return producto
     */
    function getProducto() {
        return $this->producto;
    }
     /**
     * Metodo que obtiene el usuario del inventario
     * @return usuario
     */   
    function getUser() {
        return $this->user;
    }
     /**
     * Metodo que obtiene la fecha del inventario
     * @return fecha
     */
    function getFecha() {
        return $this->fecha;
    }
     /**
     * Metodo que obtiene la cantidad del inventario
     * @return cantidad
     */
    function getCantidad() {
        return $this->cantidad;
    }
     /**
     * Metodo que obtiene el proveedor del inventario
     * @return proveedor
     */
    function getProveedor() {
        return $this->proveedor;
    }
     /**
     * Metodo que obtiene el costo del inventario
     * @return costo
     */
    function getCosto() {
        return $this->costo;
    }
     /**
     * Metodo que obtiene la descripcion del inventario
     * @return descripcion
     */
    function getDescripcion() {
        return $this->descripcion;
    }
     /**
     * Metodo que obtiene la accion del inventario
     * @return accion
     */
    function getAccion() {
        return $this->accion;
    }
    /**
     * Metodo IdInventario de la clase Inventario
     * @param type $idInventario
     */
    function setIdInventario($idInventario) {
        $this->idInventario = $idInventario;
    }
    
    /**
     * Metodo setProducto de la clase Inventario
     * @param type $producto
     */
    function setProducto($producto) {
        $this->producto = $producto;
    }

    /**
     * Metodo setUsuario de la clase Inventario
     * @param type $user
     */
    function setUser($user) {
        $this->user = $user;
    }
    /**
     * Metodo setFecha de la clase Inventario
     * @param type $fecha
     */
    function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    /**
     * Metodo setCantidad de la clase Inventario
     * @param type $cantidad
     */
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }
    /**
     * Metodo setProveedor de la clase Inventario
     * @param type $proveedor
     */
    function setProveedor($proveedor) {
        $this->proveedor = $proveedor;
    }
    /**
     * Metodo setCosto de la clase Inventario
     * @param type $costo
     */
    function setCosto($costo) {
        $this->costo = $costo;
    }
    /**
     * Metodo setDescripcion de la clase Inventario
     * @param type $descripcion
     */
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }
    /**
     * Metodo setAccion de la clase Inventario
     * @param type $accion
     */
    function setAccion($accion) {
        $this->accion = $accion;
    }
    /**
     * Metodo que obtiene fecha de inicio
     * @return fechaInicio
     */
    function getFechaInicio() {
        return $this->fechaInicio;
    }
    /**
     * Metodo que obtiene la fecha final
     * @return fechaFinal
     */
    function getFechaFin() {
        return $this->fechaFin;
    }
    /**
     * Metodo setFechaInicio de la clase Inventario
     * @param Date $FechaInicio
     */
    function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }
    /**
     * Metodo setFechaFin de la clase Inventario
     * @param Date $FechaFIn
     */
    function setFechaFin($fechaFin) {
        $this->fechaFin = $fechaFin;
    }

}
