<?php 
require '../../php/sistema.php';
include_once '../../php/administrador.php';
$sistema = new Sistema();
$sistema->creaAlerta(array('mensaje'=>'Bienvenido Admin!','icono'=>'bandera','tiempo'=>'5'));

$admin=new Administrador();
if(isset($_POST['nuevo_curso'])){
    $admin->nuevoCurso($_POST['clave'],$_POST['nombre'],$_POST['acronimo']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Alumno - ProAdmin</title>
    <link href="../../css/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../css/style.css"/>
    <script type="text/javascript" src="../../js/jquery.min.js"></script>
    <script type="text/javascript" src="../../js/util.js"></script>
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php echo headerAdmin('home','Inicio',retornanombre()); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php echo menuLateralPrincipal(array(0=>'active',1=>'',2=>'')); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php
                    $menuActual = 'grupos';
                    $submenuActual = 'elegir';
                    $administrador = new Administrador();
                    switch ($menuActual) {
                        case 'grupos':
                                switch ($submenuActual) {
                                    case 'elegir':
                                        echo '
                                            <!-- Page Heading -->
                                            <div class="modal fade" id="formCurso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    <h4 class="modal-title" id="exampleModalLabel">Login</h4>
                                                  </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <fieldset class="clearfix">
                                                                <p class="input-group col-md-6 col-xs-6"  style="float: left;"><i class="fa fa-user fa-2x"></i><input class="col-md-13" type="text" name="clave" placeholder="Clave" required></p> 
                                                                <p class="input-group col-md-6 col-xs-6"><i class="fa fa-user fa-2x"></i><input class="col-md-13" type="text" name="acronimo" placeholder="Acronimo" required></p> 
                                                                <p class="input-group col-md-12"><i class="fa fa-user fa-2x"></i><input class="col-xs-12" type="text" name="nombre" placeholder="Nombre" required></p> 
                                                                <hr>
                                                                <div class="col-md-4 col-xs-3"></div>
                                                                <div class="col-md-4 col-xs-6">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="nuevo_curso">Registrar</button>
                                                                </div>
                                                                <div class="col-md-4 col-xs-3"></div>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- termina modal -->
                                            <div class="row">
                                            	<div class="col-md-10 col-md-offset-1">
                                            	<hr>
                                            	<h2>Cursos</h2>
                                                <p style="float:right"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#formCurso">Nuevo</button></p>
                                            	<hr>
                                            		<table class="table table-striped">
												      <thead>
												        <tr>
												          <th>ID</th>
												          <th>Clave</th>
												          <th>Nombre</th>
												          <th>Grupos</th>
												          <th>Opciones</th>
												        </tr>
												      </thead>
												      <tbody>';
												      if($cursos = $administrador->getCursos()){
												      	foreach ($cursos as $key => $curso) {
												      		echo '
												      			<tr>
														          <td>'.$curso['id_curso'].'</td>
														          <td>'.$curso['clave'].'</td>
														          <td>'.$curso['nombre'].'</td>
														          <td>'.$administrador->getGruposDeCurso($curso['id_curso']).'</td>
														          <td><a href=""><i class="fa fa-pencil-square-o"></i> <i class="fa fa-trash"></i></a></td>
														        </tr>
												      		';
												      	}
												      }else{
												      	echo '<tr><td=99>No hay cursos agregados.</td></tr>';
												      }
												      echo '
												      </tbody>
												    </table>
												</div>
                                            </div>
                                            <!-- /.row -->
                                            ';
                                        break;
                                    
                                    default:
                                        echo 'Fuera del menu';
                                        break;
                                }
                            break;
                        default:
                            echo 'Fuera del menu';
                            break;
                    }
                ?>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>
