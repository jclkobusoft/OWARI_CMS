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

@section('js')
    <script type="text/javascript">
        var $mediaElements = $('.el_boletin');

        $('#ano_boletin,#marca_boletin').on("select2:select",function (e) {
            // get the category from the attribute
            var ano = $("#ano_boletin").val();
            var marca = $("#marca_boletin").val();


            var cadena = "";
            if(ano != "all" && ano != "0" && ano != "")
                cadena += "."+ano;

            if(marca != "all" && marca != "0" && marca != "")
                cadena += "."+marca;




            if((ano == 'all' && marca == 'all') || (ano == '0' && marca == '0') || (ano == 'all' && marca == '0') || (ano == '0' && marca == 'all')){
              $mediaElements.show();
            }else{
               // hide all then filter the ones to show
               $mediaElements.hide().filter(cadena).show();
            }
        });


         $('#ano_boletin,#marca_boletin').on('select2:opening', function (e) {
            $(this).find("option[value='0']").remove();
             $(this).val(null);

              //console.log(e);
          });
    </script>
@endsection

@section('contenido')


	<!--breadcumb -->
	<div class="breadcumb-wrapper breadcumb-layout1 background-image" data-img="{{ asset('/img/encabezados.png') }}">
		<div class="container">
			<div class="breadcumb-content">
				<!-- Breadcrumb Title -->
				<h1 class="breadcumb-title" >Boletines</h1>

				<!-- Breadcrumb Menu -->
				<ul>
					<li><a href="{{ route('pagina.index') }}"> Inicio </a></li>
					<li class="active">Boletines</li>
				</ul>
			</div>
		</div>
	</div>
	<!--breadcumb end -->	



      <!-- Our Team -->
    <section class="our-team-wrapper team-layout4 pt-50 pb-110">
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

            <div class="row text-center justify-content-center pb-30">
                <!-- Section Title -->
                <div class="col-md-3"></div>
                <div class="col-md-3">
                        <select id="ano_boletin" class="select select2">
                            <option value="0">AÑO</option>
                            @foreach($anos as $ano)
                                <option value="{{ $ano->ano }}">{{ $ano->ano }}</option>
                            @endforeach
                            <option value="all">TODOS</option>
                        </select>
                </div>
                <div class="col-md-3">
                        <select id="marca_boletin" class="select select2">
                            <option value="0">MARCA</option>
                            @foreach($marcas as $marca)
                                <option value="{{  str_replace(" ", "_",$marca->marca)  }}">{{ $marca->marca }}</option>
                            @endforeach
                            <option value="all">TODAS</option>
                        </select>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="row gutters-20 justify-content-center">

                
                @foreach($boletines as $boletin)
                <!-- Single Team -->

                <div class="col-md-6 col-lg-4 col-xl-3 el_boletin {{ trim($boletin->ano) }} {{ str_replace(" ", "_",trim($boletin->marca)) }}">
                    <div class="team-member">
                        <a href="{{ $boletin->url }}">
                            <div class="member-img">
                                <img src="{{ asset('/upload/boletines/portadas/'.$boletin->portada) }}" alt="Team Member Image">
                            </div>

                            <div class="member-thumb-img">
                                <img src="{{ asset('/upload/boletines/portadas/'.$boletin->portada) }}" alt="Team Member Image">
                            </div>

                            <div class="link-area">
                            </div>
                        </a>

                        <div class="member-content">

                            <div class="member-text">
                                <h3 class="name"><a href="{{ $boletin->url }}">{{ $boletin->nombre }}</a></h3>
                                <p>{{ $boletin->descripcion }}</p>
                                <p>{{ \Carbon::createFromFormat('Y-m-d H:i:s',$boletin->created_at)->format('d/M/Y') }}</p>
                                <a href="{{ $boletin->url }}" target="_blank" class="degi">Descargar</a>
                            </div>

                            <!-- Social Share -->
                            <ul class="social-links">
                               <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ $boletin->url }}&quote={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r".$boletin->descripcion) }}"><i class="fab fa-facebook-f"></i></a></li>
                                         <li><a href="mailto:?subject={{ rawurlencode($boletin->descripcion) }}&body={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $boletin->url }}"><i class="fad fa-envelope"></i></a></li>
                                        <li><a href="https://wa.me/?text={{ rawurlencode("Conoce los productos de Nikko Autoparts\n\r") }}{{ $boletin->url }}"><i class="fab fa-whatsapp"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                @endforeach

            </div>

        </div>
    </section>
    <!-- Our Team end -->


   

@endsection