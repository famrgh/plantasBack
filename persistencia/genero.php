<?php

include_once(__DIR__."/conexionBD.php");
include_once(__DIR__."/../helpers/respuestaJson.php");
include_once(__DIR__."/funcionesVarias.php");

function addGenero($nombre, $idFamilia){
    try{
        $pdo = getPdo();

        $query = "INSERT INTO generos (nombre, id_familia) values (:nombre, :idFamilia)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':nombre', $nombre);
        $stmt->bindValue( ':idFamilia', $idFamilia);
        $stmt->execute();
        respuestaExito("Genero agregado", $pdo->lastInsertId());
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getGenero($id){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM generos WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':id', $id);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        respuestaExito( '', $resp );
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getGeneros($tipo = 'array', $idFamilia=null){
    try{
        $pdo = getPdo();

        $filtroFamilia = empty($idFamilia) ? '-1' : $idFamilia;

        $query = "SELECT * FROM generos WHERE  $filtroFamilia=-1 OR id_familia = $filtroFamilia ORDER BY nombre";
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