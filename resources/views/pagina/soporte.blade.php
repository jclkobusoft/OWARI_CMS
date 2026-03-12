@extends('pagina.base')



@section('contenido')
	<div class="container" >
        <div class="row">
            <div class="col-md-12 text-center" style="padding: 20px 0px 0px 0px;">
                <h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;color:#{{  $empresa->color_pagina }}">SOPORTE TÉCNICO</h1>
            </div>
        </div>
    </div>


<!--// Main Content \\-->
  <div class="automechanic-main-content" style="padding: 20px 0px 45px 0px;">
     <!--// marcas Section \\-->
     <div class="automechanic-main-section">
        <div class="container">
          <div class="row">
            <div class="col-md-12 sub-marca">
              <div class="col-md-4 text-center">
              	<h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;color:#{{  $empresa->color_pagina }}">BOLETINES TÉCNICOS</h1>
                <a href="{{ route('pagina.boletin_tecnico') }}"><img src="{{ asset('pagina/ayuda/boletines-tecnicos.png') }}" class="custom-color-all" style="background-color: #{{ $empresa->color_pagina }} !important;"></a>
              </div>
              <div class="col-md-4 text-center">
              	<h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;color:#{{  $empresa->color_pagina }}">VIDEOS</h1>
                <a href="{{ route('pagina.videos') }}"><img src="{{ asset('pagina/ayuda/videos.png') }}" class="custom-color-all" style="background-color: #{{ $empresa->color_pagina }} !important;"></a>
              </div>
              <div class="col-md-4 text-center">
              	<h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase;color:#{{  $empresa->color_pagina }}">CONTACTO</h1>
                <a href="{{ route('pagina.buzon') }}"><img src="{{ asset('pagina/ayuda/contacto.png') }}" class="custom-color-all" style="background-color: #{{ $empresa->color_pagina }} !important;"></a>
              </div>
              <div class="col-md-10 col-md-offset-2">
              	<div class="col-md-6 need-help text-right"><a href="javascript:$zopim.livechat.window.show();"><h1 style="font-weight: bold; font-size:30px;color:#00587c; text-transform: uppercase; color:#{{  $empresa->color_pagina }}">¿necesitas ayuda?</h1></a></div>
              	<div class="col-md-6 text-left"><a href="javascript:$zopim.livechat.window.show();"><img src="{{ asset('pagina/ayuda/ayuda.png') }}" class="custom-color-all" style="margin-bottom: 32px !important; background-color: #{{ $empresa->color_pagina }} !important; "></a></div>
              </div>
            </div>
          </div>
        </div>
     </div>
     <!--// marcas Section \\-->
  </div>
  <!--// Main Content \\-->

@endsection