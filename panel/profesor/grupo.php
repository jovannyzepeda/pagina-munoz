<?php
//require '../../php/sistema.php';
include_once '../../php/profesor.php';
require_once '../../php/grupo.php';
$sistema = new Sistema();
$id = $_GET['id'];
$con = conectar();
$query = "SELECT profesor, seccion, clave, materia, prefijo, idgrupo, horario,
pdf, id_curso, clave_materia FROM relacionciclo WHERE idgrupo='$id'";
$res = $con->query($query);
$row = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> <?=$row['clave_materia'] ?> </title>
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
      <?php echo headerProfesor('home','Inicio',retornanombre()); ?>
      <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
      <?php echo menuLateralGrupoID($row['idgrupo']); ?>
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
                <h1 class="page-header">'.
                $row['materia'] . ' - '. $row['seccion']
                .'</h1>
                <ol class="breadcrumb">
                  <li class="active">
                    <i class="fa fa-list"></i> Lista curso
                  </li>
                </ol>
                <table class="table">
                <thead>
                <tr>
                <th>Codigo</th>
                <th>Nombre</th>
                </tr>
                </thead>
                <tbody>'.
                listadoAlumnos($row['id_curso'])
                .'</tbody>
                </table>
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
              ';

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
  $(document).ready(function(){
    $('select#materia').hide();
  });
  function activar(){
    $(document).ready(function(){
      $('select#materia').show();
    });
  }
</script>

</html>
<?php $con->close(); ?>
