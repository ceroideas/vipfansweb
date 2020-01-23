@extends('admin.layout')
@section('title' , 'Vip fans - Editar paquete')
@section('title_content' , 'Editar paquete')
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
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/packages/'.$p->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="row">
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="title">Título del paquete</label>
			                		<input type="text" name="title" id="title" class="form-control" value="{{ $p->title }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
			                		<label for="price">Precio</label>
			                		<input type="text" name="price" id="price" class="form-control" value="{{ $p->price }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="credit">Credito</label>
	                				<select name="credit" id="credit" class="form-control">
	                					<option value="">Seleccione credito</option>
	                					@foreach($c as $cr)
	                						<option value="{{ $cr->id }}" {{ $p->credit == $cr->id ? 'selected' : '' }}>{{ $cr->title }}</option>
	                					@endforeach
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-6">
	                			<div class="form-group">
	                				<label for="quantity">Cantidad</label>
	                				<input type="number" id="quantity" name="quantity" class="form-control" value="{{ $p->quantity }}">
	                			</div>
	                		</div>
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">Actualizar</button>
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