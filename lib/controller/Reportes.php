<?php
   
    /**
     * Reporte mesas ocupadas
     */
    function mesasOcupadas(){
    require_once 'model/Mesa.php';
    $mesas = new Mesa();
    $respuesta = $mesas->totalOcupadas()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }    
    }
    
    /**
     * Reporte actividad diaria , cantidad de pedidos por dia
     */
    function actividadDiaria(){
    require_once 'model/Atencion.php';
    $atencion = new Atencion();
    $consulta = $atencion->actividadDiaria();
    $fechas = array();
     foreach ($consulta as $a) {
        $total= $a["total"];
        $fecha=$a["fecha"];
        $fecha = date_create($fecha);
        $dia= date_format($fecha,'d');
        $mes=date_format($fecha,'m');  
        $ano=date_format($fecha,'Y');
        $fechas[intval($dia)]=array($fecha,$mes,$dia,$ano,$total);            
       }
       
       for ($i = 1; $i <= 31; $i++) {
           if (empty($fechas[$i])) {
               $fechas[$i]=array(0,0,$i,0,0); 
           }
       }
       
        $arreglo="";
       
       for($i = 15; $i >= 0; $i--) {
           //$fecha="2017-07-05"; 
           $fecha=date("Y-m-d"); 
           $dias= $i;
           $d=date("d", strtotime("$fecha -$dias day"));
           $m=date("m", strtotime("$fecha -$dias day"));
           $Y=date("Y", strtotime("$fecha -$dias day"));
           $f=$fechas[intval($d)];
           $arreglo=$arreglo."[gd($Y, $m, $f[2]), $f[4]],";   
           //print_r($d);
       } 
      
       echo $arreglo;
    }
    /**
     * Reporte los productos mas vendidos
     */
    function productosMasVendidos(){
        require_once 'model/Atencion.php';
        $atencion = new Atencion();
        $consulta = $atencion->productosMasVendidos();
        $suma=0;
        foreach ($consulta as $a) {
            $suma=$suma+$a["total"];
        }
        if (!empty($consulta)){            
            foreach ($consulta as $a) {
            $producto= $a["total"];            
            echo '<div>
                    <p>'.$a["producto"].'</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 100%;">
                        <div class="progress-bar bg-green" role="progressbar"
                        data-transitiongoal="'.(($a["total"]/$suma)*100).'"></div>
                      </div>
                    </div>
                  </div>';   
           }
        }
        else{
            for ($index = 0; $index < 4; $index++) {    
             echo '<div>
                    <p>No disponible</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 100%;">
                        <div class="progress-bar bg-green" role="progressbar"
                        data-transitiongoal="0"></div>
                      </div>
                    </div>
                  </div>';
             }
        }
         
        
    }
    /**
     * Reporte las categorias mas vendidas
     */
    function categoriasMasVendidas(){
        require_once 'model/Atencion.php';
        $atencion = new Atencion();
        $consulta = $atencion->categoriasMasVendidas();
        $suma=0;
        foreach ($consulta as $a) {
            $suma=$suma+$a["total"];
        }
        if (!empty($consulta)){            
            foreach ($consulta as $a) {
            $producto= $a["total"];            
            echo '<div>
                    <p>'.$a["categoria"].'</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 100%;">
                        <div class="progress-bar bg-green" role="progressbar"
                        data-transitiongoal="'.(($a["total"]/$suma)*100).'"></div>
                      </div>
                    </div>
                  </div>';   
           }
        }
        else{
            for ($index = 0; $index < 4; $index++) {    
             echo '<div>
                    <p>No disponible</p>
                    <div class="">
                      <div class="progress progress_sm" style="width: 100%;">
                        <div class="progress-bar bg-green" role="progressbar"
                        data-transitiongoal="0"></div>
                      </div>
                    </div>
                  </div>';
             }
        }
    }
    
    /**
     * Reporte meseros que mas venden
     */
    function ventasMeseros(){
        require_once 'model/Atencion.php';
        $atencion = new Atencion();
        $consulta = $atencion->ventasMeseros();
        $suma=0;
        foreach ($consulta as $a) {
            $suma=$suma+$a["total"];
        }
        for ($i = 0; $i < 5; $i++) {
            if (!empty($consulta[$i])){
                //$consulta[$i]["total"]=round(($consulta[$i]["total"]/$suma)*100);
                $consulta[$i]["total"]=$consulta[$i]["total"];
            }
            else if(!empty($consulta)){
                $consulta[$i]=array("usuario" => "Vacio","total" => 0);
            }
            else{
                $consulta[$i]=array("usuario" => "Vacio","total" => 20);
            }
            
        }
        return $consulta;
    }
    
    /**
     * Reporte actividad diaria , ingresos por dia
     */
    function actividadDiariaIngresos(){
    require_once 'model/Atencion.php';
    $atencion = new Atencion();
    $consulta = $atencion->actividadDiariaIngresos();
    $fechas = array();
     foreach ($consulta as $a) {
        $total= $a["total"];
        $fecha=$a["fecha"];
        $fecha = date_create($fecha);
        $dia= date_format($fecha,'d');
        $mes=date_format($fecha,'m');  
        $ano=date_format($fecha,'Y');
        $fechas[intval($dia)]=array($fecha,$mes,$dia,$ano,$total);            
       }
       
       for ($i = 1; $i <= 31; $i++) {
           if (empty($fechas[$i])) {
               $fechas[$i]=array(0,0,$i,0,0); 
           }
       }
       
        $arreglo="";
       
       for($i = 12; $i >= 0; $i--) {
           //$fecha="2017-07-05"; 
           $fecha=date("Y-m-d"); 
           $dias= $i;
           $d=date("d", strtotime("$fecha -$dias day"));
           $m=date("M", strtotime("$fecha -$dias day"));
           $D=date("D", strtotime("$fecha -$dias day"));
           $f=$fechas[intval($d)];
           //$arreglo=$arreglo."[gd($Y, $m, $f[2]), $f[4]],"; 
           
           $arreglo=$arreglo.'{"period": "'.$D." ".$f[2]." ".$m.'","Hours worked": '.$f[4].'},';
           //print_r($d);
       } 
      
       echo $arreglo;
    }
    
    /**
     * Reporte meseros activos
     */
    function meserosActivos(){
    require_once 'model/Usuario.php';
    $user = new Usuario();
    $respuesta = $user->meserosActivos()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }
    }
    /**
     * Reporte pedidos hoy
     */
    function pedidosHoy(){
    require_once 'model/Atencion.php';
    $atencion = new Atencion();
    $respuesta = $atencion->pedidosHoy()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else{
        echo "Error";
    }
    }
    /**
     * Reporte ingresos hoy
     */
    function ingresosHoy(){
    require_once 'model/Atencion.php';
    $atencion = new Atencion();
    $respuesta = $atencion->ingresosHoy()["total"];
    if (is_numeric($respuesta)) {
        $respuesta = sprintf("%02d", $respuesta);
        echo $respuesta;
    }
    else if ($respuesta==null) {
        echo "00";
    }
    else{
        echo "Error";
    }
    }
    
    /**
     * Reporte de atenciones
     */
    function Atenciones($inicio,$fin){

    list($dia, $mes, $ano) = split('[/]', $inicio);
    $inicio=$ano."-".$mes."-".$dia;
    list($dia1, $mes1, $ano1) = split('[/]', $fin);
    $fin=$ano1."-".$mes1."-".(intval($dia1)+1);

    require_once 'model/Atencion.php';    
    $atencion=new Atencion();
    $consulta=$atencion->reporteAtenciones($inicio,$fin);
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
        //$total=number_format($total, 0, ",", ".");
        if ($estado=="pedido" || $estado=="aplazado" ) {
            $class="success";
            $accion="pagar";
        }else{
            $class="info";
            $accion="ver";
        }
        
        echo '<tr> 
                <td>'.$id.'</td> 
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
     * Reporte de pedidos
     */
    function pedidos($inicio,$fin){

    list($dia, $mes, $ano) = split('[/]', $inicio);
    $inicio=$ano."-".$mes."-".$dia;
    list($dia1, $mes1, $ano1) = split('[/]', $fin);
    $fin=$ano1."-".$mes1."-".(intval($dia1)+1);
    
    require_once 'model/Atencion.php';    
    $atencion=new Atencion();
    $consulta=$atencion->reportePedidos($inicio,$fin);
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $horaPedido= $a["hora_pedido"];
        $horaPreparacion= $a["hora_preparacion"];
        $horaDespacho= $a["hora_despacho"];
        $idAtencion= $a["id_atencion"];
        
        $producto= $a["nombre"];
        $anexos= $a["anexos"];
        $id_item= $a["id_item"];
        $cocinero= $a["cocinero"];
        $mesero= $a["mesero"];
        $mesa= $a["mesa"];
        $valor= $a["valor"];
        $cantidad= $a["cantidad"];
        $total= $a["total"];
        

        $horaPedido = date_create($horaPedido);
        $horaPedido= date_format($horaPedido,'d')." ".$meses[date_format($horaPedido,'n')-1]. 
            " ".date_format($horaPedido,'Y'). " , ". date_format($horaPedido,'g:i a');
        
        
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
        
         echo '<tr> 
                <td>'.$horaPedido.'</td>
                <td>'.$producto.'</td>
                <td>'.$anexos.'</td>
                <td>'.$mesero.'</td>  
                <td>'.$cocinero.'</td> 
                <td>'.$mesa.'</td>
                <td>'.$cantidad.'</td>
                <td>'.$valor.'</td>
                <td>'.$total.'</td>        

                <td><a href="detalle_pedido.php?atencion='.$idAtencion.'">
                    <button type="button" class="btn btn-info btn-xs">Ver más</button></a>
                  </td>
                </tr>';
     
       }
    }
    
    function lista_cierres(){

        
    require_once 'model/Atencion.php';    
    $atencion=new Atencion();
    $consulta=$atencion->lista_cierres();
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    foreach ($consulta as $a) {              
        
        $fecha= $a["fecha"];
        $usuario= $a["usuario"];
        $id= $a["id"];        

        $fecha = date_create($fecha);
        $fecha= date_format($fecha,'d')." ".$meses[date_format($fecha,'n')-1]. 
            " ".date_format($fecha,'Y'). " , ". date_format($fecha,'g:i a');
        
        
         echo '<tr> 
                <td>'.$id.'</td>
                <td>'.$fecha.'</td>
                <td>'.$usuario.'</td>
                <td><a href="cierres.php?id='.$id.'">
                    <button type="button" class="btn btn-info btn-xs">Ver más</button></a>
                  </td>
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
            die ('0');
        }
        if ($usuario->getPrivilegios()[0]!=1) {
           die('0');
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
            die ('0');
        }
    }
?>