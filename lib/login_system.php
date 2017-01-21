<?php  
  require 'controller/Sesiones.php';
  login();
?>
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

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>

  <script>
            $(document).ready(function() {
                // process the form
                $('#login').submit(function() {
                    if (!$("#ingresar").hasClass( "disabled" )) {
                    // get the form data
                    // there are many ways to get this data using jQuery 
                    // (you can use the class or id also)
                    var data = {
                        'usuario'     : $('input[name=usuario]').val(),
                        'clave'       : $('input[name=clave]').val(),
                        'metodo'      : "crearSesion"
                    };
                    // process the form
                    $.ajax({
                            data:  data,
                            url:   'controller/Usuario.php',
                            type:  'post',

                            beforeSend: function () {
                                    $("#resultado").html("Procesando, espere por favor...");
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                    $('#resultado').attr("class","alert alert-danger");
                                    $('#resultado').html('<o>201:Ocurrio un error </p>');
                                    $('#resultado').show("slow").delay(4000).hide("slow");
                            },
                            success:  function (response,estado,objeto) {
                                   if (response=="Exito") {
                                    $('input[name=usuario]').val("");
                                    $('input[name=clave]').val("");
                                    $('#resultado').html("Ingreso exitoso: por favor espere ...");
                                    $('#resultado').attr("class","alert alert-success");
                                    $('#resultado').show("slow").delay(4000).hide("slow");
                                    setTimeout(function(){window.location.href = "menu_principal.php"}, 1200);

                                    
                                   }
                                   else{
                                     $('#resultado').attr("class","alert alert-danger");
                                     $('#resultado').html("202:Ocurrio un error: ");
                                     $('#resultado').html(response);
                                     $('#resultado').show("slow").delay(4000).hide("slow");
                                   } 
                            },

                    });
                  }
                  event.preventDefault(); 
                });

            });

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

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form id="login" data-toggle="validator" novalidate>
            <h1>Formulario de ingreso</h1>
            <div class="row">
                <div style="display:none" id="resultado"><button class="close" data-dismiss="alert"></button></div>
            </div>
            <div>
              <input type="text" class="form-control" placeholder="Usuario" name="usuario" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Contraseña" name="clave" required="" />
            </div>
            <div>
              <button type="submit" id="ingresar" class="btn btn-default submit disabled" >Ingresar</button>
              <a class="reset_pass" href="#">Tiene problemas para ingresar?</a>
            </div>
            <div class="clearfix"></div>
            <div class="separator">

              <p class="change_link">Nuevo en el sitio?
                <a class="to_register"> Visite nuestro sitio web </a>
              </p>
              <div class="clearfix"></div>
              <br />
              <div>
                <h1><i class="glyphicon glyphicon-glass" style="font-size: 26px;"></i> Mantil Sistema Pos!</h1>
                <p>©2016 Todods los derechos reservados. Mantil.com!. Sitio Protegido, terminos y privacidad</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>      
    </div>
  </div>
  <script src="js/validator.min.js"></script>
   <!-- pace -->
        <script src="js/pace/pace.min.js"></script>

        <script>
          var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
            showLeftPush = document.getElementById( 'showLeftPush' ),
            body = document.body;
            
          showLeftPush.onclick = function() {
            classie.toggle( this, 'active' );
            classie.toggle( body, 'cbp-spmenu-push-toright' );
            classie.toggle( menuLeft, 'cbp-spmenu-open' );
            disableOther( 'showLeftPush' );
          };
          
          function disableOther( button ) {
            if( button !== 'showLeftPush' ) {
              classie.toggle( showLeftPush, 'disabled' );
            }
        }
        </script>
</body>

</html>
