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
	<style>
		.div-q a{
		    text-decoration:none;
		    color: #7c7c7c;
		}
		.div-a{
		    border: 1px solid white;
		    padding: 10px;
		    border-radius: 10px;
		    padding-bottom: 0px;
		    background-color: #7c7c7c;
		    color: white;
		}
		.title-section{
		    color:#BF9726;
		}
	</style>
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
				<h3>
					<b>¡Bienvenid@s a VipFans Apk</b>
				</h3>
				<h3>
					Faqs
				</h3>
			</div>
			<div style="height: 70px"></div>
			@foreach($f as $fa)
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-justify div-q">
	                <h4>
	                    <a href="#question_{{ $fa->id }}" data-toggle="collapse">
	                        <b>{{ $fa->position }}. {{ $fa->title }}</b>
	                    </a>
	                </h4>
	                <div id="question_{{ $fa->id }}" class="collapse div-a">
	                    <p>
	                        {{ $fa->answer }}
	                    </p>
	                </div>
	            </div>
            @endforeach
			<div style="height: 40px"></div>
		</div>
		<div style="height: 40px"></div>
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