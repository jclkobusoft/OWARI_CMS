
    <h4 class="form-section"><i class="fa fa-file"></i> Datos generales</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('codigo_nikko','Codigo Owari',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('codigo_nikko',null,['class' => 'form-control border-primary','placeholder' => 'Codigo','required' => 'required']) }}
            {{ Form::hidden('estampa',$estampa) }}
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('descripcion_1','Descripcion 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('descripcion_1',null,['class' => 'form-control border-primary','placeholder' => 'Descripcion','required' => 'required']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('descripcion_2','Descripcion 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('descripcion_2',null,['class' => 'form-control border-primary','placeholder' => 'Descripcion']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('descripcion_3','Descripcion 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('descripcion_3',null,['class' => 'form-control border-primary','placeholder' => 'Descripcion']) }}
          </div>
        </div>

      </div>
    </div>

    <h4 class="form-section"><i class="ft-search"></i> Datos de busqueda</h4>
    <div class="row">
      <div class="col-md-6">

        <div class="form-group row">
          {{ Form::label('marca_comercial','Marca comercial',['class' => 'col-md-3 label-control','required' => 'required']) }}
          <div class="col-md-9">
            {{ Form::text('marca_comercial',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('grupo','Grupo',['class' => 'col-md-3 label-control','required' => 'required']) }}
          <div class="col-md-9">
            {{ Form::text('grupo',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('subgrupo','Subgrupo',['class' => 'col-md-3 label-control','required' => 'required']) }}
          <div class="col-md-9">
            {{ Form::text('subgrupo',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('caracteristicas_1','Caracteristicas 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('caracteristicas_1',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('caracteristicas_2','Caracteristicas 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('caracteristicas_2',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('caracteristicas_3','Caracteristicas 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('caracteristicas_3',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('caracteristicas_4','Caracteristicas 4',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('caracteristicas_4',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        

        


      </div>
      <div class="col-md-6">
            <div class="form-group row">
          {{ Form::label('equivalencia_1','Equivalencia 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('equivalencia_1',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('equivalencia_2','Equivalencia 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('equivalencia_2',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('equivalencia_3','Equivalencia 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('equivalencia_3',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('equivalencia_4','Equivalencia 4',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('equivalencia_4',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('equivalencia_5','Equivalencia 5',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('equivalencia_5',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
      </div>
    </div>


    <h4 class="form-section"><i class="ft-at-sign"></i> Datos de pagina</h4>
    <div class="row">
      <div class="col-md-6">


        <div class="form-group row">
          {{ Form::label('nuevo','¿Producto nuevo?',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('nuevo',[ '0' => 'No','1' => 'Si'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('vendido','¿Mas vendido?',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('vendido',[ '0' => 'No','1' => 'Si'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

      </div>
      <div class="col-md-6">


        <div class="form-group row">
          {{ Form::label('promocion','¿En promocion?',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('promocion',[ '0' => 'No','1' => 'Si'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>


        <div class="form-group row">
          {{ Form::label('precio_normal','Precio normal',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('precio_normal',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
        <div class="form-group row">
          {{ Form::label('precio_final','Precio final',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('precio_final',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>



      </div>
    </div>

    <h4 class="form-section"><i class="ft-at-sign"></i> Campos Extra OWARI</h4>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group row">
          {{ Form::label('extra','Extra',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::textarea('extra',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('pagina_principal','¿Pagina principal?',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::select('pagina_principal',[ '0' => 'No','1' => 'Si'],null,['class' => 'form-control border-primary']) }}
          </div>
        </div>


        <div class="form-group row">
          {{ Form::label('pruebas_ilc','Pruebas ILC',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::textarea('pruebas_ilc',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('existencias','Existencias',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('existencias',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('minimo_compra_oferta','Minimo de compra para promocion',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('minimo_compra_oferta',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

       <div class="form-group row">
          {{ Form::label('fecha_promocion_inicio','Inicio Promoción',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('fecha_promocion_inicio',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('fecha_promocion_final','Final Promoción',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('fecha_promocion_final',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

           <div class="form-group row">
          {{ Form::label('codigo_barras','Codigo de barras',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('codigo_barras',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

          <div class="form-group row">
          {{ Form::label('proveedor','Proveedor',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('proveedor',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

      </div>
      <div class="col-md-6">

 <div class="form-group row">
          {{ Form::label('extra_clave_1','Clave extra 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_clave_1',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
         <div class="form-group row">
          {{ Form::label('extra_marca_1','Extra marca 1',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_marca_1',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
         <div class="form-group row">
          {{ Form::label('extra_clave_2','Clave extra 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_clave_2',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
         <div class="form-group row">
          {{ Form::label('extra_marca_2','Extra marca 2',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_marca_2',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
         <div class="form-group row">
          {{ Form::label('extra_clave_3','Clave extra 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_clave_3',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>
         <div class="form-group row">
          {{ Form::label('extra_marca_3','Extra marca 3',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('extra_marca_3',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        

        <div class="form-group row">
          {{ Form::label('especial','Especial',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('especial',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

         <div class="form-group row">
          {{ Form::label('disponibilidad','Disponibilidad',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('disponibilidad',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

      

        <div class="form-group row">
          {{ Form::label('lo_mas_nuevo','Lo mas nuevo',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('lo_mas_nuevo',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('clave_producto_proveedor','Clave producto proveedor',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('clave_producto_proveedor',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('linea','Linea',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('linea',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('utilidad','Utilidad',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('utilidad',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('subfijo','subfijo',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('subfijo',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('multiplo_compra','Multiplo de compra',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('multiplo_compra',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>

        <div class="form-group row">
          {{ Form::label('ventas','Ventas',['class' => 'col-md-3 label-control']) }}
          <div class="col-md-9">
            {{ Form::text('ventas',null,['class' => 'form-control border-primary']) }}
          </div>
        </div>






      </div>
    </div>
