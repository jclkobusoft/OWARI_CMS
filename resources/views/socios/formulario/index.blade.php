
    <h4 class="form-section"><i class="fa fa-file"></i> Infomación general</h4>
    <div class="row">
      <div class="col-md-12">
         <div class="form-group row">
          {{ Form::label('nombre','Nombre del socio',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('nombre',null,['class' => 'form-control border-primary','placeholder' => 'Socio']) }}
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="form-group row">
          {{ Form::label('descripcion','Descripcion del socio',['class' => 'col-md-3 label-control','required' => 'required']) }}
          <div class="col-md-12">
          {{ Form::textarea('descripcion',null,['class' => 'form-control summernote']) }}          </div>
        </div>

      </div>
      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('telefono_1','Telefono 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('telefono_1',null,['class' => 'form-control border-primary','placeholder' => 'Telefono 1']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('telefono_2','Telefono 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('telefono_2',null,['class' => 'form-control border-primary','placeholder' => 'Telefono 2']) }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('direccion_1','Direccion 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('direccion_1',null,['class' => 'form-control border-primary','placeholder' => 'Direccion 1']) }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('direccion_2','Direccion 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('direccion_2',null,['class' => 'form-control border-primary','placeholder' => 'Direccion 2']) }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('direccion_3','Direccion 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('direccion_3',null,['class' => 'form-control border-primary','placeholder' => 'Direccion 3']) }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('pagina_web','Pagina web',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('pagina_web',null,['class' => 'form-control border-primary','placeholder' => 'Pagina Web']) }}
          </div>
        </div>
      </div>

      <div class="col-md-6">
         <div class="form-group row">
          {{ Form::label('tags','Tags',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('tags',null,['class' => 'form-control border-primary','placeholder' => 'Tags']) }}
          </div>
        </div>
      </div>
    

    </div>
    <div class="row">
      <div class="col-md-6">
        
         <div class="form-group">
          <div id="list" style="width: 200px;"></div>
            <label for="archivo">Logotipo</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="logotipo" name="logotipo">
              <label class="custom-file-label" for="banner">Elegir imagen</label>
            </div>
        </div>

      </div>
      
    </div>


 