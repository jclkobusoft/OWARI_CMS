<?php


    $ano_min = App\Models\ProductoBusqueda::whereRaw("ano_inicial REGEXP '^-?[0-9]+$'")->where('ano_inicial','>','0')->min('ano_inicial');
    $ano_max = App\Models\ProductoBusqueda::whereRaw("ano_final REGEXP '^-?[0-9]+$'")->where('ano_final','>','0')->max('ano_final');
    $anos = array_reverse(range($ano_min,$ano_max));
    $marcas_buscador = App\Models\ProductoBusqueda::select('armadora')->whereNotNull('armadora')->distinct('armadora')->orderBy('armadora','asc')->get();
    $modelos_buscador = App\Models\ProductoBusqueda::select('modelo')->whereNotNull('modelo')->distinct('modelo')->orderBy('modelo','asc')->get();
    $motores_buscador = App\Models\ProductoBusqueda::select('motor')->whereNotNull('motor')->distinct('motor')->orderBy('motor','asc')->get();
    $grupos_buscador = App\Models\ProductoBusqueda::select('grupo')->whereNotNull('grupo')->distinct('grupo')->orderBy('grupo','asc')->get();
    $familias_buscador = App\Models\ProductoBusqueda::select('subgrupo')->whereNotNull('subgrupo')->distinct('subgrupo')->orderBy('subgrupo','asc')->get();

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


<style>
    body {
       zoom:  0.75 !important;
       zoom:  75% !important;
    }
    .el_logo{
        max-width: 130px !important;
    }
    header{
        z-index: 9 !important;
        position: sticky;
        top: 0;
    }
    .select2-container .select2-selection--single .select2-selection__arrow {
        height: 45px !important;
    }
    .select2-container span.select2-selection {
        height: 45px !important;
        border-radius:6px !important;
        margin-bottom: 6px;
    }.select2-container .select2-selection--single .select2-selection__rendered {
        line-height: 45px !important;
    }
    .redes_sociales {
        position: absolute;
        bottom: -200px;
        transform: translate(0,100%);
        z-index: 9999;
        right: 30px;
    }

    .redes_sociales ul li a{
        display: block;
        width: 45px;
        height: 45px;
        line-height: 45px;
        text-align: center;
        background-color: #e30613;
        color: #ffffff;
        font-size: 16px;
        box-shadow: 0px 16px 32px 0px rgb(249 163 146 / 20%);
        border-radius: 50%;
        margin-bottom: 30px;
    }

    .redes_sociales ul li a:hover {
            color: #ffffff;
            background-color: #e30613;
    }
    .breadcumb-layout1:before {        
        opacity: 0 !important;
    }

    .testomonial-layout4:before {
        opacity: 0 !important;       
    }

    .flechita-prev{
        position:absolute; 
        top:50%; 
        left:0; 
        transform:translate(0,-100%);
    }
    .flechita-next{
        position:absolute; 
        top:50%; 
        right:0; 
        transform:translate(0,-100%)
    }

    .flechita-prev:hover{
        background-color: #0046e2;
        color: white;
    }
    .flechita-next:hover{
        background-color: #0046e2;
        color: white;
    }

</style>

 <!-- Mobile Menu -->
 <div class="mobile-menu-wrapper ">
    <div class="mean-menu-area">
        <!-- Menu Close Btn -->
        <button class="mobileMenucls"><i class="fal fa-times"></i></button>

        <!-- Mobile Menu -->
        <div class="mobile-logo">
            <a href="{{ route('pagina.index') }}"><img class="el_logo" src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}" alt="Nikko autopartes"></a>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu"></div><!-- Menu Will Append With Javascript -->

    </div>
</div>
<!-- Mobile Menu end -->

<!-- Header Area -->
<header class='header-layout1'>
    <div class="container">
        <div class="row align-items-center">
            <!-- Logo -->
            <div class="col-4 col-lg-2 col-xl-2" data-aos="fade-right">
                <div class="header-logo">
                    <a href="{{ route('pagina.index') }}"><img class="el_logo" src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}" alt="Nikko autopartes"></a>
                </div>
            </div>

            <!-- Main Menu Area -->
            <div class="col-8 col-lg-9 col-xl-9 align-menud" data-aos="fade-down">
                <!--// Navigation \\-->
                    @include('pagina.menu')
                <!--// Navigation \\-->
                <!-- Mobile Menu Toggle Btn -->
                <button class="menuToggleBtn d-inline-block d-lg-none"><i class="far fa-bars"></i></button>
            </div>
            <!-- Main Menu Area end -->
            <!-- Header Btn -->
            {{-- <div class="col-lg-1 col-xl-1 text-right" data-aos="fade-left">
                <div class="header-btn">
                    <button class="sidebarToggler d-none d-lg-inline-block"><i class="far fa-bars"></i></button>
                </div>
            </div> --}}

            <!-- Phone Box -->
            <div class="box-phone">
                <div class="phone-box d-none d-xl-flex align-items-center" style="display: flex !important;">
                    <div class="icon">
                        <a href="tel:+{{ $empresa->telefono_1 }}"><i class="fas fa-phone"></i></a>
                    </div>
                    <div class="content">
                        <a href="tel:+{{ $empresa->telefono_1 }}">{{ $empresa->telefono_1 }}</a>
                    </div>
                </div>
            </div>
            <!-- Header Btn end -->
        </div>
    </div>

<!-- Header Area end -->
<div class="redes_sociales">
    <ul class="social-links">
        @if($empresa->url_facebook != "")
            <li><a href="{{ $empresa->url_facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
        @endif
        @if($empresa->url_twitter != "")
             <li><a href="{{ $empresa->url_twitter }}" target="_blank"><i class="fab fa-twitter"></i></a></li>
        @endif
        @if($empresa->url_instagram != "")
             <li><a href="{{ $empresa->url_instagram }}" target="_blank"><i class="fab fa-instagram"></i></a></li>
        @endif
         @if($empresa->url_youtube != "")
             <li><a href="{{ $empresa->url_youtube }}" target="_blank"><i class="fab fa-youtube"></i></a></li>
        @endif
    </ul>
    
</div>

<!-- header Middle Area end -->
</header>

<!-- header Middle Area -->
<div class="header-middle-area bg-buscador">
    <form action="{{ route('pagina.resultados') }}" class="search-bar w-100 formulario">
    <div class="container">
            <div class="row aling-items-center d-flex justify-content-center">
                <div class="col-lg-6 col-xl-6 col-12 d-flex" data-aos="fade-down">
                    <input type="text" placeholder="Ingresa tu busqueda" name="query" value="{{ $busque_query }}">
                    <input type="hidden" id="invocacion" name="invocacion" value="0">
                    <button class="primary-btn type2">Buscar</button>
                    <input type="hidden" name="pagina" value="1">
                </div>            
            </div>

            <div class="row mt20">
                <form action="" class="search-category d-md-flex justify-content-md-center">
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-2 col-6">
                                <select name="ano" id="ano" class="select2 nueco_select">
                                    <option value="0">AÑO</option>
                                    @foreach($anos as $key => $value)
                                        <option value="{{ $value }}" @if($busque_ano == $value) selected @endif>{{ $value }}</option>
                                    @endforeach
                                    <option value="todos">TODOS</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select name="marca" id="marca" class="select2 nueco_select">
                                    <option value="0">ARMADORA</option>
                                    @foreach($marcas_buscador as $value)
                                        <option value="{{ $value->armadora }}" @if($busque_marca == $value->armadora) selected @endif>{{ $value->armadora }}</option>
                                    @endforeach
                                    <option value="todos">TODAS</option>
                                </select>
                            </div>
                                <div class="col-md-2 col-6">
                                <select name="modelo" id="modelo" class="select2 nueco_select">
                                    <option value="0">MODELO</option>
                                    @foreach($modelos_buscador as $value)
                                        <option value="{{ $value->modelo}}" @if($busque_modelo == $value->modelo) selected @endif>{{ $value->modelo }}</option>
                                    @endforeach
                                    <option value="todos">TODOS</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select name="motor" id="motor" class="select2 nueco_select">
                                    <option value="0">MOTOR</option>
                                    @foreach($motores_buscador as $value)
                                        <option value="{{ $value->motor }}" @if($busque_motor == $value->motor) selected @endif>{{ $value->motor }}</option>
                                    @endforeach
                                    <option value="todos">TODOS</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select name="grupo" id="grupo" class="select2 nueco_select">
                                    <option value="0">GRUPO</option>
                                    @foreach($grupos_buscador as $value)
                                        <option value="{{ $value->grupo }}" @if($busque_grupo == $value->grupo) selected @endif>{{ $value->grupo }}</option>
                                    @endforeach
                                    <option value="todos">TODOS</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-6">
                                <select name="familia" id="familia" class="select2 nueco_select">
                                    <option value="0">FAMILIA</option>
                                   @foreach($familias_buscador as $value)
                                        <option value="{{ $value->subgrupo }}" @if($busque_familia == $value->subgrupo) selected @endif>{{ $value->subgrupo }}</option>
                                    @endforeach
                                    <option value="todos">TODAS</option>
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-2 col-6 d-flex justify-content-center align-items-center">
                          <button class="primary-btn type2 w-100" name="con_filtro" value="si">Buscar con filtros</button>
                    </div>
            </div>
        
    </div>
    </form>
</div>







