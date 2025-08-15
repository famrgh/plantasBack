<?php
// Permitir todos los orígenes (solo para desarrollo)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$accion = $_GET['accion'] ?? $_POST['accion'];
switch($accion){
    case  'getFamilias':
        require( 'persistencia/familia.php' );
        getFamilias('option');
        break;
    case  'getGeneros':
        require( 'persistencia/genero.php' );
        $idFamilia = $_GET['idFamilia'] ?? null;
        getGeneros('option', $idFamilia);
        break;
    case 'getEspecies':
        require( 'persistencia/especie.php' );
        $idGenero = $_GET['idGenero'] ?? null;
        getEspecies('option', $idGenero);
        break;
    case  'getPlantas':
        require( 'persistencia/planta.php' );
        getPlantas('option');
        break;
    case 'getPlanta':
        require( 'persistencia/planta.php' );
        getPlanta( $_GET['idPlanta']??null , $_GET['codPlanta']??null );
        break;
}