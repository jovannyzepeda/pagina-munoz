<?php 
session_start();
require_once '../../php/sistema.php';

include_once '../../php/alumno.php';
require_once '../../php/grupo.php';
$sistema = new Sistema();
if(isset($_POST['generaregistro'])){
    base();
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
<?php
    $sistema->imprimeAlertas();
?>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <?php echo headerAlumno('home','Inicio',retornanombre()); ?>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <?php echo menuLateralGrupo(); ?>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <?php
                    $menuActual = 'grupos';
                    $submenuActual = 'elegir';
                    $grupos = new Grupo();
                    switch ($menuActual) {
                        case 'grupos':
                                switch ($submenuActual) {
                                    case 'elegir':
                                        echo '
                                            <!-- Page Heading -->
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h1 class="page-header">
                                                        Selecciona grupo: <small></small>
                                                    </h1>
                                                    <ol class="breadcrumb">
                                                        <li class="active">
                                                            <i class="fa fa-calendar-o"></i> Grupos activos ['.retornafecha().']
                                                        </li>
                                                    </ol>
                                                </div>
                                            </div>
                                            <!-- /.row -->
                                            <div class="row">
                                            ';
                                            //$grupos->imprimeBoxGrupos($grupos->dameGruposCiclo($grupos->getCicloActual()));

                                            $grupos->gruposalumno(retornafecha(),retornanombre());

                                            ///esto es adicional no se donde lo quieran poner retorna todos los grupos para el
                                            //calendario mas reciente
                                            //$grupos->gruposdisponibles(retornafecha());
                                            /*
                                            foreach ($grupos->diasClase(1) as $key => $value) {
                                                echo $value.'<br>';
                                            }*/
                                            echo '
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
<script type="text/javascript">
        function muestra(){
            var profesor = profe.value;
             var info = "profe="+profesor+"&peticion=materia";
             console.log(info);

            $.ajax({
                    url: '../../php/servidor.php',
                    type: 'post',
                    dataType: "json",
                    data: info,
                    success: function(data){
                        var select = document.getElementById("materia");
                        $('select#materia').empty()
                            .append('<option value="0">Seleccione una Curso</option>');
                        for(i in data){
                            var texto = document.createTextNode('NCR: '+data[i].ncr);
                            var option = document.createElement('option');
                            option.setAttribute('value',data[i].idgrupo);
                            option.appendChild(texto);
                            select.appendChild(option);
                        }
                      
                    }
            });
        }
        function datoscurso(){
            var valormateria = materia.value;
             var info = "materia="+valormateria+"&peticion=datos";


            $.ajax({
                    url: '../../php/servidor.php',
                    type: 'post',
                    dataType: "json",
                    data: info,
                    success: function(data){
                            $('input#nombremateria').empty().attr("value",data[0].materia);
                            $('input#hora').empty().attr("value",data[0].horario);
                            
                    }
            });
        }

</script>
</html>
