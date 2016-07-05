<!DOCTYPE html>
<html lang="en">

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

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

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
                    Perfil de usuario
              </h3>
            </div>
          </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12">
              <div class="x_panel">
                <!-- x_content-->                
                <div class="x_content">
                        <div class="col-md-3 col-sm-3 col-xs-12 profile_left">

                            <div class="profile_img">
                                <a href=""><img src="images/usuario.png" WIDTH=120 HEIGHT=120 class="img-responsive" alt="Responsive image"></a>
                            </div>
                            <h3>Juan12</h3>
                            <ul class="list-unstyled user_data">
                              <li><i class="fa fa-map-marker user-profile-icon"></i> Juan David Gomez</li>  
                              <li><i class="fa fa-briefcase user-profile-icon"></i> 3113254578</li>   
                              <li class="m-top-xs">
                                <i class="fa fa-external-link user-profile-icon"></i>
                                <a href="http://www.kimlabs.com/profile/" target="_blank">www.mantil.com</a>
                              </li>
                            </ul>

                            <a class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalPerfil"><i class="fa fa-edit m-right-xs"></i>Editar Perfil</a>
                            <a class="btn btn-default btn-sm"  data-toggle="modal" data-target="#ModalClave"><i class="fa fa-edit m-right-xs"></i>Cambiar contraseña</a><hr>
                            <br />

                            <!-- start skills -->
                            <h4>Habilidades</h4>
                            <ul class="list-unstyled user_data">
                              <li>
                                <p>Rendimiento</p>
                                <div class="progress progress_sm">
                                  <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="60"></div>
                                </div>
                              </li>                              
                            </ul>
                            <!-- end of skills -->
                          </div>

                          <div class="col-md-9 col-sm-9 col-xs-12">

                            <div class="profile_title">
                              <div class="col-md-6">
                                <h2>Reporte de actividad de usuario</h2>
                              </div>
                            </div>
                            <!-- start of user-activity-graph -->
                            <div id="graph_bar" style="width:100%; height:280px;"></div>
                            <!-- end of user-activity-graph -->

                            <div class="" role="tabpanel" data-example-id="togglable-tabs">
                              <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Notificaciones</a>
                                </li>
                              </ul>
                              <div id="myTabContent" class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                <br><button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#ModalNuevoMsj"><i class="fa fa-bell"></i> Nueva Notificación</button><hr>
                                  <!-- start recent activity -->
                                  <ul class="messages list-unstyled top_profiles scroll-view">
                                    <li class="media event">
                                      <a class="pull-left border-aero profile_thumb">
                                        <i class="fa fa-user green"></i>
                                      </a>
                                      <div class="message_wrapper">
                                        <b>Usuario 1</b>
                                        <p> <small>20-octubre-2016  12:02 pm</small></p>
                                        <h5>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</h5>
                                        <br />
                                      </div>
                                    </li>
                                    <li class="media event">
                                      <a class="pull-left border-aero profile_thumb">
                                        <i class="fa fa-user green"></i>
                                      </a>
                                      <div class="message_wrapper">
                                        <b>Usuario 1</b>
                                        <p> <small>20-octubre-2016  12:02 pm</small></p>
                                        <h5>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</h5>
                                        <br />
                                      </div>
                                    </li>
                                    <li class="media event">
                                      <a class="pull-left border-aero profile_thumb">
                                        <i class="fa fa-user green"></i>
                                      </a>
                                      <div class="message_wrapper">
                                        <b>Usuario 1</b>
                                        <p> <small>20-octubre-2016  12:02 pm</small></p>
                                        <h5>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth.</h5>
                                        <br />
                                      </div>
                                    </li>                                   
                                  </ul>
                                  <!-- end recent activity -->
                                </div>
                              </div>
                            </div>
                          </div>
                </div>

                  <!-- /modal editar Perfil -->
                    <div class="modal fade bs-example-modal-lg" id="ModalPerfil" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Cambiar su información de Perfil</h4>
                            </div>
                            <div class="modal-body">  
                               <form class="form-horizontal form-label-left">
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Nombre</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" value="David Felipe" placeholder="Nombre">
                                        </div>
                                      </div>                                     
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Apellido</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" value="Hernandez" placeholder="Apellidos">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Telefono</label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <input type="text" class="form-control" value="3113142928" placeholder="telefono">
                                        </div>
                                      </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-success">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar Perfil  -->

                    <!-- /modal editar clave -->
                    <div class="modal fade bs-example-modal-lg" id="ModalClave" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Modificar Atencion</h4>
                            </div>
                            <div class="body">
                            <br>
                            <form class="form-horizontal form-label-left">
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Nueva contraseña</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="password" class="form-control" placeholder="Nueva contraseña">
                                      </div>
                                    </div> 
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Repetir contraseña</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="password" class="form-control" placeholder="Repita contraseña">
                                      </div>
                                    </div> 
                                    <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Antigua contraseña</label>
                                      <div class="col-md-9 col-sm-9 col-xs-12">
                                        <input type="password" class="form-control" placeholder="Cntraseña">
                                      </div>
                                    </div> 
                            </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-success">Confirmar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal editar clave  -->

                    <!-- /modal nueva notificacion -->
                    <div class="modal fade bs-example-modal-lg" id="ModalNuevoMsj" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content" align="center">

                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                              </button>
                              <h4 class="modal-title" id="myModalLabel2">Nuevo Mensaje</h4>
                            </div>
                            <div class="modal-body">
                            <form class="form-horizontal form-label-left">
                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Destino: </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <select class="form-control">
                                            <option>Todos</option>
                                            <option>Option one</option>
                                            <option>Option two</option>
                                            <option>Option three</option>
                                            <option>Option four</option>
                                          </select>
                                        </div>
                                    </div><br>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Notificación <span class="required">*</span>
                                        </label>
                                        <div class="col-md-9 col-sm-9 col-xs-12">
                                          <textarea class="form-control" rows="3" placeholder='Escriba aqui el mensaje'></textarea>
                                        </div>
                                    </div>
                            </form><br>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                              <button type="button" class="btn btn-success">Enviar</button>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /modal nueva notificacione  -->

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

    <!-- chart js -->
  <script src="js/chartjs/chart.min.js"></script>
  <!-- moris js -->
  <script src="js/moris/raphael-min.js"></script>
  <script src="js/moris/morris.min.js"></script>

  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script>
    $(function() {
      var day_data = [{
        "period": "Jan",
        "Hours worked": 80
      }, {
        "period": "Feb",
        "Hours worked": 125
      }, {
        "period": "Mar",
        "Hours worked": 176
      }, {
        "period": "Apr",
        "Hours worked": 224
      }, {
        "period": "May",
        "Hours worked": 265
      }, {
        "period": "Jun",
        "Hours worked": 314
      }, {
        "period": "Jul",
        "Hours worked": 347
      }, {
        "period": "Aug",
        "Hours worked": 287
      }, {
        "period": "Sep",
        "Hours worked": 240
      }, {
        "period": "Oct",
        "Hours worked": 211
      }];
      Morris.Bar({
        element: 'graph_bar',
        data: day_data,
        xkey: 'period',
        hideHover: 'auto',
        barColors: ['#26B99A', '#34495E', '#ACADAC', '#3498DB'],
        ykeys: ['Hours worked', 'sorned'],
        labels: ['Hours worked', 'SORN'],
        xLabelAngle: 60
      });
    });
  </script>


</body>

</html>
