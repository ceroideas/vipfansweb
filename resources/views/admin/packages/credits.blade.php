@extends('admin.layout')
@section('title' , 'Vip fans - creditos de paquetes')
@section('title_content' , 'Creditos de paquetes')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-4 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">{{ isset($cr) ? 'Editar credito' : 'Agregar credito' }}</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                @if(session()->has('error'))
	                	<div class="alert alert-danger">
	                		{{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ isset($cr) ? url('/admin/credits/'.$cr->id) : url('/admin/credits') }}" method="POST" autocomplete="off">
	                	{{ csrf_field() }}
	                	@if(isset($cr))
	                		{{ method_field('PUT') }}
	                	@endif
	                	<div class="form-group">
	                		<label for="title">Título</label>
	                		<input type="text" name="title" id="title" class="form-control" value="{{ isset($cr) ? $cr->title : '' }}">
	                	</div>
						@foreach($l as $la)
		                	<div class="form-group">
		                		<label for="title_lang_{{ $la->id }}">Título en {{ $la->title }}</label>
		                		<input type="text" name="title_lang[]" id="title" class="form-control" value="{{ isset($cr) && $cr->getLang($la->iso , 'title') ? $cr->getLang($la->iso , 'title')->value : '' }}">
		                		<input type="hidden" name="langs[]" value="{{ $la->iso }}">
		                	</div>
	                	@endforeach
	                	{{-- <div class="form-group">
	                		<label for="description">Descripción</label>
	                		<textarea name="description" id="description" cols="30" rows="10" class="form-control">{{ isset($cr) ? $cr->description : '' }}</textarea>
	                	</div> --}}
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">{{ isset($cr) ? 'Actualizar' : 'Guardar' }}</button>
	                	</div>
	                </form>
	            </div>
	            <div id="sparkline8" class="sparkchart"></div>
	        </div>
	    </div>
	    <div class="col-lg-8 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Creditos registrados</h5>
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
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
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($c as $cre)
									<tr>
										<td>
											{{ $cre->title }}
										</td>
										<td>
											<div class="btn-group">
												<a href="{{ url('/admin/credits/'.$cre->id.'/edit') }}" class="btn btn-sm btn-warning">Editar</a>
												<a href="#delete_{{ $cre->id }}" data-toggle="modal" class="btn btn-sm btn-danger">Eliminar</a>
											</div>
											<div class="modal fade" id="delete_{{ $cre->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	¿Seguro de eliminar esta tematica?
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<h4>
										                		<b>{{ $cre->title }}</b>
										                	</h4>
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/credits/updateStatus/'.$cre->id) }}" class="btn btn-danger">Eliminar</a>
										                		<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button> 
										                	</div>
										                </div>
										            </div>
										        </div>
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
		</script>
	@endsection
@stop