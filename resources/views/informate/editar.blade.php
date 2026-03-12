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
             url: '{{ route('informate.eliminar_imagenes') }}',
             data: {name: name, _token: '{{ csrf_token() }}', id_informate:'{{ $informate->id }}' },
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

            $.get('{{ route('informate.subidas') }}',{id: "{{ $informate->id }}" }, function(data) {
              $.each(data, function(key,value) {
                var mockFile = { name: value.name, size: value.size, url: value.url };
                  myDropzone.files.push(mockFile);   
                  myDropzone.emit("addedfile", mockFile);
                  myDropzone.emit("thumbnail", mockFile, mockFile.url);
                  myDropzone.options.thumbnail.call(myDropzone, mockFile,value.url);
                  myDropzone.emit("success", mockFile);
                  myDropzone.emit("complete", mockFile);
                  

              });
            });


        }
    }


    function archivo(evt) {
          var files = evt.target.files; // FileList object
     
          // Obtenemos la imagen del campo "file".
          for (var i = 0, f; f = files[i]; i++) {
            //Solo admitimos imágenes.
            if (!f.type.match('image.*')) {
                continue;
            }
     
            var reader = new FileReader();
     
            reader.onload = (function(theFile) {
                return function(e) {
                  // Insertamos la imagen
                 document.getElementById("list").innerHTML = ['<img style="width:100%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
     
            reader.readAsDataURL(f);
          }
      }

            document.getElementById('banner').addEventListener('change', archivo, false);
            document.getElementById("list").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('informate/'.$informate->banner) }}"/>'].join('');

  </script>

  <script type="text/javascript">
     
     jQuery(document).ready(function($) {
        $('#boton_save').click(function(event) {
            /* Act on the event */
            $('.form').submit();
          });
     });  
  </script>


    {{ Html::script('cms/js/tinymce/tinymce.min.js') }}
  {{ Html::script('cms/js/tinymce/langs/es.js') }}
  <script type="text/javascript">
   
      tinymce.init({
          paste_data_images: true,
          selector: 'textarea',
          language: 'es',
          height: 650,
          theme: 'modern',
          plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help',
          toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat | image | imagetools',
          image_advtab: true,
          templates: [
            { title: 'Test template 1', content: 'Test 1' },
            { title: 'Test template 2', content: 'Test 2' }
          ],
          content_css: [
          '//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i'
          ]
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
               {{ Form::model($informate,['route' => ['informate.update',$informate],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                @include('informate.formulario.index')
                   {{ Form::close() }}
                 <div class="card">
                    <div class="card-header">
                      <h4><i class="ft-image"></i>&nbsp;&nbsp;&nbsp;Imagenes de la entrada/evento</h4>
                      <hr>
                    </div>
                    <div class="card-content collapse show">
                      <div class="card-body">
                        {{ Form::open(['route' => 'informate.agregar_imagenes','class' => 'dropzone dropzone-area', 'method' => 'post','files' => 'true', 'id' => 'dpz-multiple-files_uno']) }}
                        {{ Form::hidden('carpeta',$informate->id,['id' => 'stamp']) }}

                          <div class="dz-message">Arrastra o selecciona las imagenes de la galeria de productos.</div>
                        {{ Form::close() }}
                      </div>
                    </div>
                  </div>

                </div>

                <div class="form-actions text-right">
                  <a href="{{ route('informate.index') }}" class="btn btn-warning mr-1">
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