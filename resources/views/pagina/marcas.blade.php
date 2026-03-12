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
				<h1 class="breadcumb-title">Marcas</h1>

				<!-- Breadcrumb Menu -->
				<ul>
					<li><a href="{{ route('pagina.index') }}"> Inicio </a></li>
					<li class="active">Marcas</li>
				</ul>
			</div>
		</div>
	</div>
	<!--breadcumb end -->	

	<!-- blog Area -->
    <section class="blog-wrapper blog-layout3 pt-50 pb-100" id="blog">
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

            <div class="row justify-content-center">
                
 @foreach($marcas as $marca)
                <div class="col-lg-6 col-xl-4">
                    <!-- Single Blog -->
                    <div class="blog">
                        <!-- Blog Image -->
                        <div class="blog-img">
                            <a target="_blank" href="@if($marca->redireccion == 'propia'){{ route('pagina.ver_marca',$marca->id) }}@else{{ $marca->url }}@endif"><img src="{{ asset('upload/marcas/'.$marca->imagen) }}" alt=""></a>
                        </div>
                        <!-- Blog Content -->
                        <div class="blog-content">
                            <h3 class="blog-title">{{ $marca->nombre }}</h3>
                            <p>{!! $marca->descripcion_breve !!}</p>
                            <a class="read-more-btn mb-30 text-primary2" @if($marca->redireccion == 'enlace')target="_blank"@endif href="@if($marca->redireccion == 'propia'){{ route('pagina.ver_marca',$marca->id) }}@else{{ $marca->url }}@endif">Saber más <i class="ml-2 far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
@endforeach

             

            </div><!-- .row END -->
        </div><!-- .container END -->
    </section>


	


   

@endsection