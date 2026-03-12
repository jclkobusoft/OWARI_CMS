@extends('plantilla.base')

@section('js')

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
  {{ Html::script('js/colorpicker/js/colorpicker.js') }}
  <script type="text/javascript">
    
      function mostrar_imagen(evt,destino) {
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
                 document.getElementById(destino).innerHTML = ['<img style="width:75%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
     
            reader.readAsDataURL(f);
          }
      }

      $('#logotipo_general').change(function(event) {
        mostrar_imagen(event,'imagen_logotipo_general');
      });
      $('#imagen_footer').change(function(event) {
        mostrar_imagen(event,'imagen_footer_general');
      });
       @if($empresa->logotipo_general != '')
        document.getElementById("imagen_logotipo_general").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/gral/'.$empresa->logotipo_general) }}"/>'].join('');
      @endif
      @if($empresa->imagen_footer != '')
        document.getElementById("imagen_footer_general").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/gral/'.$empresa->imagen_footer) }}"/>'].join('');
      @endif
      /*$('#logotipo_email').change(function(event) {
        mostrar_imagen(event,'imagen_logotipo_email');
      });

      $('#icono_facebook').change(function(event) {
        mostrar_imagen(event,'imagen_icono_facebook');
      });
      $('#icono_instagram').change(function(event) {
        mostrar_imagen(event,'imagen_icono_instagram');
      });
      $('#icono_twitter').change(function(event) {
        mostrar_imagen(event,'imagen_icono_twitter');
      });
      $('#icono_youtube').change(function(event) {
        mostrar_imagen(event,'imagen_icono_youtube');
      });
      $('#icono_pinterest').change(function(event) {
        mostrar_imagen(event,'imagen_icono_pinterest');
      });


     
      @if($empresa->logotipo_email != '')
        document.getElementById("imagen_logotipo_email").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/gral/'.$empresa->logotipo_email) }}"/>'].join('');
      @endif
      @if($empresa->icono_facebook != '')
        document.getElementById("imagen_icono_facebook").innerHTML = ['<img style="width:75%;padding-bottom: 15px;" class="thumb" src="{{ asset('upload/gral/'.$empresa->icono_facebook) }}"/>'].join('');
      @endif
      @if($empresa->icono_instagram != '')
        document.getElementById("imagen_icono_instagram").innerHTML = ['<img style="width:75%;padding-bottom: 15px;" class="thumb" src="{{ asset('upload/gral/'.$empresa->icono_instagram) }}"/>'].join('');
      @endif
      @if($empresa->icono_twitter != '')
        document.getElementById("imagen_icono_twitter").innerHTML = ['<img style="width:75%;padding-bottom: 15px;" class="thumb" src="{{ asset('upload/gral/'.$empresa->icono_twitter) }}"/>'].join('');
      @endif
      @if($empresa->icono_youtube != '')
        document.getElementById("imagen_icono_youtube").innerHTML = ['<img style="width:75%;padding-bottom: 15px;" class="thumb" src="{{ asset('upload/gral/'.$empresa->icono_youtube) }}"/>'].join('');
      @endif
      @if($empresa->icono_pinterest != '')
        document.getElementById("imagen_icono_pinterest").innerHTML = ['<img style="width:75%;padding-bottom: 15px;" class="thumb" src="{{ asset('upload/gral/'.$empresa->icono_pinterest) }}"/>'].join('');
      @endif
       $('#colorpickerHolder').ColorPicker({flat: true,color: '#{{ $empresa->color_pagina }}',onChange: function(hsb, hex, rgb, el){
            $('.color_pagina').val(hex);
       }});*/
  </script>
@endsection

@section('css')
  {{ Html::style('js/colorpicker/css/colorpicker.css') }}
  <style type="text/css">
    .custom-file{
      margin-bottom: 15px !important;
    }
    .imagen_icono_facebook{
      background-color: #ccc;width: 200px;padding-top: 15px;
    }
    .imagen_icono_instagram{
      background-color: #ccc;
      width: 200px;
      padding-top: 15px;
      width: 200px !important;
    }
    .imagen_icono_twitter{
      background-color: #ccc;
      width: 200px;
      padding-top: 15px;
      width: 200px !important;
    }
    .imagen_icono_youtube{
      background-color: #ccc;
      width: 200px;
      padding-top: 15px;
      width: 200px !important;
    }
    .imagen_icono_pinterest{
      background-color: #ccc;
      width: 200px;
      padding-top: 15px;
      width: 200px !important;
    }
  </style>
@endsection


@section('contenido')
   <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Modificar información general</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              {{ Form::model($empresa,['route' => ['empresa.guardar_informacion_general',$empresa],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                @include('empresa.formulario.informacion_general')
                <div class="form-actions right">
                  <a href="{{ route('inicio') }}" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Cancelar
                  </a>
                  <button type="submit" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Guardar
                  </button>
                </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection