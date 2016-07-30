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
    case "pedidoCompleto":
        verificarUser();
        pedidoCompleto();
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
        if ($idAtencion=="") {  
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
     * 
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
        $url='detalle_pedido.php?id='.$atencion->getIdAtencion();
    }else {
        $estado="Disponible";
        $url='#';
    }
    
    
    $data = array();
        $data['mesa'] = $mesa->getDescripcion();
        $data['totalPedido'] = $total ;
        $data['estadoMesa'] = $estado;
        $data['urlDetalle'] = $url;
        
        echo json_encode($data);
  
    }
    
    /**
    * confirma que exista la sesion de usuario y que sea administrador
    * para poder realizar cambios propios de este privilegio
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