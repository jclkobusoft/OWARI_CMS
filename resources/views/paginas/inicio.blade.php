@extends('plantilla.base')

@section('js')
  
  {{ Html::script('cms/vendors/js/forms/icheck/icheck.min.js') }}
  {{ Html::script('cms/js/scripts/forms/checkbox-radio.js') }}

  {{ Html::script('cms/js/tinymce/tinymce.min.js') }}
  {{ Html::script('cms/js/tinymce/langs/es.js') }}
  <script type="text/javascript">
   
      tinymce.init({
          selector: 'textarea',
          language: 'es',
          height: 250,
          theme: 'modern',
          plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount   imagetools contextmenu colorpicker textpattern help',
          toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
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
  {{ Html::style('cms/vendors/css/forms/icheck/icheck.css') }}
  {{ Html::style('cms/css/plugins/forms/checkboxes-radios.css') }}
  {{ Html::style('cms/vendors/css/forms/icheck/custom.css') }}
@endsection


@section('contenido')
   <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Página inicio</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              {{ Form::model($pagina,['route' => ['paginas.guardar_inicio',$pagina],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                <div class="form-body">
               
                </div>
                <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('titulo_bienvenida','Titulo bienvenida') }}
                          {{ Form::text('titulo_bienvenida',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('subtitulo_bienvenida','Subtitulo bienvenida') }}
                          {{ Form::text('subtitulo_bienvenida',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>
                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('texto_bienvenida','Texto bienvenida') }}
                          {{ Form::textarea('texto_bienvenida',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                  <div class="row">
                        <div class="col">
                         <div class="form-group">
                            <div id="imagen_logotipo_email" style="width: 200px;"></div>
                              <label for="imagen_bienvenida">Imagen bienvenida</label>
                              <div class="custom-file">imagen_bienvenida
                                <input type="file" class="custom-file-input" id="imagen_bienvenida" name="imagen_bienvenida">
                                <label class="custom-file-label" for="imagen_bienvenida">Elegir imagen</label>
                              </div>
                          </div>
                          <img width="200px" src="{{ asset('/upload/gral/'.$pagina->imagen_bienvenida) }}"><br><br>
                       </div>

                  </div>



                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('titulo_marcas','Titulo marcas') }}
                          {{ Form::text('titulo_marcas',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('texto_marcas','Texto marcas') }}
                          {{ Form::textarea('texto_marcas',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('titulo_boletines','Titulo boletines') }}
                          {{ Form::text('titulo_boletines',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('texto_boletines','Texto boletines') }}
                          {{ Form::textarea('texto_boletines',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('titulo_catalogos','Titulo catalogos') }}
                          {{ Form::text('titulo_catalogos',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('texto_catalogos','Texto catalogos') }}
                          {{ Form::textarea('texto_catalogos',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('titulo_productos','Titulo productos') }}
                          {{ Form::text('titulo_productos',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>

                   <div class="row">
                    <div class="col">
                       <div class="form-group">
                          {{ Form::label('texto_productos','Texto productos') }}
                          {{ Form::textarea('texto_productos',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>


                   <!--<div class="row">
                        <div class="col">
                         <div class="form-group">
                            <div id="imagen_logotipo_email" style="width: 200px;"></div>
                              <label for="imagen_conviertete_distribuidor">Imagen conviertete en distribuidor</label>
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="imagen_conviertete_distribuidor" name="imagen_conviertete_distribuidor">
                                <label class="custom-file-label" for="imagen_conviertete_distribuidor">Elegir imagen</label>
                              </div>
                          </div>
                          <img width="200px" src="{{ asset('/upload/gral/'.$pagina->imagen_conviertete_distribuidor ) }}"><br><br>
                       </div>

                  </div>-->



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