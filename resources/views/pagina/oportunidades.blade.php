@extends('pagina.base')



@section('contenido')

  <!--breadcumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <!-- Breadcrumb Title -->
                <h1 class="breadcumb-title">Infórmate</h1>

                <!-- Breadcrumb Menu -->
                <ul>
                    <li><a href="index.html"> Inicio </a></li>
                    <li class="active">Infórmate</li>
                </ul>
            </div>
        </div>
    </div>
  <!--breadcumb end -->
  <section>
      <div class="container">
           <div class="row branch-information-layout2 pt-50 pb-50" style="background-color: white !important;"> 
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
      </div>
  </section>
  @if($entrada_principal)
  <!-- Latest Project -->
    <section class="latest-project-wrapper background-image pt-120 pb-120" data-img="{{ asset('informate/'.$entrada_principal->banner) }}" id="project">
        <div class="container">
            <div class="row ">
                <!-- Section Title -->
                <div class="col-xl-5">
                    <div class="section-title">
                        <h2 class="title">{{ $entrada_principal->titulo }}</h2>
                        <p class="text">{{ substr(strip_tags(html_entity_decode($entrada_principal->contenido)), 0, 250) }}</p>
                        <a href="{{ route('pagina.ver_entrada',$entrada_principal->id) }}" class="primary-btn hover-white">Ver más</a>
                    </div>
                </div>
                <!-- Section Title end -->


                <!-- Slider Area -->
                <div class="col-xl-7 position-static">
                    <div class="project-slider-area">
                        <!-- Thumb Logo -->
                        <div class="thumb-logo">
                            <img src="assets/img/thumb-logo.png" alt="Thumb Logo">
                        </div>
                        <!-- Slider Area -->

                            <?php
                                  $directory = storage_path().'/app/public/informate/'.$entrada_principal->id;
                                  if(file_exists($directory))
                                      $files = \Storage::allFiles('public/informate/'.$entrada_principal->id."/");
                                  else
                                      $files = [];
                            ?>
                            <!-- Single Image -->
                             @if(count($files) > 0)
                                <div class="latProject-slider-active">

                                @foreach($files as $key => $imagen)
                                    <div>
                                        <img src="{{ asset("storage/informate/".$entrada_principal->id."/".basename($imagen,PHP_EOL)) }}" alt="Project Image">
                                        <!-- Product discount -->
                                    </div>
                                    @endforeach
                                </div>
                              @endif

                    </div>
                </div>
                <!-- Slider Area end -->


            </div>
        </div>
    </section>
    @endif
    <!-- Latest Project end -->

    @if(count($eventos)>0)
      <section class="project-wapper project-layout1 secondary-bg2 pt-130 pb-120">
        <div class="container">
            <h2 class="">Proximos Eventos</h2>
            <div class="row d-flex justify-content-around">

                @foreach($eventos as $evento)
                <!-- Single Project -->
                <div class="col-sm-8 col-md-4 col-lg-4">
                    <div class="axivis-project">
                        <div class="project-img">
                            <img src="{{ asset('informate/'.$evento->banner) }}" alt="Project image">
                        </div>
                        <div class="project-content">
                            <span><i class="fal fa-calendar-minus"></i>{{ \Carbon::createFromFormat('Y-m-d',$evento->evento_fecha)->format('d/M/Y') }}</span>
                            <h3 class="project-title">{{ $evento->evento_nombre }}</h3>
                            <div class="content-bottom">
                              <span></span>
                                <a href="{{ route('pagina.ver_entrada',$evento->id) }}" class="primary-btn">detalles</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


            </div><!-- .row END -->
        </div><!-- .container END -->
      </section>
      @endif

      @if(count($entradas) > 0)
      <?php
                $i=0;
     ?>
    <!-- Founder Area -->
      <section class="axivis-founder-wrap founder-layout1 pt-130 pb-50">
        <div class="container">
             <h2 class="">Informate</h2>
            <!-- Single Founder -->
            @foreach($entradas as $entrada)
            <?php
                $i++;
            ?>
            @if($i%2 == 1)
            <div class="axivis-founder">
                <div class="row align-items-xl-center no-gutters justify-content-center ">
                    <div class="col-md-8 col-lg-5">
                        <!-- Founder Image -->
                        <div class="founder-img">
                             <?php
                                  $directory = storage_path().'/app/public/informate/'.$entrada->id;
                                  if(file_exists($directory))
                                      $files = \Storage::allFiles('public/informate/'.$entrada->id."/");
                                  else
                                      $files = [];
                            ?>

                            @if(count($files) > 0)
                                <img src="{{ asset("storage/informate/".$entrada->id."/".basename($files[0],PHP_EOL)) }}" alt="axivis Founder">
                            @else
                                <img src="{{ asset('img/sinimagen.jpg') }}" alt="axivis Founder">
                            @endif
                            <!-- Founder Social Links -->
                            <div class="social-links">
                                <ul>
                                    <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="mailto:?subject=&body={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fad fa-envelope"></i></a></li>
                                <li><a href="https://wa.me/?text={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Founder Image end -->
                    </div><!-- .col END -->
                    <div class="col-lg-7">

                        <!-- founder Content -->
                        <div class="founder-content">
                            <span class="degi">{{ $entrada->subtitulo }}</span>
                            <h2 class="name">{{ $entrada->titulo }}</h2>
                            <p class="text">{{ substr(strip_tags(html_entity_decode($entrada->contenido)), 0, 250) }}...</p>
                            <a href="{{ route('pagina.ver_entrada',$entrada->id) }}" class="primary-btn hover-white">Ver más</a>
                        </div>
                        <!-- founder Content end -->

                    </div><!-- .col END -->
                </div><!-- .row END -->
            </div>
            <!-- Single Founder end -->
            @else
            <!-- Single Founder -->
            <div class="axivis-founder">
                <div class="row align-items-xl-center no-gutters justify-content-center">
                    <div class="col-md-8 col-lg-5">
                        <!-- Founder Image -->
                        <div class="founder-img">
                            <?php
                                  $directory = storage_path().'/app/public/informate/'.$entrada->id;
                                  if(file_exists($directory))
                                      $files = \Storage::allFiles('public/informate/'.$entrada->id."/");
                                  else
                                      $files = [];
                            ?>

                            @if(count($files) > 0)
                                <img src="{{ asset("storage/informate/".$entrada->id."/".basename($files[0],PHP_EOL)) }}" alt="axivis Founder">
                            @else
                                <img src="{{ asset('img/sinimagen.jpg') }}" alt="axivis Founder">
                            @endif
                            <!-- Founder Social Links -->
                            <div class="social-links">
                                <ul><li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="mailto:?subject=&body={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fad fa-envelope"></i></a></li>
                                <li><a href="https://wa.me/?text={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-whatsapp"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Founder Image end -->
                    </div><!-- .col END -->
                    <div class="col-lg-7">

                        <!-- founder Content -->
                        <div class="founder-content">
                            <span class="degi">{{ $entrada->subtitulo }}</span>
                            <h2 class="name">{{ $entrada->titulo }}</h2>
                            <p class="text">{{ substr(strip_tags(html_entity_decode($entrada->contenido)), 0, 250) }}...</p>
                            <a href="{{ route('pagina.ver_entrada',$entrada->id) }}" class="primary-btn hover-white">Ver más</a>
                        </div>
                        <!-- founder Content end -->

                    </div><!-- .col END -->
                </div><!-- .row END -->
            </div>
            @endif
            <!-- Single Founder end -->
            @endforeach

        </div><!-- .container END -->
      </section>
    <!-- Founder Area end -->
    @endif






@endsection