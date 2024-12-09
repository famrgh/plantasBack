<?php

include_once(__DIR__."/conexionBD.php");
include_once(__DIR__."/../helpers/respuestaJson.php");

function addFamilia($nombre){
    try{
        $pdo = getPdo();

        $query = "INSERT INTO familias (nombre) values (:nombre)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':nombre', $nombre);
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

function getFamilias(){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM familias ORDER BY nombre";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        respuestaExito( null, $resp );
    }
    catch(Exception $e){
        respuestaError( $e->getMessage() );
    }
}