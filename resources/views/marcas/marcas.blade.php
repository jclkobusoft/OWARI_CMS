@extends('plantilla.base')

@section('js')
	{{ Html::script('cms/vendors/js/extensions/dropzone.min.js') }}
  <script type="text/javascript">
    var myDropzone;
    Dropzone.options.dpzMultipleFiles = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 0.5, // MB
        clickable: true,
        addRemoveLinks:true,
        removedfile: function(file) {
            var name = file.name; 
             
            $.ajax({
             type: 'POST',
             url: '{{ route('marcas.eliminar') }}',
             data: {name: name, _token: '{{ csrf_token() }}' },
             sucess: function(data){
              console.log('success: ' + data);
             }
            });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
         },
        init: function(){
          this.on("complete", function(file) {
                $(".dz-remove").html("Eliminar marca");
            });

          myDropzone = this;

            $.get('{{ route('marcas.subidas') }}', function(data) {
              $.each(data, function(key,value) {
                var mockFile = { name: value.name, size: value.size, url: value.url };
                  myDropzone.files.push(mockFile);   
                  myDropzone.emit("addedfile", mockFile);
                  myDropzone.emit("thumbnail", mockFile, mockFile.url);
                  myDropzone.options.thumbnail.call(myDropzone, mockFile,value.url);
                  myDropzone.emit("success", mockFile);
                  myDropzone.emit("complete", mockFile);
                  

              });
            });
        }
    }
  </script>
  <script type="text/javascript">
    
  </script>
@endsection

@section('css')

  {{ Html::style('cms/vendors/css/file-uploaders/dropzone.min.css') }}
  {{ Html::style('cms/css/plugins/file-uploaders/dropzone.css') }}
  <style type="text/css">
    .dz-image img{width: 100%;height: 100%;}
  </style>
	
@endsection

@section('contenido')
	 <div class="card">
      <div class="card-header">
        <h4 class="card-title">Marcas registradas</h4>
        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
      </div>
      <div class="card-content collapse show">
        <div class="card-body">
          <p class="card-text">Arrastra o elimina imágenes de las marcas para visualizar en la pagina web. Las marcas se guardan automaticamente.</p>
          {{ Form::open(['route' => 'marcas.agregar','class' => 'dropzone dropzone-area', 'method' => 'post','files' => 'true', 'id' => 'dpz-multiple-files']) }}
            <div class="dz-message">Arrastra o selecciona las marcas para registrarlas</div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
@endsection