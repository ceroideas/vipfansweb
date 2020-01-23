@extends('admin.layout')
@section('title' , 'Vip fans - Agregar paquete')
@section('title_content' , 'Agregar paquete')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos del paquete</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/packages') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="title">Título del paquete</label>
			                		<input type="text" name="title" id="title" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="price">Precio</label>
			                		<input type="text" name="price" id="price" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="credit">Credito</label>
	                				<select name="credit" id="credit" class="form-control">
	                					<option value="">Seleccione credito</option>
	                					@foreach($c as $cr)
	                						<option value="{{ $cr->id }}">{{ $cr->title }}</option>
	                					@endforeach
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="quantity">Cantidad</label>
	                				<input type="number" name="quantity" id="quantity" class="form-control">
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