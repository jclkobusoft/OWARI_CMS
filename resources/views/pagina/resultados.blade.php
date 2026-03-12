@extends('pagina.base')

@section('contenido')
<style type="text/css">
    .sidebar{
        position: absolute;
        top:172px;
        left:0px;
        color:black;
        width: 330px;
        border:1px solid #0046e2;
        background-color: white;
        z-index: 100;
        transform: translate(-100%,0);
    }
    .open_menu{
        position: absolute;
        top:172px;
        left:20px;
    }
    .cerrar_categoria{
        position: absolute;
        top: -25px;
        background-color: white;
        right: 31px;
    }
    .video-btn.especial{
        font-size:12px;
    }

    .faq-layout1 .faq-area {
        background:none;
        padding-left: 10px;
        padding-right: 10px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .faq-layout1 .faq-area .single-faq .faq-header h3.faq-title button:after {
    font-family: "Font Awesome\5 Pro";
}

    .faq-layout1 .faq-area .single-faq .faq-header h3.faq-title button.collapsed, .faq-layout1 .faq-area .single-faq .faq-body .faq-text {
    
        color: #01133c !important;
    }

    .faq-layout1 .faq-area .single-faq .faq-header h3.faq-title button.collapsed,.faq-layout1 .faq-area .single-faq .faq-header h3.faq-title button{
        border-color: #99b3ec;
    }
    .single-faq:last-child{
        margin-bottom: 0px !important;
    }
    .faq-body{
        padding-left:50px !important;
        padding-top: 15px !important;
    }
    .faq-layout1 .faq-area .single-faq .faq-body .faq-text.active{
        font-weight: bold;
        color: #e30613 !important;
    }

    @media(max-width: 767px) {
                .open_menu {
                    position: absolute;
                    top: 105px;
                    left: 18px;
                }
                .sidebar{
                top:105px;
                left: 0;
                }
    }
</style>

 <section class="vs-product-wrapper vs-product-layout1  pt-50 pb-130" style="position:relative;">
        <div class="row branch-information-layout2 pb-50 open_menu" style="background-color: white !important;"> 
                <a href="#" class="abrir_categoria primary-btn">
                    Ver por categorias
                </a>
            </div>
       <div class="sidebar">
         <div class="row branch-information-layout2" style="background-color: white !important; width:100%; padding-top: 5px !important; height: 21px;"> 
                <a href="#" class="cerrar_categoria">
                    <div class="info-box">
                        <div class="icon">
                            <span><i class="fal fa-window-close"></i></span>
                        </div>
                        <div class="content">
                            <span class="info-title" style="color:#0046e2;">Cerrar</span>
                        </div>
                    </div>
                </a>
            </div>
        <div class="faq-wrapper faq-layout1">
                <div class="faq-area" id="axivisfaq1">           
                        <?php 
                            $i=0;
                        ?>
                        @foreach ($slider as $key => $value)
                            <?php 
                                $i++
                            ?> 
                            <!-- Single FAQ -->
                            <div class="single-faq">
                                <!-- FAQ Head -->
                                <div class="faq-header">
                                    <h3 class="faq-title">
                                        <button class="collapsed" type="button" data-toggle="collapse" data-target="#faq{{ $i }}" aria-expanded="false" aria-controls="faq{{ $i }}">{{ $key }}</button>
                                    </h3>
                                </div>
                                <!-- FAQ Body -->
                                <div id="faq{{ $i }}" class="collapse para_abrir" data-parent="#axivisfaq1">
                                    <div class="faq-body">
                                        @foreach($value as $llave => $valor)
                                        <a class="faq-text @if(isset($_GET['ver_grupo'])) @if(str_replace("_"," ",$_GET['ver_grupo']) == $valor) active @endif @endif" style="display:block;" href="{{ route('pagina.resultados') }}?query=&pagina=1&ano=0&marca=0&modelo=0&motor=0&grupo=0&familia=0&ver_grupo={{ trim(str_replace(' ','_',$valor)) }}">{{ $valor }}</a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- SINGLE -->
                        @endforeach
                        
                        



                </div>
        </div>

       </div>
    
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

            <?php
                    if(isset($_GET['con_filtro'])){
                        $busque_query = "";
                    }
                    elseif(isset($_GET['query'])){
                        $busque_query = $_GET['query'];
                    }
                    else
                        $busque_query = "";

                    
                    if($busque_query != ""){
                        $busque_ano = "0";
                        $busque_marca = "0";
                        $busque_modelo = "0";
                        $busque_motor = "0";
                        $busque_grupo = "0";
                        $busque_familia = "0";

                    }
                    else{
                        $busque_ano = isset($_GET['ano']) ? $_GET['ano'] : "0";
                        $busque_marca = isset($_GET['marca'])  ? $_GET['marca'] : "0";
                        $busque_modelo = isset($_GET['modelo'])  ? $_GET['modelo'] : "0";
                        $busque_motor = isset($_GET['motor'])  ? $_GET['motor'] : "0";
                        $busque_grupo = isset($_GET['grupo'])  ? $_GET['grupo'] : "0";
                        $busque_familia = isset($_GET['familia'])  ? $_GET['familia'] : "0";
                    }


                    $busque_pagina = isset($_GET['pagina'])  ? $_GET['pagina'] : "1";

            ?>
            <div class="row flex-row-reverse">
                <div class="col-12">
                    <!-- product sort bar -->
                    <div class="product-sort-bar">
                        <!-- Bar left -->
                        <div class="sort-bar-left">
                            @if(isset($_GET['ver_grupo']))
                                <h1 class="bar-title">Mostrando todo {{ str_replace("_"," ", $_GET['ver_grupo']) }}</h1>
                            @else
                            <h1 class="bar-title">{{ $busque_query != "" ? "Mostrando los resultados de: ".$busque_query : "Mostrando los productos filtrados"  }}</h1>
                            @endif
                            <h1 class="bar-title">Total de resultados: {{ $total_resultados }}</h1>
                        </div>
                        <!-- Bar Right -->
                        <div class="sort-bar-right">
                            <!-- Short Box -->
                            <div class="sort-box">
                            </div>
                        </div>
                    </div>
                    <!-- product sort bar end -->
                    <div class="vs-product-area">
                        <div class="row">
                                <?php 
                                    if(isset($resultados[0]->score))
                                        $score = $resultados[0]->score;
                                    
                                    $titulo = true;
                                ?>
                            @foreach($resultados as $resultado)
                            <!-- Single Product -->
                            @if(isset($resultado->score) && $titulo && $_GET['pagina'] == 1)
                                @if($resultado->score < $score)
                                        <?php
                                            $titulo = false;
                                        ?>
                                     <div class="col-md-12 col-lg-12">
                                        <h4 style="padding: 60px 0px 30px; text-align: center; color:#0046e2;">PRODUCTOS SIMILARES</h4>
                                     </div>
                                @endif
                            @endif
                            <div class="col-md-6 col-lg-4">
                                <div class="vs-product">
                                    <!-- Product Header -->
                                     <a href="{{ route('pagina.detalles_producto') }}?clave={{ $resultado->codigo_nikko }}" target="_blank">
                                        <div class="product-header">
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
                                                <div class="product-img">
                                                    <img src="{{ asset("storage/productos/".$codigo_nikko."/".basename($files[0],PHP_EOL)) }}" alt="Product Image">
                                                </div>
                                              @else
                                                <div class="product-img">
                                                        <img src="{{ asset('img/sin-foto.png') }}" alt="Product Image">
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
                            @endforeach

                        <?php
                                 if(isset($_GET['con_filtro'])){
                                        $busque_query = "";
                                    }
                                    elseif(isset($_GET['query'])){
                                        $busque_query = $_GET['query'];
                                    }
                                    else
                                        $busque_query = "";                                

                                if($busque_query != ""){
                                    $busque_ano = "0";
                                    $busque_marca = "0";
                                    $busque_modelo = "0";
                                    $busque_motor = "0";
                                    $busque_grupo = "0";
                                    $busque_familia = "0";

                                }
                                else{
                                    $busque_ano = isset($_GET['ano']) ? $_GET['ano'] : "0";
                                    $busque_marca = isset($_GET['marca'])  ? $_GET['marca'] : "0";
                                    $busque_modelo = isset($_GET['modelo'])  ? $_GET['modelo'] : "0";
                                    $busque_motor = isset($_GET['motor'])  ? $_GET['motor'] : "0";
                                    $busque_grupo = isset($_GET['grupo'])  ? $_GET['grupo'] : "0";
                                    $busque_familia = isset($_GET['familia'])  ? $_GET['familia'] : "0";
                                }



                        ?>
                        </div>

                        @if($total_resultados > 51)
                        <div class="pagination-wrapper pagination-layout1 pt-30 pb-5 pb-lg-0">
                            <ul>
                                @if($_GET['pagina'] > 1)
                                    <li><a href="{{ route('pagina.resultados') }}?query={{ $busque_query }}&pagina={{ $_GET['pagina']-1 }}&ano={{ $busque_ano }}&marca={{ $busque_marca }}&modelo={{ $busque_modelo }}&motor={{ $busque_motor }}&grupo={{ $busque_grupo }}&familia={{ $busque_familia }}@if(isset($_GET['ver_grupo']))&ver_grupo={{ $_GET['ver_grupo'] }}@endif"><i class="fas fa-chevron-left"></i></a></li>
                                @endif
                                @foreach($botones as $key => $value)
                                <li><a href="@if($value !="...") {{ route('pagina.resultados') }}?query={{ $busque_query }}&pagina={{ $value }}&ano={{ $busque_ano }}&marca={{ $busque_marca }}&modelo={{ $busque_modelo }}&motor={{ $busque_motor }}&grupo={{ $busque_grupo }}&familia={{ $busque_familia }}@if(isset($_GET['ver_grupo']))&ver_grupo={{ $_GET['ver_grupo'] }}@endif @endif" @if($_GET['pagina'] == $value) class="active" @endif>{{ $value }}</a></li>
                                @endforeach
                                @if($_GET['pagina'] < ceil($total_resultados/51))
                                    <li><a href="{{ route('pagina.resultados') }}?query={{ $busque_query }}&pagina={{ $_GET['pagina']+1 }}&ano={{ $busque_ano }}&marca={{ $busque_marca }}&modelo={{ $busque_modelo }}&motor={{ $busque_motor }}&grupo={{ $busque_grupo }}&familia={{ $busque_familia }}@if(isset($_GET['ver_grupo']))&ver_grupo={{ $_GET['ver_grupo'] }}@endif"><i class="fas fa-chevron-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection