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

  </script> 
<!-- top Menu navigation-->
      <div class="top_nav">

        <div class="nav_menu">
          <nav class="" role="navigation">
            <div class="nav toggle">
              <a href="menu_principal.php" id="menu_toggle"><i class="fa fa-home"></i></a>
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

      <!-- PNotify -->
  <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>

  <script>
    $(function() {
      var cnt = 10; //$("#custom_notifications ul.notifications li").length + 1;
      TabbedNotification = function(options) {
        var message = "<div id='ntf" + cnt + "' class='text alert-" + options.type + "' style='display:none'><h2><i class='fa fa-bell'></i> " + options.title +
          "</h2><div class='close'><a href='javascript:;' class='notification_close'><i class='fa fa-close'></i></a></div><p>" + options.text + "</p></div>";

        if (document.getElementById('custom_notifications') == null) {
          alert('doesnt exists');
        } else {
          $('#custom_notifications ul.notifications').append("<li><a id='ntlink" + cnt + "' class='alert-" + options.type + "' href='#ntf" + cnt + "'><i class='fa fa-bell animated shake'></i></a></li>");
          $('#custom_notifications #notif-group').append(message);
          cnt++;
          CustomTabs(options);
        }
      }

      CustomTabs = function(options) {
        $('.tabbed_notifications > div').hide();
        $('.tabbed_notifications > div:first-of-type').show();
        $('#custom_notifications').removeClass('dsp_none');
        $('.notifications a').click(function(e) {
          e.preventDefault();
          var $this = $(this),
            tabbed_notifications = '#' + $this.parents('.notifications').data('tabbed_notifications'),
            others = $this.closest('li').siblings().children('a'),
            target = $this.attr('href');
          others.removeClass('active');
          $this.addClass('active');
          $(tabbed_notifications).children('div').hide();
          $(target).show();
        });
      }

      CustomTabs();

      var tabid = idname = '';
      $(document).on('click', '.notification_close', function(e) {
        idname = $(this).parent().parent().attr("id");
        tabid = idname.substr(-2);
        $('#ntf' + tabid).remove();
        $('#ntlink' + tabid).parent().remove();
        $('.notifications a').first().addClass('active');
        $('#notif-group div').first().css('display', 'block');
      });
    })
  </script>
  