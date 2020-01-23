@extends('admin.layout')
@section('title' , 'Vip fans - Lista de paquetes')
@section('title_content' , 'Paquetes')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Paquetes registrados</h5>
	                <a href="{{ url('/admin/packages/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Agregar paquete</a>
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
                    @elseif(isset($msj))
                    	<div class="alert alert-danger">
	                		{{ $msj }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <div class="table-responsive m-t-40">
		            	<table id="myTable" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Precio</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($p as $c)
									<tr>
										<td>
											{{ $c->title }}
										</td>
										<td>
											{{ number_format($c->price , 2 , ',' , '.') }}
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/packages/'.$c->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="{{ url('/admin/packages/updateStatus/'.$c->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
												<a href="{{ url('/admin/packages/sells/'.$c->id) }}" class="btn btn-sm btn-info">Ver ventas</a>
											</div>
										</td> 
									</tr>
								@endforeach
							</tbody>
		            	</table>
		            </div>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
			    $('#myTable').DataTable({
			        "language": {
			            "lengthMenu": "Mostrando _MENU_ registros por página",
			            "zeroRecords": "Sin datos encontrados",
			            "info": "Mostrando _PAGE_ de _PAGES_",
			            "infoEmpty": "Sin datos para mostrar",
			            "infoFiltered": "(filtrado de _MAX_ registros totales)",
			            'search':'Buscar:',
				        paginate: {
			                'first':      "Primero",
			                'previous':   "Anterior",
			                'next':       "Siguiente",
			                'last':       "Ultima"
			            }
			        }
			    });

			    $('#city').select2();

			    $('.mydatepicker').datepicker({
					todayHighlight:true,
					format:'d/m/yyyy'
				});

				setTimeout(function(){
					$('.select2-selection').css('height', '37.5px');
				} , 200);
			});
		</script>
	@endsection
@stop