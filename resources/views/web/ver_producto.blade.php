@extends('web.plantilla.base')                   
@section('contenido')
    @if(\Auth::check())
        HOLAAAA
    @endif
    <!-- Start Products Details Area -->
    <section class="products-details-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="products-details-desc">
                        <div class="row align-items-center">
                            <div class="col-lg-7 col-md-6">
                                <div class="main-products-image">
                                    <div class="slider-productos">
                                        <?php
                                        if(str_contains($producto->codigo_nikko, '/'))
                                            $codigo_nikko = str_replace("/", "_", $producto->codigo_nikko);
                                        else 
                                            $codigo_nikko = $producto->codigo_nikko;

                                            $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                            if(file_exists($directory))
                                                $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                            else
                                                $files = [];
                                            
                                            arsort($files);

                                        ?>
                                        @if(count($files) > 0)
                                                @foreach($files as $key => $value)
                                                    <div class="slide">
                                                            <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[$key],PHP_EOL)) }}" alt="Product Image">                               
                                                    </div>
                                                @endforeach
                                        @else
                                        <div class="slide">
                                            <img src="{{ asset('img/sin-foto.jpg') }}" alt="Product Image">
                                        </div>
                                        @endif
                                    </div>
                                    <div class="slider-productos-mini">
                                     
                                        @if(count($files) > 0)
                                                @foreach($files as $key => $value)
                                                    <div class="slide">
                                                            <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[$key],PHP_EOL)) }}" alt="Product Image">                               
                                                    </div>
                                                @endforeach
                                        @else
                                        <div class="slide">
                                            <img src="{{ asset('img/sin-foto.jpg') }}" alt="Product Image">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-5 col-md-6">
                                <div class="product-content">
                                    <h3>{{$producto->codigo_nikko}}</h3>
                                    <!--
                                    <div class="price">
                                        <span class="old-price">$150.00</span>
                                        <span class="new-price">$75.00</span>
                                    </div>
                                    -->
                                    <p>
                                        @if($producto->marca_comercial != "")
                                           <b>Marca: {{$producto->marca_comercial}}</b>
                                        @endif
                                    </p>
                                   
                                    <ul class="products-info">
                                    	
                                    	@if($producto->descripcion_1 != "")
                                            <li><span>{{$producto->descripcion_1}}</span> </li>
                                        @endif
                                        @if($producto->descripcion_2 != "")
                                            <li><span>{{$producto->descripcion_2}}</span> </li>
                                        @endif
                                        @if($producto->descripcion_3 != "")
                                            <li><span>{{$producto->descripcion_3}}</span> </li>
                                        @endif
                                        @if($producto->descripcion_4 != "")
                                            <li><span>{{$producto->descripcion_4}}</span> </li>
                                        @endif
                                        @if($producto->caracteristicas_1 != "")
                                            <li><span>{{$producto->caracteristicas_1}}</span> </li>
                                        @endif
                                        @if($producto->caracteristicas_2 != "")
                                            <li><span>{{$producto->caracteristicas_2}}</span> </li>
                                        @endif
                                        @if($producto->caracteristicas_3 != "")
                                            <li><span>{{$producto->caracteristicas_3}}</span> </li>
                                        @endif
                                        @if($producto->caracteristicas_4 != "")
                                            <li><span>{{$producto->caracteristicas_4}}</span> </li>
                                        @endif
                                    </ul>
                                   
                                    <!--<ul class="products-info">
                                     
                                        <li><span>{{ number_format((float)$producto->precio_normal,2,'.',',') }}</span></li>
                                        <li><span>{{ number_format((float)$producto->precio_final,2,'.',',') }}</span></li>
                                        <li><span>{{ $producto->minimo_compra_oferta }}</span></li>
                                        <li><span class="existo">--</span></li>
                                    </ul>-->
                                    <!--<div class="product-add-to-cart">
                                        <button type="submit" class="default-btn">
                                            <i class="flaticon-star"></i>
                                            Agregar a favoritos
                                            <span></span>
                                        </button>
                                    </div>-->
                                    @php
                                        $equivConMarca = collect($equivalencias)->filter(fn($e) => $e->id_marca > 0);
                                        $equivSinMarca = collect($equivalencias)->filter(fn($e) => !$e->id_marca || $e->id_marca == 0);
                                    @endphp
                                    @if($equivConMarca->count() > 0)
                                    <br><br><h5>Mismo producto, en otras marcas:</h5>
                                    <ul class="products-info">
                                        @foreach($equivConMarca as $eq)
                                            <li>
                                                <a href="{{route('pagina.detalles_producto',$eq->clave)}}">{{$eq->marca}} - {{$eq->clave}}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="products-details-tabs">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description" role="tab" aria-controls="description">Compatibilidad</a></li>
                        </ul>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="description" role="tabpanel">

                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Marca
                                        </th>
                                        <th>
                                            Modelo
                                        </th>
                                        <th>
                                            Desde
                                        </th>
                                        <th>
                                            Hasta
                                        </th>
                                        <th>
                                            Generación
                                        </th>
                                        <th>
                                            Versión
                                        </th>
                                        <th>
                                            Motor
                                        </th>
                                        <th>
                                            Nota
                                        </th>
                                    </tr>
                                    @foreach($especificaciones as $especificacion)
                                        @if($especificacion->modelo != "")
                                        <tr>
                                            <td>
                                                {{$especificacion->armadora}}
                                            </td>
                                            <td>
                                                {{$especificacion->modelo}}
                                            </td>
                                            <td>
                                                {{$especificacion->ano_inicial}}
                                            </td>
                                            <td>
                                                {{$especificacion->ano_final}}
                                            </td>
                                            <td>
                                                {{$especificacion->generacion_mexico}}
                                            </td>
                                            <td>
                                                {{$especificacion->version}}
                                            </td>
                                            <td>
                                                {{$especificacion->motor}}
                                            </td>
                                            <td>
                                                {{$especificacion->especificacion}}
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    @foreach($especificaciones_extra as $especificacion)
                                        @if($especificacion->modelo != "")
                                        <tr>
                                            <td>
                                                {{$especificacion->armadora}}
                                            </td>
                                            <td>
                                                {{$especificacion->modelo}}
                                            </td>
                                            <td>
                                                {{$especificacion->ano_inicial}}
                                            </td>
                                            <td>
                                                {{$especificacion->ano_final}}
                                            </td>
                                            <td>
                                                {{$especificacion->generacion_mexico}}
                                            </td>
                                            <td>
                                                {{$especificacion->version}}
                                            </td>
                                            <td>
                                                {{$especificacion->motor}}
                                            </td>
                                            <td>
                                                {{$especificacion->especificacion}}
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12">
                    <aside class="widget-area">


                        <section class="widget widget_categories">
                            <h3 class="widget-title">Categoria</h3>

                            <ul>
                                <li>
                                    <span>{{$producto->grupo}}</span>
                                </li>
                                <li>
                                    <span>{{$producto->subgrupo}}</span>
                                </li>
                            </ul>
                        </section>

                        @if($equivSinMarca->count() > 0)
                            <section class="widget widget_categories">
                                <h3 class="widget-title">Equivalencias</h3>
                                <ul>
                                    @foreach($equivSinMarca as $equiv)
                                        <li>
                                            <span>{{$equiv->clave}}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </section>
                        @endif

                    </aside>
                </div>
            </div>
        </div>
    </section>
    <!-- End Products Details Area -->

    <!-- Start Top Products Area -->
    <section class="top-products-area bg-color pt-100 pb-70">
        <div class="container">
            <div class="section-title">
                <h2>Productos Relacionados</h2>
            </div>

            <div class="row">
                @foreach($relacionados as $relacionado)
                    <div class="col-lg-3 col-sm-6">
                        <div class="">
                            <div class="top-products-image text-center">
                                <a href="{{route('pagina.detalles_producto',$relacionado['codigo_nikko'])}}">
                                <?php
                                    if(str_contains($relacionado['codigo_nikko'], '/'))
                                        $codigo_nikko = str_replace("/", ":", $relacionado['codigo_nikko']);
                                    else 
                                        $codigo_nikko = $relacionado['codigo_nikko'];

                                        $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                        if(file_exists($directory))
                                            $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                        else
                                            $files = [];
                                    ?>
                                    @if(count($files) > 0)
                                            <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[0],PHP_EOL)) }}" alt="Product Image" style="max-height:150px">
                                    @else
                                            <img src="{{ asset('img/sin-foto.jpg') }}" alt="Product Image" style="max-height:150px">
                                    @endif
                                </a>
                                
                        
                           
                            </div>

                            <div class="top-products-content text-center" style="margin-bottom:35px;">
                                <h3>
                                    <a href="{{route('pagina.detalles_producto',$relacionado['codigo_nikko'])}}">{{$relacionado['codigo_nikko']}}</a>
                                    <p>{{$relacionado['descripcion_1']}}</p>
                                </h3>
                                <!-- <span>$89.00</span>-->
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>
   
    @stop

    @section('js')

     <!-- End Top Products Area -->
     <script>

$('.slider-productos').slick({
  slidesToShow: 1,
  slidesToScroll: 1,
  arrows: false,
  fade: true,
  asNavFor: '.slider-productos-mini'
});
$('.slider-productos-mini').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  asNavFor: '.slider-productos',
  dots: true,
  centerMode: true,
  focusOnSelect: true
});
    

        $.get("https://sistemasowari.com:8443/catalowari/api/producto-existencia?clave={{ urlencode($producto->codigo_nikko) }}",{},
            function (data, textStatus, jqXHR) {
                data = JSON.parse(data);
                var existencia = parseInt(data.existencia);
                $('.existo').text("").text(existencia);
            }
        );

    </script>
    @stop
    @section('css')
    <style>
        .slider-productos{
            margin-top: 30px;
        }
        .slider-productos-mini .slide{
            padding:10px;
            max-height: 250px;
        }
        .slick-arrow::before{
            font-size: 30px;
            color:black;
        }
    </style>
    @stop