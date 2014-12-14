<?php
require_once 'sistema.php';
//require_once 'grupo.php';
class Profesor
{

	function __construct()
	{

	}



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
																<h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrar nuevo grupo</h4>
															</div>
															<div class="modal-body">
																<form action="" method="post" enctype="multipart/form-data">
																	<fieldset class="clearfix">
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-calendar fa-2x"></i> Calendario :
																		<select name="calendario" id="calendario" onchange="activar()" style="margin-left:5%">'
																		.crea_select_calendario().'</select></p>
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-book fa-2x"></i> Curso :
																		<select name="curso" style="margin-left:10%" id="materia">'.crea_select_materia().'</select></p>
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-university fa-2x"></i> Sección:
																		<input type="text" name="seccion" placeholder="sección" required style="width: 10%;margin-left:8%;">
																		</p> <!-- JS because of IE support; better: placeholder="seccion" -->
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-clock-o fa-2x"></i> Salon y Horario:
																		<input type="text" name="horario" placeholder="X-17 Martes - Jueves  - 9 AM." required style="width:
																		60%;margin-left:1%;"></p> <!-- JS because of IE support; better: placeholder="horario" -->
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-file-pdf-o fa-2x"></i> PDF DE ALUMNOS :
																		</p><input type="file" name ="file"  accept="application/pdf,text/plain"/>
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
											</li>
											<li>
												<a href="#registrar_txt" data-toggle="modal">Registrar nuevo grupo con txt</a>
												<div class="modal fade" id="registrar_txt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog">
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
																<h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrar nuevo grupo</h4>
															</div>
															<div class="modal-body">
																<form action="" method="post" enctype="multipart/form-data">
																	<fieldset class="clearfix">
																	
																		<p class="input-group col-md-12 col-xs-12"><i class="fa fa-file-text-o fa-2x"></i> TXT DEL PDF :
																		</p><input type="file" name ="file_txt"  accept="application/pdf,text/plain"/>
																		<hr>
																		<div class="col-md-4 col-xs-3"></div>
																		<div class="col-md-4 col-xs-6">
																			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
																			<button type="submit" class="btn btn-primary" name="registro_txt">Registrar</button>
																		</div>
																		<div class="col-md-4 col-xs-3"></div>
																	</fieldset>
																</form>
															</div>
														</div>
													</div>
												</div>
											</li>
									</ul>
							</li>
					</ul>
			</div>
	';
	return $html;
}

function headerProfesor($icono,$titulo,$user){
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

												'.llenar_ul_superior(retornafecha(),$user).'
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
														<a href="../../"><i class="fa fa-fw fa-power-off"></i> Salir</a>
												</li>
										</ul>
								</li>
						</ul>
	';

	return $html;
}
function crea_select_calendario(){
	$con = conectar();
	$result = mysqli_query($con,"SELECT * FROM ciclo LIMIT 2");
	$html = '<option>Selecciona un calendario</option>';
	while($row = $result->fetch_assoc()){
		 $html.="<option value=".$row['id_ciclo'].">".$row['prefijo']."</option>";
	}
	//mysql_close($con);
	$con->close();
	return $html;

}
function crea_select_materia(){
	$con = conectar();
	$result = mysqli_query($con,"SELECT * FROM curso");
	$html = '<option>Selecciona una materia</option>';
	while($row = $result->fetch_assoc()){
		 $html.="<option value=".$row['id_curso'].">".$row['nombre']."</option>";
	}
	//mysql_close($con);
	$con->close();
	return $html;
}
function llenar_ul_superior($ciclo,$user){
	$con = conectar();
			$query="SELECT * FROM relacionciclo WHERE prefijo ='$ciclo' AND profesor = '$user'";
			$result = mysqli_query($con,$query);
			$a='';
			while($row = mysqli_fetch_array($result)) {
				$a.= '<li><a href="grupo.php?id='.$row['idgrupo'].'">'.$row['clave_materia'].'</a> </li>';
			}
			//mysqli_close($con);
			$con->close();
			return $a;

}
function mover_archivos_servidor_base_datos(){
	chmod("pdf/", 777);
	$con = conectar();
	$user =$_SESSION["usuario"]["codigo"]; $curso = $_POST['curso'];$seccion=$_POST['seccion'];
	$calendario=$_POST['calendario'];$horario=$_POST['horario'];
    $maxid = mysqli_query($con,"SELECT MAX(id_grupo) AS id FROM grupo");
	if ($value = mysqli_fetch_row($maxid)) {
		$id = trim($value[0]) +1;
	}
	$directorio = '../../pdf/'.$calendario.'/'.$curso.'/'.$id.'/'; 
				mkdir($directorio, 0777,true); 
	if ($_FILES["file"]["error"] > 0){
                     return "Problema al guardar el archivo " . $_FILES["file"]["error"] . " en el servidor";
              }
              else{
              	if (file_exists($directorio . $_FILES["file"]["name"])){
                           return  "Problema al guardar el archivo " . $_FILES["file"]["error"] . "
                           intente nuevamente";
                    }
                else{
	  				move_uploaded_file($_FILES['file']['tmp_name'],$directorio. $_FILES['file']['name']);
	  				$archivo='pdf/'.$calendario.'/'.$curso.'/'.$id.'/' . $_FILES['file']['name'];
	  				
	  				$query = "INSERT INTO grupo(codigo,id_curso,seccion,id_ciclo,
	  					horario,pdf) VALUES('$user',$curso,'$seccion',
	  					$calendario,'$horario','$archivo')";
	  				$res=mysqli_query($con,$query);
	  				return  "Operacion realizada correctemente";
  				}

				}
				mysqli_close($con);
}
function menuLateralGrupoID($id){
	$con = conectar();
	$query = "SELECT clave_materia, materia, idgrupo FROM relacionciclo WHERE idgrupo = '$id'";
	$res = $con->query($query);
	$row = $res->fetch_assoc();
	$html = '
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
	<li class="active">
	<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-book"></i> '.$row['clave_materia'].'
	<i class="fa fa-fw fa-caret-down"></i></a>
	<ul id="demo" class="collapse">
	<li>
	<a href="administrar.php?id='.$row['idgrupo'].'">Administrar</a>
	</li>
	<li>
	<a href="evaluando.php?id='.$row['idgrupo'].'">Evaluandos</a>
	</li>
	<li>
	<a href="../php/descargaExcel.php" data-toggle="modal">Excel</a>
	<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrar nuevo grupo</h4>
	</div>
	<div class="modal-body">
	<form action="" method="post" enctype="multipart/form-data">
	<fieldset class="clearfix">
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-calendar fa-2x"></i> Calendario :
	<select name="calendario" id="calendario" onchange="activar()" style="margin-left:5%">'
	.crea_select_calendario().'</select></p>
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-book fa-2x"></i> Curso :
	<select name="curso" style="margin-left:10%" id="materia">'.crea_select_materia().'</select></p>
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-university fa-2x"></i> Sección:
	<input type="text" name="seccion" placeholder="sección" required style="width: 10%;margin-left:8%;">
	</p> <!-- JS because of IE support; better: placeholder="seccion" -->
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-clock-o fa-2x"></i> Salon y Horario:
	<input type="text" name="horario" placeholder="X-17 Martes - Jueves  - 9 AM." required style="width:
	60%;margin-left:1%;"></p> <!-- JS because of IE support; better: placeholder="horario" -->
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-file-pdf-o fa-2x"></i> PDF DE ALUMNOS :
	</p><input type="file" name ="file"  accept="application/pdf,text/plain"/>
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
</li>
</ul>
</li>
</ul>
</div>
';
return $html;
}
function menuLateralGrupoAdministra($id){
	$con = conectar();
	$query = "SELECT clave_materia, materia FROM relacionciclo WHERE idgrupo = '$id'";
	$res = $con->query($query);
	$row = $res->fetch_assoc();
	$html = '
	<div class="collapse navbar-collapse navbar-ex1-collapse">
	<ul class="nav navbar-nav side-nav">
	<li class="active">
	<a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-book"></i>'.$row['clave_materia'].'
	<i class="fa fa-fw fa-caret-down"></i></a>
	<ul id="demo" class="collapse">
	<li>
	<a href="alumno.php">Alumnos</a>
	</li>
	<li>
	<a href="evaluando.php">Evaluandos</a>
	</li>
	<li>
	<a href="../php/descargaExcel.php" data-toggle="modal">Excel</a>
	<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
	<div class="modal-content">
	<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
	<h4 class="modal-title" id="exampleModalLabel" style="text-align: center;">Registrar nuevo grupo</h4>
	</div>
	<div class="modal-body">
	<form action="" method="post" enctype="multipart/form-data">
	<fieldset class="clearfix">
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-calendar fa-2x"></i> Calendario :
	<select name="calendario" id="calendario" onchange="activar()" style="margin-left:5%">'
	.crea_select_calendario().'</select></p>
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-book fa-2x"></i> Curso :
	<select name="curso" style="margin-left:10%" id="materia">'.crea_select_materia().'</select></p>
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-university fa-2x"></i> Sección:
	<input type="text" name="seccion" placeholder="sección" required style="width: 10%;margin-left:8%;">
	</p> <!-- JS because of IE support; better: placeholder="seccion" -->
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-clock-o fa-2x"></i> Salon y Horario:
	<input type="text" name="horario" placeholder="X-17 Martes - Jueves  - 9 AM." required style="width:
	60%;margin-left:1%;"></p> <!-- JS because of IE support; better: placeholder="horario" -->
	<p class="input-group col-md-12 col-xs-12"><i class="fa fa-file-pdf-o fa-2x"></i> PDF DE ALUMNOS :
	</p><input type="file" name ="file"  accept="application/pdf,text/plain"/>
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
</li>
</ul>
</li>
</ul>
</div>
';
return $html;
}
function listadoAlumnos($curso){
	$con = conectar();
	$curso = $_GET['id'];
	$query = "SELECT codigo, nombre FROM alumno_grupo WHERE idgrupo='$curso'";
	$res = $con->query($query);
	$html = '';
	while($row = $res->fetch_assoc()){
		$html .= '<tr><th>'.$row['codigo'].'</td><td>'.$row['nombre'].'</td></tr>';
	}
	return $html;
}

function grupo_de_txt(){
	$user = $_SESSION["usuario"]["codigo"]; 
	$encontrado=leeTXT($_FILES["file_txt"]['tmp_name']);
	/*
	echo $encontrado['profesor'].'<br>';
	echo $encontrado['materia'].'<br>';
	echo 'Seccion = '.$encontrado['seccion'].'<br>';
	echo $encontrado['ciclo'].'<br>';
	echo 'Hora inicio = '.$encontrado['hora_ini'].'<br>';
	echo 'Hora fin = '.$encontrado['hora_fin'].'<br>';
	echo 'Dias clase = ';foreach ($encontrado['dias'] as $key => $dia)echo $dia.' ';echo '<br>';
	echo 'Alumnos...<br>';
	foreach ($encontrado['alumnos'] as $key => $value) {
		echo $value['clave'].' - '.$value['materia'].' - '.$value['nombre'].'<br>';
	}
	break;
	*/
	$con = conectar();
	$curso = trim($encontrado['materia']);
	$curso=mysqli_fetch_array(mysqli_query($con,$q="SELECT * FROM curso WHERE nombre LIKE '%$curso%' "));
	$curso=$curso['id_curso'];
	$seccion=$encontrado['seccion'];
	$calendario=trim($encontrado['ciclo']);
	$calendario=mysqli_fetch_array(mysqli_query($con,$q2="SELECT * FROM ciclo WHERE prefijo LIKE '%$calendario%' "));
	$calendario=$calendario['id_ciclo'];
	$dias='';
	foreach ($encontrado['dias'] as $key => $dia) {
		$dias .= $dia.'-';
	}
	$horario=$dias;
		$con = conectar();
		if ($_FILES["file_txt"]["error"] > 0){
	         return "Problema al guardar el archivo " . $_FILES["file_txt"]["error"] . " en el servidor";
		}else{
			$query = "INSERT INTO grupo(codigo,id_curso,seccion,id_ciclo,horario)
			 VALUES('$user',$curso,'$seccion',$calendario,'$horario')";
			if($res=mysqli_query($con,$query)){
			}else{
			}
			mysqli_close($con);
			return  "Operacion realizada correctemente";
		}
}

function leeTxt($archivo){
		$fh = fopen($archivo,'r');
		$encuentra=array('profesor'=>1,'materia'=>1,'ciclo_anio'=>1,'ciclo_letra'=>1,'profesor'=>1,'hora_ini'=>1,'hora_fin'=>1,'dias'=>1,'seccion'=>0);
		$encontrado=array('ciclo'=>0,'materia'=>0,'profesor'=>0,'alumnos'=>array(),'hora_ini'=>'','hora_fin'=>'','dias'=>'','seccion'=>'');
		$nombres=$materias=array();
		while ($line = fgets($fh)) {
			if($encuentra['ciclo_anio'] && $x=getPalabra($line,'CICLO:',"\x0") ){
				$encontrado['ciclo']=trim($x);
				$encuentra['ciclo_anio']=0;
			}elseif($encuentra['ciclo_letra'] && strlen($line)==3  ){
				$encontrado['ciclo'] .= '-'.$line;
				$encuentra['ciclo_letra']=0;
			}elseif($encuentra['materia'] && $x=getPalabra($line,'Materia:',"\x0")){
				$encontrado['materia']=$x;
				$encuentra['materia']=0;
			}elseif($encuentra['profesor'] && $x=getPalabra($line,'Profesor:',"\x0")){
				$encontrado['profesor']=str_replace("~", "N", $line);
				$encuentra['profesor']=0;
			}elseif(strlen($line)==11 && is_numeric(trim($line)) ){//Es clave de alumno
				array_push($encontrado['alumnos'], array('clave'=>$line, 'materia'=>'', 'nombre'=>''));
			}elseif(strlen($line)>15 && substr_count($line, ' ')>=2 ){//Nombres de alumnos
				array_push($nombres, $line);
			}elseif(strlen($line)==6 && ctype_alpha(trim($line)) && (trim($line)!='DIAS' && trim($line)!='AULA') ){//Carreras de alumnos
				array_push($materias, $line);
			}elseif( $encuentra['hora_ini'] && (strlen($line)==7 && $line[2]==':') ){//Hora inicio
				$encontrado['hora_ini']=$line;
				$encuentra['hora_ini']=0;
			}elseif( $encuentra['hora_fin'] && (strlen($line)==7 && $line[2]==':') ){//Hora fin
				$encontrado['hora_fin']=$line;
				$encuentra['hora_fin']=0;
			}elseif( ($encuentra['hora_ini']==0 && $encuentra['hora_fin']==0) && ($encuentra['dias'] && !substr_count($line, '.')) ){//Dias clase
				$encontrado['dias']=explode(' ', $line);
				$encuentra['dias']=0;
			}else{0;}

			if($x=getPalabra($line,'Secc:',"\x0") ){// obtiene seccion
				$encontrado['seccion']=$x;
				$encuentra['seccion']=0;
			}else{0;}

		

		}
		foreach ($encontrado['alumnos'] as $key => $value) {//junta info del alumno
			$encontrado['alumnos'][$key]['materia']=$materias[$key];
			$encontrado['alumnos'][$key]['nombre']=$nombres[$key];
		}
		fclose($fh);
		return $encontrado;
	}
?>
