@extends('pagina.base')

@section('css')
	<style>
		.background-image {
		    background-size: 100% !important;
		    background-repeat: no-repeat;
		}
	</style>
@endsection

@section('contenido')

	<style type="text/css">
		.widget:not(.footer-widget).widget_file_link ul li a:after, .widget:not(.footer-widget).widget_file_link ul li a:before {font-family: "Font Awesome\5 Pro";}
		.widget:not(.footer-widget).widget_categories ul li a:before {font-family: "Font Awesome\5 Pro";}
	</style>

	<!--breadcumb -->
	<div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/upload/marcas/'.$marca->banner) }}">
		<div class="container">
			<div class="breadcumb-content">
				<!-- Breadcrumb Title -->
				<h1 class="breadcumb-title">{{ $marca->nombre }}</h1>

				<!-- Breadcrumb Menu -->
				<ul>
					<li><a href="index.html"> Inicio </a></li>
					<li class="active">{{ $marca->nombre }}</li>
				</ul>
			</div>
		</div>
	</div>
	<!--breadcumb end -->

	<!-- blog Area -->
	<section class="blog-wrapper blog-single-wrap blog-single-layout1 secondary-bg2 pt-50">
		<div class="container">
			 <div class="row branch-information-layout2 pb-50" style="background-color: transparent; !important;"> 
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
			<div class="row gutters-40 justify-content-center">
				<div class="col-lg-12">
					
					<div class="blog">
						<!-- Blog Content -->
						<div class="blog-content">
							<div class="row">
								<div class="col-xl-5">
									<!-- Middle Image -->
									<div class="middle-img">
										<img class="w-100" src="{{ asset('upload/marcas/'.$marca->imagen) }}" alt="{{ $marca->nombre }}">
									</div>
								</div>
								<div class="col-xl-7">
									<div class="about-wrap-layout4">
										<div class="about-us-content">
											<h2 class="about-title">{{ $marca->titulo_principal }}</h2>
										</div>
									</div>
									<h3 class="inner-title">{!! $marca->descripcion_breve !!}</h3>
								</div>
							</div>

							<!-- Inner Title -->
							<!-- Blog Text -->
							<div class="blog-text detalles--marca">{!! $marca->contenido !!}</div>

							<div class="row">
								<div class="col-xl-5">
									<!-- single Widget -->
									@if(count($catalogos)>0)
									<div class="widget widget_file_link">
										<!-- Widget Title -->
										<h3 class="widget_title">Catalogos</h3>
										<ul class="descargarpdf">
											@foreach($catalogos as $catalogo)
											<li><a href="{{ $catalogo->url }}" download>{{ $catalogo->nombre }}</a></li>
											@endforeach
										</ul>
									</div>
									@endif
									<!-- Single Widget -->
									@if(count($boletines)>0)
									<div class="widget widget_categories">
										<!-- Widget Title -->
										<h3 class="widget_title">Boletines</h3>
										<ul class="descargarpdf">
											@foreach($boletines as $boletin)
											<li><a href="{{ $boletin->url }}" download>{{ $boletin->nombre }} <span>{{ $boletin->descripcion }}</span></a></li>
											@endforeach
										</ul>
									</div>
									@endif
								</div>
								@if(count($productos) >0)
								<div class="col-xl-7">
									<h4 class="widget_title">Algunos de nuestros productos</h4>
									<div class="blog-img-slider mb-40">
										@foreach ($productos as $producto)
											<?php
                                                  $directory = storage_path().'/app/public/productos/'.$producto->codigo_nikko;
                                                  if(file_exists($directory))
                                                      $files = \Storage::allFiles('public/productos/'.$producto->codigo_nikko."/");
                                                  else
                                                      $files = [];
                                        	?>
                                        	@if(count($files) > 0)
                                                <a href="{{ route('pagina.detalles_producto') }}?clave={{ $producto->codigo_nikko}}"><img src="{{ asset("storage/productos/".$producto->codigo_nikko."/".basename($files[0],PHP_EOL)) }}" alt="Product Image"></a>
                                            @else
                                            	<a href="{{ route('pagina.detalles_producto') }}?clave={{ $producto->codigo_nikko }}"><img src="{{ asset('img/sin-foto.png') }}" alt="Product Image"></a>
                                            @endif
										@endforeach
										
									</div>
								</div>
								@endif
							</div>

							<!-- Blog Slider -->
							@if(count($informate) > 0)
							<div class="d-md-flex justify-content-md-center separacion">
								<!-- Single Post -->

								@foreach($informate as $entrada)
								<div class="col-md-4 col-12">
									<div class="widget widget_recent_entries">
										<!-- title -->
										<h3 class="widget_title">Informate</h3>
										<!-- Single Post -->
										<div class="blog">
											<div class="blog-img">
												<img src="{{ asset('/informate/'.$entrada->banner) }}" alt="Blog Image">
											</div>
											<div class="blog-content">
												<h4 class="blog-title"><a href="{{ route('pagina.ver_entrada',$entrada->id) }}">{{ $entrada->titulo }}</a>
												</h4>
												<span><i class="fal fa-calendar-minus"></i>{{ \Carbon::createFromFormat('Y-m-d H:i:s',$entrada->created_at)->format('d/M/Y') }}</span>
											</div>
										</div>
									</div>
								</div>
								@endforeach
								
								
							</div>
							@endif


						</div>
						<!-- Blog Content End -->
					</div>
					<!-- Single Blog End -->
				</div><!-- .col END -->
			</div><!-- .row END -->
		</div><!-- .container END -->
	</section>

	<!-- blog Area end -->

	 <!-- Brand Area -->
	 <section>
        <div class="brand-area-wrapper brand-layout1 pt20 all-brands">
            <div class="row text-center justify-content-center m-0">
                <!-- Section Title -->
                <div class="col-md-10 col-lg-8 col-xl-6 col-12">
                    <div class="section-title">
                        <h2 class="title">Conoce nuestras marcas</h2>
                      
                    </div>
                </div>
            </div>
            <!-- BG Shape -->
        
            <div class="container">
                <div class="row brand-slider1-active">
                    @foreach($marcas as $marca)
                        <!-- Single Brand -->
                        <div class="col-xl-3">
                            <div class="brand-box">
                                <a @if($marca->redireccion == 'enlace')target="_blank"@endif href="@if($marca->redireccion == 'propia'){{ route('pagina.ver_marca',$marca->id) }}@else{{ $marca->url }}@endif"><img src="{{ asset('upload/marcas/'.$marca->imagen) }}" alt=""></a>
                            </div>
                        </div>
                    @endforeach
                </div><!-- .row END -->
            </div><!-- .container END -->
        </div>
    </section>
    <!-- Brand Area end -->

@endsection