@extends('plantilla.base')

@section('js')
  
  {{ Html::script('cms/vendors/js/extensions/dropzone.min.js') }}
  <script type="text/javascript">
    

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

            document.getElementById('logotipo').addEventListener('change', archivo, false);
            document.getElementById("list").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('socios/'.$socio->logo) }}"/>'].join('');

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
            <h4 class="card-title" id="horz-layout-colored-controls">Editar socio comercial</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              <div class="card-text">
                <p>Rellena toda la información necesaria.</p>
              </div>
              <div class="form-body">
               {{ Form::model($socio,['route' => ['socios.update',$socio],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                @include('socios.formulario.index')
                   {{ Form::close() }}
                </div>

                <div class="form-actions text-right">
                  <a href="{{ route('socios.index') }}" class="btn btn-warning mr-1">
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