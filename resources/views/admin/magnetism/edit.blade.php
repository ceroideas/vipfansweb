@extends('admin.layout')
@section('title' , 'Vip fans - Editar tarea')
@section('title_content' , 'Editar tarea')
@section('body')
	<style>
		.picker {position:relative;width:90%;margin:0 auto}
	.inputpicker {width:100%;padding:10px;background:#f2f2f2}
	
	.oculto {width:100%;background:#f2f2f2;border-radius:0 0 10px 10px;padding:10px;overflow:auto;max-height:200px;display:none}
		.oculto ul {display:inline;float:left;width:100%;margin:0;padding:0}
			.oculto ul li {margin:0;padding:0;display:block;width:30px;height:30px;text-align:center;font-size:15px;font-family:"fontawesome";float:left;cursor:pointer;color:#666;line-height:30px;transition:0.2s all}
			.oculto ul li:hover {background:#FFF;color:#000}
		.oculto input[type=text] { font-size:13px;padding:5px;margin:0 0 10px 0;border:1px solid #ddd; }
	</style>
	<div class="row">
	    <!-- Column -->
	    <div class="col-lg-12 col-md-12">
	        <div class="card">
	            <div class="card-body">
	                <h5 class="card-title">Datos de la tarea</h5>
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
	                <form action="{{ url('/admin/magnetism/packages/'.$p->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data">
	                	{{ csrf_field() }}
	                	<div class="row">
	                		<div class="col-lg-4">
	                			<div class="form-group">
	                				<label for="option">Opción de la tarea</label>
	                				<select name="option" id="option" class="form-control">
	                					<option value="">Seleccione opción</option>
	                					@foreach($o as $op)
	                						<option value="{{ $op->id }}" {{ $op->id == $p->option_id ? 'selected' : '' }}>{{ $op->title }}</option>
	                					@endforeach
	                				</select>
	                			</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="form-group">
	                				<label for="points">Puntos</label>
	                				<input type="number" name="points" id="points" class="form-control" value="{{ $p->points }}">
	                			</div>
	                		</div>
	                		<div class="col-lg-4">
	                			<div class="picker form-group">
	                				<label for="icon">Icono</label>
									<input type="text" name="icon" readonly class="inputpicker form-control" placeholder="Seleccione icono" value="{{ $p->icon }}">
								</div>
	                		</div>
	                		<div class="col-lg-12">
	                			<div class="form-group">
	                				<label for="description">Descripción</label>
	                				<textarea name="description" id="description" class="form-control" cols="30" rows="5">{{ $p->description }}</textarea>
	                			</div>
	                		</div>
	                		@foreach($l as $la)
		                		<div class="col-lg-6">
				                	<div class="form-group">
				                		<label for="answer_lang_{{ $la->id }}">Descripción en {{ $la->title }}</label>
				                		<textarea name="answer_lang[]" id="answer_lang_{{ $la->id }}" class="form-control" cols="30" rows="10">{{ isset($p) && $p->getLang($la->iso , 'description') ? $p->getLang($la->iso , 'description')->value : '' }}</textarea>
				                		<input type="hidden" name="langs[]" value="{{ $la->iso }}">
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
	@section('scripts')
		<script>
			$(document).ready(function()
	{
		$(".picker").each(function()
		{
			div=$(this);
			if (icos)
			{
				var iconos="<ul>";
				for (var i=0; i<icos.length; i++) { iconos+="<li><i data-valor='"+icos[i]+"' rel='"+icos[i]+"' class='fa "+icos[i]+"'></i></li>"; }
				iconos+="</ul>";
			}
			// console.log(icos.length);
			div.append("<div class='oculto'><input type='text' placeholder='Encuentra tu icono...'>"+iconos+"</div>");
			$(".inputpicker").click(function()
			{
				$(".oculto").fadeToggle("fast");
			});
			$(document).on("click",".oculto ul li",function()
			{
				$(".inputpicker").val($(this).find("i").data("valor"));
				$(".oculto").fadeToggle("fast");
			});
			$(document).on("keyup",".oculto input[type=text]",function()
			{
				var value=$(this).val();
				$(".oculto ul li i").each(function() 
				{
					if ($(this).attr("rel").search(value) > -1) $(this).closest("li").show();
					else $(this).closest("li").hide();
				});
			});
		});
	});
		</script>
	@endsection
@stop