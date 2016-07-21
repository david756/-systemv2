<?php
/*
 * incluye el modelo categoria, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Categoria.php";
include "../model/Usuario.php";
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
    case "listaCategorias":
        verificarAdmin();
        listaCategorias();
        break;
    
    default:
        die ('302:Error, no se encontro dirección');
}
   
/**
 * Crear una categoria
 * @param Post nombreCategoria recibe nombre de la categoria que 
 * va a crear
 */
function crear(){
$nombre = $_POST["nombre_categoria"];
$categoria = new Categoria(null,$nombre);
$respuesta = $categoria->createCategoria();

if (is_object($respuesta)) {
    echo "exito";
} else {
    echo "$respuesta";
}
}
/**
 * Actualizar una categoria
 * @param Post idCategoria,nombreCategoria recibe id y 
 * nombre actualizado  de la categoria que 
 * va a crear
 */
function actualizar(){
$id=$_POST["id_categoria"];
$descripcion = $_POST["descripcion"];
$categoriasActualizar= new Categoria($id,$descripcion);
$resultado=$categoriasActualizar->updateCategoria();

if ($resultado=="Exito") {
    echo "Exito";
} else {
    echo $resultado;
}
}

/**
 * Eliminar una categoria
 * @param Post idCategoria,recibe id de la
 *  categoria que va a eliminar
 */
function eliminar(){
$id=$_POST["id_categoria"];
$categoria = new Categoria($id);
$respuesta = $categoria->deleteCategoria();
if (is_object($respuesta)) {
   echo "Exito";
} else {
    echo $respuesta;
}
}

/**
 * Lista de  categorias
 * @Return lista de categorias
 * formato HTML tabla
 */
function listaCategorias(){
    
    $categoriasConsulta= new Categoria();
    $consulta=$categoriasConsulta->getCategorias();  
    
    foreach ($consulta as $categoria) {
        echo '<tr>
        <td>'.$categoria['id'].'</td>
        <td>'.$categoria['nombre'].'</td>
        <td><h4>   
            <a class="fa fa-edit" onclick="modalEditarCategoria('.$categoria["id"].',\''.$categoria["nombre"].'\')"></a>  
            <a class="fa fa-remove" onclick="modalEliminarCategoria('.$categoria["id"].')"></a>
        </h4></td>
        </tr>';
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