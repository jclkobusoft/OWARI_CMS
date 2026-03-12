@extends('web.plantilla.base') 
@section('contenido')

	
    <!-- Comienza slide del banner principal -->
    <div class="main-slides">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12"></div>

                <div class="col-lg-12 col-md-12">
                    <div class="home-slides owl-carousel owl-theme d-md-block d-none">
                        @foreach($slider as $slide)
                            <div class="main-slides-item" style="background-image:url('{{asset('upload/banner_principal/'.$slide->imagen)}}') !important">

                            </div>
                        @endforeach
                    </div>
                    <div class="home-slides owl-carousel owl-theme d-md-none d-block">
                        @foreach($slider as $slide)
                            <div class="main-slides-item" style="background-image:url('{{asset('upload/banner_principal/movil_'.$slide->imagen)}}') !important">

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    
        <!-- Termina slide del banner principal  -->
    
    <div class="partner-area" style="padding: 30px 0;">
        <div class="container">
            
            <div class="row">
            	
            	<div class="col-md-6 col-12 d-flex align-items-center">
            		<div class="section-title">
                	<h2 style="color:#d31531">Nuestra tienda en linea</h2>
                	<h4 style="color:#09101f">¿que puedo hacer en la tienda en linea?</h4>
                	<p>Da click en el video para obtener mas información</p>
            		</div>
            	</div>
            	
            	<div class="col-md-6 col-12">
            		<div style="width:100%; text-align:center">
            			<video height="450px" controls>
                              <source src="https://pedidos.owari.com.mx/owari.mp4" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
            		</div>
            	</div>
            </div>
            
	
            
        </div>
    </div>

    <!-- Comienza area de beneficios -->
    <section class="support-area bg-color">
        <div class="container">
            <div class="custom-row">
                <div class="custom-item">
                    <div class="single-support">
                        <div class="icon">
                            <i class="flaticon-car-wheel"></i>
                        </div>

                        <div class="support-content">
                            <h3>Productos</h3>
                            <span>El mejor surtido</span>
                        </div>
                    </div>
                </div>

                <div class="custom-item">
                    <div class="single-support">
                        <div class="icon">
                            <i class="flaticon-return-of-investment"></i>
                        </div>

                        <div class="support-content">
                            <h3>Costo-beneficio</h3>
                            <span>Los mejores precios</span>
                        </div>
                    </div>
                </div>

                <div class="custom-item">
                    <div class="single-support">
                        <div class="icon">
                            <i class="flaticon-enter"></i>
                        </div>

                        <div class="support-content">
                            <h3>Marcas</h3>
                            <span>Amplia variedad</span>
                        </div>
                    </div>
                </div>

                <div class="custom-item">
                    <div class="single-support">
                        <div class="icon">
                            <i class="flaticon-online-support"></i>
                        </div>

                        <div class="support-content">
                            <h3>Atención</h3>
                            <span>El cliente es primero</span>
                        </div>
                    </div>
                </div>

                <div class="custom-item">
                    <div class="single-support">
                        <div class="icon">
                            <i class="flaticon-award"></i>
                        </div>

                        <div class="support-content">
                            <h3>Calidad</h3>
                            <span>Los mejores productos</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Termina area de beneficios -->

    <!-- Slide de marcas -->
    <div class="partner-area pb-100 pt-100">
        <div class="container">
            <div class="section-title">
                <h2>{!! $general->titulo_marcas !!}</h2>
                <p>{!! $general->texto_marcas !!}</p>
            </div>

            <div class="partner-slider owl-carousel owl-theme">
                @foreach($marcas as $marca)
                    <div class="partner-item">
                        <img src="{{asset('/upload/marcas/'.$marca->imagen)}}" alt="image">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Termina Slide de marcas -->

    <!-- Start Coming Soon Area -->
    <section class="coming-soon-area ptb-100" style="background-image:url('{{asset('/upload/gral/'.$general->imagen_bienvenida)}}')">
        <div class="container">
            <div class="coming-soon-title">
                <h3>{!! $general->titulo_bienvenida !!}</h3>
                <h4>{!! $general->subtitulo_bienvenida !!}</h4>
                <p>{!! $general->texto_bienvenida !!}</p>
            </div>
        </div>
    </section>
    <!-- End Coming Soon Area -->



    <!-- Catalogos Area -->
    <section class="top-products-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{!! $general->titulo_catalogos !!}</h2>
                <p>{!! $general->texto_catalogos !!}</p>
            </div>

            <div class="row">

                @foreach($catalogos as $catalogo)
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-top-products">
                            <div class="top-products-image">
                                <a href="{{$catalogo->url}}" target="_blank"><img src="{{asset("/upload/catalogos/portadas/".$catalogo->portada)}}" alt="image"></a>
                            </div>

                            <div class="top-products-content">
                                <h3>
                                    <a href="{{$catalogo->url}}" target="_blank">{!! $catalogo->nombre !!}</a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="main-search-btn">
                            <a style="
                                border: none;
                                padding: 10px 35px;
                                display: inline-block;
                                width: auto;
                                background-color: #d31531;
                                color: #fff !important;
                                cursor: pointer;
                                -webkit-transition: 0.5s;
                                transition: 0.5s;" href="{{route('pagina.catalogos')}}" class="search-btn">Ver todos los catalogos</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Termina catalogos Area -->



    <!-- Start Newsletter Area -->
    <div class="newsletter-area ptb-100" style="background-image:url('{{asset('/upload/gral/fondoasiento.jpg')}}')">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="newsletter-content">
                        <span>Recibe las mejores promociones</span>
                        <h3>Suscribete</h3>
                        <p>Ingresa tu What's App o tu correo electronico y recibe las mejores promociones y actualizaciones de nuestros catalogos.</p>

                        <form class="newsletter-form" method="get" action="{{route('pagina.autenticarse')}}">
                            <input type="text" class="input-newsletter" placeholder="What's App o Correo electronico" name="EMAIL" required autocomplete="off">

                            <button type="submit">Suscribete ahora</button>

                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6 ">
                    <div class="newsletter-image wow fadeInLeft" data-wow-delay=".5s">
                        <img class="mx-auto d-block" src="{{asset('/upload/gral/logo.png')}}" alt="image">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Newsletter Area -->

    <!-- Start Products Area -->
    <?php

                $filtros = [];
                foreach ($boletines as $boletin) {
                    // code...
                    $etiquetas = explode(",", $boletin->tags);
                    foreach ($etiquetas as $key => $value) {
                        // code...
                        if(!array_search(trim($value), $filtros))
                            array_push($filtros, trim($value));

                    }
                }
                                    
        ?>
    <section class="products-area pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{$general->titulo_boletines}}</h2>

                <p>{!! $general->texto_boletines !!}</p>
            </div>

            <div class="tab products-list-tab">
                <ul class="tabas">
                    <li>
                        <a class="activado btn_filtro" href="javascript:filterSelection('all')">Ver todos</a>
                    </li>
                    @foreach($filtros as $key => $value)
                        <li>
                            <a class="btn_filtro" href="javascript:filterSelection('{{str_replace(" ","_",$value)}}')">{{$value}}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="tab_content">
                    <div class="tabs_item">
                        <div class="row">



                            @foreach($boletines as $boletin)
                                <?php

                                        $tags = "";
                                        foreach((explode(',',$boletin->tags)) as $key => $value) {
                                            // code...
                                            $tags.=" ".str_replace(" ",",",trim($value));
                                        }
                                    ?>
                                <div class="col-lg-3 col-sm-6 column{{$tags}}">
                                    <div class="single-products">
                                        <div class="products-image">
                                            <a href="{{$boletin->url}}"><img src="{{asset('/upload/boletines/portadas/'.$boletin->portada)}}" alt="image"></a>
                                            <div class="tag">{{$boletin->nombre}}</div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Products Area -->

    <!-- Productos destacados  -->
    <section class="top-products-area bg-color pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>{{$general->titulo_productos}}</h2>
                <p>{!! $general->texto_productos !!}</p>
            </div>

            <div class="row">
                <div class="slider-productos">
            
                <?php
                    $anterior = "";
                ?>
                @foreach($productos as $relacionado)
                        @if($anterior != $relacionado->codigo_nikko)
                        <?php
                            $anterior = $relacionado->codigo_nikko;
                        ?>
                            <div class="slide">
                                <div class="top-products-image text-center">
                                    <a href="{{route('pagina.detalles_producto',$relacionado['codigo_nikko'])}}">
                                    <?php
                                        if(str_contains($relacionado->codigo_nikko, '/'))
                                            $codigo_nikko = str_replace("/", ":", $relacionado->codigo_nikko);
                                        else 
                                            $codigo_nikko = $relacionado->codigo_nikko;

                                            $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                            if(file_exists($directory))
                                                $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                            else
                                                $files = [];
                                        ?>
                                        @if(count($files) > 0)
                                                <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[0],PHP_EOL)) }}" alt="Product Image" style="max-height:150px; display: inline-block;">
                                        @else
                                                <img src="{{ asset('img/sin-foto.jpg') }}" alt="Product Image" style="max-height:150px; display: inline-block;">
                                        @endif
                                    </a>
                                    
                            
                            
                                </div>

                                <div class="top-products-content text-center" style="margin-bottom:35px;">
                                    <h3>
                                        <a href="{{route('pagina.detalles_producto',$relacionado['codigo_nikko'])}}">{{$relacionado->codigo_nikko}}</a>
                                        <p>{{$relacionado->descripcion_1}}</p>
                                    </h3>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>


              

         


             
              

              
            </div>
        </div>
    </section>
    <!-- Productos destacados Area -->

    @if($general->habilitar_pop_up)
        <!-- Area del modal -->
        <div class="modal" tabindex="-1" role="dialog" id="home-modal">
            <div class="modal-dialog">
                <div class="modal-content" style="border-radius:0;">
                    <div class="modal-header" style="border:none;">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        {!! $general->pop_up !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Area del modal -->
    @endif

    @stop

        @section('js')
            <script>
            $('.slider-productos').slick({
                dots: true,
                infinite: false,
                speed: 300,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        infinite: true,
                        dots: true
                    }
                    },
                    {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                    },
                    {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });




            filterSelection("all") // Execute the function and show all columns
            function filterSelection(c) {
                var x, i;
                x = document.getElementsByClassName("column");
                if (c == "all") c = "";
                // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
                for (i = 0; i < x.length; i++) {
                    w3RemoveClass(x[i], "show");
                    if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
                }
            }

            // Show filtered elements
            function w3AddClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    if (arr1.indexOf(arr2[i]) == -1) {
                        element.className += " " + arr2[i];
                    }
                }
            }

            // Hide elements that are not selected
            function w3RemoveClass(element, name) {
                var i, arr1, arr2;
                arr1 = element.className.split(" ");
                arr2 = name.split(" ");
                for (i = 0; i < arr2.length; i++) {
                    while (arr1.indexOf(arr2[i]) > -1) {
                        arr1.splice(arr1.indexOf(arr2[i]), 1);
                    }
                }
                element.className = arr1.join(" ");
            }

            $('.btn_filtro').click(function() {
                $('.btn_filtro').removeClass('activado');
                $(this).addClass('activado');
            });
            </script>
            @stop

                @section('css')
                    <style>
                    .column.show {
                        display: block;
                    }

                    .column {
                        display: none;
                    }

                    .products-list-tab .tabas li:last-child {
                        margin-right: 0;
                    }

                    .products-list-tab .tabas {
                        text-align: center;
                        padding-left: 0;
                        list-style-type: none;
                        margin-bottom: 30px;
                    }

                    <blade media|%20only%20screen%20and%20(min-width%3A%20768px)%20and%20(max-width%3A%20991px)>.products-list-tab .tabas li a {
                        font-size: 15px;
                    }

                    .products-list-tab .tabas li a {
                        font-size: 20px;
                        color: #09101f;
                        font-weight: 500;
                        padding-bottom: 5px;
                        text-transform: uppercase;

                    }


                    .products-list-tab .tabas li.current a {
                        color: #d31531;
                        border-bottom: 1px solid #d31531;
                    }

                    .products-list-tab .tabas li {
                        display: inline-block;
                        margin-right: 35px;
                    }

                    .btn_filtro.activado {
                        color: #d31531 !important;
                        border-bottom: 1px solid #d31531;
                    }
                    
                    .slick-next:before,.slick-prev:before{
                        color:#d31531;
                        font-size:36px;
                    }
                    .slick-dots li.slick-active button:before {
                        color:#d31531 !important;
                        font-size: 12px;
                    }
                    </style>

                    @stop