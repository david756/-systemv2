<?php

/**
 * Clase AtencionProducto
 * @author David
 */
class Item {

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

    /**
     * Metodo constructor de la clase AtencionProducto
     * 
     * @param type $idAtencionProducto
     * @param type $producto
     * @param type $atencion
     * @param type $usuario
     * @param type $valor
     * @param type $horaPedido
     * @param type $cantidad
     * @param type $anexos
     * @param type $horaPreparacion
     * @param type $horaDespacho
     * @param type $estado
     * @param type $cocinero
     */
    function Item($idAtencionProducto = "def", $producto = "def", $atencion = "def", $usuario = "def", $valor = "def", $horaPedido = "def", $cantidad = "def", $anexos = "def", $horaPreparacion = "def", $horaDespacho = "def", $estado = "def", $cocinero = "def") {

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
     * Metodo que retorna la atencion Producto consultada como objeto
     * @param type $id
     * @return Item
     */
    function getAtencionProducto() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select  ap.id ap_id ,ap.valor ap_valor,ap.anexos ap_anexos,ap.hora_pedido ap_hora_pedido,"
                . "ap.hora_preparacion ap_hora_preparacion,ap.hora_despacho"
                . " ap_hora_despacho,ap.fk_atencion"
                . " ap_fk_atencion,ap.fk_producto ap_fk_producto,ap.fk_estado_item"
                . " ap_fk_estado_item,ap.fk_cocinero ap_fk_cocinero,"
                . "ea.id ea_id,ea.fk_usuario ea_fk_usuario,ea.fk_item ea_fk_item "
                . "from items ap left join atencion_empleados ea on ap.id=ea.fk_item where ap.id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencionProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = New Item($result['ap_id'], $result['ap_fk_producto'], $result['ap_fk_atencion'], $result['ea_fk_usuario']
                , $result['ap_valor'], $result['ap_hora_pedido'], 1, $result['ap_anexos'], $result['ap_hora_preparacion'], $result['ap_hora_despacho']
                , $result['ap_fk_estado_item'], $result['ap_fk_cocinero']);
        return $resultado;
    }

    /**
     * Metodo devuelve un array con la lista de todas las atencionProductos
     * @return Array <AtencionProducto>.
     * ap : items, ea : atencion_empleados
     * return ap_id , ap_valor , ap_anexos ea.fk_usuario.
     */
    function getAtencionProductos() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select  ap.id ap_id ,ap.valor ap_valor,ap.anexos ap_anexos,ap.hora_pedido ap_hora_pedido,"
                . "ap.hora_preparacion ap_hora_preparacion,ap.hora_despacho"
                . " ap_hora_despacho,ap.descuento ap_descuento,ap.fk_atencion"
                . " ap_fk_atencion,ap.fk_producto ap_fk_producto,ap.fk_estado_item"
                . " ap_fk_estado_item,ap.fk_cocinero ap_fk_cocinero,"
                . "ea.id ea_id,ea.fk_usuario ea_fk_usuario,ea.fk_item ea_fk_item "
                . "from items ap left join atencion_empleados ea on ap.id=ea.fk_item ";
        $result = $pdo->query($query);
        Database::disconnect();
        return $result;
    }

     /**
     * Metodo devuelve un array con la lista de todas los items de una atencion
     * @return Array <items>.
     */
    function itemsAtencion() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT ap.id,ap.valor,ap.anexos,ap.hora_pedido,ap.hora_preparacion, "
                . "ap.hora_despacho,ep.descripcion estado,p.nombre producto,p.valor valorActual,"
                . "ap.valor valorRegistrado,p.descripcion,e.usuario mesero,c.nombre categoria ,"
                . "cocinero.usuario cocinero FROM items AS ap INNER JOIN atenciones as a "
                . "on ap.fk_atencion=a.id INNER JOIN estados_atencion as ea on ea.id =a.fk_estado "
                . "INNER JOIN productos as p on p.id=ap.fk_producto INNER JOIN atencion_empleados as ema"
                . " ON ema.fk_item=ap.id INNER JOIN usuarios as e ON e.id=ema.fk_usuario INNER JOIN"
                . " estado_items as ep ON ep.id= ap.fk_estado_item INNER JOIN categorias as c "
                . "ON c.id = p.fk_categoria left JOIN usuarios as cocinero on ap.fk_cocinero=cocinero.id"
                . " where a.id =?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->atencion->getIdAtencion());
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();
        return $result;
    }
    
    /**
     * Metodo que retorna el id de la atencion del actual item
     * @param type $id
     * @return Item
     */
    function getAtencionItem() {
        require_once "database.php";
        $pdo = Database::connect();
        $query = "select * from items where items.id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencionProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        $resultado = $result['fk_atencion'];
        return $resultado;
    }
    /**
     * Metodo que almacena la atencionProducto en la base de datos
     * la almacena la cantidad de veces que se especifique
     * crea la tabla aten_prod y empl_atencion
     * @return estado de la creacion atencionProducto
     */
    function createAtencionProducto() {
        //ingresa los productos a la base de datos la cantidad de veces que se especifico
        //for: cantidad de veces que debe agregar el producto
        require_once "database.php";
        for ($i = 0; $i < $this->cantidad; $i++) {
            try {
                $pdo = Database::connect();
                $query = "insert into items set valor = ?,anexos = ?,hora_pedido = ?,hora_preparacion = ?,"
                        . "hora_despacho = ?,fk_atencion = ?,fk_producto = ?,fk_cocinero=?,fk_estado_item = 1";
                //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(1, $this->valor);
                $stmt->bindParam(2, $this->anexos);
                $stmt->bindParam(3, $this->horaPedido);
                $stmt->bindParam(4, $this->horaPreparacion);
                $stmt->bindParam(5, $this->horaDespacho);
                $stmt->bindParam(6, $this->atencion->getIdAtencion());
                $stmt->bindParam(7, $this->producto->getIdProducto());
                $stmt->bindParam(8, $this->cocinero->getIdUsuario());

                $resultado1 = $stmt->execute();
                $this->idAtencionProducto = $pdo->lastInsertId();

                if ($resultado1) {
                    $query = "insert into atencion_empleados set fk_usuario =? ,fk_item=?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->usuario->getIdUsuario());
                    $stmt->bindParam(2, $this->idAtencionProducto);
                    $resultado2 = $stmt->execute();
                }

                Database::disconnect();
                if ($resultado1) {
                    if ($resultado2) {
                        $atencionProducto = new Item($this->idAtencionProducto, $this->producto, $this->atencion, $this->usuario, $this->valor, $this->horaPedido, 1, $this->anexos, $this->horaPreparacion, $this->horaDespacho, $this->estado, $this->cocinero);
                    } else {
                        //si no agrego correctamente la tabla empl_atencion , elimina la atencion creada.
                        $atencionCreada = new Item($this->idAtencionProducto);
                        $atencionCreada->deleteAtencionProducto();
                        return "*1* Error al tratar de crear AtencionProducto:"
                                . " error Al asignar mesero a la atencion";
                    }
                } else {
                    return "*2* Error al tratar de crear AtencionProducto:  ";
                }
            } catch (Exception $e) {
                return "*3* Error al tratar de crear AtencionProducto:  " . $e->getMessage();
            }
        }//End:for
        return true;
    }

    /**
     * Metodo que actualiza la atencionProducto en la base de datos
     * @return string Resultado
     */
    function updateAtencionProducto() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "update items set valor = ?,anexos = ?,hora_pedido = ?,hora_preparacion = ?,"
                    . "hora_despacho = ?,fk_atencion = ?,fk_producto = ?,fk_cocinero=?,fk_estado_item = ?"
                    . " where id =" . $this->idAtencionProducto;
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->valor);
            $stmt->bindParam(2, $this->anexos);
            $stmt->bindParam(3, $this->horaPedido);
            $stmt->bindParam(4, $this->horaPreparacion);
            $stmt->bindParam(5, $this->horaDespacho);
            $stmt->bindParam(6, $this->atencion);
            $stmt->bindParam(7, $this->producto);
            $stmt->bindParam(8, $this->cocinero);
            $stmt->bindParam(9, $this->estado);
            Database::disconnect();
            if ($stmt->execute()) {
                return "Exito";
            } else {
                return "*2* Error al tratar de actualizar AtencionProducto";
            }
        } catch (Exception $e) {
            echo "*3* Error al tratar de actualizar AtencionProducto: " . $e->getMessage();
        }
    }

    /**
     * Metodo que Elimina la atencionProducto de la base de datos
     * @return string Resultado
     */
    function deleteItem() {
        try {
            require_once "database.php";
            $pdo = Database::connect();
            $query = "delete from items where id =?";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(1, $this->idAtencionProducto);
            Database::disconnect();
            if ($stmt->execute()) {
                return "Exito";
            } else {
                return "*1* Error al tratar de eliminar AtencionProducto";
            }
        } catch (Exception $e) {
            echo "*2* Error al tratar de eliminar AtencionProducto:  " . $e->getMessage();
        }
    }
    /**
     *  
     * @return resultado con los pedidos de cocina de las ultimas horas
     */
    function pedidosCocina(){
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT p.nombre,p.descripcion,ap.anexos,m.descripcion mesa,ap.hora_pedido,e.usuario mesero,ep.descripcion estado,p.id idProducto,ap.id idItem,ep.id meseroId,ap.hora_preparacion,cocinero.usuario cocinero
                              FROM atenciones AS a INNER JOIN  estados_atencion AS ea ON 
                              (a.fk_estado=ea.id)
                              INNER JOIN  items AS ap ON (ap.fk_atencion=a.id)
                              INNER JOIN  productos AS p ON (p.id=ap.fk_producto)
                              INNER JOIN  categorias AS  c ON (p.fk_categoria=c.id)
                              INNER JOIN  atencion_empleados AS eat ON (eat.fk_item=ap.id)
                              INNER JOIN  usuarios AS e ON (e.id=eat.fk_usuario)
                              INNER JOIN  mesas AS m ON (m.id=a.fk_mesa)
                              INNER JOIN  estado_items AS ep ON (ep.id=ap.fk_estado_item)
                              left JOIN  usuarios as cocinero on (cocinero.id=ap.fk_cocinero)
                              WHERE(ep.id=1 OR ep.id=2)and (ap.hora_pedido>(SELECT cc.fecha FROM cierre_caja cc order by fecha desc LIMIT 1))
                              ORDER BY ap.hora_pedido ASC";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        Database::disconnect();
        return $result;
    }
    
    function datosDespachoCocina(){
        
        require_once "database.php";
        $pdo = Database::connect();
        $query = "SELECT p.nombre producto,ap.anexos anexo,ap.hora_despacho horaDespacho,ap.hora_pedido horaPedido,u.usuario mesero,m.descripcion mesa,c.usuario cocinero FROM items AS ap INNER JOIN atenciones AS a ON (ap.fk_atencion=a.id) INNER JOIN mesas AS m ON (m.id=a.fk_mesa) INNER JOIN atencion_empleados ae on ae.fk_item=ap.id INNER JOIN usuarios u on u.id=ae.fk_usuario INNER JOIN usuarios c on c.id=ap.fk_cocinero inner JOIN productos p on p.id=ap.fk_producto WHERE(ap.id=?)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencionProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
        return $result;
    }
       
    /**
     * Metodo get idAtencionProducto de la clase Atencion Producto
     * @return idAtencionProducto
     */
    function getIdAtencionProducto() {
        return $this->idAtencionProducto;
    }

    /**
     * Metodo get producto de la clase Atencion Producto
     * @return producto
     */
    function getProducto() {
        return $this->producto;
    }

    /**
     * Metodo get atencion de la clase Atencion Producto
     * @return atencion
     */
    function getAtencion() {
        return $this->atencion;
    }

    /**
     * Metodo get usuario de la clase Atencion Producto
     * @return usuario
     */
    function getUsuario() {
        return $this->usuario;
    }

    /**
     * Metodo get valor de la clase Atencion Producto
     * @return valor
     */
    function getValor() {
        return $this->valor;
    }

    /**
     * Metodo get horaPedido de la clase Atencion Producto
     * @return horaPedido
     */
    function getHoraPedido() {
        return $this->horaPedido;
    }

    /**
     * Metodo get cantidad de la clase Atencion Producto
     * @return cantidad
     */
    function getCantidad() {
        return $this->cantidad;
    }

    /**
     * Metodo get anexos de la clase Atencion Producto
     * @return anexos
     */
    function getAnexos() {
        return $this->anexos;
    }

    /**
     * Metodo get horaPreparacion de la clase Atencion Producto
     * @return horaPreparacion
     */
    function getHoraPreparacion() {
        return $this->horaPreparacion;
    }

    /**
     * Metodo get horaDespacho de la clase Atencion Producto
     * @return horaDespacho
     */
    function getHoraDespacho() {
        return $this->horaDespacho;
    }

    /**
     * Metodo get estado de la clase Atencion Producto
     * @return estado
     */
    function getEstado() {
        return $this->estado;
    }

    /**
     * Metodo get cocinero de la clase Atencion Producto
     * @return cocinero
     */
    function getCocinero() {
        return $this->cocinero;
    }

    /**
     * Metodo set idAtencionProducto de la clase Atencion Producto
     * @param type $idAtencionProducto
     */
    function setIdAtencionProducto($idAtencionProducto) {
        $this->idAtencionProducto = $idAtencionProducto;
    }

    /**
     * Metodo set producto de la clase Atencion Producto
     * @param type $producto
     */
    function setProducto($producto) {
        $this->producto = $producto;
    }

    /**
     * Metodo set atencion de la clase Atencion Producto
     * @param type $atencion
     */
    function setAtencion($atencion) {
        $this->atencion = $atencion;
    }

    /**
     * Metodo set usuario de la clase Atencion Producto
     * @param type $usuario
     */
    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }

    /**
     * Metodo set valor de la clase Atencion Producto
     * @param type $valor
     */
    function setValor($valor) {
        $this->valor = $valor;
    }

    /**
     * Metodo set horaPedido de la clase Atencion Producto
     * @param type $horaPedido
     */
    function setHoraPedido($horaPedido) {
        $this->horaPedido = $horaPedido;
    }

    /**
     * Metodo set cantidad de la clase Atencion Producto
     * @param type $cantidad
     */
    function setCantidad($cantidad) {
        $this->cantidad = $cantidad;
    }

    /**
     * Metodo set anexos de la clase Atencion Producto
     * @param type $anexos
     */
    function setAnexos($anexos) {
        $this->anexos = $anexos;
    }

    /**
     * Metodo set horaPreparacion de la clase Atencion Producto
     * @param type $horaPreparacion
     */
    function setHoraPreparacion($horaPreparacion) {
        $this->horaPreparacion = $horaPreparacion;
    }

    /**
     * Metodo set horaDespacho de la clase Atencion Producto
     * @param type $horaDespacho
     */
    function setHoraDespacho($horaDespacho) {
        $this->horaDespacho = $horaDespacho;
    }

    /**
     * Metodo set estado de la clase Atencion Producto
     * @param type $estado
     */
    function setEstado($estado) {
        $this->estado = $estado;
    }

    /**
     * Metodo set cocinero de la clase Atencion Producto
     * @param type $cocinero
     */
    function setCocinero($cocinero) {
        $this->cocinero = $cocinero;
    }

}
