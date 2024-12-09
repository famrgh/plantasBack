<?php

ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

$tipoAccion = substr( $_POST['accion'] ?? $_GET['accion'] , 0, 3);

if($tipoAccion == 'get'){
    switch( $_GET['accion'] ){
        case 'getFamilia':
            require(__DIR__.'/familia.php');
            getFamilia( $_GET['id'] ?? throw new Exception('Debe ingresar un id') );
        break;
        case 'getFamilias':
            require(__DIR__.'/familia.php');
            getFamilias(  );
        break;
        case 'getGenero':
            require(__DIR__.'/genero.php');
            getGenero( $_GET['id'] ?? throw new Exception('Debe ingresar un id') );
        break;
        case 'getGeneros':
            require(__DIR__.'/genero.php');
            getGeneros( );
        break;
        case 'getEspecie':
            require(__DIR__.'/especie.php');
            getEspecie( $_GET['id'] ?? throw new Exception('Debe ingresar un id') );
        break;
        case 'getEspecies':
            require(__DIR__.'/especie.php');
            getEspecies( );
        break;
        case 'getPlanta':
            require(__DIR__.'/planta.php');
            getPlanta( $_GET['id'] ?? throw new Exception('Debe ingresar un id') );
        break;
        case 'getPlantas':
            require(__DIR__.'/planta.php');
            getPlantas();
        break;
        case 'getFotos':
            require(__DIR__.'/foto.php');
            getFoto( $_GET['id'] ?? throw new Exception('Debe ingresar un id') );
        break;
    }
}
elseif( $tipoAccion == 'add'){
    switch( $_POST['accion'] ){
        case 'addFamilia':
            echo "familia";
        break;
        case 'addGenero':
            echo "Genero";
        break;
        case 'addEspecie':
            echo "Especie";
        break;
        case 'addPlanta':
            echo "Planta";
        break;
        case 'addFoto':
            echo "Foto";
        break;
    }
}