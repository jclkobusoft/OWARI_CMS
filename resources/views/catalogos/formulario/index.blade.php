<div class="form-body">
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('nombre','Nombre catalogo') }}
          {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre del catalogo','required' => 'required']) }}
        </div>
        @if(isset($catalogo->url))
              <a target="_blank" href="{{ $catalogo->url }}" class="btn btn-info btn-min-width mr-1 mb-1"><i class="fa fa-file"></i> Ver catalogo</a>
            @endif
        <div class="form-group">

            <label for="archivo">Archivo del catalogo</label>
            <input type="file" class="form-control-file" id="archivo" name="archivo">
        </div>
     </div>
     <div class="col">
       <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="portada">Portada del catalogo</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="portada" name="portada">
              <label class="custom-file-label" for="portada">Elegir imagen</label>
            </div>
        </div>
        <div class="form-group">
          {{ Form::label('tags','Etiquetas') }}
          {{ Form::text('tags',null,['class' => 'form-control','placeholder' => 'Etiquetas']) }}
        </div>
     </div>
   </div>
 </div>