<?php

$accion = $_GET['accion'] ?? $_POST['accion'];
switch($accion){
    case 'getEspecies':
        require( 'persistencia/especie.php' );
        getEspecies('option');
        break;
    case  'getFamilias':
        require( 'persistencia/familia.php' );
        getFamilias('option');
        break;
    case  'getGeneros':
        require( 'persistencia/genero.php' );
        getGeneros('option');
        break;
    case  'getPlantas':
        require( 'persistencia/planta.php' );
        getPlantas('option');
        break;

}



