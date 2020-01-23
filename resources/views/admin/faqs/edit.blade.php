@extends('admin.layout')
@section('title' , 'Vip fans - Editar pregunta')
@section('title_content' , 'Editar pregunta')
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
	                @if(session()->has('msj'))
	                	<div class="alert alert-success">
	                		{{ session()->get('msj') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                            	<span aria-hidden="true">×</span> 
                            </button>
                        </div>
	                @endif
	                <form action="{{ url('/admin/faqs/'.$f->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	{{ method_field('PUT') }}
	                	<div class="row">
	                		<div class="col-lg-9">
	                			<div class="form-group">
			                		<label for="title">Título</label>
			                		<input type="text" name="title" id="title" class="form-control" value="{{ $f->title }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
	                				<label for="position">Posición</label>
	                				<select name="position" class="form-control" id="position">
	                					<option value="">Seleccione posición</option>
	                					@for($i = 1; $i <= App\Faq::where('status' , 1)->count(); $i++)
											<option value="{{ $i }}" {{ $i == $f->position ? 'selected' : '' }}>{{ $i }}</option>
	                					@endfor
	                				</select>
	                			</div>
	                		</div>
	                		@foreach($l as $la)
	                		<div class="col-lg-6">
			                	<div class="form-group">
			                		<label for="title_lang_{{ $la->id }}">Título en {{ $la->title }}</label>
			                		<input type="text" name="title_lang[]" id="title" class="form-control" value="{{ isset($f) && $f->getLang($la->iso , 'title') ? $f->getLang($la->iso , 'title')->value : '' }}">
			                		<input type="hidden" name="langs[]" value="{{ $la->iso }}">
			                	</div>
			                </div>
		                	@endforeach
	                		<div class="col-lg-12">
	                			<div class="form-group">
	                				<label for="answer">Respuesta de la pregunta</label>
	                				<textarea name="answer" id="answer" class="form-control" cols="30" rows="10">{{ $f->answer }}</textarea>
	                			</div>
	                		</div>
	                		@foreach($l as $la)
		                		<div class="col-lg-6">
				                	<div class="form-group">
				                		<label for="answer_lang_{{ $la->id }}">Respuesta en {{ $la->title }}</label>
				                		<textarea name="answer_lang[]" id="answer_lang_{{ $la->id }}" class="form-control" cols="30" rows="10">{{ isset($f) && $f->getLang($la->iso , 'answer') ? $f->getLang($la->iso , 'answer')->value : '' }}</textarea>
				                	</div>
				                </div>
		                	@endforeach
	                	</div>
	                	<div class="form-group">
	                		<button type="submit" class="btn btn-success">Actualizar</button>
	                	</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
@stop