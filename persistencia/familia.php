<?php

include_once(__DIR__."/conexionBD.php");
include_once(__DIR__."/../helpers/respuestaJson.php");
include_once(__DIR__."/funcionesVarias.php");

function addFamilia($nombre, $id = null){
    try{
        $pdo = getPdo();

        $query = "INSERT INTO familias (nombre, id) values (:nombre, :id)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':nombre', $nombre);
        $stmt->bindValue( ':id', $id??'');
        $stmt->execute();
        respuestaExito("Familia agregada", $pdo->lastInsertId() );
    }
    catch( Exception $e ){
        respuestaError( $e->getMessage() );
    }
}

function getFamilia($id){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM familias WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':id', $id);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        respuestaExito( null, $resp );
    }
    catch(Exception $e){
        respuestaError( $e->getMessage() );
    }
}

function getFamilias($tipo='array'){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM familias ORDER BY nombre";
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
        respuestaError( $e->getMessage() );
    }
}