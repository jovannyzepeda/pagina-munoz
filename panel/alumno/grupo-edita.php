<?php
session_start();
include_once '../../php/alumno.php';
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
                            Editar PRO01 <small></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Seminaio de solucion de bases
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-3">
                                </div>
                                <div class="col-lg-6">
                                    <form role="form">
                                        <div class="form-group">
                                            <label>Nombre de grupo</label>
                                            <input class="form-control" value="Seminario de bases de datos" readonly>
                                            <!--<p class="help-block">Example block-level help text here.</p>-->
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Acronimo de grupo</label>
                                                    <input class="form-control" name="AcronimoGrupo" value="SBDA14b" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Nombre unico de entregables</label>
                                                    <input class="form-control" name="ApellidoNombre" value="HaroSalvatore" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Inicio de curso</label>
                                                    <input class="form-control" name="AcronimoGrupo" value="16/07/2014" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Fin de curso</label>
                                                    <input class="form-control" name="ApellidoNombre" value="10/12/2014" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Equipo</label>
                                                    <input class="form-control" name="Equipo" value="3" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>Alumno</label>
                                                    <select class="form-control">
                                                        <option>Activo</option>
                                                        <option>Darme de baja</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                                    </form>
                                </div>
                                <div class="col-lg-3">
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
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
