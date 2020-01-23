@extends('admin.layout')
@section('title' , 'Vip fans - Restricciones')
@section('title_content' , 'Restricciones')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Restricciones</h5>
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
	                <form action="{{ url('/admin/likes') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="likes">Me gusta</label>
			                		<input type="number" name="likes" id="likes" class="form-control" value="{{ $l ? $l->likes : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="followers">Seguidores</label>
			                		<input type="number" name="followers" id="followers" class="form-control" value="{{ $l ? $l->followers : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="followers_hour">Seguir cuentas</label>
			                		<input type="number" name="followers_hour" id="followers_hour" class="form-control" value="{{ $l ? $l->followers_hour : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="texts">Textos</label>
			                		<input type="number" name="texts" id="texts" class="form-control" value="{{ $l ? $l->texts : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="hashtags">Hashtags</label>
			                		<input type="number" name="hashtags" id="hashtags" class="form-control" value="{{ $l ? $l->hashtags : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="messages">Mensajes</label>
			                		<input type="number" name="messages" id="messages" class="form-control" value="{{ $l ? $l->messages : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="tags">Etiquetas</label>
			                		<input type="number" name="tags" id="tags" class="form-control" value="{{ $l ? $l->tags : 0 }}">
			                	</div>
	                		</div>
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="comments">Comentarios</label>
			                		<input type="number" name="comments" id="comments" class="form-control" value="{{ $l ? $l->comments : 0 }}">
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