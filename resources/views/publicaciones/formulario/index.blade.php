<div class="form-body">
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('nombre','Nombre publicacion') }}
          {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre publicacion','required' => 'required']) }}
        </div>
        @if(isset($publicacion->url))
              <a target="_blank" href="{{ $publicacion->url }}" class="btn btn-info btn-min-width mr-1 mb-1"><i class="fa fa-file"></i> Ver archivo</a>
            @endif
        <div class="form-group">

            <label for="archivo">Archivo de la publicacion</label>
            <input type="file" class="form-control-file" id="archivo" name="archivo">
        </div>
     </div>
     <div class="col">
       <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="portada">Portada de la publicacion</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="portada" name="portada">
              <label class="custom-file-label" for="portada">Elegir imagen</label>
            </div>
        </div>
     </div>
   </div>
 </div>