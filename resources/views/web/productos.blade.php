@extends('web.plantilla.base')      
@section('contenido')
    <!-- Start Page Banner -->
    <div class="pb-2 pt-5">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">

                    <div class="col-12 text-center">
                        <h2>Nuestros productos</h2>
                        <h4>{{$busqueda}}</h4>
                        <h4>{{$total_resultados}} producto(s)</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Page Banner -->

    <!-- Start Shop Area -->
    <section class="shop-area ptb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-12 d-none d-md-block">
                    <div class="shop-category">
                        <div class="category-title">
                            <a href="#">Categorias</a>
                        </div>
                        <div class="shop-category-menu">


                            <div class="accordion accordion-flush" id="accordionFlushExample">

                                <?php 
                                        $i=0;  
                                    ?>
                                @foreach($categorias as $key => $value)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-heading{{$i}}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{$i}}" aria-expanded="false" aria-controls="flush-collapse{{$i}}">
                                                {{$key}}
                                            </button>
                                        </h2>
                                        <div id="flush-collapse{{$i}}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{$i}}" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body p-0">
                                                <ul class="w-100 list-group">
                                                    @foreach($value as $indice => $valor)
                                                        <li class="list-group-item w-100"><small><a href="{{route("pagina.productos")}}?q={{$valor}}&p=1&c=1">{{$valor}}</a></small></li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php 
                                        $i++;
                                    ?>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-9 col-md-12">
                    <div class="row">
                        @foreach($resultados as $key => $resultado)
                            <div class="col-md-6 col-6">
                                <div class="shop-item-box">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="shop-image">
                                                 <?php
                                                        if(str_contains($resultado->codigo_nikko, '/'))
                                                            $codigo_nikko = str_replace("/", "_", $resultado->codigo_nikko);
                                                        else 
                                                            $codigo_nikko = $resultado->codigo_nikko;


                                                        if(str_contains($resultado->codigo_nikko, '#'))
                                                            $codigo_nikko = str_replace("#", "+", $resultado->codigo_nikko);
                                                ?>

                                                <a href="{{route('pagina.detalles_producto',$codigo_nikko)}}">
                                               <?php

                                                        $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                                        
                                                        if(file_exists($directory))
                                                            $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                                        else
                                                            $files = [];
                                                    
                                                        arsort($files);
                                                        
                                                    ?>
                                                    @if(count($files) > 0)
                                                        <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[array_key_first($files)],PHP_EOL)) }}" alt="Product Image">
                                                    @else
                                                        <img src="{{ asset('img/sin-foto.jpg') }}" alt="Product Image">
                                                    @endif
                                                </a>
                                            </div>
                                           
                                            
                                        </div>
                                        <div class="col-lg-6 col-sm-6 col-12">
                                            <div class="shop-content">
                                                <h3 style="margin:0;">
                                                    <a href="{{ route('pagina.detalles_producto',$codigo_nikko) }}">{{$resultado->codigo_nikko}}</a>
                                                    <small>{{ $resultado->marca_comercial }}</small>
                                                </h3>
                                                @foreach($resultado->equivalencias as $equiv)
                                                    <small>{{$equiv}}</small>
                                                @endforeach

                                                <ul class="shop-list">
                                                    <li>{{$resultado->descripcion_1}} @if($resultado->descripcion_2 != "") {{$resultado->descripcion_2}} @endif @if($resultado->descripcion_3 != "") {{$resultado->descripcion_3}} @endif</li>
                                                    @if($resultado->caracteristicas_1 != "") 
                                                        <li>{{$resultado->caracteristicas_1}}</li>
                                                    @endif
                                                    @if($resultado->caracteristicas_2 != "") 
                                                        <li>{{$resultado->caracteristicas_2}}</li>
                                                    @endif
                                                    @if($resultado->caracteristicas_3 != "") 
                                                        <li>{{$resultado->caracteristicas_3}}</li>
                                                    @endif
                                                    @if($resultado->caracteristicas_4 != "") 
                                                        <li>{{$resultado->caracteristicas_4}}</li>
                                                    @endif
                                                    <li>{{$resultado->grupo}} - {{$resultado->subgrupo}}</li>

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="row" style="font-size:14px; font-weight:bold; margin:5px 0;">
                                                    <div class="col-md-3">{{ number_format((float)$resultado->precio_normal,2,'.',',') }}</div>
                                                    <div class="col-md-3">{{ number_format((float)$resultado->precio_final,2,'.',',') }}</div>
                                                    <div class="col-md-3">{{ $resultado->minimo_compra_oferta }}</div>
                                                    <div class="col-md-3 existencia_real_{{ $key }}"></div>
                                                    <script>
                                                        setTimeout(() => {
                                                            $.get("https://sistemasowari.com:8443/catalowari/api/producto-existencia?clave={{ urlencode($resultado->codigo_nikko) }}",{},
                                                                    function (data, textStatus, jqXHR) {
                                                                        data = JSON.parse(data);
                                                                        var existencia = parseInt(data.existencia);
                                                                        $('.existencia_real_{{ $key }}').text("").text(existencia);
                                                                    }
                                                                );
                                                        }, 1500);
                                                    </script>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <div class="shop-content">
                                                <ul class="shop-btn-list">
                                                    <li>
                                                        <!--<a href="wishlist.html" class="mb-1 btn-primary">Agregar a mis favoritos</a>-->
                                                        <a href="{{route('pagina.detalles_producto',$codigo_nikko)}}">Ver detalles</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <style>
                        small{
                            font-size:10px;
                            line-height:12px;
                            display:block;
                        }
                        .shop-item-box .shop-content .shop-list li {
                            font-size:15px;
                            line-height:17px;
                            margin-bottom:2px;
                        }
                        .shop-image img{
                            max-height: 150px
                        }

                        @media only screen and (max-width: 768px) {
                            .shop-item-box .shop-content{ 
                                text-align:left;
                            }
                            .shop-item-box .shop-content .shop-list li {
                                font-size:11px;
                                line-height:13px;
                                margin-bottom:0px;
                                text-align: left;
                            }
                            .shop-item-box .shop-content h3 {
                                font-size:14px;
                                line-height:16px;
                            }
                            .shop-image img{
                                max-height: 100px
                            }
                            .shop-item-box {
                                padding:5px 10px;
                            }
                            .shop-item-box .shop-content {
                                margin-bottom:10px;
                            }
                            .shop-item-box{
                                margin: 5px 0px!important;
                            }
                        }
                    </style>


                    <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            @if($pagina > 1)
                                <a href="{{\Request::url().$peticion.($pagina-1)}}" class="prev page-numbers">
                                    <i class='bx bxs-chevron-left'></i>
                                </a>
                            @endif
                            @foreach($botones as $key => $value)
                                @if($pagina == $value)
                                    <span class="page-numbers current" aria-current="page">{{$value}}</span>
                                @elseif("..." == $value)    
                                    <span class="page-numbers">{{$value}}</span>
                                @else
                                    <a href="{{\Request::url().$peticion.$value}}" class="page-numbers">{{$value}}</a>
                                @endif
                            @endforeach
                            @if($pagina < ceil($total_resultados/51))
                                <a href="{{\Request::url().$peticion.($pagina+1)}}" class="next page-numbers">
                                    <i class='bx bxs-chevron-right'></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Shop Area -->
    
    @stop