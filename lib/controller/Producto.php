<?php
/*
 * incluye el modelo producto, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Producto.php";
include "../model/Usuario.php";
include "../model/Categoria.php";
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
        verificarAdmin();
        crear();
        break;
    case "update":
        verificarAdmin();
        actualizar();
        break;
    case "delete":
        verificarAdmin();
        eliminar();
        break;
    case "listaProductos":
        verificarUser();
        listaProductos();
        break;
    case "listaCategorias":
        verificarUser();
        listaCategorias();
        break;
    case "cambiarEstado":
        verificarAdmin();
        cambiarEstado();
        break;
    
    default:
        die ('302:Error, no se encontro dirección');
}
   
/**
 * Crear una producto
 * @param Post nombreProducto,descripcion,valor,categoria,stock del producto que 
 * va a crear
 */
function crear(){
$nombre = $_POST["nombre_producto"];
$descripcion = $_POST["descripcion_producto"];
$valor = $_POST["valor_producto"];
$categoria = $_POST["categoria_producto"];
$stock = $_POST["stock_producto"];

$c=new Categoria($categoria);
$categoria=$c->getCategoria();
$producto = new Producto(null,$nombre,$valor,$descripcion,$categoria,1,$stock);
$respuesta = $producto->createProducto();

if (is_object($respuesta)) {
    echo "exito";
} else {
    echo "$respuesta";
}
}
/**
 * Actualizar una producto
 * @param Post idProducto,nombreProducto recibe id y 
 * nombre actualizado  de la producto que 
 * va a crear
 */
function actualizar(){
$id=$_POST["id_producto"];
$nombre = $_POST["nombre"];
$descripcion = $_POST["descripcion"];
$valor = $_POST["valor"];
$categoria = $_POST["categoria"];
$stock = $_POST["Stock"];

$c=new Categoria($categoria);
$categoria=$c->getCategoria();

$productosActualizar= new Producto($id,$nombre,$valor,$descripcion,$categoria,1,$stock);
$resultado=$productosActualizar->updateProducto();

if ($resultado=="Exito") {
    echo "Exito";
} else {
    echo $resultado;
}
}

/**
 * Cambia el estado del producto a activo o bloqueado
 * @param Post idProducto
 */
function cambiarEstado(){
$id=$_POST["id_producto"];
$productosActualizar= new Producto($id);
$resultado=$productosActualizar->cambiarEstado();

if ($resultado=="Exito") {
    echo "Exito";
} else {
    echo $resultado;
}
}

/**
 * Eliminar un producto
 * @param Post idProducto,recibe id de la
 *  producto que va a eliminar
 */
function eliminar(){
$id=$_POST["id_producto"];
$producto = new Producto($id);
$respuesta = $producto->deleteProducto();
if (is_object($respuesta)) {
   echo "Exito";
} else {
    echo $respuesta;
}
}

/**
 * Lista de  productos
 * @Return lista de productos
 * formato HTML tabla
 */
function listaProductos(){
    
    $productosConsulta= new Producto();
    $consulta=$productosConsulta->getProductos();  
    
    foreach ($consulta as $producto) {
        if ($producto['estado']=="activo"){
            $claseEstado="success";
            $iconAccion="ban";
        }
        else {
            $claseEstado="danger";
            $iconAccion="check";
        }
        if ($producto['stock']==1) {
            $producto['stock']="activado";
        }
        else{
            $producto['stock']="No disponible";
        }
        echo '<tr>
        <td>'.$producto['id'].'</td>
        <td>'.$producto['nombre'].'</td>
        <td>'.$producto['valor'].'</td>
        <td>'.$producto['categoria'].'</td>
        <td><button type="button" class="btn btn-'.$claseEstado.' btn-xs">'.$producto['estado'].'</button></td>
        <td>'.$producto['stock'].'</td>
        <td><h4> 
            <a class="fa fa-'.$iconAccion.'" onclick="bloquearProducto('.$producto["id"].')"></a>    
            <a class="fa fa-edit" onclick="modalEditarProducto('.$producto["id"].',\''.$producto["nombre"].'\',\''.$producto["descripcion"].'\',\''.$producto["valor"].'\',\''.$producto["id_categoria"].'\')"></a>  
            <a class="fa fa-remove" onclick="modalEliminarProducto('.$producto["id"].')"></a>
        </h4></td>
        </tr>';
        }    
    }
  /**
 * Lista de  categorias
 * @Return lista de categorias
 * formato HTML tabla
 */
function listaCategorias(){
    
    $categoriaConsulta= new Categoria();
    $consulta=$categoriaConsulta->getCategorias();  
    echo '<option value="">Seleccine una opcion</option>';
    foreach ($consulta as $categoria) {
        
        echo '<option value="'.$categoria["id"].'">'.$categoria["nombre"].'</option>';
        }    
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