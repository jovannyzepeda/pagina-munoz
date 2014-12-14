<?php
class Alumno
{

	function __construct()
	{

	}



}

function headerAlumno($icono,$titulo,$user){
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
                       '. llenar_ul_superior(retornafecha(),$user).'
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

function menuLateralGrupo(){
    $html = '
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-users"></i> Grupos<i class="fa fa-fw fa-caret-down"></i></a>
                    <ul id="demo" class="collapse">
                        <li>
                            <a href="index.php">Elegir</a>
                        </li>
                        <li>
                            <a href="grupos.php">Administrar</a>
                        </li>
                        <li>
                            <a href="#registrar" data-toggle="modal">Registrar nuevo grupo Calendario actual ('.retornafecha().')</a>
                                                    <div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                                <h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrarse en un grupo</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="" method="post" enctype="multipart/form-data">
                                                                    <fieldset class="clearfix">
                                                                        <p class="input-group col-md-12 col-xs-12"><i class="fa fa-calendar fa-2x"></i> Calendario :  
                                                                        <select name="calendario" id="calendario" style="margin-left:5%"><option>Selecciona un Calendario</option>
                                                                        <option id="calendario">'.retornafecha().'</option></select></p>
                                                                        <p class="input-group col-md-12 col-xs-12"><i class="fa fa-user fa-2x"></i> Profesor :  
                                                                        <select name="profesor" id="profe" style="margin-left:8%" onchange="muestra()">
                                                                        '.crear_select_profesor().'</select></p>
                                                                        <p class="input-group col-md-12 col-xs-12" id="curs"><i class="fa fa-book fa-2x"></i> Curso : 
                                                                        <select name="grupo" id="materia" style="margin-left:10%" onchange="datoscurso()">
                                                                        <option>Selecciona una Curso</option></select></p>
                                                                        <div class="input-group col-md-12 col-xs-12"><i class="fa fa fa-tasks fa-2x fa-2x"></i> Materia :  
                                                                        <input type = "text" name="materia" id="nombremateria" style="margin-left:8%; width:45%;
                                                                        border-radius:10px;" disabled></div>
                                                                        <div class="input-group col-md-12 col-xs-12"><i class="fa fa-clock-o fa-2x"></i> Horario :  
                                                                        <input type="text" name="horario" id="hora" style="margin-left:9%;width:45%;border-radius:10px;"disabled/></div>
                                                                        <hr>
                                                                        <div class="col-md-4 col-xs-3"></div>
                                                                        <div class="col-md-4 col-xs-6">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            <button type="submit" class="btn btn-primary" name="generaregistro">Registrar</button>
                                                                        </div>
                                                                        <div class="col-md-4 col-xs-3"></div>
                                                                    </fieldset>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                        </li>
												<li>
													<a href="../../php/descargaExcel.php" target="_blank">Descarga excel</a>
												</li>
                    </ul>
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
function llenar_ul_superior($ciclo,$user){
    $con = conectar();
            $query="SELECT * FROM alumno_grupo WHERE prefijo ='$ciclo' AND nombre = '$user'";
            $result = mysqli_query($con,$query);
            $a='';
            while($row = mysqli_fetch_array($result)) {
                $a.= '<li><a href="grupo.php?id='.$row['idgrupo'].'">'.$row['clave_materia'].'</a> </li>';
            }
            mysqli_close($con);
            return $a;
}
function crear_select_profesor(){
    $con = conectar();
    $result = mysqli_query($con,"SELECT * FROM profesor");
    $html = '<option>Selecciona un Profesor</option>';
    while($row = $result->fetch_assoc()){
         $html.="<option >".$row['nombre']."</option>";
    }
    mysqli_close($con);
    return $html;
}
function base(){
   $idgrupo = $_POST['grupo'];
   $codigo =  $_SESSION["usuario"]["codigo"];
   $con = conectar();
   mysqli_query($con,"INSERT INTO alumno_inscrito(id_grupo,codigo) VALUES('$idgrupo','$codigo')");
   mysqli_close($con);
}

?>
