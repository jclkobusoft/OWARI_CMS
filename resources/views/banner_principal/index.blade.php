@extends('plantilla.base')

@section('js')
  {{ Html::script('cms/vendors/js/tables/datatable/datatables.min.js') }}
  {{ Html::script('cms/vendors/js/tables/datatable/dataTables.buttons.min.js') }}
  {{ Html::script('cms/vendors/js/tables/datatable/buttons.bootstrap4.min.js') }}
  {{ Html::script('cms/vendors/js/tables/jszip.min.js') }}
  {{ Html::script('cms/vendors/js/tables/pdfmake.min.js') }}
  {{ Html::script('cms/vendors/js/tables/vfs_fonts.js') }}
  {{ Html::script('cms/vendors/js/tables/buttons.html5.min.js') }}
  <script type="text/javascript">
    $('#danger').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var id = button.data('id')
        fila = button.parents('tr');
        var form = $("#form-delete");
        url = form.attr('action').replace(":IDENTIFICADOR",id);

        if(button.data('funcion') == 'eliminar'){
            $('#modal-danger-titulo').html(' <h4 class="modal-title" id="modal-danger-titulo">Alerta</h4>');
            $('#modal-danger-cuerpo').html('<p>¿Estas seguro que deseas eliminar este registro?</p>');
            $('#modal-danger-botones').html('<button class="btn grey btn-outline-secondary" data-dismiss="modal">Cancelar</button><button class="btn btn-outline-danger eliminar_registro">Aceptar</button>');
        }

        
    });



    $('body').on('click', '.eliminar_registro', function () {

        var form = $("#form-delete");
        var data = form.serialize();
        $.post(url,data, function(respuesta){
            
            if(respuesta.code){
                fila.fadeOut();
                $('#modal-danger-titulo').html('<h4 class="modal-title" id="modal-danger-titulo">Confirmacion</h4>');
            }
            else
                $('#modal-danger-titulo').html('<h4 class="modal-title" id="modal-danger-titulo">Precaucion</h4>');
            $('#modal-danger-cuerpo').html('<p>'+ respuesta.message +'</p>');
            $('#modal-danger-botones').html('<button class="btn" data-dismiss="modal">Cerrar</button>');

        }).fail(function(){

            fila.fadeIn();
            $('#modal-danger-titulo').html('<h4 class="modal-title" id="modal-danger-titulo">Error</h4>');
            $('#modal-danger-cuerpo').html('<p>Ocurrio un error y la operación no pudo completarse. Intentalo mas tarde</p>');
            $('#modal-danger-botones').html('<button class="btn" data-dismiss="modal">Cerrar</button>');

        });

    });


    



    var  datatable = $('.scroll-horizontal').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                text: '<i class="fa fa-plus"></i>&nbsp;&nbsp;Agregar',
                className: 'btn mr-1 mb-1 btn-primary btn-sm',
                action: function ( e, dt, button, config ) {
                  window.location = '{{ route('banner_principal.create') }}';
                }   
            },
            {
                extend: 'excelHtml5',
                text: '<i class="fa fa-file-excel-o"></i>&nbsp;&nbsp;Descargar excel',
                className: 'btn mr-1 mb-1 btn-success btn-sm',
            },
            {
                extend: 'pdfHtml5',
                text: '<i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Descargar PDF',
                className: 'btn mr-1 mb-1 btn-danger btn-sm',
            }
            
        ],
        "scrollX": true,
        "language": {
              "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
          },
          "processing": true,
          "serverSide": true,
          //"ajax": "../server_side/scripts/server_processing.php" NOTE: use serverside script to fatch the data
          "ajax": "{{ route('banner_principal.data') }}",
          columns: [
                { data: 'ordenamiento', name: 'ordenamiento'},
                { data: 'id', name: 'id', visible: false},
                { data: 'imagen', name: 'imagen' },
                { data: 'url', name: 'url' },
                { data: 'acciones', name: 'acciones' }
          ],
            rowReorder: {
                dataSrc: 'readingOrder',
                selector: 'tr td:not(:first-of-type,:last-of-type)',
            },
            order: [[ 1, 'asc' ]],
            aLengthMenu: [
                [25, 50, 100, 200, -1],
                [25, 50, 100, 200, "Todas"]
            ],
            iDisplayLength: -1
    } );


        datatable.on('row-reorder', function (e, details) {
            console.log(details);
            if(details.length) {
                let rows = [];
                details.forEach(element => {
                    console.log(element);
                    rows.push({
                        id: datatable.row(element.node).data().id,
                        position: element.newPosition
                    });
                });

                $.ajax({
                    headers: {'x-csrf-token': "{{ csrf_token() }}"},
                    method: 'POST',
                    url: "{{ route('banner_principal.ordenamiento') }}",
                    data: { rows }
                }).done(function () { datatable.ajax.reload() });
            }

        });

  </script>
@endsection

@section('css')
  {{ Html::style('cms/vendors/css/tables/datatable/datatables.min.css') }}
  {{ Html::style('cms/vendors/css/tables/extensions/buttons.dataTables.min.css') }}
  {{ Html::style('cms/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}
@endsection

@section('contenido')
   <section id="horizontal">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Banner principal</h4>
                  <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content collapse show">
                  <div class="card-body card-dashboard">
                    <p class="card-text">Agrega, edita y elimina información relacionada con los banners registrados en el sistema.</p>
                    <table style="min-width: 100%" class="table display nowrap table-striped table-bordered scroll-horizontal">
                      <thead>
                        <tr>
                          <th>Orden</th>      
                          <th>ID</th>
                          <th>Imagen</th>
                          <th>Url</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
         {{ Form::open(['route' => ['banner_principal.destroy',':IDENTIFICADOR'],'method' => 'DELETE','id' => 'form-delete']) }}
    {{ form::close() }}
@endsection