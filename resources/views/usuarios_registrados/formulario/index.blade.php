<div class="form-body">
    <h4 class="form-section"><i class="fa fa-user"></i>Datos generales</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('clave','Clave',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('clave',null,['class' => 'form-control border-primary','placeholder' => 'Clave','readonly' => 'readonly']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('razon_social','Razon social',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('razon_social',null,['class' => 'form-control border-primary','placeholder' => 'Razon social','readonly' => 'readonly']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('nombre','Nombre',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('nombre',null,['class' => 'form-control border-primary','placeholder' => 'Nombre','readonly' => 'readonly']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('email','E-mail',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('email',null,['class' => 'form-control border-primary','placeholder' => 'E-mail','required' => 'required']) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('telefono','Telefono',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('telefono',null,['class' => 'form-control border-primary','placeholder' => 'Telefono','readonly' => 'readonly']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('password','Password',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::password('password',['class' => 'form-control border-primary','placeholder' => 'Password']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('estado','Nombre',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('estado',['nuevo' => 'Nuevo','aprobado' => 'Aceptado', 'rechazado' => 'Rechazado'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('nota','Nota',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::textarea('nota',null,['class' => 'form-control border-primary','placeholder' => 'Nota']) }}
          </div>
        </div>
      </div>
    </div>
  </div>