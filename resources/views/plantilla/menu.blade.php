<ul class="nav navbar-nav" id="main-menu-navigation" data-menu="menu-navigation">
    
    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="nav-link" href="{{ route('inicio') }}"><i class="ft-home"></i>
        <span>Inicio</span>
      </a>
    </li>
    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-cpu"></i>
        <span>Sistema</span>
      </a>
      <ul class="dropdown-menu">
        @can('permiso','ver_usuarios')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('usuarios.index') }}"><i class="ft-user"></i>
              <span>Usuarios</span>
            </a>
          </li>
        @endcan
        @can('permiso','ver_log')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('movimientos_sistema.ver_log') }}"><i class="ft-alert-circle"></i>
              <span>Log</span>
            </a>
          </li>
        @endcan
      </ul>
    </li>




    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-check-square"></i>
        <span>Datos generales</span>
      </a>
      <ul class="dropdown-menu">
       
        @can('permiso','ver_informacion_general')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.informacion_general') }}"><i class="ft-check-circle"></i>
            <span>Informacion general</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_aviso_privacidad')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.aviso_privacidad') }}"><i class="ft-eye"></i>
            <span>Aviso privacidad</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_terminos_uso')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.terminos_uso') }}"><i class="ft-lock"></i>
            <span>Terminos uso</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_pop_up')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.pop_up') }}"><i class="ft-copy"></i>
            <span>Ventana emergente</span>
          </a>
        </li>
        @endcan
        {{--
        @can('permiso','ver_promociones')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.promociones') }}"><i class="ft-shopping-cart"></i>
            <span>Promociones</span>
          </a>
        </li>
        @endcan
         @can('permiso','ver_notinikko')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.notinikko') }}"><i class="ft-tv"></i>
            <span>Notinikko</span>
          </a>
        </li>
        @endcan
        --}}
      </ul>
    </li>


    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-layers"></i>
        <span>Paginas principales</span>
      </a>
      <ul class="dropdown-menu">
         @can('permiso','editar_banner_principal')
         <li class="dropdown">
            <a class="dropdown-item" href="{{ route('banner_principal.index') }}"><i class="ft-image"></i>
            <span>Banner principal</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_pagina_inicio')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('paginas.inicio') }}"><i class="ft-home"></i>
            <span>Inicio</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_empresa')
           <li class="dropdown">
            <a class="dropdown-item" href="{{ route('empresa.ver') }}"><i class="ft-grid"></i>
              <span>Empresa - Nosotros</span>
            </a>
          </li>
        @endcan
        @can('permiso','ver_marcas')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('marcas.index') }}"><i class="ft-star"></i>
              <span>Marcas</span>
            </a>
          </li>
        @endcan
        {{--
        @can('permiso','editar_soporte_tecnico')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('paginas.soporte_tecnico') }}"><i class="ft-headphones"></i>
            <span>Soporte tecnico</span>
          </a>
        </li>
        @endcan
        @can('permiso','editar_bolsa_trabajo')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('paginas.bolsa_trabajo') }}"><i class="ft-users"></i>
            <span>Bolsa de trabajo</span>
          </a>
        </li>
        @endcan
       
         <li class="dropdown">
            <a class="dropdown-item" href="{{ route('informate.index') }}"><i class="ft-info"></i>
            <span>Informate</span>
          </a>
        </li>
        --}}

         
        @can('permiso','editar_contacto')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('paginas.contacto') }}"><i class="ft-phone"></i>
            <span>Contacto</span>
          </a>
        </li>
        @endcan
      </ul>
    </li>


    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-search"></i>
        <span>Buscador</span>
      </a>
      <ul class="dropdown-menu">
        @can('permiso','ver_productos')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('productos.index') }}"><i class="ft-package"></i>
              <span>Productos</span>
            </a>
          </li>
        @endcan
      </ul>
    </li>
    {{--  
    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-edit-3"></i>
        <span>Usuarios registrados</span>
      </a>
      <ul class="dropdown-menu">
          @can('permiso','ver_usuarios_registrados_nuevos')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('usuarios_registrados.nuevos') }}"><i class="ft-user-plus"></i>
              <span>Nuevos registros</span>
            </a>
          </li>
          @endcan
          @can('permiso','ver_usuarios_registrados_aceptados')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('usuarios_registrados.aceptados') }}"><i class="ft-user-check"></i>
              <span>Registros aprobados</span>
            </a>
          </li>
          @endcan
          @can('permiso','ver_usuarios_registrados_rechazados')
          <li class="dropdown">
            <a class="dropdown-item" href="{{ route('usuarios_registrados.rechazados') }}"><i class="ft-user-x"></i>
              <span>Registros rechazados</span>
            </a>
          </li>
          @endcan
      </ul>
    </li>
    --}}

    <li class="dropdown nav-item" data-menu="dropdown">
      <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown">
        <i class="ft-folder"></i>
        <span>Documentacion</span>
      </a>
      <ul class="dropdown-menu">
        @can('permiso','ver_boletines')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('boletines.index') }}"><i class="ft-map"></i>
            <span>Boletines</span>
          </a>
        </li>
        @endcan
        {{-- 
        @can('permiso','ver_publicaciones')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('publicaciones.index') }}"><i class="ft-edit"></i>
            <span>Publicaciones</span>
          </a>
        </li>
        @endcan
        --}}
        @can('permiso','ver_catalogos')
        <li class="dropdown">
            <a class="dropdown-item" href="{{ route('catalogos.index') }}"><i class="ft-book"></i>
            <span>Catalogos</span>
          </a>
        </li>
        @endcan

        
      </ul>
    </li>


    
   
    
    
   
  </ul>