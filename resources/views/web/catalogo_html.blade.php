<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@media print {
			@page {
			    size: 220mm 280mm; /* landscape */
			    /* you can also specify margins here: */
			    margin: 15mm;
			  }
			footer { position: fixed;
				left: 0mm;
				bottom: 0mm;
				right: 0mm;
				height: 8mm;
				width: 100%;
			}
			header{
				position: fixed;
				left: 0px;
				top: 0mm;
				right:0px;
				height: 8mm;
				text-align: center;
			}
			table{
				width:100%;
				height: 100%;
			}

		}
		body{
			 font-size: 12px;
			 font-family: Courier;
		}
	</style>
</head>
<body style="max-width: 220mm">
		<?php
$contador = 1;
$tabla = 1;
$empezo = 0;
$no_productos = count($productos);
$j = 0;
$pagina = $empezar_pagina;
$total_paginas = ceil($no_productos / 30);
$anterior = "";
?>
		@foreach ($productos as $producto)
				@if($anterior != $producto->codigo_nikko)
					<?php $anterior = $producto->codigo_nikko;?>
					@if($tabla == 1 && $empezo == 0)
		             	<table width="100%" height="224mm">
		             	<?php
$empezo = 1;
?>
		            @endif

		            <?php
$archivo = "";
$directory = storage_path() . '/app/public/productos/' . $producto->codigo_nikko;
if (file_exists($directory)) {
	$files = \Storage::allFiles('public/productos/' . $producto->codigo_nikko . "/");
} else {
	$files = [];
}

if (count($files) > 0) {
	$base64 = base64_encode(file_get_contents($directory . "/" . basename($files[0], PHP_EOL)));
	$extension = pathinfo($directory . "/" . $files[0], PATHINFO_EXTENSION);
	$archivo = "data:image/" . $extension . ";base64," . $base64;
}

?>
		            @if($archivo != "")

		            	@if($contador == 1)
		             		<tr>
		            	@endif
		            	<td align="center"><div style="position:relative;">@if($producto->nuevo)<img src="{{ asset('images/nuevo.png') }}" style="height:5mm;width: 15mm;position: absolute;top:0px; left:0px;">@endif<img src="{{ $archivo }}" style="height:15mm;max-width: 40mm;"></div><p style="text-align: left;"><b>{{ $producto->codigo_nikko }}</b><br>@if($producto->extra !=""){{ substr($producto->extra,0,50) }} @else {{ substr($producto->descripcion_1,0,50) }} @endif @if(isset($producto->precio))<br><b>$&nbsp;{{ number_format($producto->precio,2,'.',',') }}</b>@endif
		            	@if($producto->marca_comercial !="" && $producto->marca_comercial != NULL)<br><b>Marca:</b>{{ $producto->marca_comercial }}@endif
		            	@if($producto->armadora !="" && $producto->armadora != NULL)<br><b>Armadora:</b>{{ $producto->armadora }}@endif
		            	@if($producto->grupo !="" && $producto->grupo != NULL)<br><b>Grupo:</b>{{ $producto->grupo }}@endif
		            	</p></td>
		            	<?php
$contador++;
$j++;
?>
		            	@if($contador > 5 || $no_productos == $j)
		            		</tr>
		            		<?php
$contador = 1;
$tabla++;
?>
		           		@endif
		            @endif


		           	@if($tabla > $numero_filas || $no_productos == $j)
		            		</table>
		            		<div style="page-break-after: always;width:100%;text-align: right;"><br>Pagina {{ $pagina }} </div>
		            		<?php
$tabla = 1;
$empezo = 0;
$pagina++;
?>
		           	@endif
				@endif
		@endforeach
	@if(isset($opciones['mostrar_pie']))
	<footer>
			<div style="width:50%; text-align:right; float:left;"><img src="{{ asset('images/logo.png') }}"></div>
			<div style="width:50%; text-align:left; float:left;"><p style="margin-top: -25px;">Owari Autopartes.<br>Tel. (55) 2233 0960 Cel. (55) 3573 3553<br>E-mail: contacto@owari.com.mx<br>www.owari.com.mx</p></div>
	</footer>
	@endif
</body>
</html>