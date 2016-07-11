<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Mantil Sistema Pos | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">
  <style type="text/css">
    
  </style>
  <style type="text/css">
    #login_user {
    right: 0px;
    margin: 0px auto;
    margin-top: 5%;
    max-width: 800px;
    position: relative;
}
<style type="text/css">     

      /***** radio-box *****/
      /* radio-box grupo 01*/
      li.radio_01 { width: auto;}

      li.radio_01 input[type=radio] { display: none;}
      li.radio_01 input[type=radio] + label { 
        color: #000; 
        display: block; 
        float: left;
        width: auto; 
        height: 143px;
        text-indent: -1000em;
        align:center;
      }

      li.radio_01 input[type=radio].primero + label       { background: url(images/radio_01.png) 0px 0px no-repeat; width: 140px; }
      li.radio_01 input[type=radio].primero:checked + label   { background: url(images/radio_01.png) 0px -140px no-repeat; }

      li.radio_01 input[type=radio].ultimo + label      { background: url(images/radio_01.png) 100% 0px no-repeat; width: 140px; }
      li.radio_01 input[type=radio].ultimo:checked + label  { background: url(images/radio_01.png) 100% -140px no-repeat; }

      </style>
  </style>

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <script type="text/javascript">
            
                 function toggle2(elemento) {
                if(elemento.value=="Administrador") {
                    document.getElementById("opc_admin").style.display = "block";
                    document.getElementById("opc_empl").style.display = "none";
                    

                 }else if(elemento.value=="Empleado"){
                         document.getElementById("opc_admin").style.display = "none";
                         document.getElementById("opc_empl").style.display = "block";
                      
                     
                 }

            }

      </script>


  <script src="js/jquery.min.js"></script>

      <script type="text/javascript">            
                 

      </script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#ededed;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    
    <div id="login_user">
     <div class="row">
      <div class="x_panel">
                <h2>Formulario de ingreso</h2>    
                 <div class="form-group">
                    <div class="row" align="center">
                        <div class="col-md-6 grid_box1">
                                 <ul class="list-inline">
                                     <li class="radio_01"> 
                                     <input type="radio" name="radio_01"  id="radio_01_01" class="primero"
                                      onclick="toggle2(this)" value="Empleado" checked="true" /><label  for="radio_01_01">&#160;</label>
                                      <hr> <h4>Usuario</h4>
                                     </li> 
                                 </ul>
                        </div>
                        <div class="col-md-6">
                                    <ul class="list-inline">
                                      <li class="radio_01"> 
                                        <input type="radio" name="radio_01"  id="radio_02_01"class="ultimo" 
                                        onclick="toggle2(this)" value="Administrador" /><label for="radio_02_01">&#160;</label>
                                         <hr><h4>Administrador </h4>
                                      </li> 
                                    </ul>   
                        </div>
                      <div class="clearfix"> </div>
                    </div>
                  </div>  <hr>


                  <div  id="opc_admin" style="display:none" class="form-group">
                    <div class="row">
                        <div class="col-md-12 grid_box1">      
                                <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i>user
                                                          </a>                                                       
                                            </label>
                                            <label  class="label-image active" >                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-orange">32</span>
                                                            <i class="fa fa-user"></i> Users
                                                          </a>                                                       
                                            </label>
                                            <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>                
                                                            <i class="fa fa-user"></i> Users
                                                          </a>                                                       
                                            </label>
                        </div>
                        <div class="clearfix"> </div>
                      </div>
                  </div>




                  <div id="opc_empl" style="display:block" class="form-group">
                      <div class="row">
                          <div class="col-md-12 btn-group">                               
                                    <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>
                                     <label  class="label-image active">                                                         
                                                          <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                                            <span class="badge bg-green">211</span>
                                                            <i class="fa fa-user"></i> User
                                                          </a>                                                       
                                     </label>      
                              
                          </div>                          
                          <div class="clearfix"> </div>
                        </div>
                  </div>             

                  <!-- /modals -->
                    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" align="center">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Clave de acceso</h4>
                            </div>

                              <br><label  class="label-image active">                                                         
                                    <a class="btn btn-app" data-toggle="modal" data-target=".bs-example-modal-sm">
                                      <span class="badge bg-green">211</span>
                                      <i class="fa fa-user"></i> User
                                    </a>                                                       
                              </label>

                               <div class="form-group">
                                  <div class="row">
                                      <div class="col-md-12  form-group has-feedback">
                                          <input type="password" class="form-control has-feedback-left" id="inputSuccess2" placeholder="Clave de ingreso">
                                          <span class="fa fa-unlock-alt form-control-feedback left" aria-hidden="true"></span>
                                        </div>                 
                                    </div>
                              </div>

                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-success">Ingresar</button>
                            </div>

                          </div>
                        </div>
                    </div>
                    <!-- /modals -->

      </div>  

    </div>
  </div>
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
