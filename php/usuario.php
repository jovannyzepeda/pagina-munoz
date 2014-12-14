<?php

require_once 'sistema.php';

class Usuario
{
	var $id,
		$tipo,
		$online;

	function __construct()
	{
		$online = OFFLINE;
	}

	function encripta($string){
	   $result = '';
	   for($i=0; $i<strlen($string); $i++) {
	      $char = substr($string, $i, 1);
	      $keychar = substr('|', ($i % strlen('|'))-1, 1);
	      $char = chr(ord($char)+ord($keychar));
	      $result.=$char;
	   }

	   return base64_encode($result);
	}

	function desencripta($string) {
		$result = '';
		$string = base64_decode($string);
		for($i=0; $i<strlen($string); $i++) {
			$char = substr($string, $i, 1);
			$keychar = substr('|', ($i % strlen('|'))-1, 1);
			$char = chr(ord($char)-ord($keychar));
			$result.=$char;
		}
		return $result;

	}

	function login($user,$pass){
		$con=conectar();
		$result = mysqli_query($con,"SELECT * FROM usuario where codigo = '$user' and password = '$pass'");
  		if (mysqli_num_rows($result)){
  			$row = mysqli_fetch_array($result);
  			$_SESSION["usuario"]["nombre"] = $row['nickname'];
  			$_SESSION["usuario"]["codigo"]=$row['codigo'];
  			$_SESSION["user"] = $user;
  			if($row['activo']){
  				if($row['privilegio']==ADMINISTRADOR){//En caso de ser administrador
	  				$_SESSION["usuario"]["tipo"]=ADMINISTRADOR;
	  				header('Location: panel/administrador/');
	  			}elseif($row['privilegio']==PROFESOR){//En caso de ser profesor
	  				$_SESSION["usuario"]["tipo"]=PROFESOR;
	  				header('Location: panel/profesor/');
	  			}else{//Alumnos
	  				$_SESSION["usuario"]["tipo"]=ALUMNO;
	  				header('Location: panel/alumno/');
	  			}	
  			}else{
  				echo 'Usuario no habilitado!';
  			}	
  		}else{
  			echo 'No se encontro usuario!';
  		}
  		mysqli_close($con);
  		$this->gettime();
	}
	function gettime(){
			$con = conectar();
			$result = mysqli_query($con,"SELECT * FROM ciclo order by id_ciclo desc limit 1");
			$row = mysqli_fetch_array($result);
			$_SESSION["usuario"]["calendario"]=$row['prefijo'];  		
	}
	function agregaUsuario($nombre,$carrera,$codigo,$pass){		
		$con=conectar();
		mysqli_query($con,"BEGIN;");
		mysqli_query($con, "INSERT INTO usuario(codigo,password,nickname)values('$codigo','$pass','$nombre')");
		$id=mysqli_insert_id($con);
		if(mysqli_query($con,"INSERT INTO alumno(codigo,nombre,id_usuario,carrera) values('$codigo','$nombre'
			,$id,'$carrera')")){
			echo ("<div class='container-fluid alert alert-success alert-dismissible' role='alert' style='font-size: 2em;'>
						<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
						Bienvenido  $nombre , Tu usuario ha sido registrado correctamente con el codigo: $codigo, mucha suerte.</div>");
			mysqli_query($con,"COMMIT;");
		}else{
			echo ("<div class='container-fluid alert alert-success alert-dismissible' role='alert' style='font-size: 2em;'>
						<button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
						Estimado $nombre , Te mencionamos que el codigo: $codigo, ha sido registrado anteriormente</div>");
				mysqli_query($con,"ROLLBACK;");
			}
		mysqli_close($con);
	}

}

?>
