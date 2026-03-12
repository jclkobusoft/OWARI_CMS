@extends('pagina.base')



@section('contenido')
    <style type="text/css">
        .testomonial-layout4 .single-testomonial .testomonial-content:after {
            font-family: "Font Awesome\5 Pro";
            color: white !important;
            font-size: 48px !important;
            opacity: 1 !important;
        }
        .text_lema{
            font-size: 70px;
            font-weight: 600;
            font-family: "Oswald", sans-serif;
            width: 100%;
            color: white;
            text-align: center;

        }
    </style>
    <!--breadcumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/upload/gral/'.$empresa->nosotros_banner) }}">
        <div class="container">
            <div class="breadcumb-content">
                <!-- Breadcrumb Title -->
                <h1 class="breadcumb-title">Nosotros</h1>

                <!-- Breadcrumb Menu -->
                <ul>
                    <li><a href="{{ route('pagina.index') }}">Inicio </a></li>
                    <li class="active">Nosotros</li>
                </ul>
            </div>
        </div>
    </div>
    <!--breadcumb end -->
    <!-- About Us Section -->
    <section class="about-us-sec about-wrap-layout6 pt-50 pb-130" id="about">
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
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about-img-box6 text-center">
                        <h2 class="image-title h1">{!! $empresa->nosotros_titulo_video_historia !!}</h2>
                        <a href="{{ $empresa->nosotros_url_video_historia }}" data-fancybox class="video-btn ripple-wrap ">
                            <span class="btn-text"><i class="fal fa-play"></i></span>
                            <span class="ripple ripple-1"></span>
                            <span class="ripple ripple-2"></span>
                            <span class="ripple ripple-3"></span>
                        </a>
                        <a href="about-us.html"><img class="w-100" src="{{ asset('/upload/gral/'.$empresa->nosotros_imagen_video_historia) }}" alt="About Us Image"></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="about-content-box6 pl-xl-5">
                        <h3 class="h1 about-title mb-20">
                            {!! $empresa->nosotros_historia_titulo !!}</span>
                        </h3>
                        {!! $empresa->nosotros_historia_texto !!}
                        
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- About Us Section End -->

     <!-- Testomonial Section -->
    <section class="testomonial-wrapper testomonial-layout4 background-image pt-130 pb-130" data-img="{{ asset('/upload/gral/'.$empresa->nosotros_imagen_lema) }}">
        <div class="container">
            <div class="row testomonal-slider4-active">
                <!-- Single Testomonial -->
                <div class="col-12">
                    <div class="single-testomonial d-md-flex align-items-center">
                        <div class="testomonial-content">
                            <span class="quote"><i class="fal fa-quote-left"></i></span>
                            <p class="text_lema">{!! $empresa->nosotros_lema !!}</p>
                        </div>
                    </div>
                </div>
            </div><!-- .row END -->
        </div><!-- .container END -->
    </section>
    <!-- Testomonial Section end -->

    <!-- Mission Vision Area -->
    <section class="axivis-mission-wrapper axivis-mission-layout4 pt-100 pb-20">
        <div class="container">
            <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6">
                    <div class="section-title">
                        <h2 class="title">Misión / Visión / Valores</h2>
                    </div>
                </div>
            </div>


            <div class="row mission-slider-active">
                <div class="col-xl-4">
                    <div class="axivis-mission">
                        <span class="shape"></span>
                        <div class="mission-icon">
                            <span class="circle-btn xl">
                                <i class="flaticon-target"></i>
                            </span>
                        </div>
                        <div class="mission-content">
                            <h3 class="title">Misión</h3>
                            {!! $empresa->mision !!}
                        </div>
                    </div>
                </div>
                <!-- Single mission -->
                <div class="col-xl-4">
                    <div class="axivis-mission">
                        <span class="shape"></span>
                        <div class="mission-icon">
                            <span class="circle-btn xl">
                                <i class="flaticon-null-1"></i>
                            </span>
                        </div>
                        <div class="mission-content">
                            <h3 class="title">Visión</h3>
                            {!! $empresa->vision !!}
                        </div>
                    </div>
                </div>
                <!-- Single mission -->
                <div class="col-xl-4">
                    <div class="axivis-mission">
                        <span class="shape"></span>
                        <div class="mission-icon">
                            <span class="circle-btn xl">
                                <i class="flaticon-value"></i>
                            </span>
                        </div>
                        <div class="mission-content">
                            <h3 class="title">Valores</h3>
                           {!! $empresa->valores !!}
                        </div>
                    </div>
                </div>
                <!-- Single mission -->
                
            </div>
        </div>
    </section>
    <!-- Mission Vision Area end -->

   

    <!-- Brand Area -->
    <div class="brand-area-wrapper pt-100 pb-100">

        <div class="container">
            <div class="row"><div class="col-12 text-center"><h2 class="title">Marcas</h2></div></div>
            <div class="row brand-slider1-active ">

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
    <!-- Brand Area end -->


    <!-- Counter Area -->
    <div class="counter-area-wrap counter-layout4 pt-100 pb-100 ">
        <div class="container">
            <div class="inner-wrapper">
                <div class="row justify-content-center ">
                    @if($empresa->nosotros_numeros_experiencia !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-mission"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_experiencia !!}</span>
                                <p class="text text-primary">años de experiencia</p>
                            </div>

                        </div>
                    </div>
                    @endif
                    @if($empresa->nosotros_numeros_productos !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-car-parts"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_productos !!}</span>
                                <p class="text text-primary">productos</p>
                            </div>

                        </div>
                    </div>
                    @endif
                     @if($empresa->nosotros_numeros_socios !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-award"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_socios !!}</span>
                                <p class="text text-primary">socios comerciales</p>
                            </div>

                        </div>
                    </div>
                    @endif
                     @if($empresa->nosotros_numeros_marcas !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-repair"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_marcas !!}</span>
                                <p class="text text-primary">marcas</p>
                            </div>

                        </div>
                    </div>
                    @endif
                     @if($empresa->nosotros_numeros_empleados !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-worker"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_empleados !!}</span>
                                <p class="text text-primary">empleados</p>
                            </div>

                        </div>
                    </div>
                    @endif

                      @if($empresa->nosotros_numeros_almacenes !="")
                    <!-- Single Counter -->
                    <div class="col-sm-6 col-xl-3">
                        <div class="counter-box">
                            <div class="icon">
                                <span class="shape-icon">
                                    <i class="flaticon-car-service"></i>
                                </span>
                            </div>
                            <div class="content">
                                <span class="counter">{!! $empresa->nosotros_numeros_almacenes !!}</span>
                                <p class="text text-primary">almacenes</p>
                            </div>

                        </div>
                    </div>
                    @endif



                </div><!-- .row END -->
            </div><!-- inner Wrapper -->
        </div><!-- .container END -->
    </div>
    <!-- Counter Area end -->

@endsection