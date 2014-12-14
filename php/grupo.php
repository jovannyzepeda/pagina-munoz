<?php
class Grupo{
	var $grupoActual,
		$cicloActual;

	function __construct(){
		$this->setCicloActual();
	}

	function setCicloActual(){
		$mes = date('m');
		$anio = date('Y');
		($mes<=6)?$semestre='-A':$semestre='-B';
		$this->cicloActual=$anio.$semestre;
	}

	function getCicloActual(){
		$con = conectar();
		return $this->cicloActual;
	}

	function dameGruposCiclo($ciclo){
		$tipoUsuario=$_SESSION['usuario']['tipo'];
		$con=conectar();
		$result='bla';
		$id_cicloActual = reset(mysqli_fetch_array(mysqli_query($con,"SELECT id_ciclo FROM ciclo WHERE prefijo='$ciclo' ")));
		if($tipoUsuario==ALUMNO){
			$alumnoActual = $_SESSION["usuario"]["codigo"];
			$result = mysqli_query($con,"SELECT * FROM grupo WHERE id_ciclo='$id_cicloActual' AND id_grupo IN (SELECT id_grupo FROM alumno_inscrito WHERE codigo = '$alumnoActual' )");
		}elseif($tipoUsuario==PROFESOR){
			$profesorActual = $_SESSION["usuario"]["codigo"];
			$result = mysqli_query($con,$query = "SELECT * FROM grupo WHERE codigo='$profesorActual' AND id_ciclo='$id_cicloActual'");
		}else return 0;

		if($rows=mysqli_num_rows($result)){
			return mysqli_fetch_array($result);
		}else return 0;
	}
	function gruposdisponibles($ciclo,$user){
			$con = conectar();
			$query="SELECT *
			FROM relacionciclo WHERE prefijo ='$ciclo' AND profesor = '$user'";
			$result = mysqli_query($con,$query);
			while($row = mysqli_fetch_array($result)) {
				echo '
	            <div class="col-lg-6 col-md-6">
	                <a href="grupo.php?id='.$row['idgrupo'].'">
	                    <div class="panel panel-blue2">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-users fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">'.strtoupper($row['clave'].' '.$row['seccion']).'</div>
	                                    <div>'.ucfirst($row['materia']).'<br>'.$row['horario'].'</div>
	                                </div>
	                            </div>
	                        </div>

	                            <div class="panel-footer">
	                                <span class="pull-left">Entrar</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>

	                    </div>
	                </a>
	            </div>
			';
			}
			//mysql_close($con);
			$con->close();

		}
	function gruposalumno($ciclo,$nombre){
			$con = conectar();
			$result = mysqli_query($con,"SELECT idgrupo,clave,seccion,materia,prefijo,equipo
			FROM alumno_grupo WHERE prefijo ='$ciclo' AND nombre = '$nombre'");
			while($row = mysqli_fetch_array($result)){
				echo '
	            <div class="col-lg-6 col-md-6">
	                <a href="grupo.php?id='.$row['idgrupo'].'">
	                    <div class="panel panel-blue2">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-users fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">'.strtoupper($row['clave'].' '.$row['seccion']).'</div>
	                                    <div>'.ucfirst($row['materia']).'</div>
	                                </div>
	                            </div>
	                        </div>

	                            <div class="panel-footer">
	                                <span class="pull-left">Entrar</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>

	                    </div>
	                </a>
	            </div>
			';
			//echo ' Materia: '.$row['materia'].'  Equipo: '.$row['equipo'].'  Calendario:'.$row['prefijo']."<br>";
			}
			mysqli_close($con);

	}
	function imprimeBoxGrupo($grupo){
		if(is_array($grupo)){
			$con=conectar();
			$id_curso = $grupo['id_curso'];
			$query="SELECT * FROM curso WHERE id_curso='$id_curso' ";
			$curso = mysqli_fetch_array(mysqli_query($con,$query));
			echo '
	            <div class="col-lg-6 col-md-6">
	                <a href="grupo.php?id='.$grupo['id_grupo'].'">
	                    <div class="panel panel-blue2">
	                        <div class="panel-heading">
	                            <div class="row">
	                                <div class="col-xs-3">
	                                    <i class="fa fa-users fa-5x"></i>
	                                </div>
	                                <div class="col-xs-9 text-right">
	                                    <div class="huge">'.strtoupper($curso['clave'].$grupo['seccion']).'</div>
	                                    <div>'.ucfirst($curso['nombre']).'<br>Pendientes <span class="label label-primary">2</span></div>
	                                </div>
	                            </div>
	                        </div>

	                            <div class="panel-footer">
	                                <span class="pull-left">Entrar</span>
	                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                                <div class="clearfix"></div>
	                            </div>

	                    </div>
	                </a>
	            </div>
			';
		}else{
			return 0;
		}

	}

	function imprimeBoxGrupos($grupos){
		if(is_array($grupos)){
			if(is_array(reset($grupos))){
				foreach ($grupos as $key => $grupo) {
					$this->imprimeBoxGrupo($grupo);
				}
			}else{
				$this->imprimeBoxGrupo($grupos);
			}
		}else{
			return 0;
		}
	}

	function diasClase($id_grupo=0){
		if($id_grupo){
			$prefijos_pdf2php = array('L'=>1,
									'M'=>2,
									'I'=>3,
									'J'=>4,
									'V'=>5,
									'S'=>6,
									'D'=>7);
			$prefijos_recuperados = array('L','S');//Hacer query del grupo y obtener dias
			$startDate = strtotime("2014-01-14");//Query y Obtener dias del ciclo
			$endDate = strtotime("2014-06-15");

			for ( $date = $startDate; $date <= $endDate; $date += 60 * 60 * 24)
			{
				foreach($prefijos_recuperados as $key => $value){
					if ( strftime('%w', $date) == $prefijos_pdf2php[$value] )
			        	$dias_clase[] = strftime('%A %Y-%m-%d', $date);
				}

			}
			return $dias_clase;
		}else{
			return 0;
		}

	}

	function creaGrupo($curso,$seccion,$profesor,$ciclo){
		$con=conectar();
	}

	function actividadesgrupo($section){
			$con = conectar();
			$idgrupo = $_GET['id'];
			if($section ==="recientes"){
			$query="SELECT * FROM actividades where idgrupo = $idgrupo AND liberado = 1 AND curdate() <= fecha_limite";
			}
			else {
				$query="SELECT * FROM actividades where idgrupo = $idgrupo AND liberado = 1 AND curdate() > fecha_limite";
			}
			$result = mysqli_query($con,$query);
			while($row = mysqli_fetch_array($result)) {
				$caso = $row['prefijo'];
				echo '<div class="col-lg-3 col-md-6">';
				if($section ==="recientes"){
					       echo ' <span class="evaluando-complete">
					            <i class="fa fa-fw fa-star fw-inverse borde"></i>
					            <i class="fa fa-fw fa-star fw-inverse icon"></i>
					        </span>
					        <a href="evaluando.php?p='.$row['prefijo'].'&a='.$row['numero_consecutivo_tipo'].'&g='.$idgrupo.'">';
				}
				switch ($caso) {
					case 'P': case 'p':
						echo '
					            <div class="panel panel-green trans-7">
					                 ';
					break;
					case 'E': case 'e':    
					    echo '
		                        <div class="panel panel-red">
		                            ';
                	break;
                	case 'J': case 'j': 
		                echo '
		                        <div class="panel panel-blue">
		                          ';
	                break;
	                case 'A': case 'a':
		                echo '
		                        <div class="panel panel-blue">
		                           ';
		            break;
		             default:
		            	echo '
					            <div class="panel panel-green trans-7">
					                ';
		            break;
		            
		    }
		    echo '<div class="panel-heading">
					                    <div class="row">
					                        <div class="col-xs-3">
					                            <i class="fa fa-file-pdf-o fa-5x"></i>
					                        </div>
					                        <div class="col-xs-9 text-right">
					                            <div class="huge">'.$row['prefijo'].$row['numero_consecutivo_tipo'].'</div>
					                            <div>['.$row['nombre_evaluando'].']<br><i class="fa fa-fw fa-clock-o"></i> 
					                            Limite: '.$row['fecha_limite'].'</div>
					                        </div>
					                    </div>
					                </div>
					                
					                    <div class="panel-footer">
					                        <span class="pull-left">Ver mas</span>
					                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
					                        <div class="clearfix"></div>
					                    </div>
					                
					            </div>';
					           if($section ==="recientes")
					        echo '</a>';
					        
					   echo '</div>';

		}
		mysqli_close($con);
	}
}
?>
