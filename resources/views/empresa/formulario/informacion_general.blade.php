

<div class="form-body">
   
@can('permiso','editar_logotipos')
   <hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Logotipos</h4>
      </div>
    </div>
    <div class="row">
     <div class="col"> 
        <div class="form-group">
            <label for="logotipo_general">Logotipo general</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="logotipo_general" name="logotipo_general">
              <label class="custom-file-label" for="logotipo_general">Elegir imagen</label>
            </div>
        </div>
        <div id="imagen_logotipo_general" style="width: 200px;"></div>

     </div>
     {{--<div class="col">
       <div class="form-group">
          <div id="imagen_logotipo_email" style="width: 200px;"></div>
            <label for="logotipo_email">Logotipo e-mail</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="logotipo_email" name="logotipo_email">
              <label class="custom-file-label" for="logotipo_email">Elegir imagen</label>
            </div>
        </div>
     </div>--}}
   </div>
@endcan

@can('permiso','editar_redes_sociales')
<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Redes sociales</h4>
      </div>
    </div>
    <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('url_facebook','URL Facebook') }}
          {{ Form::text('url_facebook',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div>  
   
        <div class="col"><hr></div>

        <div class="form-group">
          {{ Form::label('url_instagram','URL Instagram') }}
          {{ Form::text('url_instagram',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div>  
        <div class="col"><hr></div>
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('url_twitter','URL Twitter') }}
          {{ Form::text('url_twitter',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div>  
        <div class="col"><hr></div>
        <div class="form-group">
          {{ Form::label('url_youtube','URL YouTube') }}
          {{ Form::text('url_youtube',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div>  
     </div>
   </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('url_pinterest','URL Pinterest') }}
          {{ Form::text('url_pinterest',null,['class' => 'form-control','placeholder' => 'URL']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>
@endcan
   
@can('permiso','editar_emails')
<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">E-mail de contacto</h4>
      </div>
    </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('email_contacto','E-mail principal de contacto') }}
          {{ Form::text('email_contacto',null,['class' => 'form-control','placeholder' => 'E-mail']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>
@endcan

@can('permiso','editar_telefonos')
<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Teléfonos</h4>
      </div>
    </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('telefono_1','Telefono linea 1') }}
          {{ Form::text('telefono_1',null,['class' => 'form-control','placeholder' => 'Teléfono 1']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('marcar_1','Marcar a:') }}
          {{ Form::text('marcar_1',null,['class' => 'form-control','placeholder' => 'Teléfono 1']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('telefono_2','Telefono linea 2 What\'s App') }}
          {{ Form::text('telefono_2',null,['class' => 'form-control','placeholder' => 'Teléfono 2']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('marcar_2','Marcar a:') }}
          {{ Form::text('marcar_2',null,['class' => 'form-control','placeholder' => 'Teléfono 1']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('telefono_3','Telefono linea 3') }}
          {{ Form::text('telefono_3',null,['class' => 'form-control','placeholder' => '(0155) 1234 5678']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('marcar_3','Marcar a:') }}
          {{ Form::text('marcar_3',null,['class' => 'form-control','placeholder' => 'Teléfono 1']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>
@endcan

@can('permiso','editar_direccion')
<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Dirección (ubicación)</h4>
      </div>
    </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('direccion_1','Dirección linea 1') }}
          {{ Form::text('direccion_1',null,['class' => 'form-control','placeholder' => 'Dirección 1']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('direccion_2','Dirección linea 2') }}
          {{ Form::text('direccion_2',null,['class' => 'form-control','placeholder' => 'Dirección 2']) }}
        </div>  
     </div>
     <div class="col">
        <div class="form-group">
          {{ Form::label('direccion_3','Dirección linea 3') }}
          {{ Form::text('direccion_3',null,['class' => 'form-control','placeholder' => 'Dirección 3']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>
@endcan

<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Horarios</h4>
      </div>
    </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::label('horarios','Horario de atención') }}
          {{ Form::text('horarios',null,['class' => 'form-control','placeholder' => 'Horario']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>
@can('permiso','editar_logotipos')
   <hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Imagen del footer</h4>
      </div>
    </div>
    <div class="row">
     <div class="col"> 
        <div class="form-group">
            <label for="imagen_footer">Imagen</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="imagen_footer" name="imagen_footer">
              <label class="custom-file-label" for="imagen_footer">Elegir imagen</label>
            </div>
        </div>
        <div id="imagen_footer_general" style="width: 200px;"></div>

     </div>
     {{--<div class="col">
       <div class="form-group">
          <div id="imagen_logotipo_email" style="width: 200px;"></div>
            <label for="logotipo_email">Logotipo e-mail</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="logotipo_email" name="logotipo_email">
              <label class="custom-file-label" for="logotipo_email">Elegir imagen</label>
            </div>
        </div>
     </div>--}}
   </div>
@endcan
<hr>
   <div class="row">
      <div class="col-12"> 
        <h4 class="card-title" id="basic-layout-card-center">Descripción en el footer.</h4>
      </div>
    </div>
   <div class="row">
     <div class="col-12">
        <div class="form-group">
          {{ Form::label('descripcion_footer','Texto descripcion Owari en footer') }}
          {{ Form::textarea('descripcion_footer',null,['class' => 'form-control','placeholder' => 'Descripcion en el footer']) }}
        </div>  
     </div>
     <div class="col">
        &nbsp;
     </div>
   </div>

{{--
@can('permiso','editar_color_general')
<hr>
   <div class="row">
      <div class="col"> 
        <h4 class="card-title" id="basic-layout-card-center">Color general de la pagina</h4>
      </div>
    </div>
   <div class="row">
     <div class="col">
        <div class="form-group">
          {{ Form::hidden('color_pagina',null,['class' => 'form-control color_pagina']) }}
          <p id="colorpickerHolder">
          </p>
        </div>  
     </div>
   </div>
@endcan
--}}

 </div>