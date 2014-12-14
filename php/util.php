<?php

function logMensaje($titulo,$mensaje){
    $ruta_log = CARPETA_ARCHIVOS.'/logs';
    $tipoArchivo = '.txt';
    $dia = date("d-D");
    $mes = date("m-F");
    $anio = date("Y");
    $hora = date("H:i:s.u");
    $ruta_final = $ruta_log.'/'.$anio.'/'.$mes; 

    if(!file_exists($ruta_final)){
        mkdir($ruta_final, 0777, true);
    }

    $archivo = fopen($ruta_final.'/'.$dia.$tipoArchivo, "a+");
    $texto = '['.$hora.']'.'['.$titulo.']'.'['.$mensaje.']'.PHP_EOL;
    fwrite($archivo, $texto);
    fclose($archivo);
}


function primera_palabra($str, $caracter, $limit, $end = ' '){
    return substr($str, 0, strpos($str, $caracter, $limit)) . $end;
}

function textoEntrePalabras($inicio,$contenido,$fin){
    $r = explode($inicio, $contenido);
    if (isset($r[1])){
    $r = explode($fin, $r[1]);
    return $r[0];
    }
    return '';
}

function xhastafinal($palabra,$letra){
    if(strlen($palabra)){
        $palabra = str_split($palabra);
        $regresar = -1;
        foreach($palabra as $key => $value){
            if($value==$letra){
                $regresar++;
            }elseif($regresar>-1){
                $final[$regresar]=$value;
                $regresar++;
            }
        }
        if(count($final)){
            $final = implode('', $final);
            return $final;
        }else return 0;
    }else return 0;
}

function getPalabra($contenido,$inicio,$fin){
    $r = explode($inicio, $contenido);
    if(isset($r[1])){
        $r = explode($fin, $r[1]);
        return $r[0];
    }
    return 0;
}


?>
