@extends('pagina.base')

@section('js')

@endsection

@section('contenido')
    
	<!--breadcumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <!-- Breadcrumb Title -->
                <h1 class="breadcumb-title">Informate</h1>

                <!-- Breadcrumb Menu -->
                <ul>
                    <li><a href="index.html"> Inicio </a></li>
                    <li class="active">Informate</li>
                </ul>
            </div>
        </div>
    </div>
    <!--breadcumb end -->

	<!-- Contact Form -->
    <section class="contact-form-wrapper contact-form-layout3 pt-50 pb-100">
        

        <div class="container">
             <div class="row branch-information-layout2 pb-50" style="background-color: white !important;"> 
                <a href="javascript:history.back()">
                    <div class="info-box">
                        <div class="icon">
                            <span><i class="fal fa-arrow-alt-to-left"></i></span>
                        </div>
                        <div class="content">
                            <span class="info-title" style="color:#0046e2;">Regresar</span>
                        </div>
                    </div>
                </a>
            </div>

            <div class="row justify-content-center">
                <!-- form Area -->
                <div class="col-lg-7 col-xl-8">
                    <div class="contact-form-area secondary-bg2">
                        <h2 class="form-title">Pregúntanos</h2>
                        <h3 class="sub-title">¿En qué podemos ayudarte?</h3>
                        <!-- Contact Form -->
                        <form action="mail.php" class="contact-form" method="POST">
                            <div class="row gutters-20">
                                <!-- Single Input -->
                                <div class="col-md-6 form-group">
                                    <label for="name" class="sr-only">Nombre</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Nombre">
                                </div>
                                <!-- Single Input -->
                                <div class="col-md-6 form-group">
                                    <label for="lastName" class="sr-only">Apellidos</label>
                                    <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Apellidos">
                                </div>
                                <!-- Single Input -->
                                <div class="col-md-6 form-group">
                                    <label for="email" class="sr-only">Correo electrónico</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Correo electrónico">
                                </div>
                                <!-- Single Input -->
                                <div class="col-md-6 form-group">
                                    <label for="number" class="sr-only">Número de teléfono</label>
                                    <input type="number" name="number" id="number" class="form-control" placeholder="Número de teléfono">
                                </div>
                                <!-- Single Input -->
                                <div class="col-12 form-group">
                                    <label for="subject" class="sr-only">Asunto</label>
									<select name="subject" id="subject" class="select2 form-control">
										<option value="0">-- Seleccione --</option>
										<option value="distribuidor">Quiero ser distribuidor</option>
										<option value="queja-comentario">Queja o comentario</option>
										<option value="bolsa-trabajo">Bolsa de trabajo</option>
									</select>
                                </div>
                                <!-- Single Input -->
                                <div class="col-12 form-group">
                                    <label for="message" class="sr-only">Mensaje</label>
                                    <textarea class="form-control" id="message" name="message" placeholder="Escribe tu mensaje"></textarea>
                                </div>
                                <!-- Form Button -->
                                <div class="col-12 form-group mb-0 pt-2">
                                    <button class="primary-btn" type="submit">Enviar mensaje</button>
                                </div>
                            </div>
                        </form>
                        <p class="form-messages"></p>
                        <!-- Contact Form end -->
                    </div>
                </div>
                <!-- form Area end -->

                <!-- Contact information Area -->
                <div class="col-lg-5 col-xl-4">
                    <div class="contact-information-area background-image" data-img="assets/img/contact-us/contact-information-img-1-1.jpg">
                        <!-- Box Area title  -->
                        <div class="area-title">
                            <h4 class="title">Nuestra información</h4>
                            <p class="text">Centro de Distribución Nikko con más de 45 años de experiencia, es una empresa dedicada a la importación y comercialización en el mercado de autopartes.</p>
                        </div>
                        <!-- Information Box -->
                        <div class="info-box">
                            <div class="icon">
                                <span><i class="fal fa-envelope"></i></span>
                            </div>
                            <div class="content">
                                <span>Envíenos un correo</span>
								<p class="text"><a href="mailto:{{ $empresa->contacto_email_1 }}">{{ $empresa->contacto_email_1 }}</a></p>
								<p class="text"><a href="mailto:{{ $empresa->contacto_email_2 }}">{{ $empresa->contacto_email_2 }}</a></p>
								<p class="text"><a href="mailto:{{ $empresa->contacto_email_3 }}">{{ $empresa->contacto_email_3 }}</a></p>
                           </div>
                        </div>
                        <!-- Information Box -->
                        <div class="info-box">
                            <div class="icon">
                                <span><i class="fas fa-phone-alt"></i></span>
                            </div>
                            <div class="content">
                                <span>Ponte en contácto</span>
                                <p class="text"><a href="tel:+52{{ $empresa->contacto_telefono_1 }}">{{ $empresa->contacto_telefono_1 }}</a></p>
								<p class="text"><a href="tel:+52{{ $empresa->contacto_telefono_2 }}">{{ $empresa->contacto_telefono_2 }}</a></p>
								<p class="text"><a href="tel:+52{{ $empresa->contacto_telefono_3 }}">{{ $empresa->contacto_telefono_3 }}</a></p>
                            </div>
                        </div>
                        <!-- Information Box -->
                        <div class="info-box">
                            <div class="icon">
                                <span><i class="fal fa-map-marker-alt"></i></span>
                            </div>
                            <div class="content">
                                <span>Nuestra ubicación</span>
								<p class="text">{{ $empresa->contacto_direccion_1 }}</p>
								<p class="text">{{ $empresa->contacto_direccion_2 }} </p>
								<p class="text">{{ $empresa->contacto_direccion_3 }} </p>
                            </div>
                        </div>
                        <!-- Information Box -->
                        <div class="info-box">
                            <div class="icon">
                                <span><i class="fal fa-clock"></i></span>
                            </div>
                            <div class="content">
                                <span>Horas laborales</span>
								<p class="text">{{ $empresa->contacto_horario_1 }}</p>
								<p class="text">{{ $empresa->contacto_horario_2 }}</p>
								<p class="text">{{ $empresa->contacto_horario_3 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Contact information Area end -->
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section>
    <!-- Contact Form end -->

	<!-- Google Map Area -->
    <div class="contact-map-wrap ">
        <div class="contact-map" id="google-map"></div>
    </div>
    <!-- Google Map Area end -->

@endsection