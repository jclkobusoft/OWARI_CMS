@extends('pagina.base')



@section('contenido')
  
<!--// SubHeader \\-->
    <div class="container" >
        <div class="row">
            <div class="col-md-12 text-center" style="padding: 20px 0px 0px 0px;">
                <h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;">Buzon de comentarios y sugerencias</h1>
            </div>
        </div>
    </div>
<!--// SubHeader \\-->

<!--// Main Content \\-->
<div class="automechanic-content-padding">

   <!--// Main Section \\-->
   <div class="automechanic-main-section">
      <div class="container">
        <div class="row el_contenido" style="padding-bottom: 20px;">
          
         <?php
            $bodytag = str_replace("[boton_formulario]", "<a href='#' class='btn-nikko' data-toggle='modal' data-target='#modal_contacto' style='font-size:25px;color:#00587c;border: 1px solid #00587c; padding:10px;'>TE ESCUCHAMOS <i class='automechanic-icon automechanic-arrows22'></i></a>", $empresa->soporte_buzon );
          ?>
          {!! $bodytag !!}

                
        </div>
      </div>
   </div>
   <!--// Main Section \\-->


</div>
<!--// Main Content \\-->

@endsection