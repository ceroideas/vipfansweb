@extends('admin.layout')
@section('title' , 'Vip fans - Magnetismo')
@section('title_content' , 'Magnetismo')
@section('body')
	
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Porcentaje de comisión al transferir magnetismo</h5>
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
	                <form action="{{ url('/admin/magnetism') }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-3">
	                			<div class="form-group">
			                		<label for="percent">Porcentaje(%)</label>
			                		<input type="text" name="percent" id="percent" class="form-control" value="{{ $m ? $m->percent : 0 }}">
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