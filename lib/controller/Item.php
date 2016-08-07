<?php
/*
 * incluye el modelo categoria, con los metodos y acceso 
 * a la base de datos
 */
include "../model/Atencion.php";
include "../model/Usuario.php";
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
    case "detalleItems":
        verificarUser();
        detalleItems();
        break;
    case "delete":
        verificarAdmin();
        eliminar();
        break;
    default:
        die ('302:Error, no se encontro dirección');
}
/**
     * Metodo lista de items de una atencion para mostrar en detalle pedido
     * @return Html tabla para mostrar los items de determinada atencion,
     */
    function detalleItems(){
    $idAtencion=$_POST["atencion"] ;
    $item=new Item();
    $atencion= new Atencion($idAtencion);
    $atencion= $atencion->getAtencion();
    $item->setAtencion($atencion);
    $consulta=$item->itemsAtencion();   
    $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dic");
    $i=0;
    foreach ($consulta as $a) {     
        $producto= $a["producto"];
        $idItem=$a["id"];
        $valorActual= $a["valorActual"];
        $valorRegistrado= $a["valorRegistrado"];
        $total= $a["valorRegistrado"];
        $mesero=$a["mesero"];
        $descripcion = $a["descripcion"];
        $anexo= $a["anexos"];
        $horaPedido=$a["hora_pedido"];
        $horaPreparacion=$a["hora_preparacion"];
        $horaDespacho=$a["hora_despacho"];
        if ($horaPedido!="") {
            $horaPedido = date_create($horaPedido);
            $horaPedido= date_format($horaPedido,'d')." ".$meses[date_format($horaPedido,'n')-1]. 
            " ".date_format($horaPedido,'Y'). " , ". date_format($horaPedido,'g:i a');
        }    
        if ($horaPreparacion!="") {
            $horaPreparacion = date_create($horaPreparacion);
            $horaPreparacion= date_format($horaPreparacion,'d')." ".$meses[date_format($horaPreparacion,'n')-1]. 
            " ".date_format($horaPreparacion,'Y'). " , ". date_format($horaPreparacion,'g:i a');
        }    
        if ($horaDespacho!="") {
            $horaDespacho = date_create($horaDespacho);
            $horaDespacho= date_format($horaDespacho,'d')." ".$meses[date_format($horaDespacho,'n')-1]. 
            " ".date_format($horaDespacho,'Y'). " , ". date_format($horaDespacho,'g:i a');
        }    
        $tiempo=25; 
        $cocinero=$a["cocinero"];
        $categoria=$a["categoria"];
               
        echo '<!-- start accordion -->
                <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                   <div class="panel">
                        <a class="panel-heading collapsed" role="tab" id="heading'.$i.'" data-toggle="collapse" data-parent="#accordion" href="#collapse'.$i.'" aria-expanded="false" aria-controls="collapse'.$i.'">
                          <h4 class="panel-title"><strong>'.$producto.' </strong><span class="fa fa-chevron-down" aling="right"></span></h4>
                        </a>
                        <div id="collapse'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$i.'">
                              <div class="panel-body">
                                 <b> Valor Actual :</b>  $'.$valorActual.' <br>
                                  <b>Valor Registrado :</b>  $'.$valorRegistrado.' <br>
                                  <b>Total:</b> $'.$total.'<br>
                                  <b> Mesero :</b>  '.$mesero.'<br>
                                  <b>Descripcion :</b> '.$descripcion.' <br>
                                  <b> Anexos :</b>  '.$anexo.'<br>
                                  <b> Hora Pedido :</b> '.$horaPedido.' <br>
                                  <b> Hora Inicio Preparacion :</b> '.$horaPreparacion.' <br>
                                  <b> Hora Despacho :</b>'.$horaDespacho.' <br>
                                  <b> Tiempo Total :</b> '.$tiempo.'  <br>                                            
                                  <b> Cocinero :</b>  '.$cocinero.' <br>
                                  <b> Categoria : </b> '.$categoria.'<br><br>
                                  <a type="button" onclick="modalEliminarItem('.$idItem.')" class="btn btn-info btn-xs">Eliminar</a><hr>
                              </div>
                        </div>
                  </div>
                </div>   
             <!-- end accordion -->';
        $i++;
     
       }
    }
    /**
    * Eliminar un item
    * @param Post idItem,recibe id de el item que va a eliminar
    */
   function eliminar(){
   $id=$_POST["id_item"];
   $item = new Item($id);
   $atencion=new Atencion($item->getAtencionItem());
   $atencion=$atencion->getAtencion();
   if ($atencion->getEstado()==2 || $atencion->getEstado()==3) {
       die("Error: El pedido ya fue facturado,no se puede eliminar");
   }
   $respuesta = $item->deleteItem();
   $atencion=$atencion->deleteAtencion();
   echo $respuesta;
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