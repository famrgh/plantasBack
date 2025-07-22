<?php
    $accion = $_GET['accion'] ?? $_POST['accion'];
    switch($accion){
        case 'getEspecies':
            optionsEspecies();
            break;

    }




function optionsEspecies(){
    require( 'persistencia/especie.php' );
    getEspecies();   
}