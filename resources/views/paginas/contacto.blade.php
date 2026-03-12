@extends('plantilla.base')

@section('js')
  
  {{ Html::script('cms/vendors/js/forms/icheck/icheck.min.js') }}
  {{ Html::script('cms/js/scripts/forms/checkbox-radio.js') }}

  {{ Html::script('cms/js/tinymce/tinymce.min.js') }}
  {{ Html::script('cms/js/tinymce/langs/es.js') }}
 
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
            <h4 class="card-title" id="horz-layout-colored-controls">Pagina de contacto</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              {{ Form::model($pagina,['route' => ['paginas.guardar_contacto',$pagina],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                <div class="form-body">
                  <div class="row">
                    <div class="col">
                      <h4>Telefonos</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_telefono_1','Telefono linea 1') }}
                          {{ Form::text('contacto_telefono_1',null,['class' => 'form-control','placeholder' => 'Telefono 1', 'required'=> 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_telefono_2','Telefono linea 2') }}
                          {{ Form::text('contacto_telefono_2',null,['class' => 'form-control','placeholder' => 'Telefono 2']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_telefono_3','Telefono linea 3') }}
                          {{ Form::text('contacto_telefono_3',null,['class' => 'form-control','placeholder' => 'Telefono 3']) }}
                        </div> 
                    </div>
                    <div class="col">
                      <h4>Direccion</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_direccion_1','Direccion linea 1') }}
                          {{ Form::text('contacto_direccion_1',null,['class' => 'form-control','placeholder' => 'Direccion 1', 'required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_direccion_2','Direccion linea 2') }}
                          {{ Form::text('contacto_direccion_2',null,['class' => 'form-control','placeholder' => 'Direccion 2']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_direccion_3','Direccion linea 3') }}
                          {{ Form::text('contacto_direccion_3',null,['class' => 'form-control','placeholder' => 'Direccion 3']) }}
                        </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col">
                      <h4>E-mails</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_email_1','E-mail linea 1') }}
                          {{ Form::text('contacto_email_1',null,['class' => 'form-control','placeholder' => 'Email 1','required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_email_2','E-mail linea 2') }}
                          {{ Form::text('contacto_email_2',null,['class' => 'form-control','placeholder' => 'Email 2']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_email_3','E-mail linea 3') }}
                          {{ Form::text('contacto_email_3',null,['class' => 'form-control','placeholder' => 'Email 3']) }}
                        </div> 
                    </div>
                    <div class="col">
                      <h4>Horarios</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_horario_1','Horario linea 1') }}
                          {{ Form::text('contacto_horario_1',null,['class' => 'form-control','placeholder' => 'Horario 1', 'required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_horario_2','Horario linea 2') }}
                          {{ Form::text('contacto_horario_2',null,['class' => 'form-control','placeholder' => 'Horario 2']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_horario_3','Horario linea 3') }}
                          {{ Form::text('contacto_horario_3',null,['class' => 'form-control','placeholder' => 'Horario 3']) }}
                        </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h4>Coordenadas marcador mapa</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_latitud_marcador','Latitud') }}
                          {{ Form::text('contacto_latitud_marcador',null,['class' => 'form-control','placeholder' => 'Latitud','required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_longitud_marcador','Longitud') }}
                          {{ Form::text('contacto_longitud_marcador',null,['class' => 'form-control','placeholder' => 'Longitud','required' => 'required']) }}
                        </div> 
                       
                    </div>
                    <div class="col">
                      <h4>Coordenadas centrado mapa</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_latitud_centrado','Latitud') }}
                          {{ Form::text('contacto_latitud_centrado',null,['class' => 'form-control','placeholder' => 'Latitud','required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_longitud_centrado','Longitud') }}
                          {{ Form::text('contacto_longitud_centrado',null,['class' => 'form-control','placeholder' => 'Longitud','required' => 'required']) }}
                        </div> 
                        <div class="form-group">
                          {{ Form::label('contacto_zoom_centrado','Nivel de zoom') }}
                          {{ Form::text('contacto_zoom_centrado',null,['class' => 'form-control','placeholder' => 'Zoom','required' => 'required']) }}
                        </div> 
                    </div>
                  </div>

                  <div class="row">
                    <div class="col">
                      <h4>Email recepcion contacto (para varios separalos con ";")</h4>
                       <div class="form-group">
                          {{ Form::label('contacto_email_envio','Email de contacto') }}
                          {{ Form::text('contacto_email_envio',null,['class' => 'form-control','placeholder' => 'E-mail','required' => 'required']) }}
                        </div> 
                    </div>
                    <div class="col">
                      &nbsp;
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