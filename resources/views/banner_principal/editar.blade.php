@extends('plantilla.base')

@section('js')

  {{ Html::script('js/summer/summernote-bs4.js') }}


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


    document.getElementById("list").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/banner_principal/'.$banner_principal->imagen) }}"/>'].join('');
    document.getElementById("listdos").innerHTML = ['<img style="width:75%;" class="thumb" src="{{ asset('upload/banner_principal/movil_'.$banner_principal->imagen) }}"/>'].join('');


</script>
  


 
  
@endsection

@section('css')
  
@endsection

@section('contenido')
 {{ Form::model($banner_principal,['route' => ['banner_principal.update',$banner_principal->id],'method' => 'put','class' => 'form','files' => true]) }}
	       <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-card-center">Editar banner</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                      <p>Rellena los campos y proporciona una imagen relacionada al banner creado.</p>
                    </div>
                     @include('banner_principal.formulario.index')
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