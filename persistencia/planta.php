<?php

include( __DIR__."/conexionBD.php" );
include_once(__DIR__."/../helpers/respuestaJson.php");

function addPlanta($codigo, $idsEspecie=[]){
    try{
        $pdo = getPdo();
        $pdo->beginTransaction();

        $query = "INSERT INTO plantas (codigo) values (:codigo)";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':codigo', $codigo);
        $stmt->execute();

        $idPlanta = $pdo->lastInsertId();

        foreach( $idsEspecie as  $idEspecie ){
            $stmt = $pdo->prepare("INSERT INTO plantas_especies (id_planta, id_especie ) VALUES (:idPlanta, :idEspecie ) " );
            $stmt->bindValue(':idPlanta', $idPlanta);
            $stmt->bindValue(':idEspecie', $idEspecie);
            $stmt->execute();
        }

        $pdo->commit();

        respuestaExito('Planta agregada', $pdo->lastInsertId());
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getPlanta($id){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM plantas WHERE id=:id";
        $stmt = $pdo->prepare($query);
        $stmt->bindValue( ':id', $id);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        return json_encode( $resp );
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}