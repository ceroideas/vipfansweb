@extends('admin.layout')
@section('title' , 'Vip fans - Lista de usuarios')
@section('title_content' , 'Usuarios')
@section('body')
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Usuarios registrados</h5>
	                <form action="{{ url('/admin/export/users') }}" method="POST">
	                	{{ csrf_field() }}
	                	<input type="hidden" name="data" value="{{ $u }}">
	                	<div class="btn-group">
	                		<a href="{{ url('/admin/users/create') }}" class="btn btn-primary" style="margin-bottom: 10px;">Agregar usuario</a>
	                		<button class="btn btn-success" type="submit" style="height: 35px">Exportar datos</button>
	                	</div>
	                </form>
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
	                	<form action="{{ url('/api/users/filter') }}" method="POST" id="formFilter" autocomplete="off">
		                	<div class="row">
		                		<div class="col-lg-12">
		                			Filtrar por
		                		</div>
		                		<div class="col-lg-2">
		                			<div class="form-group">
		                				<select name="gender" id="gender" class="form-control">
		                					<option value="">Genero</option>
		                					<option value="1" {{ isset($gender_filter) && $gender_filter == 1 ? 'selected' : '' }}>Masculino</option>
		                					<option value="2" {{ isset($gender_filter) && $gender_filter == 2 ? 'selected' : '' }}>Femenino</option>
		                				</select>
		                			</div>
		                		</div>
		                		<div class="col-lg-3">
		                			<select name="city" id="city" class="form-control">
		                				<option value="">Ciudad</option>
		                				@foreach(App\City::where('ubicacionpaisid' , 28)->get() as $ci)
		                					<option value="{{ $ci->id }}" {{ isset($city_filter) && $city_filter == $ci->id ? 'selected' : '' }}>{{ $ci->estadonombre }}</option>
		                				@endforeach
		                			</select>
		                		</div>
		                		<div class="col-lg-3">
		                			<select name="theme" id="theme" class="form-control">
		                				<option value="">Temática</option>
		                				@foreach($t as $te)
		                					<option value="{{ $te->id }}" {{ isset($theme_filter) && $theme_filter == $te->id ? 'selected' : '' }}>{{ $te->title }}</option>
		                				@endforeach
		                			</select>
		                		</div>
		                		<div class="col-lg-4">
		                			<select name="buy" id="buy" class="form-control">
		                				<option value="">Compra de paquetes</option>
		                				<option value="1" {{ isset($buy_filter) && $buy_filter == 1 ? 'selected' : '' }}>Que hayan comprado paquetes</option>
		                				<option value="2" {{ isset($buy_filter) && $buy_filter == 2 ? 'selected' : '' }}>Que NO hayan comprado paquetes</option>
		                			</select>
		                		</div>
		                		{{-- <div class="col-lg-6">
		                			<div class="row">
		                				<div class="col-lg-6">
		                					<div class="form-group">
				                				<input type="text" name="from" id="date_from" class="form-control mydatepicker" placeholder="Fecha de compra desde" value="{{ isset($from_filter) ? $from_filter : ''}}">
		                					</div>
		                				</div>
		                				<div class="col-lg-6">
		                					<div class="form-group">
		                						<input type="text" name="to" id="date_to" class="form-control mydatepicker" placeholder="Fecha de compra hasta" value="{{ isset($to_filter) ? $to_filter : '' }}">
		                					</div>
		                				</div>
		                			</div>
		                		</div>
		                		<div class="col-lg-4">
		                			<div class="row">
		                				<div class="col-lg-6">
		                					<div class="form-group">
				                				<input type="text" name="follow_from"  id="follow_from" class="form-control" placeholder="Seguidores desde" value="{{ isset($follow_from_filter) ? $follow_from_filter : ''}}">
		                					</div>
		                				</div>
		                				<div class="col-lg-6">
		                					<div class="form-group">
		                						<input type="text" name="follow_to" id="follow_to" class="form-control" placeholder="Seguidores hasta" value="{{ isset($follow_to_filter) ? $follow_to_filter : '' }}">
		                					</div>
		                				</div>
		                			</div>
		                		</div> --}}
		                	</form>
	                		<div class="col-lg-1">
	                			<button type="button" class="btn btn-success btn-block" id="filterUsers">Filtrar</button>
	                		</div>
	                		<div class="col-lg-12">
	                			@if(isset($filter_active))
	                				<br>
	                				<a href="{{ url('/admin/users') }}" class="btn btn-warning btn-sm">Remover filtros</a>
	                			@endif
	                		</div>
	                	</div>
		            	<table id="myTable" class="display nowrap table table-hover table-striped table-bordered dataTable" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Nombre</th>
									<th>Email</th>
									<th>Estatus</th>
									<th>Opciones</th>
								</tr>
							</thead>
							<tbody>
								@foreach($u as $c)
									<tr>
										<td id="name_{{ $c->id }}">
											{{ $c->name }} {{ $c->last_name }}
										</td>
										<td id="email_{{ $c->id }}">
											{{ $c->email }}
										</td>
										<td id="status_{{ $c->id }}"> 
											{{ $c->status == 1 ? 'Activo' : 'Bloqueado' }}
										</td>
										<td>
											<div class="btn-group">
												<a href="#modalEditUser_{{ $c->id }}" class="btn btn-sm btn-warning" data-toggle="modal">
													Editar
												</a>
												<a href="#actBlocUser_{{ $c->id }}" data-toggle="modal" class="btn btn-sm {{ $c->status == 1 ? 'btn-danger' : 'btn-success' }}" id="actBloc_{{ $c->id }}">
													{{ $c->status == 1 ? 'Bloquear' : 'Activar' }}
												</a>
												<button class="btn btn-default btn-sm" data-target="#credits_{{ $c->id }}" data-toggle="modal" style="background: #2A2E31 !important;color: white">
													Gestionar creditos
												</button>
												{{-- <a href="{{ url('/admin/users/'.$c->id) }}" class="btn btn-info btn-sm">
													Ver detalles
												</a> --}}
											</div>
											<div class="modal fade" id="modalEditUser_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">Editar usuario <b>{{ $c->name }} {{ $c->last_name }}</b></h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body">
										                	@php
										                		$city = App\City::where('ubicacionpaisid' , 28)->orderBy('estadonombre' , 'asc')->get();
										                	@endphp
										                    @include('admin.users.edit')
										                </div>
										            </div>
										        </div>
										    </div>
										    <div class="modal fade" id="actBlocUser_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	{{ $c->status == 1 ? '¿Seguro que desea bloquear a este usuario?' : '¿Seguro que desea activar este usuario?' }}
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body text-center">
										                	<h4>
										                		<b>{{ $c->name }} {{ $c->last_name }}</b>
										                	</h4>
										                	<div class="btn-group">
										                		<a href="{{ url('/admin/users/updateStatus/'.$c->id) }}" class="btn {{ $c->status == 1 ? 'btn-danger' : 'btn-success' }}">{{ $c->status == 1 ? 'Bloquear' : 'Activar' }}</a>
										                		<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button> 
										                	</div>
										                </div>
										            </div>
										        </div>
										    </div>
										    <div class="modal fade" id="credits_{{ $c->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
										        <div class="modal-dialog" role="document">
										            <div class="modal-content">
										                <div class="modal-header">
										                    <h4 class="modal-title" id="exampleModalLabel1">
										                    	Creditos de usuario <b>{{ $c->name }} {{ $c->last_name }}</b>
										                    </h4>
										                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										                </div>
										                <div class="modal-body">
										                	<div class="form-group">
										                		<div class="alert alert-success" id="messageSuccessCredits_{{ $c->id }}" style="display: none;">
												                    
												                </div>
										                	</div>
										                	<form action="{{ url('/admin/users/credits/'.$c->id) }}" method="POST" autocomplete="off" class="formCredits">
										                		{{ csrf_field() }}
										                		<div class="form-group">
										                			<label for="likes">Me gusta</label> <br>
										                			<input type="text" name="likes" id="likes" class="form-control" value="{{ $c->likes ? $c->likes : 0 }}">
										                		</div>
										                		<div class="form-group">
										                			<label for="followers">Seguidores</label> <br>
										                			<input type="text" name="followers" id="followers" class="form-control" value="{{ $c->followers ? $c->followers : 0 }}">
										                		</div>
										                		<div class="form-group">
										                			<label for="comments">Comentarios</label> <br>
										                			<input type="text" name="comments" id="comments" class="form-control" value="{{ $c->comments ? $c->comments : 0 }}">
										                		</div>
										                		<div class="form-group">
										                			<label for="videos">Videos</label> <br>
										                			<input type="text" name="videos" id="videos" class="form-control" value="{{ $c->videos ? $c->videos : 0 }}">
										                		</div>
										                		<div class="form-group">
										                			<label for="magnetism">Magnetismo</label> <br>
										                			<input type="text" name="magnetism" id="magnetism" class="form-control" value="{{ $c->magnetismo ? $c->magnetismo : 0 }}">
										                		</div>
										                		<div class="form-group">
										                			<button class="btn btn-primary" type="submit">Guardar</button>
										                			<button type="button" class="btn btn-info" data-dismiss="modal">Cancelar</button> 
										                		</div>
										                	</form>
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

				$('#filterUsers').on('click' , function(){
					var gender = $('#gender').val();
					var city = $('#city').val();
					var theme = $('#theme').val();
					var buy = $('#buy').val();
					var from = $('#date_from').val();
					var to   = $('#date_to').val();
					var follow_from = $('#follow_from').val();
					var follow_to   = $('#follow_to').val();

					if (gender || city || theme || buy || from || to || follow_from || follow_to) {
						$('#formFilter').submit();
					}else{
						alert('Selecciona un item para filtrar')
					}
				});

				$('.formEdit').on('submit' , function(e){
					e.preventDefault();
					var f = $(this);

					$.ajax({
						url: f.attr('action'),
						type: f.attr('method'),
						data: f.serialize(),
					})
					.done(function(data) {
						if (data.success != true) {
							$('#messageSuccess_'+data.id).hide();
							$('#messageError_'+data.id).text(data.msj);
							$('#messageError_'+data.id).show();

							setTimeout(function(){
								$('#messageError_'+data.id).hide();
							}, 4000);
						}else{
							$('#messageError_'+data.id).hide();
							$('#messageSuccess_'+data.id).text(data.msj);
							$('#messageSuccess_'+data.id).show();

							$('#name_'+data.id).text(data.user.name+' '+data.user.last_name);
							$('#email_'+data.id).text(data.user.email);

							setTimeout(function(){
								$('#messageSuccess_'+data.id).hide();
							}, 4000);
						}
					})
					.fail(function(r) {
						console.log(r);
					})
					.always(function() {
						console.log("complete");
					});
				});

				$('.formCredits').on('submit' , function(e){
					e.preventDefault();

					var f = $(this);

					$.ajax({
						url: f.attr('action'),
						type: f.attr('method'),
						data: f.serialize(),
					})
					.done(function(data) {
						$('#messageSuccessCredits_'+data.id).text(data.msj);
						$('#messageSuccessCredits_'+data.id).show();

						setTimeout(function(){
							$('#messageSuccessCredits_'+data.id).hide();
						} , 4000);
					})
					.fail(function(r) {
						console.log(r);
					})
					.always(function() {
						console.log("complete");
					});
					
				});
			});
		</script>
	@endsection
@stop