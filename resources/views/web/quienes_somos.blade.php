@extends('web.plantilla.base')
@section('contenido')
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2" style="background-image: url('{{ asset('/upload/gral/'.$general->nosotros_banner) }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>¿Quienes somos?</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>¿Quienes somos?</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
         <!-- historia -->
        <section class="story-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="story-image" style="background-image: url('{{ asset('/upload/gral/'.$general->nosotros_imagen_video_historia)  }}');"> 
                            <a href="{{ $general->nosotros_url_video_historia }}" class="video-btn popup-youtube">
                                <i class='bx bx-play-circle'></i>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="story-content">
                            <h3>{{ $general->nosotros_historia_titulo }}</h3>
                            {!! $general->nosotros_historia_texto !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- termina historia -->

         <!-- Start Fun Facts Area -->
        <section class="fun-facts-area pt-100 pb-70" style="background-image:url('{{ asset('/upload/gral/'.$general->nosotros_imagen_lema) }}');">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="single-fun-fact">
                            <h3>
                                {{ $general->nosotros_lema }}
                            </h3>
                          
                        </div>
                    </div>

                   
                </div>
            </div>
        </section>
        <!-- End Fun Facts Area -->

        <!-- Start Mission Area -->
        <section class="mission-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mission-content">
                            <h3>Misión</h3>
                            {!! $general->mision !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="mission-image"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Mission Area -->

        <!-- Start Vision Area -->
        <section class="vision-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="vision-image"></div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="vision-content">
                            <h3>Visión</h3>
                            {!! $general->vision !!}
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Mission Area -->
        <!-- Start Valores Area -->
        <section class="mission-area pb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="mission-content">
                            <h3>Valores</h3>
                            {!! $general->valores !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="mission-image"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Valores Area -->
       

@stop