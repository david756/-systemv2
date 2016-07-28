<?php

/**
 * Clase Categoria
 * @author David
 */
class Categoria {

    //id de la categoria
    private $idCategoria;
    //nombre de la categoria
    private $nombre;

    /**
     * Metodo constructor de la clase Categoria
     * @param type $idCategoria
     * @param type $nombre
     */
    function Categoria($idCategoria = "def", $nombre = "def") {
        $this->idCategoria = $idCategoria;
        $this->nombre = $nombre;
    }

    /**
     * 
     * @param type $id
     * @return Categoria
     */
    function getCategoria() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from categorias where id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idCategoria);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = New Categoria($result['id'], $result['nombre']);
        return $resultado;
    }

    /**
     * Metodo devuelve un array con la lista de todas las categorias
     * @return Array <Categoria>
     */
    function getCategorias() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from categorias";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }
    
    /**
     * Metodo devuelve un array con la lista de todas las categorias
     * y el numero de productos que tiene cada una
     * @return Array <Categoria>
     */
    function getCategoriasProductos() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select c.id,c.nombre,COUNT(p.id) as cantidad "
                . "from categorias c left JOIN productos "
                . "p on c.id=p.fk_categoria GROUP by c.id";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

    /**
     * Metodo que verifica si la categoria tiene productos
     * True: solo si hay productos que pertenecen a la categoria
     * False: solo si no hay productos en la categoria
     */
    function categoriaConProductos() {
        require_once "database.php";
        $estado = true;
        $pdo = Database::connect();
        $query = "select * from categorias c inner join productos p on c.id=p.fk_categoria "
                . "where c.id=" . $this->idCategoria;
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        Database::disconnect();
        //si no hay atenciones en la categoria , estado =false        
        if (empty($result)) {
            $estado = false;
        }
        return $estado;
    }

    /**
     * Metodo que almacena la categoria en la base de datos
     * @return id de la categoria creada
     */
    function createCategoria() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "insert into categorias set nombre = ?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            $resultado = $stmt->execute();
            $this->idCategoria = $pdo->lastInsertId();
            $categoria = new Categoria($this->idCategoria, $this->nombre);
            Database::disconnect();
            if ($resultado) {
                return $categoria;
            } else {
                return "*1* Error al tratar de crear Categoria:  " . $resultado;
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de crear Categoria:  " . $e->getMessage();
        }
    }

    /**
     * Metodo que actualiza la categoria en la base de datos
     * @return string Resultado
     */
    function updateCategoria() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "update categorias set nombre = ? where id =" . $this->idCategoria;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->nombre);
            Database::disconnect();
            if ($stmt->execute()) {
                return "Exito";
            } else {
                return "*1* Error al tratar de actualizar Categoria";
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de actualizar Categoria: " . $e->getMessage();
        }
    }

    /**
     * Metodo que Elimina la categoria de la base de datos
     * @return string Resultado
     */
    function deleteCategoria() {
        if (!$this->categoriaConProductos()) {
            try {
                require_once "database.php";
                $pdo = Database::connect();
                $query = "delete from categorias where id =?";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->idCategoria);
                Database::disconnect();
                if ($stmt->execute()) {
                    return "exito";
                } else {
                    return "*1* Error al tratar de eliminar Categoria";
                }
            } catch (Exception $e) {
                echo "*2* Error al tratar de eliminar Categoria:  " . $e->getMessage();
            }
        } else {
            return "*3* Error al tratar de eliminar Categoria: La categoria tiene productos registrados";
        }
    }

    /**
     * Metodo que obtiene el id de una categoria
     * @return String
     */
    function getIdCategoria() {
        return $this->idCategoria;
    }

    /**
     * que obtiene el nombre de una categoria
     * @return String
     */
    function getNombre() {
        return $this->nombre;
    }

    /**
     * Metdo set id de la clase categoria
     * @param type $idMesa
     */
    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    /**
     * Metodo setNombre de la clase categoria
     * @param type $nombre
     */
    function setNombre($nombre) {
        $this->nombre = $nombre;
    }

}
