<?php
require 'sistema.php';
$sistema = new Sistema();
$funcion = $_POST['peticion'];
    //conexion a base de datos
switch ($funcion) {
	case 'materia':
		materia();
		break;
	case 'datos':
		datos();
	break;
}
function materia(){
	$profes = $_POST['profe'];
	$fecha = retornafecha();
	$con = new mysqli('localhost','u514918493_munoz','luisalberto','u514918493_sys');
	if ($con->connect_errno !='' ){
	  	echo "Failed to connect to MySQL ";
	}else{
	$consulta = "SELECT * FROM relacionciclo WHERE profesor = '$profes' AND prefijo = '$fecha'";
		$resultado = $con->query($consulta);
	while ($row = $resultado->fetch_assoc()) {
		$alumnos[] = $row;
	}
	echo json_encode($alumnos);
	mysqli_close($con);}
}
function datos(){
	$id = $_POST['materia'];
	$con = new mysqli('localhost','u514918493_munoz','luisalberto','u514918493_sys');
	if ($con->connect_errno !='' ){
	  	echo "Failed to connect to MySQL ";
	}else{
	$consulta = "SELECT * FROM relacionciclo WHERE idgrupo = $id";
		$resultado = $con->query($consulta);
	while ($row = $resultado->fetch_assoc()) {
		$alumnos[] = $row;
	}
	echo json_encode($alumnos);
	mysqli_close($con);}
}
	
?> 