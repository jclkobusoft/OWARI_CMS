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
	   				<div class="col-md-8 feature-list">
	   					<hr class="sub-hr">
	   					<div class="feature-table">
	   						<table>
								<tbody>
									<tr>
										<td width="70%"><b>FP</b> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</td>
										<td colspan="2" rowspan="2"><img src="{{ asset('pagina/marcas/fp.jpg') }}" style="margin-top: 11px;"></td>
									</tr>
									<tr>
										<td width="70%"> <br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Balatas delanteras</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Balatas tambor</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Cilindro de rueda</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Disco / Rotor</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Bomba de freno</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Ligas / Kit Caliper</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Bomba de clutch</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Manguera de freno</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Pistón</td>
									</tr>
									<tr>
										<td><br>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</td>
										<td><img src="{{ asset('pagina/marcas/corchete.png') }}"></td>
										<td>Cilindro esclavo 
										</td>
									</tr>
								</tbody>
							</table>
	   					</div>
	   					
	   				</div>
	   				<div class="col-md-4 catalogo">
	   					<div class="vacio"></div>
	   					<div class="">
	   						<img src="{{ asset('pagina/marcas/fp-catalogo.jpg') }}">
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