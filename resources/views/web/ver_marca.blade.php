@extends('web.plantilla.base')
@section('contenido')
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2" style="background-image: url('{{ asset('/upload/marcas/'.$marca->banner) }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>{{ $marca->nombre  }}</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>Marcas</li>
                                <li>{{ $marca->nombre }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
         <!-- Start Terms of Service Area -->
        <section class="terms-of-service-area ptb-100">
            <div class="container">
                <div class="terms-of-service-content">
                    <h3>{{ $marca->nombre }}</h3>
                    {!! $marca->descripcion_breve !!}
                    
                    <h3>Categoria</h3>
                    <p>{{ $marca->tipo }}</p>

                    {!! $marca->contenido !!}
                </div>
            </div>
        </section>
        <!-- End Terms of Service Area -->
@stop