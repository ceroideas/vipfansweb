@extends('admin.layout')
@section('title' , 'Vip fans - Agregar usuario')
@section('title_content' , 'Agregar usuario')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos del usuario</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/users') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="name">Nombre Completo</label>
			                		<input type="text" name="name" id="name" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="email">Email</label>
			                		<input type="text" name="email" id="email" class="form-control">
			                	</div>
	                		</div>
	                	</div>
	                	<div class="row">
	                		<div class="col-lg-4">
	                			<div class="form-group">
	                				<label for="born_date">Fecha de nacimiento</label>
	                				<input type="text" name="born_date" id="born_date" class="form-control mydatepicker" placeholder="dd/mm/yyyy">
	                			</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="gender">Género</label>
			                		<select name="gender" id="gender" class="form-control">
			                			<option value="">Seleccione género</option>
			                			<option value="1">Masculino</option>
			                			<option value="2">Femenino</option>
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="city">Ciudad</label>
									<select name="city" id="city" class="form-control">
										<option value="">Seleccione ciudad</option>
										@foreach($c as $ci)
											<option value="{{ $ci->id }}">{{ $ci->estadonombre }}</option>
										@endforeach
									</select>
			                	</div>
	                		</div>
	                		{{-- <div class="col-lg-4">
	                			<div class="form-group">
		                			<label for="cover">Foto de portada</label>
		                			<input type="file" id="input-file-now" class="dropify" name="avatar" accept="image/*" />
		                		</div>	
	                		</div> --}}
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="theme">Temática</label>
			                		<select name="theme" id="theme" class="form-control">
			                			<option value="">Seleccione temática</option>
			                			@foreach($t as $te)
			                				<option value="{{ $te->id }}">{{ $te->title }}</option>
			                			@endforeach
			                		</select>
			                	</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
			                		<label for="status">Estatus del usuario</label>
			                		<select name="status" id="status" class="form-control">
			                			<option value="">Seleccione estatus</option>
			                			<option value="1">Activo</option>
			                			<option value="0">Bloqueado</option>
			                		</select>
			                	</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">Guardar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	@section('scripts')
		<script>
			$(document).ready(function() {
				$('.mydatepicker').datepicker({
					todayHighlight:true,
					format:'d/m/yyyy'
				});

		        $('.dropify').dropify({
					messages: {
		                default: 'Click aqui o arrastra un archivo',
		                remove: 'Remover',
		                error: 'Error, archivo no soportado',
		                replace:'Click aqui o arrastra un archivo para reemplazar'
		            }
				});
			});
		</script>
	@endsection
@stop