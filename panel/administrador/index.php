<?php 
require '../../php/sistema.php';
include_once '../../php/administrador.php';
$sistema = new Sistema();
$sistema->creaAlerta(array('mensaje'=>'Bienvenido Admin!','icono'=>'bandera','tiempo'=>'5'));
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
            <?php echo menuLateralPrincipal(); ?>
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
                                            <div class="row">
                                            	<div class="col-md-10 col-md-offset-1">
                                            	<hr>
                                            	<h2>Hola! '.$_SESSION['usuario']['nombre'].'</h2>
                                            	 Hola admin
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
