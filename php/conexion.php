<?php

function conectar(){
	$con = new mysqli(DATEBASE,USER_BASE,PASS_USER,DB_NAME);
	if ($con->connect_errno !='' ){
	  	echo "Failed to connect to MySQL ";
	}
	return $con;
}

?>
