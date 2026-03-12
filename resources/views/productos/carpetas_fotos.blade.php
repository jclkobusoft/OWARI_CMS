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
                        <p>Esta seccion muestra las carpetas y las fotos contenidas en cada carpeta.</p>
                    </div>
                    <div>
                        @foreach($archivos as $carpeta)
                            @if($carpeta != ".." && $carpeta != ".")
                            <div class="card" style="box-shadow: 0 10px 40px 0 rgba(62, 57, 107, 0.07), 0 2px 9px 0 rgba(62, 57, 107, 0.06) !important;">
                                <div class="card-header">
                                    <div class="card-title">
                                        <h4>{{ $carpeta }}</h4>
                                    </div>
                                </div>
                                
                                <div class="card-content">
                                    <div class="card-body" style="margin-left:50px;">
                                        <?php
                                         $directory = storage_path().'/app/public/productos/'.$carpeta;
                                         if(file_exists($directory))
                                             $files = \Storage::allFiles('public/productos/'.$carpeta."/");
                                         else
                                             $files = [];
                                         ?>

                                         @if(count($files) > 0)
                                            @foreach($files as $key => $value)
                                                <a target="_blank" href="{{ asset("storage/productos/".$carpeta."/".basename($files[$key],PHP_EOL)) }}" alt="Product Image">{{ basename($files[$key],PHP_EOL) }}</a>  
                                            @endforeach
                                         @else
                                            <p>No hay fotos en la carpeta</p>
                                         @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection