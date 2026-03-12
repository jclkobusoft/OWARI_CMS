@extends('pagina.base')
@section('js')
        @if($empresa->habilitar_pop_up)
            <script type="text/javascript">
                $('.ventanaEmergente').modal('show');
            </script>
        @endif

@endsection

@section('css')
    <style type="text/css">
        .automechanic-banner .slick-arrow {
            position: absolute;
            right: 40px;
            top: 45%;
            font-size: 36px;
            margin: -10px 0px 0px;
            cursor: pointer;
            z-index: 1;
            color: #dedede;
        }

        .automechanic-banner .slick-arrow-left.slick-arrow {
            right: auto !important;
            left: 40px;
        }

        .automechanic-banner  .slick-arrow-left.slick-arrow, .widget_search label::before, .automechanic-pagination > ul > li > .previous > span i {
            -webkit-transform: scaleX(-1);
            -moz-transform: scaleX(-1);
            -ms-transform: scaleX(-1);
            -o-transform: scaleX(-1);
            transform: scaleX(-1);
        }
        .automechanic-banner .slick-dots {
            bottom: 18px !important;
        }

        .automechanic-banner .slick-dots li button {
            background-color: #083388;
            border: 2px solid #ffffff;
            border-radius: 8px;
            text-indent: -9999px;
            float: left;
            width: 8px;
            height: 8px;
        }
        .automechanic-banner .slick-dots li.slick-active button {
           background-color: #fff;
        }

        .custom-color span {
            background-color: #{{ $empresa->color_pagina }} !important;
        }
        .boton_conoce_mas:hover{
            color: inherit !important;
        }
        .name_catalogo{
            font-size: 15px !important;
        }
   </style>
@endsection

@section('contenido')
    <!-- Hero Area -->
    <div class="hero-sec-wrapper hero-layout1">
        <div class="hero-slider-active">
                    <!-- Single Hero Slide -->
            @foreach($banner_principal as $banner)
                <div>
                    <a href="{{ $banner->url }}">
                        <img src="{{ asset('upload/banner_principal/'.$banner->imagen) }}" width="100%" alt="Nikko" class="ls-bg">
                    </a>
                </div>
                <!-- Single Hero Slide end -->
            @endforeach
        </div>

    </div>
    <!-- Hero Area end -->
   

    <!-- About Us Section -->
    <section class="about-us-sec about-wrap-layout1 spacing2" id="about">
        <div class="container">
            <div class="row">
                <div class="col-10 offset-md-2">
                    <!-- Title -->
                    <h2 class="about-title">{!! $empresa->titulo_bienvenida !!}</h2>
                </div>
                <!-- About Us Image Area -->
                <div class="col-lg-5 col-xl-4 offset-md-2">
                    <div class="about-us-left">
                        <!-- About US Image -->
                        <div class="about-us-img">
                            <a href="#"><img src="{{ asset('/upload/gral/'.$empresa->imagen_bienvenida) }}" alt="About Nikko autopartes"></a>
                        </div>
                        <!-- Experience Box -->
                        <div class="experiance-box d-md-flex">
                            
                            <div class="content">
                                <h2 class="main-title"><a class="boton_conoce_mas" href="{{ route('pagina.empresa') }}">Conoce más</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- About Us Image Area end -->
                <!-- About Us Content Area -->
                <div class="col-lg-7 col-xl-5">
                    <div class="about-us-content">
                        <h3 class="sub-title" style="line-height: 40px;">{!! $empresa->subtitulo_bienvenida !!}</h3>
                        <p class="text">{!! $empresa->texto_bienvenida !!}</p>
                    </div>
                </div>
                <!-- About Us Content Area end -->
                
                
            </div>
        </div>
    </section>
    <!-- About Us Section end -->

    <!-- Brand Area -->
    <section>
        <div class="brand-area-wrapper brand-layout1 pt20 all-brands">
            <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title">
                        <h2 class="title">{!! $empresa->titulo_marcas !!}</h2>
                        <p class="text">{!! $empresa->texto_marcas !!}</p>
                    </div>
                </div>
            </div>
            <!-- BG Shape -->
        
            <div class="container">
                <div class="row brand-slider1-active">
                    @foreach($marcas as $marca)
                        <!-- Single Brand -->
                        <div class="col-xl-3">
                            <div class="brand-box">
                                <a @if($marca->redireccion == 'enlace')target="_blank"@endif href="@if($marca->redireccion == 'propia'){{ route('pagina.ver_marca',$marca->id) }}@else{{ $marca->url }}@endif"><img src="{{ asset('upload/marcas/'.$marca->imagen) }}" alt=""></a>
                            </div>
                        </div>
                    @endforeach
                </div><!-- .row END -->
            </div><!-- .container END -->
        </div>
    </section>
    <!-- Brand Area end -->

    <!-- Our Service -->
    <section class="service-layout1 our-service-wrapper pt-130" id="service">
        <div class="container">
            <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title">
                        <h2 class="title">{!! $empresa->titulo_boletines !!}</h2>
                        <p>{!! $empresa->texto_boletines !!}</p>
                        <a class="primary-btn hover-white" href="{{ route('pagina.boletines') }}">Ver más boletines</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center vs-carousel mb-65" data-slidetoshow="3" data-lgslidetoshow="2" data-mdslidetoshow="2" data-xsslidetoshow="1" data-smslidetoshow="1" data-centermode="true" data-mlcentermode="true" data-xlcentermode="true" data-dots="true" data-xsdots="true" data-smdots="true" data-mddots="true" data-lgdots="true" data-mldots="true" data-xldots="true" data-arrows="true" data-prevArrow='<button type="button" class="slick-prev flechita-prev"><i class="fal fa-chevron-left"></i></button>' data-nextArrow='<button type="button" class="slick-next flechita-next"><i class="fal fa-chevron-right"></i></button>'>

                <!-- Single Service -->
                @foreach($boletines as $boletin)

                    <div class="col-xl-4">
                        <div class="service-box">
                            <a href="#" class="op">
                                <div class="service-img">
                                    <img src="{{ asset('/upload/boletines/portadas/'.$boletin->portada) }}" alt="Service Image">
                                </div>
                            </a>
                            <span class="service-icon"><i class="flaticon-car-search"></i></span>
                            <div class="service-content">
                                <a href="#">
                                    <h3 class="title">{{ $boletin->nombre }}</h3>
                                </a>
                                <p class="service-text">{{ $boletin->descripcion }}</p>
                                <div class="social-media boletin">
                                    <ul class="d-flex justify-content-center align-items-center">
                                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $boletin->url }}&quote={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r".$boletin->descripcion) }}"><i class="fab fa-facebook-f"></i></a></li>
                                         <li><a href="mailto:?subject={{ rawurlencode($boletin->descripcion) }}&body={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $boletin->url }}"><i class="fad fa-envelope"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $boletin->url }}"><i class="fab fa-whatsapp"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <a href="{{ $boletin->url }}" class="primary-btn hover-white w-100">Descargar</a>
                        </div>
                    </div>

                  @endforeach
            </div>
        </div>
    </section>
    <!-- Our Service end -->

    <!-- Our Team -->
    <section class="our-team-wrapper team-layout1 pt-200 pb-100" id="team">
        <div class="container">

            <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6 ">
                    <div class="section-title pt-55 pb-25">
                        <h2 class="title">{!! $empresa->titulo_catalogos !!}</h2>
                        <p>{!! $empresa->texto_catalogos !!}</p>
                        <a class="primary-btn hover-white" href="{{ route('pagina.documentos') }}">Ver más catalogos</a>
                    </div>
                </div>
            </div>
            <div class="row gutters-10 team-slider1-active-otro" data-numero="{{ count($catalogos) < 4 ? count($catalogos) : 4 }}">

                 
                 @foreach($catalogos as $catalogo)


                 
                  
                        <!-- Single Team -->
                        <div class="col-xl-4 col-6">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('/upload/catalogos/portadas/'.$catalogo->portada) }}" alt="Team Member Image">
                                </div>

                                <div class="link-area">
                                    <!-- Social Share -->
                                    <ul class="social-links hover-link">
                                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $catalogo->url }}&quote={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r".$catalogo->nombre) }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="mailto:?subject={{ rawurlencode($catalogo->nombre) }}&body={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $catalogo->url }}"><i class="fad fa-envelope"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $catalogo->url }}"><i class="fab fa-whatsapp"></i></a></li>
                                    </ul>
                                    <!-- Overly Icon -->
                                    <a href="#" class="btn-overly member-link circle-btn xs">
                                        <i class="fas fa-share-alt"></i>
                                        <span class="ripple ripple-1"></span>
                                        <span class="ripple ripple-2"></span>
                                        <span class="ripple ripple-3"></span>
                                    </a>
                                </div>
                                <div class="member-content">
                                    <div class="member-text">
                                        <a href="{{ $catalogo->url }}"><span class="degi">Descargar</span>
                                        <h3 class="name name_catalogo">{{ $catalogo->nombre }}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>

         
                    @endforeach
                


            </div>

        </div>
    </section>
    <!-- Our Team end -->

    <!-- blog Area -->
    <section class="blog-wrapper blog-layout1 pt-130 pb-100" id="blog">
        <div class="container">
            <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title">
                        <h2 class="title">{!! $empresa->titulo_productos !!}</h2>
                        <p>{!! $empresa->texto_productos !!}</p>
                        <a href="{{ route('pagina.resultados') }}?query=&pagina=1&ano=0&marca=0&modelo=0&motor=0&grupo=0&familia=0" class="primary-btn hover-white">Ver todos los productos</a>
                    </div>
                </div>
            </div><!-- .row END -->


            <div class="row blog-slider1-active">


                
                @foreach($nuevos as $producto)
                    <?php
                        $directory = storage_path().'/app/public/productos/'.$producto->codigo_nikko;
                        if(file_exists($directory)){
                            $files = \Storage::allFiles('public/productos/'.$producto->codigo_nikko."/");
                            if(count($files)>=1)
                                $imagen = asset("storage/productos/".$producto->codigo_nikko."/".basename($files[0],PHP_EOL));
                            else
                                $imagen = asset('img/sin-foto.png');
                        }
                        else
                            $imagen = asset('img/sin-foto.png');

                    ?>
                        <div class="col-xl-4">
                            <div class="blog">
                                <!-- Blog Image -->
                                <div class="blog-img">
                                    <a href="{{ route('pagina.detalles_producto') }}?clave={{ $producto->codigo_nikko }}">
                                         <img src="{{ $imagen }}" alt="Blog Image">
                                    </a>
                                </div>
                            
                            </div>
                        </div>
                @endforeach


                
             
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section>
    <!-- blog Area end -->



    <!-- Subscribe Area -->
    <section class="subscribe-sec-wrapper subscribe-layout1">
        <div class="container-fluid" style="padding:0;">
            <div class="inner-wrapper background-image pt-100 pb-100" style="background-size: 100% !important;" data-img="{{ asset('/upload/gral/'.$empresa->imagen_conviertete_distribuidor) }}">
                <div class="row gutters-20 text-center justify-content-center">
                    <div class="col-11 col-md-10 col-lg-8 col-xl-6">
                        <div class="subscribe-content">
                            <h2 class="title">Conviertete en distribuidor</h2>
                            <!-- Subscribe Form -->
                            <a class="primary-btn hover-white" data-toggle="modal" data-target="#distribuidor" style="color:white;">Ver más</a>
                       

                        </div>
                    </div>
                </div><!-- .row END -->
            </div>
        </div><!-- .container END -->
    </section>
    <!-- Subscribe Area end -->

@endsection


