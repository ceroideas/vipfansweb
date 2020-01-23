<div class="row">
    <!-- Column -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                {{-- <h5 class="card-title">Datos del usuario</h5> --}}
            	<div class="alert alert-danger" id="messageError_{{ $c->id }}" style="display: none;">
            		
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    	<span aria-hidden="true">×</span> 
                    </button> --}}
                </div>
            	<div class="alert alert-success" id="messageSuccess_{{ $c->id }}" style="display: none;">
            		
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
                    	<span aria-hidden="true">×</span> 
                    </button> --}}
                </div>
                <form action="{{ url('/admin/users/'.$c->id) }}" method="POST" autocomplete="off" enctype="multipart/form-data" class="formEdit">
                	{{ csrf_field() }}
                	{{ method_field('PUT') }}
                	<div class="row">
                		<div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="name">Nombre</label> <br>
		                		<input type="text" name="name" id="name" class="form-control" value="{{ $c->name }}">
		                	</div>
                		</div>
                		<div class="col-lg-6">
		                	<div class="form-group">
		                		<label for="last_name">Apellido</label> <br>
		                		<input type="text" name="last_name" id="last_name" class="form-control" value="{{ $c->last_name }}">
		                	</div>
                		</div>
                	</div>
                	<div class="row">
                		<div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="email">Email</label> <br>
		                		<input type="text" name="email" id="email" class="form-control" value="{{ $c->email }}">
		                	</div>
                		</div>
                		<div class="col-lg-6">
		        			<div class="form-group">
		        				<label for="born_date">Fecha de nacimiento</label> <br>
		        				<input type="text" name="born_date" id="born_date" class="form-control mydatepicker" placeholder="dd/mm/yyyy" value="{{ $c->getDate() }}">
		        			</div>
                		</div>
                	</div>
        			<div class="row">
        				<div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="gender">Género</label> <br>
		                		<select name="gender" id="gender" class="form-control">
		                			<option value="">Seleccione género</option>
		                			<option value="1" {{ $c->gender == 1 ? 'selected' : '' }}>Masculino</option>
		                			<option value="2" {{ $c->gender == 2 ? 'selected' : '' }}>Femenino</option>
		                		</select>
		                	</div>
        				</div>
        				<div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="city">Ciudad</label> <br>
								<select name="city" id="city" class="form-control">
									<option value="">Seleccione ciudad</option>
									@foreach($city as $ci)
										<option value="{{ $ci->id }}" {{ $c->city_id == $ci->id ? 'selected' : '' }}>{{ $ci->estadonombre }}</option>
									@endforeach
								</select>
		                	</div>
        				</div>
        			</div>
            		<div class="row">
            			<div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="theme">Tematica</label> <br>
		                		<select name="theme" id="theme" class="form-control">
		                			<option value="">Seleccione temática</option>
		                			@foreach($t as $te)
		                				<option value="{{ $te->id }}" {{ $c->theme == $te->id ? 'selected' : '' }}>{{ $te->title }}</option>
		                			@endforeach
		                		</select>
		                	</div>
            			</div>
            			{{-- <div class="col-lg-6">
		        			<div class="form-group">
		                		<label for="status">Estatus del usuario</label> <br>
		                		<select name="status" id="status" class="form-control">
		                			<option value="">Seleccione estatus</option>
		                			<option value="1" {{ $c->status = 1 ? 'selected' : '' }}>Activo</option>
		                			<option value="0" {{ $c->status = 0 ? 'selected' : '' }}>Bloqueado</option>
		                		</select>
		                	</div>
            			</div> --}}
            		</div>
                	<div class="form-group">
                		<button type="submit" class="btn btn-success">Actualizar</button>
                		<button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                	</div>
                </form>
            </div>
        </div>
    </div>
</div>