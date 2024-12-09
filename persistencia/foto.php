<?php

require_once( __DIR__."/conexionBD.php" );
include_once(__DIR__."/../helpers/respuestaJson.php");

function persistirFoto($url, $descripcion, $idPlanta){
    try{
        $pdo = getPdo();

        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO fotos (url, descripcion) VALUES( :url, :descripcion )");
        $stmt->bindParam( ':url', $url );
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->execute();

        $idFoto = $pdo->lastInsertId();

        $stmt = $pdo->prepare("INSERT INTO plantas_fotos (id_planta, id_foto) VALUES ( :idPlanta, :idFoto )" );
        $stmt->bindValue(':idPlanta', $idPlanta);
        $stmt->bindValue(':idFoto', $idFoto);
        $stmt->execute();

        $pdo->commit();

        respuestaExito("Foto agregada", $pdo->lastInsertId());
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

function getFotos($idPlanta){
    try{
        $pdo = getPdo();

        $stmt = $pdo->prepare(
            "SELECT f.* FROM plantas_fotos pf
            JOIN fotos f ON pf.id_foto = f.id
            WHERE id_planta = :idPlanta;"
        );
        $stmt->bindParam( ':idPlanta', $idPlanta );
        $stmt->execute();
        respuestaExito('', $stmt->fetchAll() );
    }
    catch(Exception $e){
        respuestaError($e->getMessage());
    }
}

?>