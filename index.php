<?php
include_once 'php/sistema.php';
include 'php/usuario.php';
$sistema = new Sistema();
//$sistema->resetBase();
$sistema->creaAlerta(array('mensaje'=>'Bienvenido!','icono'=>'bandera','tiempo'=>'5'));
if(isset($_POST['loginSend'])){
	$usuario = new Usuario();
	$usuario->login($_POST['nip'],$_POST['password']);
}elseif(isset($_POST['registro'])){
    $nombre = $_POST['nombre']." ".$_POST['apellidoP']." ".$_POST['apellidoM'];
	if(trim($_POST['password']) == trim($_POST['password2'])){
		$usuario = new Usuario();
		$usuario->agregaUsuario($nombre,$_POST['carrera'],$_POST['codigo'],$_POST['password']);
	}else $sistema->creaAlerta(array('mensaje'=>'Passwords no coinciden.','icono'=>'error','tiempo'=>'5','fondo'=>'firebrick'));
}

?>
<HTML>
	<HEAD>
		<title>Login - ProAdmin</title>
		<link rel="stylesheet" type="text/css" href="css/dist/css/bootstrap.css" />
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="stylesheet" type="text/css" href="css/login.css"/>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<link rel="icon" href="img/favicon.ico">
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</HEAD>
	<BODY>

<?php
	$sistema->imprimeAlertas();
?>
		<div class="container" id="login" >
			<div class="image" style="background-image:url('img/logo.png')"></div>
			<fieldset class="clearfix">
				<button type="button" class="btn btn-primary col-md-12 col-xs-12 col-sm-12" data-toggle="modal" data-target="#exampleModal" style="margin-top: 2em; background-color: #40C077;">Ingresar</button>

				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				  <div class="modal-dialog">
				    <div class="modal-content">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				        <h4 class="modal-title" id="exampleModalLabel">Login</h4>
				      </div>
				     	<div class="modal-body">
				        	<form action="" method="post">
								<fieldset class="clearfix">
									<p><i class="fa fa-user fa-2x"></i><input type="text" name="nip" value="NIP" onBlur="if(this.value == '') this.value = 'NIP'" onFocus="if(this.value == 'NIP') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
									<p><i class="fa fa-key fa-2x"></i><input type="password" name="password" value="Password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
						       		<hr>
											<div class="col-md-4 col-xs-3"></div>
											<div class="col-md-4 col-xs-6">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        	<button type="submit" class="btn btn-primary" name="loginSend">Ingresar</button>
											</div>
											<div class="col-md-4 col-xs-3"></div>
								</fieldset>
							</form>
						</div>
				    </div>
				  </div>
				</div>

				<button type="button" class="btn btn-primary col-md-12 col-xs-12 col-sm-12" data-toggle="modal" data-target="#registrar" style="margin-top: 2em; background-color: #40C077;">Registrarse</button>

				<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
								<h4 class="modal-title" id="exampleModalLabel">registrarse</h4>
							</div>
							<div class="modal-body">
								<form action="" method="post">
									<fieldset class="clearfix">
										<p class="input-group col-md-12 col-xs-12"><i class="fa fa-user fa-2x"></i><input  type="text" name="nombre"  placeholder="Tu nombre" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-6 col-xs-6"  style="float: left;"><i class="fa fa-user fa-2x"></i><input class="col-md-13" type="text" name="apellidoP" placeholder="Tu apellido paterno" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-6 col-xs-6"><i class="fa fa-user fa-2x"></i><input class="col-md-13" type="text" name="apellidoM" placeholder="Tu apellido materno" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-6 col-xs-6" style="float: left;"><i class="fa fa-code fa-2x"></i><input class="col-md-13" type="text" name="codigo"  placeholder="Tu codigo de alumno" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-6 col-xs-6"><i class="fa fa-user fa-2x"></i><input class="col-md-13" type="text" name="nick" placeholder="Tu alias" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-12 col-xs-12"><i class="fa fa-book fa-2x"></i><input type="text" class="text-uppercase" name="carrera" placeholder="INNI" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<p class="input-group col-md-12 col-xs-12"><i class="fa fa-key fa-2x"></i><input type="password" name="password" placeholder="Tu contraseña" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
										<p class="input-group col-md-12 col-xs-12"><i class="fa fa-key fa-2x"></i><input type="password" name="password2" placeholder="Repite tu contraseña" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
										<hr>
										<div class="col-md-4 col-xs-3"></div>
										<div class="col-md-4 col-xs-6">
											<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
											<button type="submit" class="btn btn-primary" name="registro">Registrar</button>
										</div>
										<div class="col-md-4 col-xs-3"></div>
									</fieldset>
								</form>
							</div>
						</div>
					</div>
				</div>
			</fieldset>
		</div>

		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/util.js"></script>
		<script type="text/javascript" src="css/dist/js/bootstrap.js"></script>
	</BODY>
</HTML>
