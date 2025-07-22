<?php

include_once(__DIR__."/conexionBD.php");
include_once(__DIR__."/../helpers/respuestaJson.php");
include_once(__DIR__."/funcionesVarias.php");

function addEspecie($nombre, $idGenero){
    try{
        $pdo = getPdo();
        $query = "INSERT INTO especies (nombre, id_genero) values (:nombre, :idGenero)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':nombre', $nombre);
        $stmt->bindValue( ':idGenero', $idGenero);
        $stmt->execute();
        respuestaExito( 'Especia agragada', $pdo->lastInsertId() );
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

function getEspecies($tipo='array'){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM especies ORDER BY nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        switch($tipo){
            case 'option':
                echo pdoFetchAllToOption($resp);
                break;
            default:
                respuestaExito('', $resp);
        }
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}