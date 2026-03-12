@extends('web.plantilla.base')
@section('contenido')

        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg1" style="background-image: url('{{ asset('/upload/gral/bannerboletines.jpg') }}');">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Boletines</h2>
                            <ul>
                                <li>
                                    <a href="{{ route('pagina.index') }}">Inicio</a>
                                </li>
                                <li>Boletines</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Team Area -->
        <?php

                $filtros = [];
                foreach ($boletines as $boletin) {
                    // code...
                    $etiquetas = explode(",", $boletin->tags);
                    foreach ($etiquetas as $key => $value) {
                        // code...
                        if(!array_search(trim($value), $filtros))
                            array_push($filtros, trim($value));

                    }
                }
                                    
        ?>
        <section class="team-area products-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-12 tab products-list-tab">
                        <ul class="tabas">
                            <li>
                                <a class="activado btn_filtro" href="javascript:filterSelection('all')">Ver todos</a>
                            </li>
                            @foreach($filtros as $key => $value)
                            <li>
                                <a class="btn_filtro" href="javascript:filterSelection('{{ str_replace(" ","_",$value) }}')">{{ $value }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    
                    @foreach($boletines as $boletin)
                    <?php

                        $tags = "";
                        foreach((explode(',',$boletin->tags)) as $key => $value) {
                            // code...
                            $tags.=" ".str_replace(" ","_",trim($value));
                        }
                    ?>
                    <div class="col-lg-4 col-sm-6 column {{ $tags }}">
                        <div class="single-team">
                            <a href="{{ $boletin->url }}" target="_blank">
                                <div class="team-image">
                                    <img src="{{ asset('/upload/boletines/portadas/'.$boletin->portada) }}" alt="image">
                                </div>

                                <div class="team-content">
                                    <h3>{{ $boletin->nombre }}</h3>
                                    <span>Creado: {{ \Carbon::createFromFormat('Y-m-d H:i:s',$boletin->created_at)->format('d/m/Y') }}</span>
                                </div>
                            </a>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>
        <!-- End Team Area -->
@stop

@section('js')
<script>
    filterSelection("all") // Execute the function and show all columns
    function filterSelection(c) {
      var x, i;
      x = document.getElementsByClassName("column");
      if (c == "all") c = "";
      // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
      for (i = 0; i < x.length; i++) {
        w3RemoveClass(x[i], "show");
        if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
      }
    }

    // Show filtered elements
    function w3AddClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        if (arr1.indexOf(arr2[i]) == -1) {
          element.className += " " + arr2[i];
        }
      }
    }

    // Hide elements that are not selected
    function w3RemoveClass(element, name) {
      var i, arr1, arr2;
      arr1 = element.className.split(" ");
      arr2 = name.split(" ");
      for (i = 0; i < arr2.length; i++) {
        while (arr1.indexOf(arr2[i]) > -1) {
          arr1.splice(arr1.indexOf(arr2[i]), 1);
        }
      }
      element.className = arr1.join(" ");
    }

    $('.btn_filtro').click(function(){
        $('.btn_filtro').removeClass('activado');
        $(this).addClass('activado');
    });
    
</script>
@stop

@section('css')
    <style>
        .column.show {
          display: block;
        }
        .column {
          display: none;
        }

        .products-list-tab .tabas li:last-child {
            margin-right: 0;
        }

        .products-list-tab .tabas {
            text-align: center;
            padding-left: 0;
            list-style-type: none;
            margin-bottom: 30px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px)
        .products-list-tab .tabas li a {
            font-size: 15px;
        }

        .products-list-tab .tabas li a {
            font-size: 20px;
            color: #09101f;
            font-weight: 500;
            padding-bottom: 5px;
            text-transform: uppercase;
            
        }
        

        .products-list-tab .tabas li.current a {
            color: #d31531;
            border-bottom: 1px solid #d31531;
        }

        .products-list-tab .tabas li {
            display: inline-block;
            margin-right: 35px;
        }
        .btn_filtro.activado{
                color: #d31531 !important;
                border-bottom: 1px solid #d31531;
        }

    </style>

@stop