@extends('web.plantilla.base')
@section('contenido')

	{{ Form::open(['route' => 'pagina.generar_catalogo','method' => 'post','target' => 'blank']) }}
  <style>
    .form-group{
      margin-top:30px;
    }
    label{
      font-weight:bold;
      font-size:18px;
      display:block;
    }

  </style>
<section>
  <div class="container" style="margin-top: 40px; margin-bottom:40px;">
	<div class="row">
		<div class="col-md-6 grid-margin stretch-card">
          <div class="">
            <div class="">
              <h4 class="">Imprimir catalogo</h4>
              <p class="">
                Selecciona los filtros que deseas aplicar para el archivo de impresion del catalogo.<br><br>
                Recuerda que el catalogo con todos los productos podria demorar aproximadamente 20min, utiliza los filtros para que tu pedido sea mas especifico y lo obtengas mas rapido.<br><br>
                Para seleccionar mas de un grupo, linea o armadora, solo deja presionada la tecla CTRL y da click a las opciones que necesites.<br><br>
                <img src="{{ asset('images/imagen.jpeg')}}" style="width:200px;"><br>Tu catalogo estara listo cuando el circulo de la pestaña del catalogo deje de girar y desaparezca.<br><br>
                Cuando obtengas tu catalogo, imprimelo y guardalo como un PDF.<br><br>
              </p>
            </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />



            <div class="">
               <div class="form-group">
                {{ Form::radio('orden','codigo_nikko',true) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Ordenar alfabeticamente por clave.</label><br>
                {{ Form::radio('orden','descripcion_1',false) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Ordenar alfabeticamente por descripción.</label>
              </div>
               <div class="form-group">
                {{ Form::label('numero_filas','No. filas por hojas:') }}
                <input class="form-control" placeholder="Filas" aria-label="Filas" name="numero_filas" type="text" id="numero_filas" value="5" style="width:100px;">
              </div>
              <div class="form-group">
                {{ Form::checkbox('precio',false,['class' => 'form-control','style' => 'display:inline-block']) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px;display: inline;">Ver precio en el catalogo</label>.
              </div>




            </div>
          </div>
        </div>


        <div class="col-md-6">
          <div class="">
            <div class="">
               <div class="form-group">
                {{ Form::label('descripcion','Descripcion:') }}
                {{ Form::text('descripcion',null,['class' => 'form-control','placeholder' => 'Descripcion', 'aria-label' => 'Descripcion']) }}
              </div>
            <div class="form-group">
                {{ Form::label('linea','Grupo') }}
                {{ Form::checkbox('todos_grupos','todos_grupos',false) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Todos los grupos</label><br>
                {{ Form::select('linea[]',$lineas,'todos',["class" => "form-control chosen-select select-grupos",'multiple' => 'multiple',"data-placeholder"=>"o selecciona varios grupos"]) }}
              </div>

              <div class="form-group">
                {{ Form::label('subgrupo','Subgrupo') }}
                {{ Form::checkbox('todos_subgrupos','todos_subgrupos',false) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Todos los subgrupos</label><br>
                {{ Form::select('subgrupo[]',$subgrupos,'todos',["class" => "form-control chosen-select select-subgrupos",'multiple' => 'multiple',"data-placeholder"=>"o selecciona varios subgrupos"]) }}
              </div>


              <div class="form-group">
                {{ Form::label('marca','Marca') }}
                {{ Form::checkbox('todas_marcas','todas_marcas',false) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Todas las marcas</label><br>
                {{ Form::select('marca[]',$marcas,'todos',["class" => "form-control chosen-select select-marcas",'multiple' => 'multiple',"data-placeholder"=>"o selecciona varias marcas"]) }}

              </div>

              <div class="form-group">
                {{ Form::label('modelo','Armadora') }}
                {{ Form::checkbox('todas_armadoras','todas_armadoras',false) }}&nbsp;&nbsp;&nbsp;<label style="margin-top:6px; display: inline-block;">Todas las armadoras</label><br>
                {{ Form::select('modelo[]',$modelos,'todos',["class" => "form-control chosen-select select-armadoras",'multiple' => 'multiple',"data-placeholder"=>"o selecciona varias armadoras"]) }}
              </div>

              <div class="form-group">
              <button type="submit" class="btn btn-primary btn-xlarge" style="background-color:#d31531; display:block;">Generar mi catalogo personalizado</button>
              </div>
            </div>
          </div>
        </div>
	</div>
</div>
</section>
{{ Form::close() }}
@endsection
@section('js')
<script>
  $('.chosen-select').chosen({});

  $('input[name="todos_grupos"]').click(function() {
    if ($(this).is(':checked')){

        $('.select-grupos option').prop('selected', true);
        $('.select-grupos').trigger('change');
      }
    else{
        $('.select-grupos option').prop('selected', false);
        $('.select-grupos').trigger('change');
      }


      $('.chosen-select').trigger("chosen:updated");
});
  $('input[name="todos_subgrupos"]').click(function() {
    if ($(this).is(':checked'))
        $('.select-subgrupos option').prop('selected', true);
    else
      $('.select-subgrupos option').prop('selected', false);

      $('.chosen-select').trigger("chosen:updated");
});

$('input[name="todas_marcas"]').click(function() {
    if ($(this).is(':checked'))
        $('.select-marcas option').prop('selected', true);
    else
      $('.select-marcas option').prop('selected', false);

      $('.chosen-select').trigger("chosen:updated");
});

$('input[name="todas_armadoras"]').click(function() {
    if ($(this).is(':checked'))
        $('.select-armadoras option').prop('selected', true);
    else
      $('.select-armadoras option').prop('selected', false);

      $('.chosen-select').trigger("chosen:updated");
});

$('.select-grupos').change(function(event) {
  /* Act on the event */
  console.log($(this).val());
  $.get('https://owari.com.mx/api/subgrupos', {grupos : $('.select-grupos').val()} ,function(data) {
    /*optional stuff to do after success */
     data = $.parseJSON(data);
     $(".select-subgrupos").html("");
     $.each(data, function(index, val) {
        /* iterate through array or object */
        if(val.subgrupo != null){
          $(".select-subgrupos").append('<option valeu="'+val.subgrupo+'">'+val.subgrupo+'</option>');
        }
     });
     $('.select-subgrupos').trigger("chosen:updated");
  });
});

</script>
@endsection
@section('css')
<style>

</style>
@endsection