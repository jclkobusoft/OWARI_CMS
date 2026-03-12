@extends('pagina.base')



@section('contenido')
  
<!--// SubHeader \\-->
    <div class="container" >
        <div class="row">
            <div class="col-md-12 text-center" style="padding: 20px 0px 0px 0px;">
                <h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;">Boletines, publicaciones y catalogos</h1>
            </div>
        </div>
    </div>
<!--// SubHeader \\-->

<!--// Main Content \\-->
<div class="automechanic-content-padding">

   <!--// Main Section \\-->
   <div class="automechanic-main-section">
      <div class="container">
        <div class="row el_contenido">
          
          <div class="col-md-12">
              <div class="automechanic-filterable">
                          <ul class="filters-button-group">
                              <li><a data-filter="*" class="is-checked" href="javascript:void(0)">Todos</a></li>
                              <li><a data-filter=".boletines" href="javascript:void(0)">Boletines</a></li>
                              <li><a data-filter=".catalogos" href="javascript:void(0)">Catalogos</a></li>
                              <li><a data-filter=".publicaciones" href="javascript:void(0)">Publicaciones</a></li>
                          </ul>
                      </div>
              <div class="automechanic-portfolio automechanic-portfolio-grid automechanic-portfolio-filter">
                <ul class="row">
                  
                  @foreach($catalogos as $catalogo)
                  <li class="col-md-3 element-item general catalogos">
                    <figure><a href="{{ $catalogo->url }}" target="_blank"><img src="{{ asset('upload/catalogos/portadas/'.$catalogo->portada) }}" alt=""><span class="automechanic-article-btn automechanic-color">Descargar</span></a>
                      <figcaption>
                        <h4><a href="{{ $catalogo->url }}" target="_blank">Catalogo</a></h4>
                        <p>{{ $catalogo->nombre }}</p>
                      </figcaption>
                    </figure>
                  </li>
                  @endforeach

                  @foreach($boletines as $boletin)
                  <li class="col-md-3 element-item general boletines">
                    <figure><a href="{{ $boletin->url }}" target="_blank"><img src="{{ asset('upload/boletines/portadas/'.$boletin->portada) }}" alt=""><span class="automechanic-article-btn automechanic-color">Descargar</span></a>
                      <figcaption>
                        <h4><a href="{{ $boletin->url }}" target="_blank">Boletin</a></h4>
                        <p>{{ $boletin->nombre }}</p>
                      </figcaption>
                    </figure>
                  </li>
                  @endforeach

                  @foreach($publicaciones as $publicacion)
                  <li class="col-md-3 element-item general publicaciones">
                    <figure><a href="{{ $publicacion->url }}" target="_blank"><img src="{{ asset('upload/publicaciones/portadas/'.$publicacion->portada) }}" alt=""><span class="automechanic-article-btn automechanic-color">Descargar</span></a>
                      <figcaption>
                        <h4><a href="{{ $publicacion->url }}" target="_blank">Publicacion</a></h4>
                        <p>{{ $publicacion->nombre }}</p>
                      </figcaption>
                    </figure>
                  </li>
                  @endforeach
                </ul>
              </div>

            </div>
                
        </div>
      </div>
   </div>
   <!--// Main Section \\-->


</div>
<!--// Main Content \\-->

@endsection