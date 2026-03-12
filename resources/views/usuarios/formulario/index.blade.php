<div class="form-body">
    <h4 class="form-section"><i class="fa fa-user"></i> Datos generales</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('name','Nombre',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('name',null,['class' => 'form-control border-primary','placeholder' => 'Nombre','required' => 'required']) }}
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
          {{ Form::label('password','Password',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::password('password',['class' => 'form-control border-primary','placeholder' => 'Password','required' => 'required']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('confirmar_password','Confirmar password',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::password('confirmar_password',['class' => 'form-control border-primary','placeholder' => 'Confirmar password','required' => 'required']) }}
          </div>
        </div>
      </div>
    </div>
    <h4 class="form-section"><i class="fa fa-lock"></i> Permisos / Autorizaciones</h4>
    <div class="row">
      <div class="col-md-3">
          <h5><i class="fa fa-user"></i>&nbsp;&nbsp;Usuarios</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_usuarios',isset($usuario->permisos->ver_usuarios) ? $usuario->permisos->ver_usuarios:false,['class' => 'custom-control-input','id' => 'ver_usuarios']) }}
            {{ Form::label('ver_usuarios','Ver usuarios',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_usuarios',isset($usuario->permisos->agregar_usuarios) ? $usuario->permisos->agregar_usuarios:false,['class' => 'custom-control-input','id' => 'agregar_usuarios']) }}
            {{ Form::label('agregar_usuarios','Agregar usuarios',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_usuarios',isset($usuario->permisos->editar_usuarios) ? $usuario->permisos->editar_usuarios:false,['class' => 'custom-control-input','id' => 'editar_usuarios']) }}
            {{ Form::label('editar_usuarios','Editar usuarios',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_usuarios',isset($usuario->permisos->eliminar_usuarios) ? $usuario->permisos->eliminar_usuarios:false,['class' => 'custom-control-input','id' => 'eliminar_usuarios']) }}
            {{ Form::label('eliminar_usuarios','Eliminar usuarios',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_log',isset($usuario->permisos->ver_log) ? $usuario->permisos->ver_log:false,['class' => 'custom-control-input','id' => 'ver_log']) }}
            {{ Form::label('ver_log','Ver log',['class' => 'custom-control-label']) }}
          </div>
         
      </div>


      <div class="col-md-3">
          <h5><i class="ft-grid"></i>&nbsp;&nbsp;Datos generales</h5>
           <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_banner_principal',isset($usuario->permisos->editar_banner_principal) ? $usuario->permisos->editar_banner_principal:false,['class' => 'custom-control-input','id' => 'editar_banner_principal']) }}
            {{ Form::label('editar_banner_principal','Editar banner principal',['class' => 'custom-control-label']) }}
          </div>


          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_informacion_general',isset($usuario->permisos->ver_informacion_general) ? $usuario->permisos->ver_informacion_general:false,['class' => 'custom-control-input','id' => 'ver_informacion_general']) }}
            {{ Form::label('ver_informacion_general','Ver información general',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_logotipos',isset($usuario->permisos->editar_logotipos) ? $usuario->permisos->editar_logotipos:false,['class' => 'custom-control-input','id' => 'editar_logotipos']) }}
            {{ Form::label('editar_logotipos','Editar logotipos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_redes_sociales',isset($usuario->permisos->editar_redes_sociales) ? $usuario->permisos->editar_redes_sociales:false,['class' => 'custom-control-input','id' => 'editar_redes_sociales']) }}
            {{ Form::label('editar_redes_sociales','Editar redes sociales',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_emails',isset($usuario->permisos->editar_emails) ? $usuario->permisos->editar_emails:false,['class' => 'custom-control-input','id' => 'editar_emails']) }}
            {{ Form::label('editar_emails','Editar emails',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_telefonos',isset($usuario->permisos->editar_telefonos) ? $usuario->permisos->editar_telefonos:false,['class' => 'custom-control-input','id' => 'editar_telefonos']) }}
            {{ Form::label('editar_telefonos','Editar teléfonos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_direccion',isset($usuario->permisos->editar_direccion) ? $usuario->permisos->editar_direccion:false,['class' => 'custom-control-input','id' => 'editar_direccion']) }}
            {{ Form::label('editar_direccion','Editar direccion',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_aviso_privacidad',isset($usuario->permisos->editar_aviso_privacidad) ? $usuario->permisos->editar_aviso_privacidad:false,['class' => 'custom-control-input','id' => 'editar_aviso_privacidad']) }}
            {{ Form::label('editar_aviso_privacidad','Editar aviso privacidad',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_terminos_uso',isset($usuario->permisos->editar_terminos_uso) ? $usuario->permisos->editar_terminos_uso:false,['class' => 'custom-control-input','id' => 'editar_terminos_uso']) }}
            {{ Form::label('editar_terminos_uso','Editar terminos uso',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_pop_up',isset($usuario->permisos->editar_pop_up) ? $usuario->permisos->editar_pop_up:false,['class' => 'custom-control-input','id' => 'editar_pop_up']) }}
            {{ Form::label('editar_pop_up','Editar ventana emergente',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_promociones',isset($usuario->permisos->ver_promociones) ? $usuario->permisos->ver_promociones:false,['class' => 'custom-control-input','id' => 'ver_promociones']) }}
            {{ Form::label('ver_promociones','Ver promociones',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_notinikko',isset($usuario->permisos->ver_notinikko) ? $usuario->permisos->ver_notinikko:false,['class' => 'custom-control-input','id' => 'ver_notinikko']) }}
            {{ Form::label('ver_notinikko','Ver notinikko',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_color_general',isset($usuario->permisos->editar_color_general) ? $usuario->permisos->editar_color_general:false,['class' => 'custom-control-input','id' => 'editar_color_general']) }}
            {{ Form::label('editar_color_general','Cambiar colores pagina',['class' => 'custom-control-label']) }}
          </div>
      </div>


      <div class="col-md-3">
          <h5><i class="ft-grid"></i>&nbsp;&nbsp;Paginas principales</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_pagina_inicio',isset($usuario->permisos->editar_pagina_inicio) ? $usuario->permisos->editar_pagina_inicio:false,['class' => 'custom-control-input','id' => 'editar_pagina_inicio']) }}
            {{ Form::label('editar_pagina_inicio','Editar página inicio',['class' => 'custom-control-label']) }}
          </div>
           <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_empresa',isset($usuario->permisos->editar_empresa) ? $usuario->permisos->editar_empresa:false,['class' => 'custom-control-input','id' => 'editar_empresa']) }}
            {{ Form::label('editar_empresa','Editar empresa',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_soporte_tecnico',isset($usuario->permisos->editar_soporte_tecnico) ? $usuario->permisos->editar_soporte_tecnico:false,['class' => 'custom-control-input','id' => 'editar_soporte_tecnico']) }}
            {{ Form::label('editar_soporte_tecnico','Editar soporte técnico',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_bolsa_trabajo',isset($usuario->permisos->editar_bolsa_trabajo) ? $usuario->permisos->editar_bolsa_trabajo:false,['class' => 'custom-control-input','id' => 'editar_bolsa_trabajo']) }}
            {{ Form::label('editar_bolsa_trabajo','Editar bolsa trabajo',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_contacto',isset($usuario->permisos->editar_contacto) ? $usuario->permisos->editar_contacto:false,['class' => 'custom-control-input','id' => 'editar_contacto']) }}
            {{ Form::label('editar_contacto','Editar página contacto',['class' => 'custom-control-label']) }}
          </div>
      </div>

      

      <div class="col-md-3">
          <h5><i class="ft-package"></i>&nbsp;&nbsp;Productos</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_productos',isset($usuario->permisos->ver_productos) ? $usuario->permisos->ver_productos:false,['class' => 'custom-control-input','id' => 'ver_productos']) }}
            {{ Form::label('ver_productos','Ver productos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_productos',isset($usuario->permisos->agregar_productos) ? $usuario->permisos->agregar_productos:false,['class' => 'custom-control-input','id' => 'agregar_productos']) }}
            {{ Form::label('agregar_productos','Agregar productos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_productos',isset($usuario->permisos->editar_productos) ? $usuario->permisos->editar_productos:false,['class' => 'custom-control-input','id' => 'editar_productos']) }}
            {{ Form::label('editar_productos','Editar productos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_productos',isset($usuario->permisos->eliminar_productos) ? $usuario->permisos->eliminar_productos:false,['class' => 'custom-control-input','id' => 'eliminar_productos']) }}
            {{ Form::label('eliminar_productos','Eliminar productos',['class' => 'custom-control-label']) }}
          </div>
      </div>
      <div class="col-md-12"><hr></div>
      <div class="col-md-3">
          <h5><i class="ft-star"></i>&nbsp;&nbsp;Marcas</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_marcas',isset($usuario->permisos->ver_marcas) ? $usuario->permisos->ver_marcas:false,['class' => 'custom-control-input','id' => 'ver_marcas']) }}
            {{ Form::label('ver_marcas','Ver marcas',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_marcas',isset($usuario->permisos->agregar_marcas) ? $usuario->permisos->agregar_marcas:false,['class' => 'custom-control-input','id' => 'agregar_marcas']) }}
            {{ Form::label('agregar_marcas','Agregar marcas',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_marcas',isset($usuario->permisos->editar_marcas) ? $usuario->permisos->editar_marcas:false,['class' => 'custom-control-input','id' => 'editar_marcas']) }}
            {{ Form::label('editar_marcas','Editar marcas',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_marcas',isset($usuario->permisos->eliminar_marcas) ? $usuario->permisos->eliminar_marcas:false,['class' => 'custom-control-input','id' => 'eliminar_marcas']) }}
            {{ Form::label('eliminar_marcas','Eliminar marcas',['class' => 'custom-control-label']) }}
          </div>
      </div>

      <div class="col-md-3">
          <h5><i class="ft-map"></i>&nbsp;&nbsp;Boletines</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_boletines',isset($usuario->permisos->ver_boletines) ? $usuario->permisos->ver_boletines:false,['class' => 'custom-control-input','id' => 'ver_boletines']) }}
            {{ Form::label('ver_boletines','Ver boletines',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_boletines',isset($usuario->permisos->agregar_boletines) ? $usuario->permisos->agregar_boletines:false,['class' => 'custom-control-input','id' => 'agregar_boletines']) }}
            {{ Form::label('agregar_boletines','Agregar boletines',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_boletines',isset($usuario->permisos->editar_boletines) ? $usuario->permisos->editar_boletines:false,['class' => 'custom-control-input','id' => 'editar_boletines']) }}
            {{ Form::label('editar_boletines','Editar boletines',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_boletines',isset($usuario->permisos->eliminar_boletines) ? $usuario->permisos->eliminar_boletines:false,['class' => 'custom-control-input','id' => 'eliminar_boletines']) }}
            {{ Form::label('eliminar_boletines','Eliminar boletines',['class' => 'custom-control-label']) }}
          </div>
      </div>

      <div class="col-md-3">
          <h5><i class="ft-edit"></i>&nbsp;&nbsp;Publicaciones</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_publicaciones',isset($usuario->permisos->ver_publicaciones) ? $usuario->permisos->ver_publicaciones:false,['class' => 'custom-control-input','id' => 'ver_publicaciones']) }}
            {{ Form::label('ver_publicaciones','Ver publicaciones',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_publicaciones',isset($usuario->permisos->agregar_publicaciones) ? $usuario->permisos->agregar_publicaciones:false,['class' => 'custom-control-input','id' => 'agregar_publicaciones']) }}
            {{ Form::label('agregar_publicaciones','Agregar publicaciones',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_publicaciones',isset($usuario->permisos->editar_publicaciones) ? $usuario->permisos->editar_publicaciones:false,['class' => 'custom-control-input','id' => 'editar_publicaciones']) }}
            {{ Form::label('editar_publicaciones','Editar publicaciones',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_publicaciones',isset($usuario->permisos->eliminar_publicaciones) ? $usuario->permisos->eliminar_publicaciones:false,['class' => 'custom-control-input','id' => 'eliminar_publicaciones']) }}
            {{ Form::label('eliminar_publicaciones','Eliminar publicaciones',['class' => 'custom-control-label']) }}
          </div>
      </div>

      <div class="col-md-3">
          <h5><i class="ft-book"></i>&nbsp;&nbsp;Catálogos</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_catalogos',isset($usuario->permisos->ver_catalogos) ? $usuario->permisos->ver_catalogos:false,['class' => 'custom-control-input','id' => 'ver_catalogos']) }}
            {{ Form::label('ver_catalogos','Ver catálogos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','agregar_catalogos',isset($usuario->permisos->agregar_catalogos) ? $usuario->permisos->agregar_catalogos:false,['class' => 'custom-control-input','id' => 'agregar_catalogos']) }}
            {{ Form::label('agregar_catalogos','Agregar catálogos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','editar_catalogos',isset($usuario->permisos->editar_catalogos) ? $usuario->permisos->editar_catalogos:false,['class' => 'custom-control-input','id' => 'editar_catalogos']) }}
            {{ Form::label('editar_catalogos','Editar catálogos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','eliminar_catalogos',isset($usuario->permisos->eliminar_catalogos) ? $usuario->permisos->eliminar_catalogos:false,['class' => 'custom-control-input','id' => 'eliminar_catalogos']) }}
            {{ Form::label('eliminar_catalogos','Eliminar catálogos',['class' => 'custom-control-label']) }}
          </div>
      </div>
      <div class="col-md-12"><hr></div>
      <div class="col-md-3">
          <h5><i class="ft-user"></i>&nbsp;&nbsp;Usuarios registrados</h5>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_usuarios_registrados_nuevos',isset($usuario->permisos->ver_usuarios_registrados_nuevos) ? $usuario->permisos->ver_usuarios_registrados_nuevos:false,['class' => 'custom-control-input','id' => 'ver_usuarios_registrados_nuevos']) }}
            {{ Form::label('ver_usuarios_registrados_nuevos','Ver usuarios nuevos',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','aceptar_usuarios_registrados_nuevos',isset($usuario->permisos->aceptar_usuarios_registrados_nuevos) ? $usuario->permisos->aceptar_usuarios_registrados_nuevos:false,['class' => 'custom-control-input','id' => 'aceptar_usuarios_registrados_nuevos']) }}
            {{ Form::label('aceptar_usuarios_registrados_nuevos','Aceptar usuarios registrados',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_usuarios_registrados_aceptados',isset($usuario->permisos->ver_usuarios_registrados_aceptados) ? $usuario->permisos->ver_usuarios_registrados_aceptados:false,['class' => 'custom-control-input','id' => 'ver_usuarios_registrados_aceptados']) }}
            {{ Form::label('ver_usuarios_registrados_aceptados','Ver usuarios aceptados',['class' => 'custom-control-label']) }}
          </div>
          <div class="custom-control custom-checkbox">
            {{ Form::checkbox('permisos[]','ver_usuarios_registrados_rechazados',isset($usuario->permisos->ver_usuarios_registrados_rechazados) ? $usuario->permisos->ver_usuarios_registrados_rechazados:false,['class' => 'custom-control-input','id' => 'ver_usuarios_registrados_rechazados']) }}
            {{ Form::label('ver_usuarios_registrados_rechazados','Ver usuarios rechazados',['class' => 'custom-control-label']) }}
          </div>
      </div>

      
    </div>
  </div>