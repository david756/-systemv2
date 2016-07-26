<script>
            $(document).ready(function() {
                notificacionesBarra();  
                $.ajax({
                   type   : 'POST',
                   url    : 'controller/Usuario.php',
                   data  : {metodo: "datosUsuario"},
                   dataType : 'json',
                   success  : function(data){
                      $('#usernameUser1').html(data.username);
                  },
                   error  : function(data){
                    console.log(data);
                  }
               });
            });
</script>
<script>
        function salidaSegura(){

          console.log("salidaSegura");
                var data = {                        
                    'metodo'      : "cerrarSesion"
                };
                // process the form
                $.ajax({
                        data:  data,
                        url:   'controller/Usuario.php',
                        type:  'post',
                        error: function(jqXHR, textStatus, errorThrown) {
                             new PNotify({title: 'Oh No!', text: 'error fatal. No se cerro sesion',
                            type: 'error'});  
                        },
                        success:  function (response,estado,objeto) {                                
                               if (response=="Exito") {                                   
                                  window.location.href = "login_system.php"}
                                else{
                                   new PNotify({title: 'Oh No!',text: response,type: 'error'});
                                }                                   
                        },

                });
              }

          function notificacionesBarra(){         
                  $.post("controller/Usuario.php", 
                  {metodo: "notificacionesBarra"}
                  ,function(tabla){
                    $('#menu1').html(tabla);
                    var total= $("#menu1 li").size()-1;
                    $('#totalNotificaciones').html(total);
                  }
                  );
      }

  </script> <!-- top Menu navigation-->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="images/userMale.png" alt=""><span id="usernameUser1"></span>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                  <li><a href="perfil_usuario.php">  Perfil</a>
                  </li>
                  <li><a onclick="salidaSegura()"><i class="fa fa-sign-out pull-right"></i> Salida Segura</a>
                  </li>
                </ul>
              </li>

              <li role="presentation" class="dropdown">
                <a href="javascript:;" class="dropdown-toggle info-number" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell-o"></i>
                  <span class="badge bg-green" id="totalNotificaciones"></span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  
                </ul>
              </li>

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top Menu navigation -->