<div class="form-body">
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('nombre','Nombre boletin') }}
          {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre del boletin','required' => 'required']) }}
        </div>
        @if(isset($boletin->url))
              <a target="_blank" href="{{ $boletin->url }}" class="btn btn-info btn-min-width mr-1 mb-1"><i class="fa fa-file"></i> Ver archivo</a>
            @endif
        <div class="form-group">

            <label for="archivo">Archivo del boletin</label>
            <input type="file" class="form-control-file" id="archivo" name="archivo">
        </div>
     </div>
     <div class="col">
       <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="portada">Portada del boletin</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="portada" name="portada">
              <label class="custom-file-label" for="portada">Elegir imagen</label>
            </div>
        </div>
     </div>
   </div>
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('descripcion','Descripcion') }}
          {{ Form::text('descripcion',null,['class' => 'form-control','placeholder' => 'Descripcion breve','required' => 'required']) }}
        </div>
     </div>
     <div class="col">
       <div class="form-group">
          {{ Form::label('fecha_publicacion','Fecha de publicacion') }}
          {{ Form::text('fecha_publicacion',null,['class' => 'form-control pickadate','placeholder' => 'Fecha de publicacion','required' => 'required']) }}
        </div>
   </div>
 </div>
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('tags','Etiquetas') }}
          {{ Form::text('tags',null,['class' => 'form-control','placeholder' => 'Etiquetas','required' => 'required']) }}
        </div>
     </div>
 </div>
 <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('ano','Año') }}
          {{ Form::text('ano',null,['class' => 'form-control','placeholder' => 'Filtro año','required' => 'required']) }}
        </div>
     </div>
 </div>
 <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('marca','Marca') }}
          {{ Form::text('marca',null,['class' => 'form-control','placeholder' => 'Filtro Marca','required' => 'required']) }}
        </div>
     </div>
 </div>
</div>