<?php

function respuestaError($texto){
    return json_encode( [ error=>1, texto=>$texto ] );
}

function respuestaExito($texto, $mensaje){
    return json_encode( [ error=>0, texto=>$texto, mensaje=>$mensaje ] );
}