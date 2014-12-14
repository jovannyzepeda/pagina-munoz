<?php
/**
@Autor: Jonathan <Jonathangtz.sosa@yahoo.com.mx>
@integracion de librerias.
*/
include '../PHPExcel/Classes/PHPExcel.php';
include 'sistema.php';
include 'grupo.php';

/**
@Clase impementada para generar excel.
*/

class Excel
{
  var $documento,
      $titulo,
      $curso,
      $grupo,
      $ciclo;

/**
@Contructor -> genera el nuevo excel.
*/
  function __construct($curso, $seccion, $ciclo, $profesor){
    $this->documento = new PHPExcel();
    $this->documento->getDefaultStyle()->getFont()->setName('Arial');
    $this->documento->getDefaultStyle()->getFont()->setSize(12);
    $this->grupo = new Grupo();
    $this->setTitle();
    $this->poblandoExcel($curso, $seccion, $ciclo, $profesor);//Hoja 1
    $this->hojaAsistencia();
    $this->guardar();
  }

/**
@Destructor
*/

  function __destruct(){
    //$this->guardar();
  }

/**
@Funcion que le da un titulo y por quien se modifico
*/

  function setTitle($titulo = 'Avance PRO', $creadores ="schoolsysTeam"){
    $this->documento->getProperties()->setCreator($creadores);
    $this->documento->getProperties()->setLastModifiedBy($creadores);
    $this->documento->getProperties()->setTitle($titulo);
    $this->documento->getProperties()->setSubject("Office 2007 XLSX Test Document");
    $this->documento->getProperties()->setDescription("excel generado por ".$creadores);
    $this->titulo = $titulo;
  }

/**
@Funcion que genera el encabezado de cada pestaña de excel
*/

  function encabezado($curso, $seccion, $ciclo, $profesor, $index){
    $this->curso = $curso;
    $this->ciclo = $this->grupo->getCicloActual();
    $this->documento->setActiveSheetIndex($index)
                ->setCellValue('A1', 'Curso de '.$curso.' - '.$seccion.' - '.$ciclo)
                ->setCellValue('A2', 'Profesor '.$profesor)
                ->mergeCells('A1:B1')
                ->mergeCells('A2:B2');
  }

  function encabezadoEvaluacion($curso, $seccion, $ciclo, $profesor, $index){
    $this->encabezado($curso, $seccion, $ciclo, $profesor, $index);
    $this->documento->setActiveSheetIndex($index)
                ->setCellValue('A3', 'Evaluacion general')
                ->setTitle('Evaluacion')
                ->mergeCells('A3:B3');
  }

  function encabezadoAsistencia($curso, $seccion, $ciclo, $profesor, $index){
    $this->encabezado($curso, $seccion, $ciclo, $profesor, $index);
    $this->documento->setCellValue('A3', 'Asistencia')
                ->setTitle('Asistencia')
                ->mergeCells('A3:B3');
  }

/**
@Funcion que genera el excel completo con nombres y codigos
*/

  function poblandoExcel($curso, $seccion, $ciclo, $profesor){
    $this->encabezadoEvaluacion($curso,$seccion,$ciclo,$profesor,0);
    //$this->encabezadoAsistencia($curso,$seccion,$ciclo,$profesor,1);
    $numero=6;
    $this->documento->getActiveSheet()->setCellValue('A'.$numero,'Codigo');
    $this->documento->getActiveSheet()->setCellValue('B'.$numero,'Nombre');
    $conexion = conectar();
    $resultado=$conexion->query("SELECT codigo, nickname as nombre FROM usuario");
    while($row=$resultado->fetch_assoc()){
      $numero++;
      $this->documento->getActiveSheet()
      ->setCellValue('A'.$numero, $row['codigo']);
      $this->documento->getActiveSheet()
      ->setCellValue('B'.$numero, $row['nombre']);
    }
    $this->documento->getActiveSheet()->getColumnDimension("A")->setAutoSize(true);
    $this->documento->getActiveSheet()->getColumnDimension("B")->setAutoSize(true);
  }

  function hojaAsistencia(){
    $this->documento->createSheet(NULL,1);
    $this->documento->setActiveSheetIndex(1);
    $this->documento->getActiveSheet()->setTitle('Asistencia');
  }

/**
@Funcion que guarda el excel
*/

  function guardar(){
    $save = PHPExcel_IOFactory::createWriter($this->documento, 'Excel5');
    $carpetaCiclo = '../archivos/excel/'.$this->ciclo;
    $carpetaCurso = $carpetaCiclo.'/'.$this->curso;
    $carpetaGrupo = $carpetaCurso.'/';
    (!file_exists($carpetaCiclo))? mkdir($carpetaCiclo,0777):0;//Si no existe carpeta, la crea.
    (!file_exists($carpetaCurso))?mkdir($carpetaCurso,0777):0;// ´´
    (!file_exists($carpetaGrupo))?mkdir($carpetaGrupo,0777):0;// ´´

    $save->save($final=$carpetaGrupo.$this->titulo.'.xls');
    if(file_exists($final))
      header('Location: '.$final);
    echo '
      <script>
          window.open("","_parent","");
          window.close();
      </script> 
    ';

  }

}//Termina clase

?>
