@extends('admin.layout')
@section('title' , 'Vip fans - Agregar pregunta')
@section('title_content' , 'Agregar pregunta')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la pregunta</h5>
	                @if($errors->any())
	                	<div class="alert alert-danger">
	                		{{ $errors->first() }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/faqs') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-9">
	                			<div class="form-group">
			                		<label for="title">Título</label>
			                		<input type="text" name="title" id="title" class="form-control">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="position">Posición</label>
	                				<select name="position" class="form-control" id="position">
	                					<option value="">Seleccione posición</option>
	                					@for($i = 1; $i <= App\Faq::where('status' , 1)->count() + 1; $i++)
											<option value="{{ $i }}">{{ $i }}</option>
	                					@endfor
	                				</select>
	                			</div>
	                		</div>
	                		@foreach($l as $la)
	                		<div class="col-lg-6">
			                	<div class="form-group">
			                		<label for="title_lang_{{ $la->id }}">Título en {{ $la->title }}</label>
			                		<input type="text" name="title_lang[]" id="title" class="form-control" value="{{ isset($te) && $te->getLang($la->iso , 'title') ? $te->getLang($la->iso , 'title')->value : '' }}">
			                		<input type="hidden" name="langs[]" value="{{ $la->iso }}">
			                	</div>
			                </div>
		                	@endforeach
	                		<div class="col-lg-12">
	                			<div class="form-group">
	                				<label for="answer">Respuesta de la pregunta</label>
	                				<textarea name="answer" id="answer" class="form-control" cols="30" rows="10"></textarea>
	                			</div>
	                		</div>
	                		@foreach($l as $la)
		                		<div class="col-lg-6">
				                	<div class="form-group">
				                		<label for="answer_lang_{{ $la->id }}">Respuesta en {{ $la->title }}</label>
				                		<textarea name="answer_lang[]" id="answer_lang_{{ $la->id }}" class="form-control" cols="30" rows="10">{{ isset($te) && $te->getLang($la->iso , 'answer') ? $te->getLang($la->iso , 'title')->value : '' }}</textarea>
				                	</div>
				                </div>
		                	@endforeach
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">Guardar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@stop