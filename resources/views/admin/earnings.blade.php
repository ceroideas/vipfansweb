@extends('admin.layout')
@section('title' , 'Vip fans - Ganancias por click')
@section('title_content' , 'Ganancias por click')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Ganancias</h5>
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
	                <form action="{{ url('/admin/earnings') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="likes">Me gusta</label>
			                		<input type="text" name="likes" id="likes" class="form-control" value="{{ $e ? $e->likes : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="comments">Comentarios</label>
			                		<input type="text" name="comments" id="comments" class="form-control" value="{{ $e ? $e->comments : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="followers">Seguidores</label>
			                		<input type="text" name="followers" id="followers" class="form-control" value="{{ $e ? $e->comments : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="videos">Videos</label>
			                		<input type="text" name="videos" id="videos" class="form-control" value="{{ $e ? $e->comments : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="premiun">Usuarios Premiun</label>
			                		<input type="text" name="premiun" id="premiun" class="form-control" value="{{ $e ? $e->premiun : 0 }}">
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
@stop