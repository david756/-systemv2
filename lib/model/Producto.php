<?php

/**
 * Clase Producto
 * @author David
 */
class Producto {

    //Id de producto
    private $idProducto;
    //Nombre del producto
    private $nombre;
    //Valor del producto
    private $valor;
    //descripcion del producto
    private $descripcion;
    //categoria del producto
    private $categoria;
    //estado del producto
    private $estado;
    //estado del control_stock
    private $control_stock;
    	

    /**
     * Metodo constructor de la clase Producto
     * @param type $idProducto
     * @param type $nombre
     * @param type $valor
     * @param type $descripcion
     * @param type $categoria
     * @param type $estado
     * @param type $control_stock
     */
    function Producto($idProducto = "def", $nombre = "def", $valor = "def", $descripcion = "def", $categoria = "def",$estado = "def",$control_stock = "def") {
        $this->idProducto = $idProducto;
        $this->nombre = $nombre;
        $this->valor = $valor;
        $this->descripcion = $descripcion;
        $this->categoria = $categoria;
        $this->estado = $estado;
        $this->control_stock = $control_stock;
    }

    /**
     * 
     * @param type $id
     * @return Producto
     */
    function getProducto() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from productos where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = New Producto($result['id'], $result['nombre'], $result['valor'], $result['descripcion'],
         $result['fk_categoria'],$result['fk_estado'],$result['control_stock']);
        return $resultado;
    }

    /**
     * Metodo devuelve un array con la lista de todas los productos
     * @return Array <Producto>
     */
    function getProductos() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select p.id,p.nombre,p.descripcion,p.valor,c.id as id_categoria,c.nombre as categoria,p.control_stock as stock,ep.descripcion as estado from productos p inner join estado_productos ep on p.fk_estado=ep.id INNER JOIN categorias c on c.id=p.fk_categoria order by p.id asc";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
    
    /**
     * Metodo devuelve un array con la lista de todas los productos
     * @return Array <Producto>
     */
    function getProductosInventario() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT * FROM productos WHERE control_stock=1";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

    /**
     * Metodo que verifica si se han hecho atenciones del producto
     * True: solo si hay atenciones con el producto
     * False: solo si no hay atenciones con el producto
     */
    function productoAtenciones() {
        require_once "database.php";
        $estado = true;
        $pdo = Database::connect();
        $query = "SELECT * FROM productos p inner join aten_prod ap "
                . "on p.id=ap.fk_producto where p.id=" . $this->idProducto;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones con el producto , estado =false        
        if (empty($result)) {
            $estado = false;
        }
        return $estado;
    }

    /**
     * Metodo que almacena el producto en la base de datos
     * @return id del producto creado
     */
    function createProducto() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into productos set nombre = ?,valor = ?,"
                    . "descripcion = ?,fk_categoria = ?,fk_estado = ?,control_stock = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->valor);
            $stmt->bindParam(3, $this->descripcion);
            $stmt->bindParam(4, $this->categoria->getIdCategoria());
            $stmt->bindParam(5, $this->estado);
            $stmt->bindParam(6, $this->control_stock);
            $resultado = $stmt->execute();
            $this->idProducto = $pdo->lastInsertId();
            $producto = new Producto($this->idProducto, $this->nombre, $this->valor, $this->descripcion, $this->categoria,$this->estado,$this->control_stock);
            Database::disconnect();
            if ($resultado) {
                return $producto;
            } else {
                return "*1* Error al tratar de crear Producto:  " . $resultado;
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Producto:  " . $e->getMessage();
        }
    }

    /**
     * Metodo que actualiza el producto en la base de datos
     * @return string Resultado
     */
    function updateProducto() {

        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "update productos set nombre = ?,valor = ?,"
                    . "descripcion = ?,fk_categoria = ?,fk_estado = ?,control_stock = ? where id =" . $this->idProducto;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $stmt->bindParam(2, $this->valor);
            $stmt->bindParam(3, $this->descripcion);
            $stmt->bindParam(4, $this->categoria->getIdCategoria());
            $stmt->bindParam(5, $this->estado);
            $stmt->bindParam(6, $this->control_stock);
            Database::disconnect();
            if ($stmt->execute()) {
                return "Exito";
            } else {
                return "*1* Error al tratar de actualizar Producto";
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de actualizar Producto: " . $e->getMessage();
        }
    }

    /**
     * Metodo que Elimina la producto de la base de datos
     * @return string Resultado
     */
    function deleteProducto() {
        if (!$this->productoAtenciones()) {
            try {
                require_once "database.php";
                $pdo = Database::connect();
                $query = "delete from productos where id =?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->idProducto);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*1* Error al tratar de eliminar Producto";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Producto:  " . $e->getMessage();
            }
        } else {
            return "*3* Error al tratar de eliminar Producto: "
                    . "El producto ya tiene atenciones registradas";
        }
    }
    
    /**
     * Metodo que cambia el estado de una producto en la base de datos
     * @return string Resultado
     */
    function cambiarEstado() {
        $productosActualizar= new Producto($this->idProducto);
        $resultado=$productosActualizar->getProducto();
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
                $query = "update productos set fk_estado = ? where id =" . $this->idProducto;
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $estado);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "Exito";
                } else {
                    return "*101* Error al tratar de cambiar estado a Producto";
                }
            } catch (Exception $e) {
                echo "*102* Error al tratar cambiar estado a Producto: " . $e->getMessage();
            }
        } 

    /**
     * Metodo get Id del producto
     * @return idProducto
     */
    function getIdProducto() {
        return $this->idProducto;
    }

    /**
     * metodo get del nombre del producto
     * @return nombre
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * metodo get del valor del producto
     * @return valor
     */
    function getValor() {
        return $this->valor;
    }

    /**
     * metodo get de la descripcion del producto
     * @return descripcion
     */
    function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * metodo get de la categoria del producto
     * @return categoria
     */
    function getCategoria() {
        return $this->categoria;
    }

    /**
     * metodo get del estado del producto
     * @return estado
     */
    function getEstado() {
        return $this->estado;
    }
    
    /**
     * metodo get del control_stock del producto
     * @return control_stock
     */
    function getControlStock() {
        return $this->control_stock;
    }

    /**
     * metodo set id del producto
     * @param type $idProducto
     */
    function setIdProducto($idProducto) {
        $this->idProducto = $idProducto;
    }

    /**
     * metodo set nombre del producto
     * @param type $nombre
     */
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    /**
     * metodo set valor del producto
     * @param type $valor
     */
    function setValor($valor) {
        $this->valor = $valor;
    }

    /**
     * metodo set descripcion del producto
     * @param type $descripcion
     */
    function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    /**
     * metodo set categoria del producto
     * @param type $categoria
     */
    function setCategoria($categoria) {
        $this->categoria = $categoria;
    }

    /**
     * metodo set estado del producto
     * @param type $estado
     */
    function setEstado($estado) {
        $this->estado = $estado;
    }
    /**
     * metodo set control_stock del producto
     * @param type $control_stock
     */
    function setControlStock($control_stock) {
        $this->control_stock = $control_stock;
    }

}
