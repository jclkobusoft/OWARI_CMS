@extends('plantilla.base')

@section('js')
  <script type="text/javascript">

      $(document).ready(function() {
            $('#password').removeAttr('required');
            $('#confirmar_password').removeAttr('required');
      });
     
  </script>
@endsection

@section('css')
 <style type="text/css">
    h5{ margin-top:10px; }
  </style>
@endsection

@section('contenido')
	<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Detalle de usuario</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              <div class="card-text">
                <p>Acepta o rechaza un usuario, escribiendo una nota al respecto.</p>
              </div>
              {{ Form::model($usuario_registrado,['route' => ['usuarios_registrados.guardar_cambio',$usuario_registrado],'files' => true,'method' => 'put', 'class' => 'form form-horizontal']) }}
                @include('usuarios_registrados.formulario.index')
                <div class="form-actions right">
                  <a href="{{ route('usuarios.index') }}" class="btn btn-warning mr-1">
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