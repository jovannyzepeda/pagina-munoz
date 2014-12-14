<?php
function conectar(){
$nombre=$_POST['nombre'];
$pass=$_POST['password'];
$con = new mysqli('localhost','root','cruel1293','conectar');
if ($con->connect_errno !='' ){
  	echo "Failed to connect to MySQL " ;
		}else{
$instruccion = mysqli_query($con,"INSERT INTO users(nombre,password) VALUES('$nombre',md5('$pass'))");

mysqli_close($con);
if($instruccion==true){
	echo "Correcta Insercion";
}else echo "No Insertado";}}




function mostrar(){
	$con=  mysqli_connect("localhost","root","cruel1293","conectar");
	$result = mysqli_query($con,"SELECT * FROM users");
	while($row = mysqli_fetch_array($result)) {
  		echo $row['nombre'];
  		echo "       ";
  		echo $row['id'];
  		echo "    <br>    ";
		}
	mysqli_close($con);

}
mostrar();

?>