<!DOCTYPE html>
<html lang="en">
  
<head>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
{{-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-216942491-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-216942491-1');
</script> --}}
	
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nikko Autoparts - Centro de Distribución Mayorista en Autopartes</title>
  <meta name="author" content="Nikko Autopartes">
  <meta name="description" content="Nikko Autopartes">
  <meta name="keywords" content="Nikko Autopartes" />
  <meta name="robots" content="INDEX,FOLLOW">

  <!-- Mobile Specific Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Google Web Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- Favicons - Place favicon.ico in the root directory -->
  <link rel="icon" type="image/png" href="{{ asset('pagina/assets/img/favicons/favicon.png') }}">
  
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="pagina/assets/img/favicons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">


  <!-- Css Files -->
  {{ Html::style('pagina/assets/css/bootstrap.min.css') }}
  {{ Html::style('pagina/assets/css/flaticon.min.css') }}
  {{ Html::style('pagina/assets/css/fontawesome.min.css') }}
  {{ Html::style('pagina/assets/css/select2.min.css') }}
  {{ Html::style('pagina/assets/css/aos.min.css') }}
  {{ Html::style('pagina/assets/css/jquery.fancybox.min.css') }}
  {{ Html::style('pagina/assets/css/slick.min.css') }}
  {{ Html::style('pagina/assets/css/layerslider.min.css') }}
  {{ Html::style('pagina/assets/css/jquery.datetimepicker.min.css') }}
  {{ Html::style('pagina/assets/css/style.css') }}
  {{ Html::style('pagina/assets/css/nikko.css') }}
  {{ Html::style('pagina/assets/css/responsive.min.css') }}
  {{ Html::style('assets/rotate/tikslus360.css') }}




   <style type="text/css">
     .modal input{
        border:1px solid #00587c !important;
     }

     .breadcumb-layout1 .breadcumb-content {
        padding-top: 80px;
        padding-bottom: 80px;
        position: relative;
    }
    .autocomplete-suggestions { -webkit-box-sizing: border-box; -moz-box-sizing: border-box; box-sizing: border-box; border: 1px solid #999; background: #FFF; cursor: default; overflow: auto; -webkit-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); -moz-box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); box-shadow: 1px 4px 3px rgba(50, 50, 50, 0.64); }
    .autocomplete-suggestion { padding: 2px 5px; white-space: nowrap; overflow: hidden; }
    .autocomplete-no-suggestion { padding: 2px 5px;}
    .autocomplete-selected { background: #F0F0F0; }
    .autocomplete-suggestions strong { font-weight: bold; color: #000; }
    .autocomplete-group { padding: 2px 5px; font-weight: bold; font-size: 16px; color: #000; display: block; border-bottom: 1px solid #000; }
   </style>
  @yield('css')

   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
   <!--[if lt IE 9]>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
     <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
   <![endif]-->
  </head>
  <body>

    <!-- Preloader -->
    <div class="preloader ">
      <div class="meter">
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
          <div class="line"></div>
          <div class="subline"></div>
          <div class="subline"></div>
          <div class="subline"></div>
          <div class="subline"></div>
          <div class="subline"></div>
          <div class="loader-circle-1">
              <div class="loader-circle-2"></div>
          </div>
          <div class="needle"></div>
          <span class="loadtext">Cargando</span>
      </div>
  </div>
  <!-- Preloader end -->
	  
   
   <!--// Main Wrapper \\-->
   <div class="automechanic-main-wrapper">
		@include('pagina.header')
		@yield('contenido')
		@include('pagina.footer')
	   <div class="clearfix"></div>
   </div>
   <!--// Main Wrapper \\-->

   <!-- LoginModal -->
    <div class="loginmodal modal fade in" id="signUpModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document" style="width: 460px;">
            <div class="automechanic-login-box">
                <a href="#" data-dismiss="modal" class="automechanic-login-close"><i class="fa fa-times"></i></a>
                 <div class="automechanic-marca" style="text-align: center;">
                    <h2>INICIAR SESIÓN</h2>
                </div>
                <form>
                    <input placeholder="E-mail" type="text" name="email">
                    <input type="password" placeholder="Contraseña" name="password">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                    <div class="clearfix"></div>
                    <label><input value="Ingresar" type="submit"></label>
                </form>
                
            </div>
        <div class="clearfix"></div>
        </div>
    </div>

    <div class="modal ventanaEmergente" id="emergente" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
                 @if(isset($empresa))
                {!! $empresa->pop_up !!}
                @endif
            </div>
             <div class="modal-footer">
                <button type="button" class="primary-btn type2" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
        </div>
      </div>




      <div class="modal ventanaDistribuidor" id="distribuidor" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header justify-content-center">
              <img src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}">
            </div>
            <div class="modal-body">
                 @if(isset($empresa))
                {!! $empresa->distribuidor !!}
                @endif
            </div>
            <div class="modal-footer text-center justify-content-center">
                <a href="{{ route('pagina.contacto') }}" class="primary-btn hover-white">Quiero dejar mis datos para que me contacten</a>
            </div>
          </div>
        </div>
      </div>

 


  <div class="loginmodal modal fade" id="registroModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document" style="width:600px;">
            <div class="automechanic-login-box">
                <a href="#" data-dismiss="modal" class="automechanic-login-close"><i class="fa fa-times"></i></a>
                <div class="automechanic-marca" style="text-align: center;">
                    <h2>REGISTRO</h2>
                </div>
                
              <div class="col-md-12 resultado_registro">
                <form id="form-registro">
                  <div class="form-group row">
                <label class="col-md-3 col-form-label">Clave*</label>
                <div class="col-md-9">
                  <input type="text" placeholder="Clave" name="clave" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Razón Social*</label>
                <div class="col-md-9">
                  <input type="text" value="" placeholder="Razon social" name="razon_social" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Nombre*</label>
                <div class="col-md-9">
                  <input type="text" value="" placeholder="Nombre" name="nombre" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">E-mail*</label>
                <div class="col-md-9">
                  <input type="text" value="" placeholder="E-mail" name="email" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Password*</label>
                <div class="col-md-9">
                  <input type="password" value="" placeholder="Password" name="password" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Confirmar password*</label>
                <div class="col-md-9">
                  <input type="password" value="" placeholder="Confirmar password" name="confirmar_password" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Teléfono*</label>
                <div class="col-md-9">
                   <input type="text" value="" placeholder="Teléfono" name="telefono" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <div class="col-md-1">
                    <input class="form-check-input" type="checkbox" id="terminos_condiciones" name="termino_condiciones" required>
                  </div>
                  <div class="col-md-11">
                    <label class="form-check-label terminos" for="termino_condiciones">Acepto términos y condiciones</label>
                  </div>
                  
                </div>
                
              </div>
                      <div class="clearfix"></div>
                      <div class="automechanic-marca enviando_registro">
                        <label class="send-label" style="float: right; width: 35% !important;"><input type="submit" value="Crear cuenta" id="boton_registro"></label>
                      </div>
                      
                  </form>
              </div>
            </div>
        <div class="clearfix"></div>
        </div>
    </div>


    <div class="loginmodal modal fade" id="curriculum" tabindex="-1" role="dialog" >
        <div class="modal-dialog" role="document" style="width:800px;">
            <div class="automechanic-login-box">
                <a href="#" data-dismiss="modal" class="automechanic-login-close"><i class="fa fa-times"></i></a>
                <div class="automechanic-marca" style="text-align: center;">
                    <h2>TRABAJA CON NOSOTROS</h2>
                    <h4>INGRESA TU CV</h4>
                </div>
                
              <div class="col-md-12">
                <form id="form-cv">
                  <div class="form-group row">
                <label class="col-md-3 col-form-label">Nombre*</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Correo electrónico*</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Teléfono celular*</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Lugar de residencia*</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Profesión*</label>
                <div class="col-md-9">
                   <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Lugar de residencia</label>
                <div class="col-md-9">
                  <select type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                             <option></option>
                           </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Áreas de interés</label>
                <div class="col-md-9">
                  <select type="text" value="- Todos- " onblur="if(this.value == '') { this.value ='- Todos- '; }" onfocus="if(this.value =='') { this.value = ''; }">
                             <option>- Todos -</option>
                           </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Adjunta tu CV*</label>
                <div class="col-md-9">
                  <input type="file" class="upload-file">
                </div>
              </div>
                      <div class="clearfix"></div>
                      <div class="automechanic-marca">
                        <label class="send-label" style="float: right; width: 35% !important;"><input type="submit" value="Enviar"></label>
                      </div>
                      
                  </form>
              </div>
            </div>
        <div class="clearfix"></div>
        </div>
    </div>



    <div class="loginmodal modal fade" id="modal_contacto" tabindex="-1" role="dialog" >
        <div class="modal-dialog modal-sm" role="document">
            <div class="automechanic-login-box">
                <a href="#" data-dismiss="modal" class="automechanic-login-close"><i class="fa fa-times"></i></a>
                <div class="automechanic-marca" style="text-align: center;">
                    <h2>CONTACTANOS</h2>
                </div>
                
              <div class="col-md-12">
                <form id="form-cv">
                  <div class="form-group row">
                <label class="col-md-3 col-form-label">Nombre*</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Teléfono</label>
                <div class="col-md-9">
                  <input type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Mensaje*</label>
                <div class="col-md-9">
                  <textarea style = "margin: 0px; width:100%;height: 122px;" type="text" value="" onblur="if(this.value == '') { this.value =''; }" onfocus="if(this.value =='') { this.value = ''; }"></textarea>
                </div>
              </div>
                      <div class="clearfix"></div>
                      <div class="automechanic-marca" style="margin:0px;">
                        <label class="send-label" style="float: right; width: 35% !important;"><input type="submit" value="Enviar"></label>
                      </div>
                  </form>
              </div>
            </div>
        <div class="clearfix"></div>
        </div>
    </div>

   <!-- jQuery (necessary for JavaScript plugins) -->
    {{ Html::script('https://maps.googleapis.com/maps/api/js?key=AIzaSyCIzmm8tCuVeoLw-Vnd6Tt1NzUd57GUHjA') }}
    {{ Html::script('pagina/assets/js/vendor/jquery-1.12.4.min.js') }}
    {{ Html::script('pagina/assets/js/custom.js') }}
    {{ Html::script('pagina/assets/js/slick.min.js') }}
    {{ Html::script('pagina/assets/js/bootstrap.min.js') }}
    {{ Html::script('pagina/assets/js/waypoints.min.js') }}
    {{ Html::script('pagina/assets/js/jquery.counterup.min.js') }}
    {{ Html::script('assets/js/jquery.autocomplete.js') }}
    {{ Html::script('assets/rotate/tikslus360.js') }}
    {{ Html::script('pagina/assets/js/select2.min.js') }}
    {{ Html::script('pagina/assets/js/jquery.fancybox.min.js') }}
    {{ Html::script('pagina/assets/js/greensock.min.js') }}
    {{ Html::script('pagina/assets/js/layerslider.transitions.js') }}
    {{ Html::script('pagina/assets/js/layerslider.kreaturamedia.jquery.js') }}
    {{ Html::script('pagina/assets/js/jquery.datetimepicker.min.js') }}
    {{ Html::script('pagina/assets/js/circle-progress.min.js') }}
    {{ Html::script('pagina/assets/js/aos.min.js') }}
    {{ Html::script('pagina/assets/js/imagesloaded.pkgd.min.js') }}
    {{ Html::script('pagina/assets/js/isotope.pkgd.min.js') }}
    {{ Html::script('pagina/assets/js/vscustom-carousel.min.js') }}
    {{ Html::script('pagina/assets/js/ajaxmail.js') }}
    {{ Html::script('pagina/assets/js/main.js') }}
    {{ Html::script('js/jquery.zoom.js') }}


  
	
   {{ Html::script('pagina/script/functions.js') }}


  <script type="text/javascript">
     

      $('input[name="query"]').devbridgeAutocomplete({
          serviceUrl: '{{ route('pagina.autocompletar') }}',
          minChars: 2,
          noCache: true,
          onSelect: function (suggestion) {
              $('#invocacion').val(1);
          }
      });

      //console.log($('.nueco_select'));
      var $filtros = ["ano","marca","modelo","motor","grupo","familia"];
      var $variables = ["anos","marcas","modelos","motores","grupos","familias"];
      var $nombre = ["AÑO","ARMADORA","MODELO","MOTOR","GRUPO","FAMILIA"];

                       
                 
      $('.nueco_select').on('select2:opening', function (e) {
        $(this).find("option[value='0']").remove();
         $(this).val(null);

          //console.log(e);
      });

      $('.nueco_select').on("select2:select",function (e) {
          $(this).find("option[value='0']").remove();
          var $formulario = {
              pagina:0,
              ano:$("#ano").val(),
              marca:$("#marca").val(),
              modelo:$("#modelo").val(),
              motor:$("#motor").val(),
              grupo:$("#grupo").val(),
              familia:$("#familia").val()
          };

          var identificador = $(this).attr('id');
          var indice = $filtros.indexOf(identificador);
          for (var i = indice+1; i  <  $filtros.length ; i++) {
              $formulario[$filtros[i]] = "0";
          }

           $.get('{{ route('pagina.filtros') }}',$formulario,function(data) {
              
              var data = jQuery.parseJSON(data);
              var indice = $filtros.indexOf(identificador);

              for (var i = indice+1; i  <  $filtros.length ; i++) {
                      
                      $("#"+$filtros[i]).html("<option value='0'>"+$nombre[i]+"</option>");
                      $.each(data[$variables[i]], function(index, val) {
                         if(val != "null")
                          $("#"+$filtros[i]).append("<option value='"+val+"'>"+val+"</option>");
                      });
                      $("#"+$filtros[i]).append("<option value='todos'>TODOS</option>");
                      $("#"+$filtros[i]).select2('destroy');
                      $("#"+$filtros[i]).select2();
                 

              }

           });
      });
      <?php 
        $busque_query = isset($_GET['query']) ? $_GET['query'] : "";  
      ?>
      @if(\Request::route()->getName() == "pagina.resultados" && $busque_query == "")
          var nuecos = $('.nueco_select');
          $(nuecos[0]).trigger('change');
      @endif   
     
      $('.video-btn.especial').click(function(event) {
        /* Act on the event */
        $(this).css('width','0px');
        $('.sidebar').css('width','auto');
      });


  </script>

    <script type="text/javascript">
      
      $(document).ready(function() {
          
           $('#boton_registro').click(function(event) {
             /* Act on the event */
             $('.enviando_registro').html('Espera un momento...');
             $.get('{{ route('usuarios_registrados.nuevo_registro') }}', $('#form-registro').serialize() ,function(data) {
                if(data.code)
                  $('.resultado_registro').html('<p>Tu registro a sido guardado exitosamente.</p><p>Recibiras un e-mail despues de que confirmemos tu registro.<p>');
                else
                  $('.resultado_registro').html('<p>Ocurrio un error.</p><p>Intentalo mas tarde.<p>');


             });
           });
      });
    </script>

    <script>
                            $('.faq-text.active').closest('.para_abrir').removeClass('collapse').addClass('collapsed');
                            $('.abrir_categoria').click(function (e) {

                              e.preventDefault();
                              $(this).hide();
                              $('.sidebar').css('transform','translate(0)');

                            }); 
                             $('.cerrar_categoria').click(function (e) {

                              e.preventDefault();
                              $('.sidebar').css('transform','translate(-100%,0)');
                              $('.abrir_categoria').show();
                              

                            }); 
                        </script>
   
	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-216942491-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-216942491-1');
</script>
  
	  
   @yield('js')
  </body>

</html>