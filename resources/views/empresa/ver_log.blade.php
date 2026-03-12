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

		$('.scroll-horizontal').DataTable( {
		    dom: 'Bfrtip',
        buttons: [
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
	        "ajax": "{{ route('movimientos_sistema.data') }}",
	        columns: [
	            { data: 'movimiento', name: 'movimiento' },
              { data: 'created_at', name: 'created_at' }
	        ]
		} );

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
                  <h4 class="card-title">Log del sistema</h4>
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
                    <p class="card-text">Ultimos moviemientos</p>
                    <table style="min-width: 100%" class="table display nowrap table-striped table-bordered scroll-horizontal">
                      <thead>
                        <tr>
                          <th>Movimiento</th>
                          <th>Fecha y hora</th>
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
@endsection