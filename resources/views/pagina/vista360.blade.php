<!-- saved from url=(0021)http://www.orbitvu.pl -->
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>{{ $producto->codigo_nikko }}</title>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <style type="text/css">
            body {
                background-color: #ffffff;
                margin: 0px;
            }
        </style>
    </head>
    <body style="height: 800px;">
        <div id="vista"></div>

        <script type="text/javascript" src="{{ asset('orbitvu12/swfobject.js') }}"></script>
        <script type="text/javascript" src="{{ asset('orbitvu12/orbitvu.js') }}"></script>
        <script type="text/javascript">
            var force_html5 = document.location.search.indexOf('force_html5=yes') == -1 ? 'no' : 'yes';
            inject_orbitvu('vista',  // id of the viewer container element which is defined above
                           '{{ asset('orbitvu12/orbitvuer12.swf') }}',  // location of viewer swf file
                           '{{ asset('orbitvu12/expressInstall.swf') }}',  // location of flash installer file
                           {ovus_folder: "{{ asset('/360/'.$producto->codigo_nikko.'_360') }}/",  // location of presentation files (can be absolute or relative url)
                            content2: "yes",
                            width: "800",
                            height: "600",
                            force_html5: force_html5
                           });
        </script>
    </body>
</html>