 <div class="form-body">
  <div class="form-group">
    {{ Form::label('url','El banner redirecciona a:') }}
    {{ Form::text('url',null,['class' => 'form-control','placeholder' => 'URL','required' => 'required']) }}
  </div>
  <div class="form-group">
    <div id="list" style="width: 200px;"></div>
      <label for="basicInputFile">Imagen del banner</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="archivo" name="archivo">
        <label class="custom-file-label" for="archivo">Elegir imagen</label>
      </div>
  </div>
  <div class="form-group">
    <div id="listdos" style="width: 200px;"></div>
      <label for="basicInputFile">Imagen del banner para celular</label>
      <div class="custom-file">
        <input type="file" class="custom-file-input" id="archivo_movil" name="archivo_movil">
        <label class="custom-file-label" for="archivo_movil">Elegir imagen</label>
      </div>
  </div>
  <div class="form-group">
    {{ Form::label('fecha_inicio','Mostrar el banner el:') }}
    {{ Form::text('fecha_inicio',null,['class' => 'form-control date-time','placeholder' => 'Fecha','required' => 'required']) }}
  </div>
  <div class="form-group">
    {{ Form::label('fecha_fin','Quitar el banner el:') }}
    {{ Form::text('fecha_fin',null,['class' => 'form-control date-time','placeholder' => 'Fecha','required' => 'required']) }}
  </div>
</div>