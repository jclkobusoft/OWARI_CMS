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
@endsection

@section('css')
  
@endsection


@section('contenido')
   <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Editar página Empresa</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              <div class="card-text">
                <p>Edita y crea elementos para la página ¿Quienes somos?.</p>
              </div>
              {{ Form::model($empresa,['route' => ['empresa.guardar',$empresa],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                <div class="form-body">
                   <div class="row">
                        <div class="col">
                         <div class="form-group">
                            <div id="imagen_logotipo_email" style="width: 200px;"></div>
                              <label for="nosotros_banner">Banner de la pagina ¿Quienes somos?</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nosotros_banner" name="nosotros_banner">
                                <label class="custom-file-label" for="nosotros_banner">Elegir imagen</label>
                              </div>
                          </div>
                          <img width="50%" src="{{ asset('/upload/gral/'.$empresa->nosotros_banner) }}"><br><br>
                       </div>

                  </div>
                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          {{ Form::label('nosotros_historia_titulo','Titulo de historia de la empresa') }}
                          {{ Form::text('nosotros_historia_titulo',null,['class' => 'form-control','placeholder' => 'Titulo']) }}
                        </div>  
                        <div class="col"><hr></div>
                        <div class="form-group">
                          {{ Form::label('nosotros_historia_texto','Texto de historia de la empresa') }}
                          {{ Form::textarea('nosotros_historia_texto',null,['class' => 'form-control','placeholder' => 'Texto']) }}
                        </div>  
                     </div>
                  </div>
                 
                  <div class="row">
                        <div class="col">
                         <div class="form-group">
                            <div id="imagen_logotipo_email" style="width: 200px;"></div>
                              <label for="nosotros_imagen_lema">Imagen del lema de la empresa</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nosotros_imagen_lema" name="nosotros_imagen_lema">
                                <label class="custom-file-label" for="nosotros_imagen_lema">Elegir imagen</label>
                              </div>
                          </div>
                          <img width="50%" src="{{ asset('/upload/gral/'.$empresa->nosotros_imagen_lema) }}"><br><br>
                       </div>

                  </div>
                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          {{ Form::label('nosotros_lema','Lema de la empresa') }}
                          {{ Form::text('nosotros_lema',null,['class' => 'form-control','placeholder' => 'Lema']) }}
                        </div>  
                     </div>
                  </div>
                   <div class="row">
                        <div class="col">
                         <div class="form-group">
                            <div id="imagen_logotipo_email" style="width: 200px;"></div>
                              <label for="nosotros_imagen_video_historia">Portada del video historia de la empresa</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="nosotros_imagen_video_historia" name="nosotros_imagen_video_historia">
                                <label class="custom-file-label" for="nosotros_imagen_video_historia">Elegir imagen</label>
                              </div>
                          </div>
                          <img width="50%" src="{{ asset('/upload/gral/'.$empresa->nosotros_imagen_video_historia) }}"><br><br>
                       </div>

                  </div>
                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          {{ Form::label('nosotros_url_video_historia','URL video de historia de la empresa') }}
                          {{ Form::text('nosotros_url_video_historia',null,['class' => 'form-control','placeholder' => 'URL']) }}
                        </div>  
                        <div class="col"><hr></div>
                        <div class="form-group">
                          {{ Form::label('nosotros_titulo_video_historia','Titulo del video de la historia de la empresa') }}
                          {{ Form::text('nosotros_titulo_video_historia',null,['class' => 'form-control','placeholder' => 'Texto']) }}
                        </div>  
                     </div>
                  </div>

                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          {{ Form::label('mision','Misión') }}
                          {{ Form::textarea('mision',null,['class' => 'form-control','placeholder' => 'Mision']) }}
                        </div>  
                        <div class="col"><hr></div>
                        <div class="form-group">
                          {{ Form::label('vision','Visión') }}
                          {{ Form::textarea('vision',null,['class' => 'form-control','placeholder' => 'Texto']) }}
                        </div>  
                     </div>
                  </div>

                  <div class="row">
                      <div class="col">
                        <div class="form-group">
                          {{ Form::label('valores','Valores') }}
                          {{ Form::textarea('valores',null,['class' => 'form-control','placeholder' => 'URL']) }}
                        </div>  
                        <div class="col"><hr></div>
                     </div>
                  </div>

                  <!--
                  <div class="row">
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_experiencia','Numero años experiencia') }}
                          {{ Form::text('nosotros_numeros_experiencia',null,['class' => 'form-control','placeholder' => 'Años']) }}
                        </div>  
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_productos','Numero de productos') }}
                          {{ Form::text('nosotros_numeros_productos',null,['class' => 'form-control','placeholder' => 'Productos']) }}
                        </div>  
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_socios','Numero de socios comerciales') }}
                          {{ Form::text('nosotros_numeros_socios',null,['class' => 'form-control','placeholder' => 'Socios']) }}
                        </div>  
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_marcas','Numero de marcas') }}
                          {{ Form::text('nosotros_numeros_marcas',null,['class' => 'form-control','placeholder' => 'Marcas']) }}
                        </div>  
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_empleados','Numero de empleados') }}
                          {{ Form::text('nosotros_numeros_empleados',null,['class' => 'form-control','placeholder' => 'Empleados']) }}
                        </div>  
                     </div>
                      <div class="col-6">
                        <div class="form-group">
                          {{ Form::label('nosotros_numeros_almacenes','Numero de almacenes') }}
                          {{ Form::text('nosotros_numeros_almacenes',null,['class' => 'form-control','placeholder' => 'Almacenes']) }}
                        </div>  
                     </div>
                  </div>

                -->

                </div>
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