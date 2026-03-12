<div class="form-body">
   <div class="row">
     <div class="col"> 
        <div class="form-group">
          {{ Form::label('nombre','Nombre marca') }}
          {{ Form::text('nombre',null,['class' => 'form-control','placeholder' => 'Nombre de la marca','required' => 'required']) }}
        </div>
        <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="archivo">Imagen de la marca</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="archivo" name="archivo">
              <label class="custom-file-label" for="archivo">Elegir imagen</label>
            </div>
        </div>
     </div>
     <div class="col">
       <div class="form-group">
          {{ Form::label('tipo','Tipo de marca') }}
          {{ Form::text('tipo',null,['class' => 'form-control','placeholder' => 'Tipo de marca','required' => 'required']) }}
        </div> 
        <div class="form-group">
            {{ Form::label('redireccion','Redirecciona a') }}
            {{ Form::select('redireccion',['propia' => 'Página propia','enlace' => 'Página externa'],null,['class' => 'form-control']) }}
          </div>
     </div>
   </div>
   <div class="row">
     <div class="col"> 
          <div class="form-group">
            {{ Form::label('titulo_principal','Titulo principal') }}
            {{ Form::text('titulo_principal',null,['class' => 'form-control','placeholder' => 'Titulo principal','required' => 'required']) }}
          </div>
          <div class="form-group">
            <div id="banner_marca" style="width: 200px;"></div>
              <label for="banner">Banner de la marca</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" id="banner" name="banner">
                <label class="custom-file-label" for="banner">Elegir imagen</label>
              </div>
          </div>
       </div>

      
     </div>
     <div class="row">
         <div class="col"> 
          <div class="form-group">
            {{ Form::label('descripcion_breve','Descripcion breve') }}
            {{ Form::textarea('descripcion_breve',null,['class' => 'form-control summernote']) }}
          </div>
        
       </div>
     </div>
   <hr>
   <div class="row" id="propia">
    
     <div class="col">
      <br>
       <h4 class="card-title" id="basic-layout-card-center">Contenido propio</h4>
       <div class="form-group">
          {{ Form::label('contenido','Contenido') }}
          {{ Form::textarea('contenido',null,['class' => 'form-control summernote']) }}
        </div> 
     </div>
   </div>
   <div class="row" id="externa" style="display:none;">
     <div class="col">
      <br>
      <h4 class="card-title" id="basic-layout-card-center">URL contenido externo</h4>
      <div class="col-lg-6 col-md-12">
       <div class="form-group">
          {{ Form::label('url','URL de redireccionamiento') }}
          {{ Form::text('url',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div> 
      </div>
     </div>
   </div>
 </div>