@extends('web.plantilla.base')
@section('contenido')
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg1" style="background-image: url('{{ asset('/upload/gral/catalogos_banner.jpg') }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Catalogos</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>Catalogos</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Team Area -->
        <section class="team-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    
                    @foreach($catalogos as $catalogo)
                    <div class="col-lg-4 col-sm-6">
                        <div class="single-team">
                            <a href="{{ $catalogo->url }}" target="_blank">
                                <div class="team-image">
                                    <img src="{{ asset('/upload/catalogos/portadas/'.$catalogo->portada) }}" alt="image">
                                </div>

                                <div class="team-content">
                                    <h3>{{ $catalogo->nombre }}</h3>
                                    <span>Ultima actualización: {{ \Carbon::createFromFormat('Y-m-d H:i:s',$catalogo->updated_at)->format('d/m/Y') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- End Team Area -->
@stop