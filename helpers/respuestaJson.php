<?php

function respuestaError($texto){
    echo json_encode( [ 'error'=>1, 'texto'=>$texto ] );
}

function respuestaExito($texto, $mensaje){
    echo json_encode( [ 'error'=>0, 'texto'=>$texto, 'mensaje'=>$mensaje ] );
}