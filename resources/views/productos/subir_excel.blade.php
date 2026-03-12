@extends('plantilla.base')

@section('js')
  <script type="text/javascript">
    $('#boton_save').click(function(event) {
      /* Act on the event */
        $('#default').modal('show');
        $('#formulario').submit();
        return false;


    });

    function validar(){
      if(confirm('¿Estas seguro que deseas vaciar la tabla de productos?')){
          window.location = "{{ route('productos.vaciar_tabla') }}";
      }
    }

  </script>
 
@endsection

@section('css')

    
@endsection

@section('contenido')
	<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title" id="horz-layout-colored-controls">Subir Excel</h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
          </div>
          <div class="card-content collpase show">
            <div class="card-body">
              <div class="card-text">
                <p>Rellena toda la información necesaria.</p>
              </div>
               @if (Session::has('message'))
                <div class="alert @if(Session::has('code')) alert-success @else alert-danger @endif alert-icon-left alert-dismissible" role="alert" style="margin-bottom: 0px !important;">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                  <strong>Oh no!</strong><br> {!! Session::get('message') !!}
                </div>
                @endif
              {{ Form::open(['route' => 'productos.upload_excel','files' => true,'method' => 'post', 'class' => 'form form-horizontal','id' => 'formulario']) }}
                <div class="col-md-6">
                   <fieldset class="form-group">
                    <label for="basicInputFile">Selecciona el archivo y la funcion a realizar</label><br>
                    <small>Para actualizar o eliminar, es indispensable que el archivo de Excel tenga el campo ID al inicio para indentificarlo dentro del sistema, con ese ID sabra que elemento actualizara o eliminara segun sea el caso.</small><br><br>
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="archivo" name="archivo">
                      <label class="custom-file-label" for="inputGroupFile01">Elegir Excel</label>
                    </div>
                  </fieldset>
                </div>
                <div class="col-md-6">
                    <fieldset class="form-group">
                      <label for="basicSelect">Operacion</label>
                      <select class="form-control" id="operacion" name="operacion">
                        <option value="agregar">Agregar</option>
                        <option value="actualizar">Actualizar</option>
                        <option value="eliminar">Eliminar</option>
                      </select>
                    </fieldset>
                  </div>

                <div class="form-actions text-right">
                  <a href="{{ route('productos.index') }}" class="btn btn-warning mr-1">
                    <i class="ft-x"></i> Cancelar
                  </a>
                  <a href="#" id="boton_save" class="btn btn-primary">
                    <i class="fa fa-check-square-o"></i> Ejecutar
                  </a>
                </div>
              {{ Form::close() }}
              <br><br><br><br>
              <a href="{{ route('productos.actualizar_magenes') }}" class="btn btn-secondary">Actualizar imagenes</a>
              <a href="{{ route('productos.anexar_imagenes') }}" class="btn btn-warning">Anexar imagenes</a>
              <a href="{{ route('productos.ver_carpetas') }}" class="btn btn-success">Ver carpetas Excel</a>
              <a href="{{ route('productos.ver_carpeta_fotos') }}" class="btn btn-blue">Ver carpetas y fotos</a>
              <a href="{{ route('productos.respaldo_tabla') }}" class="btn btn-primary">Crear respaldo de los productos</a>
              <a href="javascript:validar()" class="btn btn-danger">Eliminar informacion</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade text-left show" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" style="display: none;">
        <div class="modal-dialog modal-xs" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel1">Espera un momento...</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body text-center">
              <h5>Estamos validando y realizando la operacion solicitada.</h5>
              <p>No cierres ni actualices esta ventana, en cuanto la operacion este terminada seras redirigido automaticamente.
              </p>
              <img src="{{ asset('img/loading.gif') }}" height="200px">
            </div>
          </div>
        </div>
      </div>
@endsection