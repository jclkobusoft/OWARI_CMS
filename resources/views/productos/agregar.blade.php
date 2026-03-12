@extends('plantilla.base')

@section('js')
  
  {{ Html::script('cms/vendors/js/extensions/dropzone.min.js') }}
  <script type="text/javascript">
    var myDropzone;
    Dropzone.options.dpzMultipleFilesUno = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        clickable: true,
        addRemoveLinks:true,
        removedfile: function(file) {
            var name = file.name; 
             
            $.ajax({
             type: 'POST',
             url: '{{ route('productos.eliminar_imagenes') }}',
             data: {name: name, _token: '{{ csrf_token() }}', estampa:'{{ $estampa }}' },
             sucess: function(data){
              console.log('success: ' + data);
             }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         },
        init: function(){
          this.on("complete", function(file) {
                $(".dz-remove").html("Eliminar");
            });

          myDropzone = this;
        }
    }


    var myDropzoneDos;
    Dropzone.options.dpzMultipleFilesDos = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 5, // MB
        clickable: true,
        addRemoveLinks:true,
        removedfile: function(file) {
            var name = file.name; 
             
            $.ajax({
             type: 'POST',
             url: '{{ route('productos.eliminar_imagenes_360') }}',
             data: {name: name, _token: '{{ csrf_token() }}', estampa:'{{ $estampa }}' },
             sucess: function(data){
              console.log('success: ' + data);
             }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         },
        init: function(){
          this.on("complete", function(file) {
                $(".dz-remove").html("Eliminar");
            });

          myDropzoneDos = this;

       
        }
    }
  </script>

  <script type="text/javascript">
     
     jQuery(document).ready(function($) {
        $('#boton_save').click(function(event) {
            /* Act on the event */
            $('.form').submit();
          });
     });  
  </script>
@endsection

@section('css')

      {{ Html::style('cms/vendors/css/file-uploaders/dropzone.min.css') }}
      {{ Html::style('cms/css/plugins/file-uploaders/dropzone.css') }}
      <style type="text/css">
        .dz-image img{width: 100%;height: 100%;}
      </style>
@endsection

@section('contenido')
	<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Agregar producto</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              <div class="card-text">
                <p>Rellena toda la información necesaria.</p>
              </div>
              <div class="form-body">
               {{ Form::open(['route' => 'productos.store','files' => true,'method' => 'post', 'class' => 'form form-horizontal']) }}
                @include('productos.formulario.index')
                   {{ Form::close() }}
                 <div class="card">
                    <div class="card-header">
                      <h4><i class="ft-image"></i>&nbsp;&nbsp;&nbsp;Imagenes del producto</h4>
                      <hr>
                    </div>
                    <div class="card-content collapse show">
                      <div class="card-body">
                        {{ Form::open(['route' => 'productos.agregar_imagenes','class' => 'dropzone dropzone-area', 'method' => 'post','files' => 'true', 'id' => 'dpz-multiple-files_uno']) }}
                        {{ Form::hidden('estampa',$estampa,['id' => 'stamp']) }}

                          <div class="dz-message">Arrastra o selecciona las imagenes de la galeria de productos.</div>
                        {{ Form::close() }}
                      </div>
                    </div>
                  </div>

                  <div class="card">
                    <div class="card-header">
                      <h4><i class="ft-codepen"></i>&nbsp;&nbsp;&nbsp;Imagenes 360.</h4>
                      <hr>
                    </div>
                    <div class="card-content collapse show">
                      <div class="card-body">
                        {{ Form::open(['route' => 'productos.agregar_360_imagenes','class' => 'dropzone dropzone-area', 'method' => 'post','files' => 'true', 'id' => 'dpz-multiple-files_dos']) }}
                        {{ Form::hidden('estampa',$estampa,['id' => 'stamp']) }}
                          <div class="dz-message">Arrastra las imagenes que componen la vista 360.</div>
                        {{ Form::close() }}
                      </div>
                    </div>
                  </div>
                </div>


                <div class="form-actions text-right">
                  <a href="{{ route('productos.index') }}" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Cancelar
                  </a>
                  <button id="boton_save" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Guardar
                  </button>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection