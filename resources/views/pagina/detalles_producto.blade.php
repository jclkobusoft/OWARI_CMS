@extends('pagina.base')

@section('js')
    <script src='https://unpkg.com/spritespin@4.1.0/release/spritespin.js' type='text/javascript'></script>
    {{ Html::script('js/jquery.zoom.js') }}

    <script type="text/javascript">


    <?php
        if(str_contains($producto->codigo_nikko, '/'))
            $codigo_nikko = str_replace("/", ":", $producto->codigo_nikko);
        else 
            $codigo_nikko = $producto->codigo_nikko;
    ?>





    @if(is_dir(public_path()."/360/".$codigo_nikko."_360"))
        $('a.fancybox_iframe').fancybox({
              fitToView: false,
              'autoSize' : false,
              type: 'iframe',
              width: "800",
              heigth: "600",
              scrolling: 'no',
              iframe: {
                scrolling : 'no',
                preload   : true
              },
              'autoscale' : true,
        });

    @endif


    </script>

 


@endsection



@section('contenido')
<style type="text/css">
    iframe::-webkit-scrollbar {   
        display: none; 
    }

    .boton_escritorio{
        display:block;
    }
    .boton_movil {
        display:none;
    }

    @media(max-width: 767px) {
                .boton_escritorio{
                    display:none;
                }
                .boton_movil {
                    display:block;
                }
    }
</style>

<!-- Product Area -->
    <section class="vs-product-details product-details-layout1 pt-100 pb-90">
        <div class="container">
            <div class="row branch-information-layout2" style="background-color: white !important;"> 
                <a href="javascript:window.close()">
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
            <div class="row gutters-40 align-items-start align-items-xl-center">
                <!-- Porduct header -->
                <div class="col-lg-6 col-xl-5">
                    <div class="product-header pb-50">
                        <!-- Product Image -->
                        <div class="product-details-img">
                            <?php
                                  $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                  if(file_exists($directory))
                                      $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                  else
                                      $files = [];
                            ?>
                            <!-- Single Image -->
                             @if(count($files) > 0)
                                @foreach($files as $key => $imagen)
                                    <div>
                                        <a download style="position: absolute; top:10px; left:10px;" href="{{ asset("storage/productos/".$codigo_nikko."/".basename($imagen,PHP_EOL)) }}" class="blue-text">Descargar imagen</a>
                                        <a href="{{ asset("storage/productos/".$codigo_nikko."/".basename($imagen,PHP_EOL)) }}" data-fancybox="images"><img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($imagen,PHP_EOL)) }}" alt="Product Image"></a>
                                        <!-- Product discount -->
                                    </div>
                                    @endforeach
                              @else
                                <div>
                                    <a href="{{ asset('img/sin-foto.png') }}" data-fancybox="images"><img src="{{ asset('img/sin-foto.png') }}" alt="Product Image"></a>
                                        <!-- Product discount -->
                                </div>
                              @endif
                            
                        </div>
                        <!-- Product Thumb -->
                        <div class="product-details-thumb">
                            <!-- single thumb -->
                            @if(count($files) > 0)
                                @foreach($files as $key => $imagen)
                                    <div>
                                        <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($imagen,PHP_EOL)) }}" alt="Product Image">
                                    </div>
                                    @endforeach
                              @else
                                <div>
                                    <img src="{{ asset('img/sin-foto.png') }}" alt="Product Image">
                                </div>
                              @endif
                        </div>
                        
                        @if(is_dir(public_path()."/360/".$codigo_nikko."_360"))
                            <div class="row branch-information-layout2 mt-20" style="background-color: white !important;"> 
                                <a class="iframe fancybox_iframe boton_escritorio" href="{{ route('pagina.pagina_360',$producto->codigo_nikko) }}">
                                    <div class="info-box">
                                        <div class="icon">
                                            <span><i class="fal fa-repeat"></i></span>
                                        </div>
                                        <div class="content">
                                            <span class="info-title" style="color:#0046e2;">Ver imagen 360°</span>
                                        </div>
                                    </div>
                                </a>
                                <a class="boton_movil" target="_blank" href="{{ route('pagina.pagina_360',$producto->codigo_nikko) }}">
                                    <div class="info-box">
                                        <div class="icon">
                                            <span><i class="fal fa-repeat"></i></span>
                                        </div>
                                        <div class="content">
                                            <span class="info-title" style="color:#0046e2;">Ver imagen 360°</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif


                    </div>
                </div>
                <!-- Porduct header end -->

                <!-- Product body -->
                <div class="col-lg-6 col-xl-7">
                    <div class="product-body pb-50">
                        <div class="product-content">
                            <!-- Product Price -->
                            <!--<div class="price">
                                <del>$1200.00</del>
                                <span>$999.00</span>
                            </div>-->
                            <!-- Product Title -->
                            <h1>{{ $producto->descripcion_1 }} @if($producto->descripcion_2 != "---"){{ $producto->descripcion_2 }}@endif  @if($producto->descripcion_3 != "---"){{ $producto->descripcion_3 }}@endif</h1>
                            <h2 class="product-title">{{ $producto->codigo_nikko }}</h2>
                            <!-- Product Features -->

                            <h2 style="font-size: 22px; text-transform: none;">Detalles del producto</h2>
                            <div class="product-features">
                                <ul>
                                    <li>Grupo: <b>{{ $producto->grupo }}</b></li>
                                    <li>Familia: <b>{{ $producto->subgrupo }}</b></li>
                                    <li>Codigo: <b>{{ $producto->codigo_nikko }}</b></li>
                                    <li>Datos tecnicos: <b>{{ $producto->caracteristicas_1 }}
                                                        {{ $producto->caracteristicas_2 }}
                                                        {{ $producto->caracteristicas_3 }}
                                                        {{ $producto->caracteristicas_4 }}
                                                     </b></li>
                                    <li>Marca: <b>{{ $producto->marca_comercial }}</b></li>
                                </ul>
                            </div>

                            <h2 style="font-size: 22px;text-transform: none;">Referencias comerciales</h2>
                            <div class="product-features" id="ver_aplicaciones">
                                <ul>
                                    <li><b>{{ $producto->equivalencia_1 }}</b></li>
                                    <li><b>{{ $producto->equivalencia_2 }}</b></li>
                                    <li><b>{{ $producto->equivalencia_3 }}</b></li>
                                    <li><b>{{ $producto->equivalencia_4 }}</b></li>
                                    <li><b>{{ $producto->equivalencia_5 }}</b></li>
                                </ul>
                            </div>
                            <!-- Product Action Buttons -->
                            
                        </div>
                    </div>
                </div>
                <!-- Product body -->

                <div class="col-12">
                    <!-- Product Tab Menu -->
                    <ul class="nav product-tab-nav" id="productTab" role="tablist">
                        <li>
                            <a id="review-tab" class="active" data-toggle="tab" href="#review" role="tab" aria-controls="review" aria-selected="false">Vehículos/Aplicaciones</a>
                        </li>
                    </ul>
                    <!-- Product Tab Menu end -->

                    <!-- Product Tab Content Area -->
                    <div class="tab-content" id="productDetailsTab">
                        <div class="tab-pane show active" id="review" aria-labelledby="review-tab">
                            <style>
                              
                              .parimpar tr:nth-child(even) {background: #e6e6e6}
                              .parimpar th {
                                color: white;
                                background: #0046e2;
                              }
                            </style>
                            <table class="parimpar table table-bordered mb-0">
                              <tr align="center">
                                <th>ARMADORA</th>
                                <th>MODELO</th>
                                <th>GENERACIÓN</th>
                                <th>VERSIÓN</th>
                                <th>AÑO INICIAL</th>
                                <th>AÑO FINAL</th>
                                <th>MOTOR</th>
                                <th>ESPECIFICACIONES</th>
                              </tr>
                              @foreach($tabla as $prod)
                                <?php
                                    $texto_motor = ($prod->litros != "" && $prod->litros != "---" ? $prod->litros : "")." ".($prod->unidad_litros != "" && $prod->unidad_litros != "---" ? $prod->unidad_litros : "")." ".($prod->cilindros != "" && $prod->cilindros != "---" ? $prod->cilindros : "")." ".($prod->unidad_cilindros != "" && $prod->unidad_cilindros != "---" ? $prod->unidad_cilindros : "")." ".($prod->bloqueo_motor != "" && $prod->bloqueo_motor != "---" ? $prod->bloqueo_motor : "");

                                ?>
                              <tr align="center">
                                  <td>{{ $prod->armadora !="" ? $prod->armadora : "---" }}</td>
                                  <td>{{ $prod->modelo !="" ? $prod->modelo : "---" }}</td>
                                  <td>{{ $prod->generacion_mexico !="" ? $prod->generacion_mexico : "---" }}</td>
                                  <td>{{ $prod->version !="" ? $prod->version : "---" }}</td>
                                  <td>{{ $prod->ano_inicial !="" ? $prod->ano_inicial : "---" }}</td>
                                  <td>{{ $prod->ano_final !="" ? $prod->ano_final : "---" }}</td>
                                  <td>{{ trim($texto_motor) }}</td>
                                  <td>{{ $prod->especificacion !="" ? $prod->especificacion : "---" }}</td>
                              </tr>
                              @endforeach
                            </table>
                            @if($producto->extra != NULL)
                                <p><br><b>{{ $producto->extra }}</b></p>
                            @endif
                        </div>
                    </div>
                    <!-- Product Tab Content Area end -->
                </div>
            </div>
        </div>
    </section>
    <!-- Product Area End -->
@if(count($resultados) > 0)
    <!-- Related Product Area -->
    <div class="related-product-area vs-product-layout1 pb-100">
        <div class="container">
            <!-- Sectiono Title -->
            <div class="section-title text-center">
                <h2 class="title">Productos relacionados</h2>
            </div>
            <div class="row">
                <?php
                  $i = 0;
                  $mostrados = [];
                ?>
                
                @foreach($resultados as $resultado)
                        @if($i<3 && $producto->codigo_nikko != $resultado->codigo_nikko && !isset($mostrados[$resultado->codigo_nikko]))
                            <!-- Single Product -->
                            <?php
                                $mostrados[$resultado->codigo_nikko]=true;
                            ?>
                            <div class="col-md-6 col-lg-4">
                                <div class="vs-product">
                                    <!-- Product Header -->
                                     <a href="{{ route('pagina.detalles_producto') }}?clave={{ $resultado->codigo_nikko }}" target="_blank">
                                    <div class="product-header">
                                        <!-- Porduct Image -->
                                         <!-- Porduct Image -->
                                        <?php
                                                    if(str_contains($resultado->codigo_nikko, '/'))
                                                        $codigo_nikko = str_replace("/", ":", $resultado->codigo_nikko);
                                                    else 
                                                        $codigo_nikko = $resultado->codigo_nikko;

                                                  $directory = storage_path().'/app/public/productos/'.$codigo_nikko;
                                                  if(file_exists($directory))
                                                      $files = \Storage::allFiles('public/productos/'.$codigo_nikko."/");
                                                  else
                                                      $files = [];
                                        ?>
                                        @if(count($files) > 0)
                                            <div class="product-img text-center">
                                                <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[0],PHP_EOL)) }}" alt="Product Image" style="width:inherit;;max-height:200px">
                                            </div>
                                          @else
                                            <div class="product-img">
                                                <img src="{{ asset('img/sin-foto.png') }}" style="max-height:200px;width:inherit;" alt="Product Image">
                                            </div>
                                          @endif
                                    </div>
                                </a>
                                    <!-- Product Body -->
                                    <div class="product-body">
                                        <div class="product-content">
                                            <!-- Product Price -->
                                            <!--<div class="price">
                                                <del>$920.00</del>
                                                <span>$800.00</span>
                                            </div>-->
                                            <!-- Product Title -->
                                            <h3 class="product-title"><a target="_blank" href="{{ route('pagina.detalles_producto') }}?clave={{ $resultado->codigo_nikko }}">{{ $resultado->codigo_nikko }} <br>{{ $resultado->descripcion_1 }}@if($resultado->descripcion_2 != "---"){{ " ".$resultado->descripcion_2 }}@endif  @if($resultado->descripcion_3 != "---"){{ " ".$resultado->descripcion_3 }}@endif</a></h3>
                                            <!-- Product Rating -->
                                            <ul>
                                                <li>Marca: {{ $resultado->marca_comercial }}</li>
                                                <li>Grupo: {{ $resultado->grupo }}</li>
                                            </ul>
                                            <br>
                                            <a target="_blank" class="primary-btn" href="{{ route('pagina.detalles_producto') }}?clave={{ $resultado->codigo_nikko }}#ver_aplicaciones">Ver aplicaciones</a>

                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Single Product -->
                            <?php
                              $i++;
                            ?>
                            @endif
                  @endforeach


            </div>
        </div>
    </div>
    <!-- Related Product Area end -->
@endif

 <div class="modal vista360" id="emergente360" tabindex="-1">
        <div class="modal-dialog modal-lg" style="max-width:900px !important;">
          <div class="modal-content">
            <div class="modal-body text-center">
                  <p>Da click y arrastra el mouse en el sentido que quieras rotar la imagen.</p>
                  <div id="view360" style="width:100%">
                </div>
            </div>
          </div>
        </div>
      </div>



<!--// Main Content \\-->

@endsection