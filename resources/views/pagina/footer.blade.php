<!-- footer section start -->
<footer class="footer-area footer-layout1 ">


    <!-- Footer Widget Area -->
    <div class="footer-wid-wrap pt-100 pb-100">
        <div class="container">
            <div class="row">
                <!-- Single Widget -->
                <div class="col-sm-6 col-lg-3 col-xl-3 ">
                    <div class="widget footer-widget widget_contact">
                        <!-- title -->
                        <h3 class="widget_title">Contáctanos</h3>
                         @if($empresa->telefono_1 !="")
                            <p><i class="fas fa-phone-alt"></i><a href="tel:+{{ $empresa->telefono_1 }}">{{ $empresa->telefono_1 }}</a></p>
                        @endif
                         @if($empresa->telefono_2 !="")
                            <p><i class="fas fa-phone-alt"></i><a href="tel:+{{ $empresa->telefono_2 }}">{{ $empresa->telefono_2 }}</a></p>
                        @endif


                        <p><i class="fal fa-envelope"></i><a href="mailto:{{ $empresa->email_contacto }}">{{ $empresa->email_contacto }}</a></p>
                        <p class="d-flex"><i class="far fa-map-marker-alt"></i><span>{{ $empresa->direccion_1 }} @if($empresa->direccion_2 != "" || $empresa->direccion_3 != ""),@endif {{ $empresa->direccion_2 }} @if($empresa->direccion_3 != ""),@endif {{ $empresa->direccion_3 }}</span></p>
                    </div>
                </div>


                <!-- Single Widget -->
                <div class="col-sm-6 col-lg-3 col-xl-2 ">
                    <div class="widget footer-widget widget-links">
                        <!-- Title --><a href="{{ route('pagina.contacto') }}">
                        <h3 class="widget_title">Horario de atención</h3>
                        <ul>
                            <li style="color:white;">Horario de atención</li>
                            <li style="color:white;">Lunes a viernes </li>
                            <li style="color:white;">10 am - 7 pm</li>

                            
                        </ul>
                        </a>
                    </div>
                </div>

                <!-- Single Widget -->
                <div class="col-sm-6 col-lg-3 col-xl-3 ">
                    <div class="widget footer-widget widget-links">
                        <!-- Title -->
                        <a href="{{ route('pagina.contacto') }}">
                        <h3 class="widget_title">Bolsa de trabajo</h3>
                        <ul>
                            <li style="color:white;">Si estás interesado en ser parte de nuestro equipo de trabajo en Nikko, ponemos a tu disposición los siguientes medios de contacto:</li>
                            <li style="color:white;">{{ $empresa->telefono_3 }}</li>
                            <li style="color:white;">rh@nikkoauto.mx</li>

                            
                        </ul>
                        </a>
                    </div>
                </div>


                <!-- Single Widget  -->
                <div class="col-sm-6 col-lg-3 col-xl-3 ">
                    <div class="widget footer-widget widget-links">
                     <ul>
                            <li style="color:white;"><a href="{{ route('pagina.aviso') }}">Aviso de privacidad</a></li>
                            <li style="color:white;"><a href="{{ route('pagina.terminos') }}">Terminos y condiciones</a></li>

                            
                    </ul>
                </div>
                <br>
                    <div class="footer-widget widget-map h-100">
                        <div class="google-map" id="footer-map"></div>
                    </div>
                </div>



            </div><!-- row END -->
        </div>
    </div>
    <!-- Footer Widget Area end -->


    <!-- Copyright Area -->
    <div class="copyright-area">
        <div class="container">
            <div class="row align-items-center">
                <!-- Logo -->
                <div class="col-md-3 col-lg-3">
                    <div class="copyright-logo d-none d-md-block">
                        <a href="#"><img class="el_logo" src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}" alt="Footer Logo"></a>
                    </div>
                </div>

                <!-- Copyright -->
                <div class="col-md-9 col-lg-6 text-center text-md-right text-lg-center">
                    <div class="copyright">
                        <p class="text">&copy; {{ date('Y') }} <a href="#">Nikko Autoparts.</a> Todos los derechos reservados.</p>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="col-lg-3 text-right">
                    <div class="social-links d-none d-lg-block">
                        <ul>
                             @if($empresa->url_facebook != "")
                                <li><a href="{{ $empresa->url_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            @endif
                            @if($empresa->url_twitter != "")
                                  <li><a href="{{ $empresa->url_twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            @endif
                            @if($empresa->url_instagram != "")
                                 <li><a href="{{ $empresa->url_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            @endif
                              @if($empresa->url_youtube != "")
                                 <li><a href="{{ $empresa->url_youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
                            @endif


                            
                           
                            
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Copyright Area end -->


</footer>
<!-- footer section end -->



<!-- scroll to top -->
<a href="#" class="scrollToTop"><i class="move"></i></a>



<!-- Sidemenu Area -->
<div class="sidemenu-wrapper d-none d-lg-block ">
    <div class="sidemenu-content">
        <!-- Close Button -->
        <button class="closeButton sideMenuCls"><i class="far fa-times"></i></button>
        <!-- Single Widget -->
        <div class="widget sidemenu-widget widget_about mb-0">
            <a href="#"><img class="el_logo" src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}" alt="Logo"></a>
            <p class="about-text">Centro de Distribución Nikko con más de 50 años de experiencia, es una empresa dedicada a la importación y comercialización en el mercado de autopartes.</p>
        </div>1
        <!-- Single Widget -->
        <div class="widget sidemenu-widget widget_contact">
            @if($empresa->telefono_1 !="")
                <p><i class="fas fa-phone-alt"></i><a href="tel:+{{ $empresa->telefono_1 }}">{{ $empresa->telefono_1 }}</a></p>
            @endif
             @if($empresa->telefono_2 !="")
                <p><i class="fas fa-phone-alt"></i><a href="tel:+{{ $empresa->telefono_2 }}">{{ $empresa->telefono_2 }}</a></p>
            @endif
             @if($empresa->telefono_3 !="")
                <p><i class="fas fa-phone-alt"></i><a href="tel:+{{ $empresa->telefono_3 }}">{{ $empresa->telefono_3 }}</a></p>
            @endif
            <p><i class="fal fa-envelope"></i><a href="mailto:{{ $empresa->email_contacto }}">{{ $empresa->email_contacto }}</a></p>
            <p class="d-flex"><i class="far fa-map-marker-alt"></i><span>{{ $empresa->direccion_1 }} @if($empresa->direccion_2 != "" || $empresa->direccion_3 != ""),@endif {{ $empresa->direccion_2 }} @if($empresa->direccion_3 != ""),@endif {{ $empresa->direccion_3 }}</span></p>
        </div>
    </div>
</div>
<!-- Sidemenu Area end -->

