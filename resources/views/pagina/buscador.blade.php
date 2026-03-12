@extends('pagina.base')

@section('js')
    <script>
        $.get('{{ route('pagina.buscar') }}',{ palabras: '{{ $palabras }}' @if($la_armadora!=""), armadora: '{{ $la_armadora }}' @endif @if($la_modelo!=""), modelo: '{{ $la_modelo }}' @endif @if($la_grupo!=""), grupo: '{{ $la_grupo }}' @endif @if($la_marca!=""), marca: '{{ $la_marca }}' @endif  } ,function(data) {
            /*optional stuff to do after success */
            if(data.cantidad == '0'){
                $('#el_mensaje').html(data.mensaje);
            }
            else{
                $('.numeros_resultados').html(data.cantidad);
                $.each(data.productos, function(index, val) {
                     /* iterate through array or object */
                     $('#lista_normal').append('<li class="col-md-12">'+
                                            '<figure><a href="{{ route('pagina.detalles_producto') }}?id_producto='+val.id+'"><img src="'+val.imagen+'" alt=""><span style="color:#{{ $empresa->color_pagina }}; border-color:#{{ $empresa->color_pagina }};" class="automechanic-article-btn automechanic-color">Ver detalles</span></a></figure>'+
                                            '<div class="automechanic-shop-list-text">'+
                                                '<h5><a href="{{ route('pagina.detalles_producto') }}">'+val.codigo+'</a></h5>'+
                                                '<!--<span style="font-size:13px !important; margin: 0px !important; color:#{{ $empresa->color_pagina }}">Marca: '+val.marca+'</span>'+
                                                '<span style="font-size:13px !important; margin: 0px !important; color:#{{ $empresa->color_pagina }}">Modelo: '+val.modelo+'</span>-->'+
                                                '<span style="font-size:13px !important; margin: 0px !important; color:#{{ $empresa->color_pagina }}">Aplicaciones: '+val.aplicacions+'</span>'+
                                                '<span style="font-size:13px !important; margin: 0px !important; color:#{{ $empresa->color_pagina }}">Sistema: '+val.sistema+'</span>'+
                                                '<span style="font-size:13px !important; margin: 0px !important; color:#{{ $empresa->color_pagina }}">Grupo: '+val.grupo+'</span>'+
                                                '<p style="margin-bottom:0px; color:black;">'+val.descripcion+'</p><br><br>&nbsp;&nbsp;&nbsp;'+
                                                '<a style="display:block; width:146px;color:#{{ $empresa->color_pagina }}; border-color:#{{ $empresa->color_pagina }};" href="{{ route('pagina.detalles_producto') }}?id_producto='+val.id+'" class="btn"><span>Ver detalles</span></a>'+
                                            '</div>'+
                                        '</li>');
                      $('#lista_cuadritos').append('<li class="col-md-4">'+
                                            '<figure><a href="{{ route('pagina.detalles_producto') }}?id_producto='+val.id+'"><img src="'+val.imagen+'" alt=""><span style="color:#{{ $empresa->color_pagina }}; border-color:#{{ $empresa->color_pagina }};"  class="automechanic-article-btn automechanic-color">Ver detalles</span></a></figure>'+
                                            '<div class="automechanic-shop-grid-text">'+
                                                '<h6><a href="{{ route('pagina.detalles_producto') }}">'+val.codigo+'</a></h6>'+
                                                '<span style="color:#{{ $empresa->color_pagina }};">'+val.descripcion+'</span>'+
                                                '<a style="color:#{{ $empresa->color_pagina }}; border-color:#{{ $empresa->color_pagina }};" href="{{ route('pagina.detalles_producto') }}?id_producto='+val.id+'" class="btn"><span>Ver detalles</span></a>'+
                                            '</div>'+
                                        '</li>');
                });

                $.each(data.armadoras, function(index, val) {
                     /* iterate through array or object */
                     $('#filtro_armadoras').append('<li><a href="{{ route('pagina.buscador') }}?palabras={{ $palabras }}&armadora='+val+'">'+val+'</a></li>');
                });
                $.each(data.modelos, function(index, val) {
                     /* iterate through array or object */
                     $('#filtro_modelos').append('<li><a href="{{ route('pagina.buscador') }}?palabras={{ $palabras }}&modelo='+val+'">'+val+'</a></li>');
                });
                $.each(data.grupos, function(index, val) {
                     /* iterate through array or object */
                     $('#filtro_grupos').append('<li><a href="{{ route('pagina.buscador') }}?palabras={{ $palabras }}&grupo='+val+'">'+val+'</a></li>');
                });
                $.each(data.marcas, function(index, val) {
                     /* iterate through array or object */
                     $('#filtro_marcas').append('<li><a href="{{ route('pagina.buscador') }}?palabras={{ $palabras }}&marca='+val+'">'+val+'</a></li>');
                });
            }
            $('.loading_img').hide();
            $('.automechanic-main-content').show();
        });
    </script>
@endsection
@section('contenido')
<div class="loading_img" style="width:100%;text-align: center;"><img src="{{ asset('img/loading.gif') }}"></div>
<div class="automechanic-main-content" style="display:none;">

	   <!--// Main Section \\-->
	   <div class="automechanic-main-section">
	   		<div class="container">
	   			<div class="row">

	   				<div class="col-md-9">
	   					<div class="automechanic-shop-filter">
                            <span style="font-size: 25px;" id="el_mensaje"><span class="numeros_resultados"></span> producto(s) encontrados para "{{ $palabras }}"</span>
                            <!-- Nav tabs -->
                            <ul class="nav-tabs" role="tablist">
                              <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" style="color:#{{ $empresa->color_pagina }};"><i class="automechanic-icon automechanic-interface-12"></i></a></li>
                              <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" style="color:#{{ $empresa->color_pagina }};"><i class="automechanic-icon automechanic-squares"></i></a></li>
                            </ul>
                            <!-- Tab panes -->
                        </div>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="home">
                                <div class="automechanic-shop automechanic-shop-list">
                                	<ul class="row" id="lista_normal">
                                		
                                	</ul>
                                </div>
                                <!--
		                        <div class="automechanic-pagination">
		                          <ul class="page-numbers">
		                             <li><a class="previous page-numbers" href="404.html"><span aria-label="Next"><i class="automechanic-icon automechanic-arrows22"></i></span></a></li>
		                             <li><span class="page-numbers current">1</span></li>
		                             <li><a class="page-numbers" href="404.html">2</a></li>
		                             <li><a class="page-numbers" href="404.html">3</a></li>
		                             <li><a class="page-numbers" href="404.html">4</a></li>
		                             <li><a class="next page-numbers" href="404.html"><span aria-label="Next"><i class="automechanic-icon automechanic-arrows22"></i></span></a></li>
		                          </ul>
		                        </div>
		                        -->
                            </div>
                            <div role="tabpanel" class="tab-pane" id="profile">
                                <div class="automechanic-shop automechanic-shop-grid">
                                	<ul class="row"  id="lista_cuadritos">
                                		
                                	</ul>
                                </div>
		                        <!--
                                <div class="automechanic-pagination">
		                          <ul class="page-numbers">
		                             <li><a class="previous page-numbers" href="404.html"><span aria-label="Next"><i class="automechanic-icon automechanic-arrows22"></i></span></a></li>
		                             <li><span class="page-numbers current">1</span></li>
		                             <li><a class="page-numbers" href="404.html">2</a></li>
		                             <li><a class="page-numbers" href="404.html">3</a></li>
		                             <li><a class="page-numbers" href="404.html">4</a></li>
		                             <li><a class="next page-numbers" href="404.html"><span aria-label="Next"><i class="automechanic-icon automechanic-arrows22"></i></span></a></li>
		                          </ul>
		                        </div>-->
                            </div>
                        </div>
	   				</div>

	   				<!--// Sidebar \\-->
                    <aside class="col-md-3">

                        <!--// Widget Search \\-->
                        <div class="widget widget_search">
                            <h2 class="automechanic-widget-heading automechanic-color" style="color:#{{ $empresa->color_pagina }};">¡Busca aquí!</h2>
                            <form  action="{{ route('pagina.buscador') }}" method="GET">
                                <input onblur="if(this.value == '') { this.value ='¿Que buscas?'; }" onfocus="if(this.value =='¿Que buscas?') { this.value = ''; }" tabindex="0" type="text" name="palabras">
                                <label><input type="submit" value=""></label>
                            </form>
                        </div>
                        <!--// Widget Search \\-->

                        <!--// Widget SORT BY CETAGORIES \\-->
                        <div class="widget widget_sort_cetagories">
                        	<h2 class="automechanic-widget-heading automechanic-color" style="color:#{{ $empresa->color_pagina }};">Sistema</h2>
                        	<ul id="filtro_armadoras">
                        			
                        	</ul>
                        </div>
                        <!--// Widget SORT BY CETAGORIES \\-->
                          <!--// Widget SORT BY CETAGORIES \\-->
                        <!--<div class="widget widget_sort_cetagories">
                        	<h2 class="automechanic-widget-heading automechanic-color" style="color:#{{ $empresa->color_pagina }};">Modelos</h2>
                        	<ul id="filtro_modelos">
                        	</ul>
                        </div>-->
                        <!--// Widget SORT BY CETAGORIES \\-->
                          <!--// Widget SORT BY CETAGORIES \\-->
                       

                         <!--<div class="widget widget_sort_cetagories">
                            <h2 class="automechanic-widget-heading automechanic-color" style="color:#{{ $empresa->color_pagina }};">Marcas</h2>
                            <ul id="filtro_marcas">
                            </ul>
                        </div>-->

                         <div class="widget widget_sort_cetagories">
                            <h2 class="automechanic-widget-heading automechanic-color" style="color:#{{ $empresa->color_pagina }};">Grupos</h2>
                            <ul id="filtro_grupos">
                            </ul>
                        </div>
                        <!--// Widget SORT BY CETAGORIES \\-->

                       

                    </aside>
                    <!--// Sidebar \\-->

	   			</div>
	   		</div>
	   </div>
	   <!--// Main Section \\-->

	</div>
@endsection