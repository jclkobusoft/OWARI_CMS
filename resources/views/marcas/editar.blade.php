@extends('plantilla.base')

@section('js')

  {{ Html::script('js/summer/summernote-bs4.js') }}


  <script type="text/javascript">
        $('#redireccion').change(function(event) {
          /* Act on the event */
          $('#propia,#externa').hide();
          if($(this).val() == "propia")
            $('#propia').show();
          else
            $('#externa').show();
        });

        $(document).ready(function() {
           
            $('#propia,#externa').hide();
            if($('#redireccion').val() == "propia")
              $('#propia').show();
            else
              $('#externa').show();

        });


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
                 document.getElementById("list").innerHTML = ['<img style="width:75%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
     
            reader.readAsDataURL(f);
          }
      }
     
      document.getElementById('archivo').addEventListener('change', archivo, false);
      function archivo2(evt) {
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
                 document.getElementById("banner_marca").innerHTML = ['<img style="width:75%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
     
            reader.readAsDataURL(f);
          }
      }
      document.getElementById('banner').addEventListener('change', archivo2, false);
      document.getElementById("list").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/marcas/'.$marca->imagen) }}"/>'].join('');
      document.getElementById("banner_marca").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/marcas/'.$marca->banner) }}"/>'].join('');
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
  
@endsection

@section('contenido')
 {{ Form::model($marca,['route' => ['marcas.update',$marca->id],'method' => 'put','class' => 'form','files' => true]) }}
	       <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-card-center">Editar marca</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                      <p>Rellena los campos y proporciona una imagen relacionada a la marca creada.</p>
                    </div>
                     @include('marcas.formulario.index')
                      <div class="form-actions right">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                          <i class="fa fa-check-square-o"></i> Guardar
                        </button>
                      </div>
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
  {{ Form::close() }}
@endsection