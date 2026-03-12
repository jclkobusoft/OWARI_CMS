@extends('pagina.base')
@section('js')
    <script type="text/javascript">
        var $mediaElements = $('.el_socio');

        $('.filter_link').click(function(e){
            e.preventDefault();
            // get the category from the attribute
            var filterVal = $(this).data('filter');

            if(filterVal === 'all'){
              $mediaElements.show();
            }else{
               // hide all then filter the ones to show
               $mediaElements.hide().filter('.' + filterVal).show();
            }
        });

    </script>
@endsection


@section('contenido')

  <!--breadcumb -->
    <div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
        <div class="container">
            <div class="breadcumb-content">
                <!-- Breadcrumb Title -->
                <h1 class="breadcumb-title" data-aos="fade-left">Socios Comerciales</h1>

                <!-- Breadcrumb Menu -->
                <ul>
                    <li><a href="index.html"> Inicio </a></li>
                    <li class="active">Socios comerciales</li>
                </ul>
            </div>
        </div>
    </div>
  <!--breadcumb end -->

 <section>
      <div class="container">
           <div class="row branch-information-layout2 pt-50" style="background-color: white !important;"> 
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
      @if(count($socios) > 0)
      <?php
                $i=0;
     ?>
    <!-- Founder Area -->
      <section class="axivis-founder-wrap founder-layout1 pt-50 pb-50">
        <div class="container">


             <h2 class="">Conoce a nuestros socios comerciales</h2>

              <div class="row text-center justify-content-center">
                <!-- Section Title -->
                <div class="col-12 widget widget_tag_cloud">
                    <div class="section-title tagcloud">
                        <a href="#" class="filter_link" data-filter="all">Ver todos</a> 
                       @foreach($filtros as $key => $value)
                        <a href="#" class="filter_link" data-filter="{{ $value }}">{{ str_replace("_"," ",$value) }}</a> 
                       @endforeach
                    </div>
                </div>
            </div>
            <!-- Single Founder -->
            @foreach($socios as $socio)
            <?php
                    $i++;
                    $filtros_arreglo = explode(",", $socio->tags);
                    $filtros = "";
                    foreach ($filtros_arreglo as $key => $value) {
                        if(str_contains($value,"filtro:")){
                            $explotado = explode(":",$value);
                           $filtros.=str_replace(" ","_",trim($explotado[1]))." ";
                        }
                    }
                ?>

            @if($i%2 == 1)
            <div class="axivis-founder el_socio {{ trim($filtros) }}">
                <div class="row align-items-xl-center no-gutters justify-content-center ">
                    <div class="col-md-8 col-lg-5">
                        <!-- Founder Image -->
                        <div class="founder-img">
                            <img src="{{ asset('/socios/'.$socio->logo) }}" alt="axivis Founder">
                            <!-- Founder Social Links -->
                        </div>
                        <!-- Founder Image end -->
                    </div><!-- .col END -->
                    <div class="col-lg-7">
                        <!-- founder Content -->
                        <div class="founder-content">
                            <h2 class="name">{{ $socio->nombre }}</h2>
                            <p class="text">{!! $socio->descripcion !!}</p>

                            <ul>
                                @if($socio->telefono_1)
                                    <li><b>Telefono:</b> <a href="phone:+{{ $socio->telefono_1 }}">{{ $socio->telefono_1 }}</a></li>
                                @endif
                                @if($socio->telefono_2)
                                    <li><b>Celular:</b> <a href="phone:+{{ $socio->telefono_2 }}">{{ $socio->telefono_2 }}</a></li>
                                @endif
                            </ul>
                            <b>Dirección:</b>
                             <ul>
                                @if($socio->direccion_1)
                                    <li>{{ $socio->direccion_1 }}</li>
                                @endif
                                @if($socio->direccion_2)
                                    <li>{{ $socio->direccion_2 }}</li>
                                @endif
                                 @if($socio->direccion_3)
                                    <li>{{ $socio->direccion_3 }}</li>
                                @endif
                            </ul>

                             @if($socio->pagina_web)
                            <br><br>
                            <a class="btn btn-primary" href="{{ $socio->pagina_web }}">Ver pagina web</a>
                            @endif

                        </div>
                        <!-- founder Content end -->

                    </div><!-- .col END -->
                </div><!-- .row END -->
            </div>
            <!-- Single Founder end -->
            @else
            <!-- Single Founder -->
            <div class="axivis-founder el_socio {{ trim($filtros) }}">
                <div class="row align-items-xl-center no-gutters justify-content-center">
                    <div class="col-md-8 col-lg-5">
                        <!-- Founder Image -->
                        <div class="founder-img">
                            <img src="{{ asset('/socios/'.$socio->logo) }}" alt="axivis Founder">
                        </div>
                        <!-- Founder Image end -->
                    </div><!-- .col END -->
                    <div class="col-lg-7">

                        <!-- founder Content -->
                        <div class="founder-content">
                            <h2 class="name">{{ $socio->nombre }}</h2>
                            <p class="text">{!! $socio->descripcion !!}</p>
                            <ul>
                                @if($socio->telefono_1)
                                    <li><b>Telefono:</b> <a href="phone:+{{ $socio->telefono_1 }}">{{ $socio->telefono_1 }}</a></li>
                                @endif
                                @if($socio->telefono_2)
                                    <li><b>Celular:</b> <a href="phone:+{{ $socio->telefono_2 }}">{{ $socio->telefono_2 }}</a></li>
                                @endif
                            </ul>
                            <b>Dirección:</b>
                             <ul>
                                @if($socio->direccion_1)
                                    <li>{{ $socio->direccion_1 }}</li>
                                @endif
                                @if($socio->direccion_2)
                                    <li>{{ $socio->direccion_2 }}</li>
                                @endif
                                 @if($socio->direccion_3)
                                    <li>{{ $socio->direccion_3 }}</li>
                                @endif
                            </ul>

                            @if($socio->pagina_web)
                            <br><br>
                            <a class="btn btn-primary" href="{{ $socio->pagina_web }}">Ver pagina web</a>
                            @endif
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