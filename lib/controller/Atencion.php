<?php
/*
 * incluye el modelo categoria, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Atencion.php";
include "../model/Categoria.php";
include "../model/Mesa.php";
include "../model/Usuario.php";
include "../model/Producto.php";
include "../model/Item.php";
/**
 * recibe por POST el metodo segun
 * el proceso que valla a realizar
 */
if (isset($_POST["metodo"])) {
    $metodo=$_POST["metodo"];
}
//si no recibe metodo
 else {
    die ('301:Error, no existe dirección');
}

/**
 * Direcciona al metodo que se recibe
 */
switch ($metodo) {
    case "create":
        verificarUser();
        crear();
        break;
    case "update":
        verificarAdmin();
        actualizar();
        break;
    case "listaCategorias":
        verificarUser();
        listaCategorias();
        break;
    case "listaProductos":
        verificarUser();
        listaProductos();
        break;
    
    case "datosAtencion":
        verificarUser();
        datosAtencion();
        break;
    
    case "datosAtencion2":
        verificarUser();
        datosAtencion2();
        break;
    
    case "pedidoCompleto":
        verificarUser();
        pedidoCompleto();
        break;
    
    case "pedidoCompleto2":
        verificarUser();
        pedidoCompleto2();
        break;
    
    case "descuento":
        verificarUser();
        agregarDescuento();
        break;
    case "pagar":
        verificarUser();
        pagar();
        break;
    case "aplazar":
        verificarUser();
        aplazar();
        break;
    case "pedidosCaja":
        verificarUser();
        pedidosCaja();
        break;
    case "pedidosCocina":
        verificarUser();
        pedidosCocina();
        break;
    case "atencionesAbiertas":
        verificarUser();
        atencionesAbiertas();
        break;  
    case "cierreCaja":
        verificarUser();
        cierreCaja();
        break; 
    case "pedidosAlCierre":
        verificarUser();
        atencionesAlCierre();
        break; 
    case "cortesia":
        verificarUser();
        cortesia();
        break;
    case "meseroAutorizado":
        verificarUser();
        meseroAutorizado();
        break;
    
    
        
    default:
        die ('302:Error, no se encontro dirección');
}
   
    /**
     * Crear una atencion
     * @param Post atencion e items de la atencion que va a ser creada
     */
    function crear(){
        $pedido=$_POST["jsonPedido"];
        $mesa = new Mesa($pedido['mesa']);
        $mesa=$mesa->getMesa();
        if ($mesa->getEstado()!=1) {
            die ('301:Error, no puede hacer pedidos en esta mesa');
        }
        $atencion= new Atencion();
        $atencion->setMesa($mesa);
        $idAtencion=$atencion->atencionMesa()['idAtencion'];
        $atencion->setIdAtencion($idAtencion);
        $atencion=$atencion->getAtencion();
        $cajero=new Usuario(null);
        if ($idAtencion=="" || $atencion->getEstado()!=1) {  
            $a = new Atencion(null,"pedido",0,$cajero,$mesa,null,1); 
            $atencion=$a->createAtencion();
        }
        if (is_object($atencion)) {
            $items=$pedido['pedido'];
            foreach ($items as $p) {
                $producto=new Producto($p['id']);
                $producto=$producto->getProducto();                
                $valor=$producto->getValor();
                $fecha= date('Y-m-d H:i:s');
                $anexo=$p['anexo'];
                
                for ($index = 0; $index < $p['cantidad']; $index++) {
                    //creando un nuevo atencionProducto
                    $usuario = new Usuario();
                    $usuario= $usuario->getSesion();
                    $cocinero=new $usuario(null);
                    $atencionProducto = new Item(null,$producto,$atencion,$usuario,$valor,$fecha,1,
                    $anexo,null,null,1,$cocinero);
                    $atencionProducto->createAtencionProducto();
                    if (!is_object($atencionProducto)) {
                        die ('302:Error fatal al tratar de agregar item: '.$atencionProducto);
                    }                    
                }              
            }
        }
        else{
            die ('303:Error al tratar de crear atencion: '.$atencion);
        }
      echo "Exito";
    }
    /**
    * Actualizar una atencion
    * @param Post idAtencion,mesa,estado,descuento
    */
   function actualizar(){
        $id=$_POST["id_atencion"];
        $mesa=$_POST["mesa"];
        $estado=$_POST["estado"];
        $descuento=$_POST["descuento"];
        $mesa= new Mesa($mesa);        
        $atencion=new Atencion($id);
        $atencion=$atencion->getAtencion();
        if ($atencion->getEstado()==2||$atencion->getEstado()==3) {
            die("Error: el pedido ya fue tarifado,no se puede editar");
        }
        if ($estado!=1 && $estado!=4 ) {
            die("Error: no esta autorizado para realizar esta accion");
        }
        $cajero=$atencion->getCajero();
        if ($cajero==null) {
            $cajero=new Usuario(null);
        }
        $atencionActualizar= new Atencion($id,$atencion->getDescripcionEstado(),$descuento,
                $cajero,$mesa,$atencion->getHoraPago(),$estado);
        $resultado=$atencionActualizar->updateAtencion();
        if ($resultado=="Exito") {
            echo "Exito";
        } else {
            echo $resultado;
        }
   }
    /**
     * Lista de  categorias
     * @Return lista de categorias
     * formato HTML tabla
     */
    function listaCategorias(){    
    $categoriasConsulta= new Categoria();
    $consulta=$categoriasConsulta->getCategoriasProductos();  
    
    foreach ($consulta as $categoria) {
        $cantidad=$categoria["cantidad"];
        $span="";
        if ($cantidad>1) {
            $span='<span class="badge bg-orange">'.$categoria["cantidad"].'</span>';
        }
        echo '<a onclick="verProductos('.$categoria["id"].')" id="'.$categoria["id"].'" class="btn btn-app">
                '.$span.'
                <i class="fa fa-inbox"></i> '.$categoria["nombre"].'
              </a>';
        }    
    }
    /**
     * retorna el pedido completo de la atencion
     * recibe por parametro post el id de la mesa
     * @Return pedido completo
     * cantidad producto anexo total
     * formato HTML tabla
     */
    function pedidoCompleto(){   
    $idMesa=$_POST["mesa"];
    $mesa=new Mesa($idMesa);
    $atencion= new Atencion();
    $atencion->setMesa($mesa);
    $idAtencion=$atencion->atencionMesa()['idAtencion'];    
    $atencion->setIdAtencion($idAtencion);
    
    $atencion=$atencion->getAtencion();
    if ($atencion->getEstado()==1) {
       $consulta=$atencion->pedidoCompleto() ;
        foreach ($consulta as $pedido) {        
        echo '<tr>
                <th scope="row">'.$pedido['cantidad'].'</th>
                <td>'.$pedido['nombre'].'</td>
                <td>'.$pedido['anexos'].'</td>
                <td>'.$pedido['subtotal'].'</td>
                <td>'.$pedido['total'].'</td>
              </tr>';
        }   
    }
     
    }
    /**
     * retorna el pedido completo de la atencion
     * recibe por parametro post el id de la atencion
     * @Return pedido completo
     * cantidad producto anexo total
     * formato HTML tabla
     */
    function pedidoCompleto2(){   
    $idAtencion=$_POST["atencion"];    
    $atencion= new Atencion($idAtencion);    
    $atencion=$atencion->getAtencion();
       $consulta=$atencion->pedidoCompleto() ;
        foreach ($consulta as $pedido) {        
        echo '<tr>
                <th scope="row">'.$pedido['cantidad'].'</th>
                <td>'.$pedido['nombre'].'</td>
                <td>'.$pedido['anexos'].'</td>
                <td>'.$pedido['subtotal'].'</td>
                <td>'.$pedido['total'].'</td>
              </tr>';
        }   
    }
    /**
     * Lista de productos
     * @Return lista de productos0
     * formato HTML tabla
     */
    function listaProductos(){
    
    $productosConsulta= new Producto();
    $consulta=$productosConsulta->getProductos();  
    
    foreach ($consulta as $producto) {
        if ($producto["estado"]=="activo") {           
        
        $total= $producto["valor"];
        $valor= $producto["valor"];
        $valor=number_format($valor, 0, ",", ".");
        echo '<!-- producto-->
                <div class="categoria" style="display:none" name="'.$producto["id_categoria"].'">
                    <div  class="well prod" align="center" >
                    <div onclick="agregarFila(['.$producto["id"].',1,\''.$producto["nombre"].'\','.$producto["valor"].','.$total.',\'\'])" style="cursor: pointer">
                     <h5>
                     <span class="badge badge-success">$ '.$valor.'</span>
                     <span style="display:none" class="badge bg-red check'.$producto["id"].'"><i class="fa fa-check"></i></span>
                     </h5>
                     <h4>'.$producto["nombre"].'</h4> 
                    </div>
                    <button onclick="modalDetalleProducto(\''.$producto["nombre"].'\',\''.$producto["descripcion"].'\')" type="button" class="btn btn-round btn-success btn-xs"><i class="fa fa-plus"></i></button>
                    <button onclick="modalAnexo('.$producto["id"].',\''.$producto["nombre"].'\','.$producto["valor"].')" type="button" class="btn btn-round btn-info"><i class="fa fa-comment"></i></button>
                  </div>
                </div>
             <!-- End producto-->';
        }
       }
    }
    /**
     * recibe por parametro post el id de la mesa
     * DatosAtencion, obtiene los datos de la atencion actual en la mesa 
     * especificada
     * @Return datos de la atencion 
     * formato Json
     */
    function datosAtencion(){
    $idMesa=$_POST["mesa"];
    $mesa=new Mesa($idMesa);
    $mesa=$mesa->getMesa();
    $atencion= new Atencion();
    $atencion->setMesa($mesa);
    $id=$atencion->atencionMesa()['idAtencion'];
    $atencion->setIdAtencion($id);
    $atencion=$atencion->getAtencion();
    $total=$atencion->getDatosAtencion()['total'];
    if ($total=="") {
        $total=0;
    }
    
    if ($atencion->getEstado()==1) {
        $estado="Ocupada";
        $url='detalle_pedido.php?atencion='.$atencion->getIdAtencion();
    }else {
        $estado="Disponible";
        $url='#';
        $total=0;
    }
    
    
    $data = array();
        $data['mesa'] = $mesa->getDescripcion();
        $data['totalPedido'] = $total ;
        $data['estadoMesa'] = $estado;
        $data['urlDetalle'] = $url;
        
        echo json_encode($data);
  
    }
    
    /**
     * recibe por parametro post el id de la atencion
     * DatosAtencion, obtiene los datos de la atencion actual en la mesa 
     * especificada
     * @Return datos de la atencion 
     * formato Json
     */
    function datosAtencion2(){
    $id=$_POST["atencion"];
    $atencion= new Atencion($id);
    $atencion=$atencion->getAtencion();
    $total=$atencion->getDatosAtencion()['total'];
    $subtotal=$atencion->getDatosAtencion()['subtotal'];
    $descuento=$atencion->getDatosAtencion()['dcto'];
    if ($total=="") {
        $total=0;
    }       
    $nombreMesa=$atencion->getDatosAtencion()['mesa'];
    $horaInicio=$atencion->getDatosAtencion()['horaInicio'];
    $cajero=new Usuario($atencion->getDatosAtencion()['cajero']);
    $cajero=$cajero->getUsuario();
    $cajero=$cajero->getUserName();
    $idMesa=$atencion->getMesa();
    $impuesto=$total*(8/100);
    $horaPago=$atencion->getDatosAtencion()['horaPago'];
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $tiempo="no disponible";
    if ($horaPago!=null) {
        $tiempo=date("H:i:s", strtotime("00:00:00") + strtotime($horaPago) - strtotime($horaInicio) );
        $horaPago = date_create($horaPago);
        $horaPago= date_format($horaPago,'d')." ".$meses[date_format($horaPago,'n')-1]. 
            " ".date_format($horaPago,'Y'). " , ". date_format($horaPago,'g:i a');
    }
    else{
        $horaPago="Aun no se ha tarifado";
    }    
    $estado=$atencion->getDatosAtencion()['estadoAtencion'];
    $horaInicio = date_create($horaInicio);
    $horaInicio= date_format($horaInicio,'d')." ".$meses[date_format($horaInicio,'n')-1]. 
            " ".date_format($horaInicio,'Y'). " , ". date_format($horaInicio,'g:i a');
    
    
    
    $data = array();
        $data['mesa'] = $nombreMesa;
        $data['subtotal'] = $subtotal;
        $data['totalPedido'] = $total ;
        $data['estadoAtencion'] = $estado;
        $data['descuento'] = $descuento;
        $data['cajero'] = $cajero;
        $data['horaPago'] = $horaPago;
        $data['idAtencion'] = $id;
        $data['idMesa'] = $idMesa;
        $data['horaInicio'] = $horaInicio;
        $data['impuesto'] = $impuesto;
        $data['tiempoTotal']=$tiempo;
        
        
        echo json_encode($data);
  
    }
    
    /**
     * agrega descuento a una atencion cuando esta aplazada o 
     * en estado pedido.
     */
    function agregarDescuento(){
        $id=$_POST["idAtencion"];
        $descuento=$_POST["descuento"];
        $atencion= new Atencion($id);
        $atencion=$atencion->getAtencion();
        if ($atencion->getEstado()!=1 && $atencion->getEstado()!=4) {
            die('Error : El pedido ya fue facturado') ;
        }
        if (!is_numeric($descuento)) {
            die('Error : Descuento no valido') ;
        }
        $estado= $atencion->agregarDescuento($descuento);
        echo $estado;
    }
    
    /**
     * pagar una atencion.
     */
    function pagar(){
        $id=$_POST["idAtencion"];
        $detalle=$_POST["detalle"];
        $cajero = new Usuario();
        $cajero= $cajero->getSesion();
        $atencion= new Atencion($id);
        $atencion=$atencion->getAtencion();
        $atencion->setCajero($cajero);
        if ($atencion->getEstado()!=1 && $atencion->getEstado()!=4) {
            die('Error : El pedido ya fue facturado') ;
        }
        $estado= $atencion->pagar($detalle);
        echo $estado;
    }
     /**
     * pagar una atencion.
     */
    function aplazar(){
        $id=$_POST["idAtencion"];
        $detalle=$_POST["detalle"];
        $cajero = new Usuario();
        $cajero= $cajero->getSesion();
        $atencion= new Atencion($id);
        $atencion=$atencion->getAtencion();
        $atencion->setCajero($cajero);
        if ($atencion->getEstado()!=1 && $atencion->getEstado()!=4) {
            die('Error : El pedido ya fue facturado') ;
        }
        $estado= $atencion->aplazar($detalle);
        echo $estado;
    }
     /**
     * pagar una atencion.
     */
    function cortesia(){
        $id=$_POST["idAtencion"];
        $detalle=$_POST["detalle"];
        $cajero = new Usuario();
        $cajero= $cajero->getSesion();
        $atencion= new Atencion($id);
        $atencion=$atencion->getAtencion();
        $atencion->setCajero($cajero);
        if ($atencion->getEstado()!=1 && $atencion->getEstado()!=4) {
            die('Error : El pedido ya fue facturado') ;
        }
        $estado= $atencion->cortesia($detalle);
        echo $estado;
    }   
    
    
    /**
     * Metodo lista de pedidos para mostrar en el modulo de caja
     * @return Html tabla para mostrar los pedidos en modulo de caja
     */
    function pedidosCaja(){
        
    $atencion=new Atencion();
    $consulta=$atencion->pedidosCaja();
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $subtotal= $a["total"];
        $descuento= $a["descuento"];
        $total= $subtotal-$descuento;
        $horaInicio=$a["horaInicio"];
        $horaInicio = date_create($horaInicio);
        $horaInicio= date_format($horaInicio,'d')." ".$meses[date_format($horaInicio,'n')-1]. 
            " ".date_format($horaInicio,'Y'). " , ". date_format($horaInicio,'g:i a');
        $horaPago=$a["horaPago"];
        if ($horaPago!="") {
            $horaPago = date_create($horaPago);
            $horaPago= date_format($horaPago,'d')." ".$meses[date_format($horaPago,'n')-1]. 
            " ".date_format($horaPago,'Y'). " , ". date_format($horaPago,'g:i a');
        }        
        $id=$a["id"];
        $estado=$a["descripcion"]; 
        $mesa=$a["mesa"]; 
        $total=number_format($total, 0, ",", ".");
        if ($estado=="pedido" || $estado=="aplazado" ) {
            $class="success";
            $accion="pagar";
        }else{
            $class="info";
            $accion="ver";
        }
        
        echo '<tr> 
                <td>'.$horaInicio.'</td> 
                <td>'.$mesa.'</td>
                 <td>'.$subtotal.'</td>
                <td>'.$descuento.'</td>                    
                <td>'.$total.'</td>
                <td>'.$estado.'</td>                
                <td>'.$horaPago.'</td>
                <td><a href="pago_pedido.php?atencion='.$id.'">
                    <button type="button" class="btn btn-'.$class.' btn-xs">'.$accion.'</button></a>
                  </td>
                </tr>';
     
       }
    }
    
    /**
     * Metodo lista de pedidos para mostrar en el modulo de caja
     * @return Html tabla para mostrar los pedidos en modulo de caja
     */
    function pedidosCocina(){
        
    $consulta= new Item();
    $consulta= $consulta->pedidosCocina();
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $producto= $a["nombre"];
        $anexos= $a["anexos"];
        $mesa= $a["mesa"];  
        $tiempo=$a["hora_pedido"];        
        $mesero=$a["mesero"];
        $cocinero=$a["cocinero"]; 
        $estado=$a["estado"]; 
        $id=$a["idItem"]; 
        
        $date = new DateTime($tiempo); 
        $horaPedido= $date->format('U');
        $horaActual=time();
        $diferencia=round(($horaActual-$horaPedido)/60)+1;
        $progreso='<span class="timeprogress">'.$diferencia.'</span> Minutos <i class="fa fa-level-up"></i>';
        $classTr="";
        if ($diferencia>5) {
            $classTr="danger";
        }
        if ($estado=="pedido") {
            $class="success";
            $accion="Preparar";
            
        }else{
            $class="info";
            $accion="Despachar";
        }
        
        echo '<tr class="'.$classTr.'"> 
                <td>'.$producto.'</td> 
                <td>'.$anexos.'</td>
                <td>'.$mesa.'</td>
                <td>'.$progreso.'</td>                    
                <td>'.$mesero.'</td>
                <td>'.$cocinero.'</td>                
                <td>'.$estado.'</td>
                <td><a>
                    <button onclick="(cambiarEstado('.$id.',\''.$accion.'\'))" type="button" class="btn btn-'.$class.' btn-xs">'.$accion.'</button></a>
                </td>
                </tr>';
     
       }
    }
    
    function atencionesAbiertas(){
    $atencion=new Atencion();
    $consulta=$atencion->getAtencionesAbiertas();
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $subtotal= $a["total"];
        $descuento= $a["descuento"];
        $total= $subtotal-$descuento;
        $horaInicio=$a["horaInicio"];
        $horaInicio = date_create($horaInicio);
        $horaInicio= date_format($horaInicio,'d')." ".$meses[date_format($horaInicio,'n')-1]. 
            " ".date_format($horaInicio,'Y'). " , ". date_format($horaInicio,'g:i a');
        
        $id=$a["id"];
        $estado="Pendiente de pago"; 
        $mesa=$a["mesa"]; 
        $total=number_format($total, 0, ",", ".");
        
        
        echo '<tr> 
                <td>'.$horaInicio.'</td> 
                <td>'.$mesa.'</td>
                 <td>'.$subtotal.'</td>
                <td>'.$descuento.'</td>                    
                <td>'.$total.'</td>
                <td>'.$estado.'</td>
                </tr>';     
       }
        
    }
    
    function cierreCaja(){
        $atencion=new Atencion();
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $id=$usuario->getIdUsuario();
        
        $estado=$atencion->cerrarAtenciones();
        if ($estado){
            $estado=$atencion->cierreCaja($id);
            if ($estado){
                echo "Exito";
            }
            else {
                echo $estado;
            }
        }
        else {
            echo $estado;
        }
    }
    
    function atencionesAlCierre(){
        
        $atencion=new Atencion();
    $consulta=$atencion->pedidosAlCierre();
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $subtotal= $a["total"];
        $descuento= $a["descuento"];
        $total= $subtotal-$descuento;
        $horaInicio=$a["horaInicio"];
        $horaInicio = date_create($horaInicio);
        $horaInicio= date_format($horaInicio,'d')." ".$meses[date_format($horaInicio,'n')-1]. 
            " ".date_format($horaInicio,'Y'). " , ". date_format($horaInicio,'g:i a');
        $horaPago=$a["horaPago"];
        if ($horaPago!="") {
            $horaPago = date_create($horaPago);
            $horaPago= date_format($horaPago,'d')." ".$meses[date_format($horaPago,'n')-1]. 
            " ".date_format($horaPago,'Y'). " , ". date_format($horaPago,'g:i a');
        }        
        $id=$a["id"];
        $estado=$a["descripcion"]; 
        $mesa=$a["mesa"]; 
        $total=number_format($total, 0, ",", ".");
        if ($estado=="pedido" || $estado=="aplazado" ) {
            $class="success";
            $accion="pagar";
        }else{
            $class="info";
            $accion="ver";
        }
        
        echo '<tr> 
                <td>'.$horaInicio.'</td> 
                <td>'.$mesa.'</td>
                 <td>'.$subtotal.'</td>
                <td>'.$descuento.'</td>                    
                <td>'.$total.'</td>
                <td>'.$estado.'</td>                
                <td>'.$horaPago.'</td>
                <td><a href="pago_pedido.php?atencion='.$id.'">
                    <button type="button" class="btn btn-'.$class.' btn-xs">'.$accion.'</button></a>
                  </td>
                </tr>';
     
       }
        
    }
    
    
    /**
    * Verifica que el mesero sea el mismo que abrio la mesa o que esta se encuentre disponible
    */
     function verificarAdmin(){        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (!is_object($usuario)) {
            die ('Por favor inicie sesion para continuar');
        }
        if ($usuario->getPrivilegios()[0]!=1) {
           die('no esta autorizado para realizar esta accion');
        }
    }
    
    
    /**
    * confirma que exista la sesion de usuario y que sea administrador
    * para poder realizar cambios propios de este privilegio
    */
    function meseroAutorizado(){        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        
        if (isset($_POST["mesa"])) {
            $idMesa=$_POST["mesa"];
        }
         else {
            die ('No autorizado');
        }
        
        $atencion= new Atencion();
        $mesa=new Mesa($idMesa);
        $atencion->setMesa($mesa);
        $estadoMesa=$atencion->atencionMesa()["disponibilidad"];
        $idAtencion=$atencion->atencionMesa()["idAtencion"];
        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        $id=$usuario->getIdUsuario();
        
        if ($estadoMesa!=1) {
            die("Autorizado");
        }
        else if ($usuario->getPrivilegios()[0]==1) {
           die("Autorizado");
        }
        else{            
            if ($atencion->pedidoMesero($id)==1){
                die("Autorizado");
            }
            else{
                die("No autorizado");
            }
            
        }
        
    }
    
    /**
    * confirma que exista la sesion de usuario y que sea empleado
    * para poder realizar cambios propios de este privilegio
    */
    function verificarUser(){
        
        $usuario = new Usuario();
        $usuario= $usuario->getSesion();
        if (!is_object($usuario)) {
            die ('Por favor inicie sesion para continuar');
        }
    }
?>