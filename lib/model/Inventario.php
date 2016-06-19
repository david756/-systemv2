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
    function Inventario($idInventario, $producto, $user, $fecha, $cantidad,
            $proveedor, $costo, $descripcion, $accion) {
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
                    . "costo = ?,fk_producto = ?,fk_accion = ?,fk_empleado = ?,";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->fecha);
            $stmt->bindParam(1, $this->cantidad);
            $stmt->bindParam(1, $this->proveedor);
            $stmt->bindParam(1, $this->costo);
            $stmt->bindParam(1, $this->producto->getIdProducto());
            $stmt->bindParam(1, $this->accion->getIdAccion());
            $stmt->bindParam(1, $this->user->getIdUsuario());
            
            $resultado=$stmt->execute();
            $this->idInventario = $pdo->lastInsertId();
            $inventario=new Inventario($this->idInventario,$this->descripcion);
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
    function eliminarInventario() {  
        if (!$this->inventarioAtenciones()) {
            try {
            require_once "database.php";          
                    $pdo = Database::connect();            
                    $query = "delete from inventarios where id =?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->idInventario);
                    Database::disconnect();
                    if ($stmt->execute()){                        
                        return "exito";
                    } else {
                        return "*1* Error al tratar de eliminar Inventario";
                    } 
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Inventario:  " . $e->getMessage();
            }
        }
        else {
            return "*3* Error al tratar de eliminar Inventario: La inventario ya tiene atenciones registradas";
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



}
