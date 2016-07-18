<script>
            $(document).ready(function() {
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
                  <img src="images/img.jpg" alt=""><span id="usernameUser1"></span>
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
                  <span class="badge bg-green">6</span>
                </a>
                <ul id="menu1" class="dropdown-menu list-unstyled msg_list animated fadeInDown" role="menu">
                  <li>
                    <a>
                      <span class="image">
                                        <img src="images/img.jpg" alt="Profile Image" />
                                    </span>
                      <span>
                                        <span>John Smith</span>
                      <span class="time">3 mins ago</span>
                      </span>
                      <span class="message">
                                        Film festivals used to be do-or-die moments for movie makers. They were where...
                                    </span>
                    </a>
                  </li>                  
                  <li>
                    <div class="text-center">
                      <a>
                        <strong>Ver todas las alertas</strong>
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </div>
                  </li>
                </ul>
              </li>

            </ul>
          </nav>
        </div>
      </div>
      <!-- /top Menu navigation -->