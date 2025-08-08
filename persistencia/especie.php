<?php

include_once(__DIR__."/conexionBD.php");
include_once(__DIR__."/../helpers/respuestaJson.php");
include_once(__DIR__."/funcionesVarias.php");

function addEspecie($nombre, $idEspecie, $idGenero,){
    try{
        $pdo = getPdo();
        $query = "INSERT INTO especies (nombre, id_genero, id) values (:nombre, :idGenero, :idEspecie)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':nombre', $nombre);
        $stmt->bindValue( ':idGenero', $idGenero);
        $stmt->bindValue( ':idEspecie', $idEspecie);
        $stmt->execute();
        respuestaExito( 'Especia agragada', $idEspecie );
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getEspecie($id){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM especies WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':id', $id);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        respuestaExito('', $resp);
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getEspecies($tipo='array', $idGenero){
    try{
        $pdo = getPdo();

        $filtroGenero = empty($idGenero) ? '-1' : $idGenero;

        $query = "SELECT * FROM especies WHERE  $filtroGenero=-1 OR id_genero = $filtroGenero ORDER BY nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        switch($tipo){
            case 'option':
                pdoFetchAllToOption($resp);
                break;
            default:
                respuestaExito('', $resp);
        }
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}