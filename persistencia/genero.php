<?php

include_once(__DIR__."/conexionBD.php");

function addGenero($nombre, $idFamilia){
    $pdo = getPdo();

    $query = "INSERT INTO generos (nombre, idFamilia) values (:nombre, :idFamilia)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue( ':nombre', $nombre);
    $stmt->bindValue( ':idFamilia', $idFamilia);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function getGenero($id){
    $pdo = getPdo();

    $query = "SELECT * FROM generos WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue( ':id', $id);
    $stmt->execute();
    $resp = $stmt->fetchAll();

    return json_encode( $resp );
}