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
          height: 650,
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
            <h4 class="card-title" id="horz-layout-colored-controls">Pagina de soporte tecnico</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              {{ Form::model($pagina,['route' => ['paginas.guardar_soporte_tecnico',$pagina],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                <div class="form-body">
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          <h4>Pagina de boletines</h4>
                          {{ Form::textarea('soporte_boletines',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          <h4>Pagina de videos</h4>
                          {{ Form::textarea('soporte_videos',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          <h4>E-mail de envio de buzon de sugerencias (separa los emails con ";")</h4>
                          {{ Form::text('soporte_buzon_email',null,['class' => 'form-control','placeholder' => 'Email de buzon']) }}
                        </div> 
                    </div>
                    <div class="col">
                      &nbsp;
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                       <div class="form-group">
                          <h4>Pagina buzon de sugerencias</h4>
                          {{ Form::textarea('soporte_buzon',null,['class' => 'form-control']) }}
                        </div> 
                    </div>
                  </div>
                  <div class="row skin skin-square">
                    <div class="col">
                        
                        <h4>Habilitar/Deshabilitar chat</h4>
                        <fieldset>
                         <div class="form-group">
                            {{ Form::checkbox('soporte_habilitar_chat',true,null,['id' => 'habilitar_nuevos_lanzamientos']) }}
                            <label for="soporte_habilitar_chat">&nbsp;Mostrar chat</label>
                          </div> 
                        </fieldset>
                    </div>
                   
                  
                  </div>
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