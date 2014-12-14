<?php
require '../../php/sistema.php';
include_once '../../php/alumno.php';
require_once '../../php/grupo.php';
$sistema = new Sistema();
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
            <?php echo headerAlumno('users','SBDA14b',retornanombre()); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <? echo menuLateralGrupo();?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Administrar grupos <small></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Acronimo</th>
                                    <th>Nombre</th>
                                    <th>Ciclo</th>
                                    <th>Tools</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PRO01</td>
                                    <td>Progamacion orientada a objetos</td>
                                    <td>2013 B</td>
                                    <td><a href="grupo-edita.php"><i class="fa fa-fw fa-edit "></i></a><a href=""><i class="fa fa-fw fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>PRO02</td>
                                    <td>Programacion orientada a objetos</td>
                                    <td>2014 B</td>
                                    <td><a href="grupo-edita.php"><i class="fa fa-fw fa-edit "></i></a><a href=""><i class="fa fa-fw fa-trash-o"></i></a></td>
                                </tr>
                                <tr>
                                    <td>SBDA</td>
                                    <td>Seminario de bases de datos</td>
                                    <td>2014 B</td>
                                    <td><a href="grupo-edita.php"><i class="fa fa-fw fa-edit "></i></a><a href=""><i class="fa fa-fw fa-trash-o"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <script src="../../js/bootstrap.min.js"></script>
</body>

</html>
