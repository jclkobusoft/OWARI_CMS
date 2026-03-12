@extends('pagina.base')



@section('contenido')
	
<!--// SubHeader \\-->
    <div class="container" >
        <div class="row">
            <div class="col-md-12" style="padding: 20px 0px 0px 0px;">
                <h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;">Terminos de uso</h1>
            </div>
        </div>
    </div>
<!--// SubHeader \\-->

<!--// Main Content \\-->
<div class="automechanic-content-padding">

   <!--// Main Section \\-->
   <div class="automechanic-main-section">
   		<div class="container">
   			<div class="row el_contenido">
   				
   				{!! $empresa->terminos_uso !!}
                
   			</div>
   		</div>
   </div>
   <!--// Main Section \\-->


</div>
<!--// Main Content \\-->

@endsection