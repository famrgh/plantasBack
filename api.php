<?php
// Permitir todos los orígenes (solo para desarrollo)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

$accion = $_GET['accion'] ?? $_POST['accion'];
switch($accion){
    case  'getFamilias':
        require( 'persistencia/familia.php' );
        getFamilias($_GET['tipo']??'option');
        break;
    case  'getGeneros':
        require( 'persistencia/genero.php' );
        $idFamilia = $_GET['idFamilia'] ?? null;
        getGeneros($_GET['tipo'] ?? 'option', $idFamilia);
        break;
    case 'getEspecies':
        require( 'persistencia/especie.php' );
        $idGenero = $_GET['idGenero'] ?? null;
        getEspecies($_GET['tipo'] ?? 'option', $idGenero);
        break;
    case  'getPlantas':
        require( 'persistencia/planta.php' );
        getPlantas('option');
        break;
    case 'getPlanta':
        require( 'persistencia/planta.php' );
        getPlanta( $_GET['idPlanta'] ?? null , $_GET['codigoPlanta'] ?? null );
        break;
    case 'addPlanta':
        require( 'persistencia/planta.php' );
        $codigo = $_POST['codigo'];
        $descripcion = $_POST['descripcion'];
        $idsEspecies = $_POST['especies'];
        addPlanta($codigo, $descripcion, $idsEspecies);
        break;
    case 'getFotosPlanta':
        require 'persistencia/foto.php';
        $idPlanta = $_GET['idPlanta'];
        getFotos($idPlanta);
        break;
    case 'agregarFotoPlanta':
        require( __DIR__.'/helpers/fotoArchivo.php');
		$idPlanta = $_GET['idPlanta'] ?? $_POST['idPlanta'];
		$rutaDestino = saveImage($idPlanta );
        break;

        
}