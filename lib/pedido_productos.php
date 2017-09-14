<?php
        include 'controller/Sesiones.php';
        mesero();
        if (isset($_GET['mesa'])) {
               $idMesa=$_GET['mesa'];
        }else{
            header('Location: pedido_mesas.php');
        }
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Holly Sistema Pos | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">

  <script src="js/jquery.min.js"></script>


  <style type="text/css">    
    .categoria{
      float: left;
      margin: 5px;
      width: 150px;
      height: 155px;
      }
    .prod {
      padding: 10px;
      margin-bottom: 20px;
      background-color: #f2f5f7;
      border-radius: 10px;
    }
  </style>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
  <script>
            $(document).ready(function() {
               meseroAutorizado();
               datosAtencion();
               pedidoCompleto();
               categorias();
               productos();
        

            });
  </script>

    <script type="text/javascript">
      function meseroAutorizado(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "meseroAutorizado", mesa:"<?php echo $idMesa ?>"}
                  ,function(tabla){
                    console.log(tabla);
                      if (tabla=="No autorizado") {
                        location.href ="pedido_mesas.php";
                      }

                  }
                  );
      }
      </script>



  <script type="text/javascript">
      var idMesa=<?php echo $idMesa; ?> ;
      function datosAtencion(){ 
              $.ajax({
                   type   : 'POST',
                   url    : 'controller/Atencion.php',
                   data  : {metodo: "datosAtencion",mesa: idMesa },
                   dataType : 'json',
                   success  : function(data){
                    var total=data.totalPedido;
                    total=parseInt(total);
                     $('#totalPedido').attr("valor",total);
                      var num = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                      $('#totalPedido').html(num);
                      $('#mesa').html(data.mesa);
                      $('#estadoMesa').html(data.estadoMesa); 
                      $('#urlDetallle').prop("href", data.urlDetalle);
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
      }
      function categorias(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "listaCategorias"}
                  ,function(tabla){
                    $('#categorias').html(tabla);
                  }
                  );
      }
      function productos(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "listaProductos"}
                  ,function(tabla){
                    $('#productos').html(tabla);
                  }
                  );
      }
      function pedidoCompleto(){         
                  $.post("controller/Atencion.php", 
                  {metodo: "pedidoCompleto",mesa:idMesa}
                  ,function(tabla){
                    $('#pedidoCompleto').html(tabla);
                  }
                  );
      }

      function verProductos(idCategoria) {
                    $(".categoria").hide();
                    $( "div[name="+idCategoria+"]" ).show();
      }

      function modalAnexo(id,nombre,valor){            
                  $('#idProductoAnexo').val(id);
                  $('#nombreProductoAnexo').val(nombre);
                  $('#valorProductoAnexo').val(valor);
                  $('#modalAnexo').modal('show');

       }
       function modalDetalleProducto(nombre,detalle){                 
                  $('#nombreProducto').html(nombre);
                  $('#detalleProducto').html(detalle);
                  $('#modalDetalleProducto').modal('show');
       }

      function agregarguarnicion(parametro){
          $('#anexoDescripcion').append(" "+parametro+"  ");         
      }

      function limpiarGuarnicion(parametro){
          $('#anexoDescripcion').text('');         
      }
     

  </script>     


  <!-- Script para manejar la lista de productos -->
  <script type="text/javascript">
      
        /**
          param(dataArr)
          dataArr[idProducto,cantidad,nombreProducto,valor,total,anexos];
          dataArr[0]=id
          dataArr[1]=cantidad
          dataArr[2]=producto
          dataArr[3]=valor
          dataArr[4]=total
          dataArr[5]=anexos
        **/
        function agregarFila(dataArr){ 

              idProducto=dataArr[0];

              $('.check' + idProducto).show(120).delay(150).hide(100);
                tabla = document.getElementById("myTable");

                for(var i = 1; tabla.rows[i]; i++){
                  if (tabla.rows[i].cells[0].innerHTML==idProducto && tabla.rows[i].cells[5].innerHTML==dataArr[5]) {
                      dataArr[1]=dataArr[1]+parseInt(tabla.rows[i].cells[1].innerHTML);
                      dataArr[4]=(1+parseInt(tabla.rows[i].cells[1].innerHTML))*parseInt(tabla.rows[i].cells[3].innerHTML);
                      deleteRow(idProducto,dataArr[5]);
                  }
                }

              var tr=document.createElement('tr');
              var len=dataArr.length;

              
              for(var i=0;i<len;i++){
                  var td=document.createElement('td');
                  if (i==0) {
                   td.style.display="none";
                  }
                  td.appendChild(document.createTextNode(dataArr[i]));
                  tr.appendChild(td);
              }

              var td=document.createElement('td');

              var btn = document.createElement("a");   
              btn.className = "fa fa-remove";

              btn.setAttribute("onclick", 'eliminarProductoLista('+idProducto+',"'+dataArr[5]+'")');
              btn.id=idProducto;
                                       
              td.appendChild(btn); 
              tr.appendChild(td);
              sumarTotales(dataArr);
              document.getElementById('tbl_bdy').appendChild(tr);              
              
              return true; 
          }

          function agregarAnexo(){
            productoId=$('#idProductoAnexo').val();
            anexoDescripcion=$('#anexoDescripcion').val();
            cantidad=parseInt($('#cantidadAnexo').val());
            nombre=$('#nombreProductoAnexo').val();
            valor=parseInt($('#valorProductoAnexo').val());
            total=parseInt(valor*cantidad);

            array=[productoId,cantidad,nombre,valor,total,anexoDescripcion];
            agregarFila(array);
            limpiarGuarnicion();
            $('#modalAnexo').modal('hide');
          }

          function sumarTotales(dataArr){
                  var total =0;
                  tabla = document.getElementById("myTable");
                  var cuenta=dataArr[4];

                  for(var i = 1; tabla.rows[i]; i++){
                        cuenta =cuenta+parseInt(tabla.rows[i].cells[4].innerHTML);
                   }

                total=cuenta;
                pedidoCompleto=$('#totalPedido').attr("valor");
                pedidoCompleto=parseInt(pedidoCompleto)+total;
                var num = pedidoCompleto.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                $('#totalPedido').html(num);
                num = total.toFixed(0).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1.");
                var t = document.getElementById("total");                
                t.innerHTML=num; 
            }

          function deleteRow(id,anexo) {

             tabla = document.getElementById("myTable");
             for(var i = 1; tabla.rows[i]; i++){
                  if (tabla.rows[i].cells[0].innerHTML==id && tabla.rows[i].cells[5].innerHTML==anexo) {
                      tabla.deleteRow(i); 
                  }
                }
              }


          function eliminarProductoLista(id,anexo) {

              tabla = document.getElementById("myTable");
               for(var i = 1; tabla.rows[i]; i++){

                    if (tabla.rows[i].cells[0].innerHTML==id && tabla.rows[i].cells[1].innerHTML>1 && tabla.rows[i].cells[5].innerHTML==anexo) {
                        tabla.rows[i].cells[1].innerHTML=(tabla.rows[i].cells[1].innerHTML)-1;
                        tabla.rows[i].cells[4].innerHTML=(tabla.rows[i].cells[1].innerHTML)*(tabla.rows[i].cells[3].innerHTML);
                    }
                   else if (tabla.rows[i].cells[0].innerHTML==id && tabla.rows[i].cells[1].innerHTML==1 && tabla.rows[i].cells[5].innerHTML==anexo) {
                        tabla.deleteRow(i,tabla.rows[i].cells[5].innerHTML); 
                    }
                  }
              sumarTotales([0,0,0,0,0,0,0]);
          }

         /**
            guardar Producto , controller Atencion
            jsonPedido= "{  
              "mesa": *,
              "pedido": [
                {"id":*,      
                  "cantidad":*,
                  "anexo": "***", 
                },
                {"id":*,
                  "cantidad":*,
                  "anexo": "***",
                },
                {"id":*,
                  "cantidad":*,
                  "anexo": "***",
                }
              ]
            }"    
         **/
          function guardarPedido(){

              tabla = document.getElementById("myTable");
                      var mesa=<?php echo $idMesa; ?> ; 
                      var jsonPedido={};
                      jsonPedido['mesa']=mesa;
                      jsonPedido['pedido']=[];

                      var hayProductos=0;
                        for(var j = 1; tabla.rows[j]; j++){                                
                                hayProductos=1;                                  
                                var id=tabla.rows[j].cells[0].innerHTML;
                                var cantidad=tabla.rows[j].cells[1].innerHTML;
                                var anexo=tabla.rows[j].cells[5].innerHTML;
                                jsonPedido.pedido.push({"id":id,"cantidad":cantidad,"anexo":anexo});                          
                         }  

                        if (hayProductos){
                           $.ajax({
                                    type:  'POST',
                                    url:   'controller/Atencion.php',
                                    data:{'jsonPedido' : jsonPedido,
                                          'metodo'   : "create"}, 

                                    error: function(jqXHR, textStatus, errorThrown) {
                                     $('#resultado').attr("class","alert alert-danger");
                                     $('#resultado').html('<o>201:Ocurrio un error </p>');
                                     $('#resultado').show("slow").delay(4000).hide("slow");
                                    },
                                    success:  function (response,estado,objeto) {
                                       if (response=="Exito") {
                                        $('input[name=crear-nombre]').val("")
                                        $('#resultado').html("El pedido se guardo con exito!");
                                        $('#resultado').attr("class","alert alert-success");
                                        $('#resultado').show("slow").delay(4000).hide("slow");
                                        setTimeout(function(){window.location.href = "pedido_mesas.php"}, 1000);
                                       }
                                       else{
                                         $('#resultado').attr("class","alert alert-danger");
                                         $('#resultado').html("202:Ocurrio un error: ");
                                         $('#resultado').html(response);
                                         $('#resultado').show("slow").delay(4000).hide("slow");
                                       } 
                                    }

                            });   
                        }   

            }

      </script>  

</head>
<body style="background:#F7F7F7;">

<!-- top Menu navigation-->
<?php include 'menu.php'; ?>
<!-- /top Menu navigation -->



      <!-- page content -->
      <div class="right_col" role="main">

        <div class="x_content">
          <div class="page-title">
            <div class="title_left">
              <h3>
                    Pedido
                    <small>
                        Seleccion de pedidos 
                    </small>
                </h3>
            </div>            
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <!-- x_content-->                
                <div class="x_content">
                    <div>
                        <div class="title_left">
                          <div class="pull-left">
                            <h2>Nuevo Pedido : <span id="mesa"></span></h2>
                            <small>
                              <h4> <span id="estadoMesa"></span> :  <a id="urlDetallle" href="">Ver detalle</a></h4>
                            </small>
                          </div>
                        </div>
                        <div class="title_right">
                          <div class="pull-right">
                            <h2>Total Pedido: $ <span id="totalPedido" valor="">0</span></h2>
                            <small>
                              <h4>Esta orden : $ <span id="total">0</span></h4>
                            </small>
                          </div>
                        </div>
                    </div>
                    <div class="clearfix"></div><br>


                    <!-- start accordion -->
                  <div class="accordion" id="accordion" role="tablist" aria-multiselectable="false">
                      <div class="panel">
                          <a class="panel-heading collapsed" role="tab" id="headingTwo" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h4 class="panel-title"><strong>Ver el pedido actual</strong></h4>
                          </a>
                            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                                  <div class="panel-body">
                                  <table class="table datatable">
                                    <thead>
                                      <tr>
                                        <th>Cant</th>
                                        <th>Producto</th>
                                        <th>Anexo</th>
                                        <th>Sub-total</th>
                                        <th>Total</th>
                                      </tr>
                                    </thead>
                                    <tbody id="pedidoCompleto">
                                      
                                    </tbody>
                                  </table>
                                </div>
                            </div>
                      </div>
                  </div>   
                    <!-- end accordion -->
                    <div align="right">
                            <br><button type="button" onclick="guardarPedido()" class="btn btn-info btn-sm">Guardar</button>
                            <a href="pedido_mesas.php" type="button" class="btn btn-default btn-sm">Cancelar</a>
                          
                    </div> 
                    <div class="row">
                      <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
                    </div>                 

                    <hr> <!-- Separador -->

                    <div class="row">
                        <!-- div que agrupa categorias y productos-->
                        <div class="col-md-8 col-xs-12 ">


                              <!-- div que agrupa categorias-->
                              <div id="categorias">
                                 
                              </div><div class="clearfix"></div><br>


                              <!-- div que agrupa productos-->
                              <div id="productos">
                                                      
                              </div>
                        </div>

                        <!-- div que agrupa listado -->
                        <div class="col-md-4 col-xs-12 ">                        
                          <table  class="table datatable" id="myTable">
                                    <thead>
                                      <tr>
                                        <th style="display:none">Cod</th>
                                        <th>Cant</th>
                                         <th>Producto</th>                  
                                         <th>Precio</th>             
                                         <th>total</th>
                                         <th>Anexo</th>
                                         <th>accion</th>
                                      </tr>
                                    </thead>
                                    <tbody id="tbl_bdy"> </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /modals anexo del producto -->
                    <div id="modalAnexo" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Ingresar Anexo</h4>
                            </div>

                            <div class="modal-body">
                              <form>
                                    <input type="text" id ="idProductoAnexo" value="" style="display:none">
                                    <input type="text" id ="nombreProductoAnexo" value="" style="display:none">
                                    <input type="text" id ="valorProductoAnexo" value="" style="display:none">

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Guarniciones</label><br><br>
                                        <label>
                                           <button type="button" class="btn btn-info btn-xs" onclick='agregarguarnicion("Casabe.")' data-target="#ModalOrden">Casabe</button>
                                        </label>
                                        <label>
                                           <button type="button" class="btn btn-info btn-xs" onclick='agregarguarnicion("Papas fritas.")' >Papas Fritas</button>
                                        </label>
                                        <label>
                                            <button type="button" class="btn btn-info btn-xs" onclick='agregarguarnicion("Platanos fritos.")'>Platanos Fritos</button>
                                        </label>
                                        <label>
                                            <button type="button" class="btn btn-success btn-xs" onclick='agregarguarnicion("Para llevar.")'>Para llevar</button>
                                        </label><br><br>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Anexo</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea id="anexoDescripcion" class="form-control" rows="4" maxlength="100" placeholder='Anexo de este producto' required="required"></textarea><br>
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Cantidad</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input id="cantidadAnexo" type="number" class="form-control" value="1" placeholder="Cantidad"><br>
                                        </div>
                                      </div> 
                                    <div class="clearfix"></div>                            
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" onclick="limpiarGuarnicion()" data-dismiss="modal">Cerrar</button>
                                    <button type="button" onclick="agregarAnexo()" class="btn btn-info">Guardar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modals anexo producto -->

                    <!-- /modal detalle del producto -->
                      <div class="modal fade bs-example-modal-sm" id="modalDetalleProducto" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content" align="center">
                          <div class="modal-body">
                            <h2 id="nombreProducto"></h2>
                            <h5 id="detalleProducto"></h5>
                          </div>                          
                            <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- /modal detalle de producto-->

                </div>
                <!-- /x_content End dv -->
              </div>
            </div>
          </div>
        </div>

        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->

      </div>
      <!-- /page content -->

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <script src="js/nicescroll/jquery.nicescroll.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>

  <script src="js/custom.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>

</body>

</html>
