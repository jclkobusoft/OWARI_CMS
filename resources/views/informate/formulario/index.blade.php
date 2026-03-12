
    <h4 class="form-section"><i class="fa fa-file"></i> Datos generales</h4>
    <div class="row">
      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('evento','¿Es un evento?',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('evento',[ '0' => 'No','1' => 'Si'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('evento_fecha','Fecha del evento',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('evento_fecha',null,['class' => 'form-control border-primary','placeholder' => 'Fecha']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('evento_nombre','Nombre del evento',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('evento_nombre',null,['class' => 'form-control border-primary','placeholder' => 'Nombre']) }}
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group row">
          {{ Form::label('titulo','Titulo de la entrada',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('titulo',null,['class' => 'form-control border-primary','placeholder' => 'Nombre','required' => 'required']) }}
            {{ Form::hidden('estampa',$estampa) }}
          </div>
        </div>

          <div class="form-group row">
            {{ Form::label('subtitulo','Subtitulo de la entrada/evento',['class' => 'col-md-3 label-control']) }}
            <div class="col-md-9">
              {{ Form::text('subtitulo',null,['class' => 'form-control border-primary','placeholder' => 'Subtitulo']) }}
            </div>
          </div>

          <div class="form-group row">
            {{ Form::label('tags','Etiquetas (usala para que aparesca en los productos o en la seccion de marcas)',['class' => 'col-md-3 label-control']) }}
            <div class="col-md-9">
              {{ Form::text('tags',null,['class' => 'form-control border-primary','placeholder' => 'Marcas Claves de producto']) }}
            </div>
          </div>
   
      </div>

    </div>

    <h4 class="form-section"><i class="ft-search"></i>Contenido de la seccion</h4>
    <div class="row">
      <div class="col-md-6">
        
         <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="archivo">Banner de la entrada</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="banner" name="banner">
              <label class="custom-file-label" for="banner">Elegir imagen</label>
            </div>
        </div>

      </div>
      <div class="col-md-12">
        
        <div class="form-group row">
          {{ Form::label('contenido','Contenido de la entrada',['class' => 'col-md-3 label-control','required' => 'required']) }}
          <div class="col-md-12">
          {{ Form::textarea('contenido',null,['class' => 'form-control summernote']) }}          </div>
        </div>

      </div>
    </div>


 