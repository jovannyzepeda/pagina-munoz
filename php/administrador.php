<?php

class Administrador
{

	function __construct()
	{
		
	}

    function nuevoCurso($clave,$nombre,$acronimo){
        $con = conectar();
        $query = "INSERT INTO curso (id_curso, clave, nombre, clave_materia) VALUES (NULL, '$clave', '$nombre', '$acronimo');";
        if($con->query($query)){
            echo "<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                        <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                        INSERCCION CORRECTA! </div>";
        }else{
            echo "<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                        <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                        FALLO AL INSERTAR! </div>";
        }
        mysqli_close($con);
    }

    function nuevoProfe($nombre,$carrera,$nickname,$codigo,$password,$password2){
        $con=conectar();
        if($password==$password2){
            mysqli_query($con,"BEGIN;");
            mysqli_query($con, "INSERT INTO usuario(codigo,password,nickname,privilegio)values('$codigo','$password','$nombre','2')");
            $id=mysqli_insert_id($con);
            if(mysqli_query($con,"INSERT INTO profesor(codigo,nombre,id_usuario,carrera) values('$codigo','$nombre'
                ,$id,'$carrera')")){
                echo ("<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                            <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                            Profesor registrado correctamente!</div>");
                mysqli_query($con,"COMMIT;");
            }else{
                echo ("<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                            <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                            Error al agregar usuario</div>");
                    mysqli_query($con,"ROLLBACK;");
                }
            mysqli_close($con);
        }
    }

    function nuevoTipo($nombre,$prefijo){
        $con=conectar();
        $query="INSERT INTO tipo_evaluando (id_tipo_evaluando, nombre, prefijo) VALUES (NULL, '$nombre', '$prefijo')";
        if($con->query($query)){
            echo "<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                        <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                        INSERCCION CORRECTA! </div>";
        }else{
            echo "<div class='container-fluid alert alert-success alert-dismissible text-center' role='alert' style='font-size: 2em;'>
                        <button type='button' class='close' data-dismiss='alert'><span aria-hidden='true'>×</span><span class='sr-only'>Close</span></button>
                        FALLO AL INSERTAR! </div>";
        }
        mysqli_close($con);
    }

    /*

    */
	function getCursos(){
		$con=conectar();
		$result = mysqli_query($con,"SELECT * FROM curso");
		if(mysqli_num_rows($result)){
			while($curso=mysqli_fetch_assoc($result)){
				$cursos[]=$curso;
			}
			return $cursos;
		}else{
			return 0;
		}
	}

    function getProfesores(){
        $con=conectar();
        $result = mysqli_query($con,"SELECT * FROM profesor");
        if(mysqli_num_rows($result)){
            while($profesor=mysqli_fetch_assoc($result)){
                $profesores[]=$profesor;
            }
            return $profesores;
        }else{
            return 0;
        }
    }

    function getTipos(){
        $con=conectar();
        $result = mysqli_query($con,"SELECT * FROM tipo_evaluando");
        if(mysqli_num_rows($result)){
            while($tipo=mysqli_fetch_assoc($result)){
                $tipos[]=$tipo;
            }
            return $tipos;
        }else{
            return 0;
        }
    }

	function getGruposDeCurso($id_curso){
		$con=conectar();
		$grupos = mysqli_num_rows(mysqli_query($con,"SELECT * FROM grupo WHERE id_grupo='$id_curso' "));
		if($grupos)
			return $grupos;
		else
			return 0;
	}

}

function headerAdmin($icono,$titulo,$user){
	$html = '
		<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><i class="fa fa-fw fa-'.$icono.'"></i> '.$titulo.'</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw fa-users"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">SBDA14b <span class="label label-primary">1</span></a>
                        </li>
                        <li>
                            <a href="#">PRO01 <span class="label label-primary">3</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grupos.php">todos los grupos</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> '. $user.' <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-user"></i> Cuenta</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Config.</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../../php/logout.php"><i class="fa fa-fw fa-power-off"></i> Salir</a>
                        </li>
                    </ul>
                </li>
            </ul>
	';

	return $html;
}
 
function menuLateralPrincipal($activo=array(0=>'',1=>'',2=>'')){
    $html = '
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="'.$activo[0].'">
                    <a href="cursos.php" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Cursos</a>
                </li>
                <li class="'.$activo[1].'">
                    <a href="profesores.php" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Profesores</a>
                </li>
                <li class="'.$activo[2].'">
                    <a href="tipos.php" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Tipo Evaluandos</a>
                </li>
            </ul>
        </div>
    ';
    return $html;
}

function menuLateralEvaluando(){
    $html = '
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Grupos<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="grupo.php"><i class="fa fa-fw fa-table"></i> Evaluandos</a>
                </li>
                <li>
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-cloud-download"></i> Archivos<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="archivo.php">Excel</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="index.php"><i class="fa fa-fw fa-mail-reply"></i> Cerrar grupo</a>
                </li>
            </ul>
                </li>
            </ul>
        </div>
    ';
    return $html;
}

?>