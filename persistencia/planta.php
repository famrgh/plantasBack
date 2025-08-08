<?php

include_once( __DIR__."/conexionBD.php" );
include_once(__DIR__."/../helpers/respuestaJson.php");
include_once(__DIR__."/funcionesVarias.php");

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

        respuestaExito('', $resp );
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getPlantas($tipo='array'){
    try{
        $pdo = getPdo();

        $query = "SELECT * FROM plantas ORDER BY fecha DESC";
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
        respuestaError( $e->getMessage() );
    }
}

function getLastIdPlanta(){
    try{
        $pdo = getPdo();

        $query = "SELECT max(id) id FROM plantas";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        $resp = $stmt->fetchAll();

        return $resp[0]['id'];
    }
    catch(Exception $e){
        respuestaError( $e->getMessage() );
    }   
}