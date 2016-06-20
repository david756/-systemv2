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
            $usuario="def", $valor="def", $horaPedido="def",$cantidad="def", $anexos="def", 
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
        $query = "select  ap.id ap_id ,ap.valor ap_valor,ap.anexos ap_anexos,ap.hora_pedido ap_hora_pedido,ap.hora_preparacion ap_hora_preparacion,ap.hora_despacho"
                . " ap_hora_despacho,ap.descuento ap_descuento,ap.fk_atencion"
                . " ap_fk_atencion,ap.fk_producto ap_fk_producto,ap.fk_estadoProd"
                . " ap_fk_estadoProd,ap.fk_cocinero ap_fk_cocinero,"
                . "ea.id ea_id,ea.fk_empleado ea_fk_empleado,ea.fk_aten_prod ea_fk_aten_prod "
                . "from aten_prod ap left join empl_atencion ea on ap.id=ea.fk_empleado where ap.id=?";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(1, $this->idAtencionProducto);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect(); 
        $resultado= New AtencionProducto($result['ap_id'], $result['ap_fk_producto'], $result['ap_fk_atencion'], $result['ea_fk_empleado']
                , $result['ap_valor'], $result['ap_hora_pedido'], null, $result['ap_anexos'], $result['ap_hora_preparacion'], $result['ap_hora_despacho']
                , $result['ap_fk_estadoProd'], $result['ap_fk_cocinero']);
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
     * @return estado de la creacion atencionProducto
     */
    function createAtencionProducto() {
        //ingresa los productos a la base de datos la cantidad de veces que se especifico
        //for: cantidad de veces que debe agregar el producto
        require_once "database.php";
        for($i=0;$i<$this->cantidad;$i++){
            try {                
                $pdo = Database::connect();
                $query = "insert into aten_prod set valor = ?,anexos = ?,hora_pedido = ?,hora_preparacion = ?,"
                        . "hora_despacho = ?,fk_atencion = ?,fk_producto = ?,fk_cocinero=?,fk_estadoProd = 1";
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

                $resultado1=$stmt->execute();
                $this->idAtencionProducto = $pdo->lastInsertId();
            
                if ($resultado1) {
                    $query = "insert into empl_atencion set fk_empleado =? ,fk_aten_prod=?";
                    $stmt = $pdo->prepare($query);
                    $stmt->bindParam(1, $this->usuario->getIdUsuario());
                    $stmt->bindParam(2, $this->idAtencionProducto);
                    $resultado2=$stmt->execute();
                }

                Database::disconnect();
                if ($resultado1) {
                    if ($resultado2) {
                            $atencionProducto=new AtencionProducto($this->idAtencionProducto, 
                            $this->producto, $this->atencion,
                            $this-> usuario,$this->valor,$this->horaPedido,
                            1, $this->anexos, 
                            $this->horaPreparacion, $this->horaDespacho,
                            $this->estado, $this->cocinero);                            
                     }
                     else{
                         //si no agrego correctamente la tabla empl_atencion , elimina la atencion creada.
                        $atencionCreada= new AtencionProducto($this->idAtencionProducto);
                        $atencionCreada->deleteAtencionProducto();
                    return "*1* Error al tratar de crear AtencionProducto:"
                     . " error Al asignar mesero a la atencion";
                     }
                }
                else {
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

     function getIdAtencionProducto() {
         return $this->idAtencionProducto;
     }

     function getProducto() {
         return $this->producto;
     }

     function getAtencion() {
         return $this->atencion;
     }

     function getUsuario() {
         return $this->usuario;
     }

     function getValor() {
         return $this->valor;
     }

     function getHoraPedido() {
         return $this->horaPedido;
     }

     function getCantidad() {
         return $this->cantidad;
     }

     function getAnexos() {
         return $this->anexos;
     }

     function getHoraPreparacion() {
         return $this->horaPreparacion;
     }

     function getHoraDespacho() {
         return $this->horaDespacho;
     }

     function getEstado() {
         return $this->estado;
     }

     function getCocinero() {
         return $this->cocinero;
     }

     function setIdAtencionProducto($idAtencionProducto) {
         $this->idAtencionProducto = $idAtencionProducto;
     }

     function setProducto($producto) {
         $this->producto = $producto;
     }

     function setAtencion($atencion) {
         $this->atencion = $atencion;
     }

     function setUsuario($usuario) {
         $this->usuario = $usuario;
     }

     function setValor($valor) {
         $this->valor = $valor;
     }

     function setHoraPedido($horaPedido) {
         $this->horaPedido = $horaPedido;
     }

     function setCantidad($cantidad) {
         $this->cantidad = $cantidad;
     }

     function setAnexos($anexos) {
         $this->anexos = $anexos;
     }

     function setHoraPreparacion($horaPreparacion) {
         $this->horaPreparacion = $horaPreparacion;
     }

     function setHoraDespacho($horaDespacho) {
         $this->horaDespacho = $horaDespacho;
     }

     function setEstado($estado) {
         $this->estado = $estado;
     }

     function setCocinero($cocinero) {
         $this->cocinero = $cocinero;
     }



    
}
