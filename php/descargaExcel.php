<?php

include 'excel.php';

$grupo = new Grupo();

$descarga = new Excel('seminario de programacion','d02',$grupo->getCicloActual(),'muñoz');

?>
