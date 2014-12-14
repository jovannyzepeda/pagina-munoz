<?php

class Evaluando{

  function carga_elementos_base(){
	$p=$_GET['p'];
	$a=$_GET['a'];
	$g=$_GET['g'];
	$con = conectar();
	$query = "SELECT * FROM actividades WHERE prefijo = '$p' AND numero_consecutivo_tipo=$a AND idgrupo=$g";
    $result = $con->query($query);
    $row = $result->fetch_assoc();
    $query2 = "SELECT * FROM relacionciclo WHERE idgrupo = $g";
    $result2 = $con->query($query2);
    $row2 = $result2->fetch_assoc();
    $prefijoevaluando = $row['prefijo']
    .$row['numero_consecutivo_tipo'].$row2['clave_materia'].
    retornafecha()[2].retornafecha()[3].retornafecha()[5]. 
    preg_replace('[\s+]','', retornanombre()).'.zip';
	echo '

                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header">'.$row['nombre_evaluando'].' '.
                                $row['numero_consecutivo_tipo'].'</h1>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                       '.$row['nombre_evaluando'].' a realizar
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="panel-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#v1" data-toggle="tab">Version 
                                                     '.$row['version'].'</a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                    <div class="tab-pane fade in active" id="v1">
                                                        <div class="col-lg-8">
                                                            <h4>Descripción</h4>
                                                            <p style ="word-break: break-word;">Bajar el PDF donde viene la descripción de la actividad a realizar
                                                             y enviar a través de la esta página con el prefijo '.$prefijoevaluando.'</p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h4>Adjunto</h4>
                                                            <div class="well well-lg">
                                                                <i class="fa fa-file-pdf-o fa-12x ico-center ico-red2"></i>
                                                                    <hr>
                                                                    <a href = "../../'.$row['pdf'].'" ><button type="submit" class="btn btn-danger btn-block">
                                                                    <i class="fa fa-download ico-white"></i> Descargar</button></a>
                                                            </div>
                                                        </div>
                                                     </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                            
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        Entrega de archivos
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="panel-body">
                                                <!-- Nav tabs -->
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#mv1" data-toggle="tab">Version '.$row['version'].'</a>
                                                    </li>
                                                </ul>

                                                <!-- Tab panes -->
                                                <div class="tab-content">
                                                <form method="post">
                                                    <div class="tab-pane fade in active" id="mv1">
                                                        <div class="col-lg-8">
                                                            <h4>Detalles de entrega</h4>
                                                            <p>Requisitos:</p>
                                                            <div class="list-group" style="word-break: break-word;">
                                                                <a href="#" class="list-group-item">
                                                                    <i class="fa fa-font fa-fw"></i> Nombre de entregable  
                                                                    <span class="pull-right text-muted small">
                                                                    <em>'.$prefijoevaluando.'
                                                                    </em>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="fa fa-file-zip-o fa-fw"></i> Formato de archivo  
                                                                    <span class="pull-right text-muted small"><em>ZIP</em>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="fa fa-calendar fa-fw"></i> Fecha liberado  
                                                                    <span class="pull-right text-muted small"><em>
                                                                    '.$row['fecha_liberacion'].'</em>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="fa fa-calendar fa-fw"></i> Fecha maxima de entrega  
                                                                    <span class="pull-right text-muted small"><em>'.$row['fecha_limite'].'</em>
                                                                    </span>
                                                                </a>
                                                                <a href="#" class="list-group-item">
                                                                    <i class="fa fa-clock-o fa-fw"></i> Hora maxima de entrega  
                                                                    <span class="pull-right text-muted small"><em>24:00 hrs</em>
                                                                    </span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h4>Pendiente</h4>
                                                            <div class="well well-lg">
                                                                <i class="fa fa-file-zip-o fa-12x ico-center ico-blue2"></i>
                                                                <hr>
                                                                <input type="file" class="filestyle" accept=".zip" name="archivo"
                                                                data-buttonName="btn-primary" data-buttonText="Archivo">
                                                                <hr>
                                                                <button type="submit" class="btn btn-primary btn-block" name ="subir">
                                                                <i class="fa fa-upload ico-white"></i> Subir</button>
                                                            </div>
                                                        </div>
                                                     </div>
                                                     </form>
                                                    <div class="tab-pane fade" id="mv2">
                                                        <div class="col-lg-8">
                                                            <h4>Detalles de entrega</h4>
                                                            <p......</p>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <h4>Entregado</h4>
                                                            <div class="well well-lg">
                                                                <i class="fa fa-file-zip-o fa-12x ico-center ico-blue2"></i>
                                                                <i>Nombre: ~</i><br>
                                                                <i>Tipo: ~</i><br>
                                                                <i>Tamaño: ~</i><br>
                                                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                                                    <span class="btn btn-primary btn-file btn-block"><span class="fileupload-new">Select file</span>
                                                                    <span class="fileupload-exists btn-lg">Change</span><input type="file" name="entrega_archivo" accept="application/zip,application/x-zip,application/x-zip-compressed,application/octet-stream"/></span>
                                                                    <textarea class="form-control fileupload-preview" rows="1"></textarea>
                                                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">×</a>
                                                                </div>
                                                                <a class="btn2 btn2-outline btn2-blue btn-block" href="" type="file"><i class="fa fa-download ico-blue2"></i> Subir</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.panel -->
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>

                            <!-- /.col-lg-12 -->
                        </div>

                    ';
                    mysqli_close($con);
}
function cargadatos($prefijoevaluacion){
    echo '<script>console.log("'.$prefijoevaluacion.'")</script>';
}
}
?>
