@extends('web.plantilla.base')
@section('contenido')
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2" style="background-image: url('{{ asset('/upload/gral/contacto.jpg') }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Contacto</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>Contacto</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Contact Info Area -->
        <section class="contact-info-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bx-envelope'></i>
                            </div>

                            <h3>Correo electronico</h3>
                            @if($general->contacto_email_1 != "")
                                <p><a href="mailto:{{ $general->contacto_email_1 }}">{{ $general->contacto_email_1 }}</a></p>
                            @endif
                            @if($general->contacto_email_2 != "")
                                <p><a href="mailto:{{ $general->contacto_email_2 }}">{{ $general->contacto_email_2 }}</a></p>
                            @endif
                            @if($general->contacto_email_3 != "")
                                <p><a href="mailto:{{ $general->contacto_email_3 }}">{{ $general->contacto_email_3 }}</a></p>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bx-map'></i>
                            </div>

                            <h3>Ubicación</h3>
                            <a target="_blank" href="https://waze.com/ul?q=Owari%20Autopartes&navigate=yes">
                            <p>
                                @if($general->contacto_direccion_1 != "")
                                    {{ $general->contacto_direccion_1 }}<br>
                                @endif
                                @if($general->contacto_direccion_2 != "")
                                    {{ $general->contacto_direccion_2 }}<br>
                                @endif
                                @if($general->contacto_direccion_3 != "")
                                    {{ $general->contacto_direccion_3 }}<br>
                                @endif

                            </p>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bxs-phone-call'></i>
                            </div>

                            <h3>Llamanos</h3>
                            @if($general->contacto_telefono_1 != "")
                                <p><a href="tel:{{$general->contacto_telefono_1}}">{{$general->contacto_telefono_1 }}</a></p>
                            @endif
                            @if($general->contacto_telefono_2 != "")
                                <p><a href="tel:{{$general->contacto_telefono_2}}">{{$general->contacto_telefono_2 }}</a></p>
                            @endif
                            @if($general->contacto_telefono_3 != "")
                                <p><a href="tel:{{$general->contacto_telefono_3}}">{{$general->contacto_telefono_3 }}</a></p>
                            @endif


                          
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Info Area -->
        
        <!-- Start Contact Area -->
        <section class="contact-area pb-100">
            <div class="container">
                <div class="section-title">
                    <h2>¿Tienes mas dudas?</h2>
                    <p>Envianos tu mensaje y nos pondremos en contacto contigo.</p>
                </div>

                <div class="contact-form">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" name="name" class="form-control" required data-error="Escribe tu nombre">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" id="email" class="form-control" required data-error="Escribe tu correo electronico">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Telefono/Celular</label>
                                    <input type="text" name="phone_number" id="phone_number" required data-error="Escribe tu numero telefonico" class="form-control">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                          

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Mensaje</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="6" required data-error="Escribe tu mensaje"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn">
                                    Enviar mensaje
                                </button>

                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->

        <!-- Start Map Area -->
        <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3759.8600922827886!2d-99.04762734866978!3d19.5476192419913!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f1e17391ce43%3A0xd9ca0eb852f8e2d3!2sOWARI%20AUTOPARTES!5e0!3m2!1ses-419!2smx!4v1668818079774!5m2!1ses-419!2smx"></iframe>
        </div>
        <!-- End Map Area -->
@stop