@extends('pagina.base')


@section('contenido')
	
<!--// SubHeader \\-->
<div class="automechanic-subheader">
    <span class="automechanic-dark-transparent"></span>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Nuestras <span>marcas</span></h1>
                <ul class="automechanic-breadcrumb">
                    <li><a href="#">Inicio</a></li>
                    <li>Marcas</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--// SubHeader \\-->

    <!--// Main Content \\-->
	<div class="automechanic-main-content" style="padding: 20px 0px 45px 0px;">


	   <!--// marcas Section \\-->
	   <div class="automechanic-main-section">
	   		<div class="container">
	   			<div class="row">
	   				<div class="col-md-12">
	   					<div class="automechanic-sub-marca">
                            <a href="{{ route('pagina.marcas') }}"><img src="{{ asset('pagina/extra-images/back.png') }}" style="float: left;"></a> <h2 style="float: left;">MARCAS</h2>
                        </div>
	   				</div>
	   				<div class="col-md-6 feature-list">
	   					<hr class="sub-hr">
	   					<div>
	   						<b>CTR</b>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur
	   					</div>
	   					<div>
	   						Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur
	   					</div>
	   					<div>
	   						<b>Denso</b> ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur
	   					</div>
	   					<div>
	   						<img src="{{ asset('pagina/marcas/ctr-producto.jpg') }}">
	   					</div>
	   				</div>
	   				<div class="col-md-2">
	   					<img src="{{ asset('pagina/marcas/ctr.jpg') }}" style="margin-top: 11px;">
	   					<div class="padding-bottom-50p"></div>
	   					<h6>Productos</h6>
	   					<h6>Partes de suspensión</h6>
	   					<ul class="list-marca">
	   						<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
	   						<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
	   						<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</li>
	   					</ul>
	   				</div>
	   				<div class="col-md-4 catalogo">
	   					<div class="vacio"></div>
	   					<div class="">
	   						<img src="{{ asset('pagina/marcas/ctr-catalogo.jpg') }}">
	   					</div>
	   					<div class="" align="center">
	   						<a href="#"><h4>DESCARGAR EL CATÁLOGO</h4></a>
	   					</div>
	   				</div>
	   			</div>
	   		</div>
	   </div>
	   <!--// marcas Section \\-->

	</div>
	<!--// Main Content \\-->

@endsection