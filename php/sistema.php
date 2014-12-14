<?php
session_start();
date_default_timezone_set('America/Mexico_City');
require_once 'conexion.php';
require_once 'util.php';

/* CONSTANTES DEL SISTEMA */
define('OFFLINE',0);
define('ONLINE',1);

define('ADMINISTRADOR',1);
define('PROFESOR',2);
define('ALUMNO',3);

define('DIRECTORIO',$_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['PHP_SELF']));
define('CARPETA_IMAGENES',DIRECTORIO.'/img');
define('CARPETA_ARCHIVOS',DIRECTORIO.'/archivos');

define('DATEBASE','localhost');
define('USER_BASE','u514918493_munoz');
define('PASS_USER','luisalberto');
define('DB_NAME','u514918493_sys');

define('CREADORES','SCHOOLSYS');




/* TERMINA CONSTANTES DEL SISTEMA */

class Sistema
{
	var $alertas;

	function __construct(){
		$this->setAlertas();
	}

	function setAlertas(){
		if(!isset($_SESSION['alertas'])){
			$_SESSION['alertas']=serialize(array('NULL'));
		}else{
			if(!is_array(unserialize($_SESSION['alertas']))){
				$_SESSION['alertas']=serialize(array('NULL'));
			}
		}
		$this->alertas=unserialize($_SESSION['alertas']);
	}

	function creaAlerta($mensaje){
		array_push($this->alertas, $mensaje);
	}

	function imprimeAlertas(){
		$iconos = array('info'=>'info',
						'flag' => 'bandera',
						'exclamation' => 'error',
						'user' => 'usuario');
			echo '	<div class="alertas">';
				foreach ($this->alertas as $key => $alerta){
					if(isset($alerta['mensaje']) && $alerta['mensaje']!='' ){
						(!isset($alerta['icono']) || !in_array($alerta['icono'], $iconos))?$alerta['icono']=reset($iconos):0;
						(!isset($alerta['tiempo']) || !is_numeric($alerta['tiempo']))?$alerta['tiempo']=5:0;
						(!isset($alerta['fondo']))?$alerta['fondo']='':$alerta['fondo'] = ' style="background-color:'.$alerta['fondo'].'"';
						$icono = '<i class="fa fa-'.array_search($alerta['icono'], $iconos).'"></i>';
						echo '<div class="alerta" time='.$alerta['tiempo'].' '.$alerta['fondo'].'>'.$icono.' '.$alerta['mensaje'].'</div>';
					}
				}
				unset($_SESSION['alertas']);
				$this->setAlertas();
			echo '	</div>';
		}

	function instalaBase(){
		$con = new mysqli(DATEBASE,USER_BASE,PASS_USER);
		if(mysqli_query($con,"CREATE DATABASE IF NOT EXISTS ".DB_NAME.";"))
			$this->creaAlerta(array('mensaje'=>'Se creo base de datos.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se creo base de datos.','fondo'=>'firebrick'));
		mysqli_close($con);
		$con = conectar();
		$filename = 'docs/'.DB_NAME.'.sql';
		if(!file_exists($filename)){
			$this->creaAlerta(array('mensaje'=>'No se encontro archivo a importar.','fondo'=>'firebrick'));
			return 0;
		}
		$templine = '';
		$lines = file($filename);
		foreach ($lines as $line){
			if (substr($line, 0, 2) == '--' || $line == '')//Salta comentarios
			    continue;

			$templine .= $line;//Agrega linea a query final

			if (substr(trim($line), -1, 1) == ';'){//Checa si acaba el query
			    mysqli_query($con,$templine);
			    //mysqli_query($con,$templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysqli_error($con) . '<br /><br />');
			    $templine = '';//Reset
			}
		}
		$this->creaAlerta(array('mensaje'=>'Tablas importadas correctamente.','fondo'=>'green'));
	}

	function inicializaBase(){
		$con=conectar();
		//Agrego Administrador a usuarios
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`usuario` (`id_usuario`, `nickname`, `codigo`, `password`, `password`, `activo`) VALUES ('1', 'Admin', '111111111', 'super.admin', '1', b'1');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego admin.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se agrego admin.','fondo'=>'firebrick'));
		//Agrego usuario para prfesor
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`usuario` (`id_usuario`, `nickname`, `codigo`, `password`, `privilegio`, `activo`) VALUES ('2', 'Muños', '123456789', 'luisalberto', '2', b'1');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego user profe.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se agrego user profe.','fondo'=>'firebrick'));
		//Agrego profesor
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`profesor` (`codigo`, `nombre`, `id_usuario`, `carrera`) VALUES ('123456789', 'Luis Alberto Muños', '2', 'INCO');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego profe.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se agrego profe.','fondo'=>'firebrick'));
		//Agrego alumno(usuario)
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`usuario` (`id_usuario`, `nickname`, `codigo`, `password`, `password`, `privilegio`, `activo`) VALUES (NULL, 'Alumno', '000000000', 'alumno', '3', b'0');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego user-alumno.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se agrego user-alumno.','fondo'=>'firebrick'));
		//Agrego alumno(alumno)
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`alumno` (`codigo`, `nombre`, `escuela_procedencia`, `promedio_escuela_procedencia`, `id_usuario`) VALUES ('000000000', 'Alumno Del Sistema', NULL, NULL, '3');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego alumno.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>'No se agrego alumno.','fondo'=>'firebrick'));
		//Agrego ciclo
		if(mysqli_query($con,"INSERT INTO  `u514918493_sys`.`ciclo` (`id_ciclo` ,`fecha_inicio` ,`fecha_fin` ,`prefijo`) VALUES (NULL ,  '2014-08-18',  '2014-12-12',  '14B');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego ciclo.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>"No se agrego ciclo.",'fondo'=>'firebrick'));
		//Agrego curso
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`curso` (`id_curso`, `clave`, `nombre`) VALUES (NULL, 'SBDA', 'Seminario de Bases de Datos');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego curso.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>"No se agrego curso.",'fondo'=>'firebrick'));
		//Agrego grupo
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`grupo` (`id_grupo`, `codigo`, `id_curso`, `seccion`, `id_ciclo`) VALUES (NULL, '123456789', '1', '01', '1');"))
			$this->creaAlerta(array('mensaje'=>'Se agrego grupo.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>"No se agrego grupo.",'fondo'=>'firebrick'));
		//Agrega alumno a grupo
		if(mysqli_query($con,"INSERT INTO `u514918493_sys`.`alumno_inscrito` (`id_alumno_inscrito`, `id_grupo`, `codigo`, `activo`, `equipo`) VALUES (NULL, '1', '000000000', '', '5');"))
			$this->creaAlerta(array('mensaje'=>'Alumno inscrito.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>"No se ainscribio alumno.",'fondo'=>'firebrick'));
		//
		mysqli_close($con);
	}

	function destruyeBase(){
		$con=conectar();
		if(mysqli_query($con,'DROP DATABASE '.DB_NAME))
			$this->creaAlerta(array('mensaje'=>'Se elimino base de datos.','fondo'=>'green'));
		else
			$this->creaAlerta(array('mensaje'=>"No se elimino base de datos.",'fondo'=>'firebrick'));
	}

	function resetBase(){
		$this->destruyeBase();
		$this->instalaBase();
		//$this->inicializaBase();
	}

}

function retornanombre(){
    return $_SESSION['usuario']['nombre'];
    //return 'Alumno';
}
function retornafecha(){
	return $_SESSION['usuario']['calendario'];
}
?>
