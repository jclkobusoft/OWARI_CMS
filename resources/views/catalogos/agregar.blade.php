@extends('plantilla.base')

@section('js')
<script type="text/javascript">
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
     
      document.getElementById('portada').addEventListener('change', archivo, false);
</script>

@endsection

@section('css')
@endsection

@section('contenido')
 {{ Form::open(['route' => 'catalogos.store','method' => 'post','class' => 'form','files' => true]) }}
	       <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title" id="basic-layout-card-center">Agregar catalogo</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body">
                    <div class="card-text">
                      <p>Rellena los campos y proporciona el archivo para el catalogo.</p>
                    </div>
                     @include('catalogos.formulario.index')
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