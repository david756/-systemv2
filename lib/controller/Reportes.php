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