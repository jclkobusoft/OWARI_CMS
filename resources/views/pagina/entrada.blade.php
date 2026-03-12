@extends('pagina.base')
@section('contenido')

<!--breadcumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <!-- Breadcrumb Title -->
                <h1 class="breadcumb-title" data-aos="fade-left">{{ $entrada->titulo }}</h1>

                <!-- Breadcrumb Menu -->
                <ul>
                    <li><a href="{{ route('pagina.index') }}"> Inicio </a></li>
                    <li class="active">{{ $entrada->titulo }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!--breadcumb end -->




    <!-- Project Details Area -->
    <section class="axivis-project-details project-details-layout1 pt-130 pb-100">
        <div class="container">
            <div class="row justify-content-center">


                <div class="col-xl-10">
                    <div class="project-details-area" data-aos="fade-up">

                        <!-- Project Image -->
                        <div class="project-img mb-30">
                            <img src="{{ asset('/informate/'.$entrada->banner) }}" alt="Project Details Image" class="w-100">
                        </div>
                        <h2 class="sub-title">{{ $entrada->subtitulo }}</h2>

                        {!! html_entity_decode($entrada->contenido) !!}
                        <!-- Middle Image -->
                        <div class="row">
                            <?php
                                  $directory = storage_path().'/app/public/informate/'.$entrada->id;
                                  if(file_exists($directory))
                                      $files = \Storage::allFiles('public/informate/'.$entrada->id."/");
                                  else
                                      $files = [];
                            ?>
                            <!-- Single Image -->
                             @if(count($files) > 0)
                                 @foreach($files as $key => $imagen)
                                   
                                    <div class="col-lg-4">
                                        <div class="middle-img">
                                            <img src="{{ asset("storage/informate/".$entrada->id."/".basename($imagen,PHP_EOL)) }}" alt="Project Details Image">
                                        </div>
                                    </div>
                                    @endforeach
                             @endif
                        </div>
                       
                       
                        <!-- Share Links Area -->
                        <div class="share-links">
                            <div class="row align-items-center">
                                <div class="col-md-6 col-lg-4 text-left">
                                    <div class="social-links">
                                        <ul>
                                             <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="mailto:?subject=&body={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fad fa-envelope"></i></a></li>
                                            <li><a href="https://wa.me/?text={{ route('pagina.ver_entrada',$entrada->id) }}"><i class="fab fa-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Share Links Area end -->

                        <!-- Post Pagination end -->
                    </div>
                </div>

            </div><!-- .row END -->
        </div><!-- .container END -->
    </section>
    <!-- Project Details Area End -->


    @endsection