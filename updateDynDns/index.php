<?php

$nombreArchivo="/home/freddy/ipPublica/ipPublica.txt";

$ipActual = trim(file_get_contents('https://api.ipify.org'));

$ipGuardada = trim(file_get_contents($nombreArchivo));

if( $ipActual !=$ipGuardada ){
    file_put_contents($nombreArchivo, $ipActual);
}

