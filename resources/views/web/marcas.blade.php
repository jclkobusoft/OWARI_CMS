@extends('web.plantilla.base')
@section('contenido')
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2" style="background-image: url('{{ asset('/upload/gral/banner_marcas.png') }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Marcas</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>Marcas</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
         <!-- Start Gallery Area -->
        <div class="gallery-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    

                    @foreach($marcas as $marca)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-gallery-box">
                            <img src="{{ asset('/upload/marcas/'.$marca->imagen) }}" alt="image">
    
                            <a href="@if($marca->redireccion == "propia"){{ route('pagina.ver_marca',$marca->id) }} @else {{ $marca->url }} @endif" class="gallery-btn">
                                <i class='bx bx-plus'></i>
                            </a>
                        </div>
                    </div>
                    @endforeach

                  

                   
                </div>
            </div>
        </div>
        <!-- End Gallery Area -->
       

@stop