@extends('plantilla.base')

@section('js')
  <script type="text/javascript">
       $('.date-time').datetimepicker({
        format: 'Y-m-d H:i',
        lang: 'es',
        i18n: {
          es: { // Spanish
              months: [
                "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"
              ],
              dayOfWeekShort: [
                "Dom", "Lun", "Mar", "Mié", "Jue", "Vie", "Sáb"
              ],
              dayOfWeek: ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"]
            }
        }
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


      function archivodos(evt) {
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
                 document.getElementById("listdos").innerHTML = ['<img style="width:75%;" class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                };
            })(f);
     
            reader.readAsDataURL(f);
          }
      }
     
      document.getElementById('archivo').addEventListener('change', archivo, false);
      document.getElementById('archivo_movil').addEventListener('change', archivodos, false);
  </script>
@endsection

@section('css')
@endsection

@section('contenido')
	 <div class="row justify-content-md-center">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-card-center">Agregar banner</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                      <p>Rellena los campos y proporciona una imagen relacionada al banner creada.</p>
                    </div>
                    {{ Form::open(['route' => 'banner_principal.store','method' => 'post','class' => 'form','files' => true]) }}
                     @include('banner_principal.formulario.index')
                      <div class="form-actions center">
                        <button type="button" class="btn btn-warning mr-1">
                          <i class="ft-x"></i> Cancel
                        </button>
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