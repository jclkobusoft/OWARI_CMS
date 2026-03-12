@extends('pagina.base')

@section('css')
	<style type="text/css">
		.img-marcas{
			padding: 10px;
		}
		.img-marcas:hover{
			opacity: 0.8;
		}
		.img-marcas:img{
			content: '';
			position: absolute;
			left: 0%;
			bottom: 0px;
			width: 100%;
			height: 100%;
			opacity: 0;
			
		}
	</style>
@endsection

@section('contenido')


	<!--breadcumb -->
	<div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
		<div class="container">
			<div class="breadcumb-content">
				<!-- Breadcrumb Title -->
				<h1 class="breadcumb-title" >Catalogos</h1>

				<!-- Breadcrumb Menu -->
				<ul>
					<li><a href="{{ route('pagina.index') }}"> Inicio </a></li>
					<li class="active">Catalogos</li>
				</ul>
			</div>
		</div>
	</div>
	<!--breadcumb end -->	

	 <section class="our-team-wrapper team-layout1 pt-50 pb-100" id="team">
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

            <div class="row gutters-10">


                 @foreach($catalogos as $catalogo)
                 
                  
                        <!-- Single Team -->
                        <div class="col-xl-3">
                            <div class="team-member">
                                <div class="member-img">
                                    <img src="{{ asset('/upload/catalogos/portadas/'.$catalogo->portada) }}" alt="Team Member Image">
                                </div>

                                <div class="link-area">
                                    <!-- Social Share -->
                                    <ul class="social-links hover-link">
                                        <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $catalogo->url }}&quote={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r".$catalogo->nombre) }}"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="mailto:?subject={{ rawurlencode($catalogo->nombre) }}&body={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $catalogo->url }}"><i class="fad fa-envelope"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $catalogo->url }}"><i class="fab fa-whatsapp"></i></a></li>
                                    </ul>
                                    <!-- Overly Icon -->
                                    <a href="#" class="btn-overly member-link circle-btn xs">
                                        <i class="fas fa-share-alt"></i>
                                        <span class="ripple ripple-1"></span>
                                        <span class="ripple ripple-2"></span>
                                        <span class="ripple ripple-3"></span>
                                    </a>
                                </div>
                                <div class="member-content">
                                    <div class="member-text">
                                        <a href="{{ $catalogo->url }}"><span class="degi">Descargar</span>
                                        <h3 class="name name_catalogo">{{ $catalogo->nombre }}</h3></a>
                                    </div>
                                </div>
                            </div>
                        </div>

         
                    @endforeach
                


            </div>

        </div>
    </section>

     <!-- Latest Project -->
    <section class="latest-project-wrapper background-image pt-120 pb-120" data-img="{{ asset('/img/arte.png') }}" id="project">
        <div class="container">
            <div class="row ">
                <!-- Section Title -->
                <div class="col-xl-5">
                    <div class="section-title">
                        <h2 class="title">Te invitamos a conocer nuestros productos</h2>
                        <p class="text">En Nikko Autoparts, integramos en nuestras líneas marcas premium, ademas de marcas propias y equipo original para autos nacionales, asiáticos, americanos y europeos.</p>
                        <a href="{{ route('pagina.resultados') }}?query=&pagina=1&ano=0&marca=0&modelo=0&motor=0&grupo=0&familia=0" class="primary-btn hover-white">Ver productos</a>
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

                        @if(count($promociones) > 0)

                        <div class="latProject-slider-active">
                            @foreach($promociones as $producto)
                            <?php
                                $directory = storage_path().'/app/public/productos/'.$producto->codigo_nikko;
                                if(file_exists($directory)){
                                    $files = \Storage::allFiles('public/productos/'.$producto->codigo_nikko."/");
                                    if(count($files)>=1)
                                        $imagen = asset("storage/productos/".$producto->codigo_nikko."/".basename($files[0],PHP_EOL));
                                    else
                                        $imagen = asset('img/sin-foto.png');
                                }
                                else
                                    $imagen = asset('img/sin-foto.png');


                            ?>
                            <a href="{{ route('pagina.detalles_producto') }}?clave={{ $producto->codigo_nikko }}">
                                <img src="{{ $imagen }}" alt="Project Image">
                            </a>
                            @endforeach
                        </div>

                        @endif

                    </div>
                </div>
                <!-- Slider Area end -->


            </div>
        </div>
    </section>
    <!-- Latest Project end -->

	


   

@endsection