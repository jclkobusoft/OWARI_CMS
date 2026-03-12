@extends('plantilla.base')

@section('js')


@endsection

@section('css')


@endsection

@section('contenido')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="horz-layout-colored-controls">Carpetas y fotos de la pagina web</h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            </div>
            <div class="card-content collpase show">
                <div class="card-body">
                    <div class="card-text">
                        <p>Esta seccion muestra las carpetas de fotos en la pagina.</p>
                    </div>
                    <div>
                        @foreach($archivos as $carpeta)
                            @if($carpeta != ".." && $carpeta != ".")
                            
                            <h4>{{ $carpeta }}</h4>
                                    
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection