<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Vip fans - Faqs</title>
	<link rel="stylesheet" href="css/app.css">
	<style>
		.mano_img{
			/*margin-left: 80%;*/
		}
		body{
			color: #2A2A2A
		}
	</style>
</head>
<body>
	<div class="div_1" style="background-image: linear-gradient(to right, #FF977A , #FDDE61);">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
							<img src="img/VIPFANS-21.png" width="100" style="margin-top: 5%">
							<br><br>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<h3>
					<b>¡Bienvenid@s a VipFans Apk</b>
				</h3>
				<h3>
					Contacto
				</h3>
			</div>
			<div style="height: 70px"></div>
			<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 col-sm-12 col-sm-offset-0 col-xs-offset-0 col-xs-12 text-justify">
				<form action="#" method="POST">
					<form action="{{ url('/con-ss') }}" method="POST" autocomplete="off">
					{{ csrf_field() }}
					@if($errors->any())
						<div class="form-group">
							<div class="alert alert-danger text-center t_g">
								{{ $errors->first() }}
							</div>
						</div>
					@endif
					@if(session()->has('msj'))
						<div class="form-group">
							<div class="alert alert-success text-center t_g">
								{{ session()->get('msj') }}
							</div>
						</div>
					@endif
					<div class="form-group">
						<input type="text" name="name" class="form-control t_gg" placeholder="Nombre Completo*" value="{{ old('name') }}">
					</div>
					<div class="form-group">
						<input type="email" name="email" class="form-control t_gg" placeholder="Correo electrónico*" value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<input type="text" name="phone" class="form-control t_gg" placeholder="Teléfono" value="{{ old('phone') }}">
					</div>
					<div class="form-group">
						<textarea name="message" class="form-control t_gg" cols="30" rows="10" placeholder="Mensaje:">{{ old('message') }}</textarea>
					</div>
					<div class="form-group text-right">
						<button type="button" class="btn btn-success">Enviar mensaje</button>
					</div>
				</form>
				</form>
			</div>
			<div style="height: 40px"></div>
		</div>
	</div>
	<footer style="background-color: #2A2A2A;color: #7C7C7C">
		<div class="container">
			<div class="row">
				<div style="height: 60px"></div>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
					<img src="img/logo.png" width="110px"> <br><br>
					<p>Copyright <?php echo date('Y');?> VipFans. All Rights Reserved</p>
				</div>
				<div style="height: 185px"></div>
			</div>
		</div>
	</footer>
	<script src="js/app.js"></script>
</body>
</html>