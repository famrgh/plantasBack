<?php

include_once(__DIR__."/conexionBD.php");

function addFamilia($nombre){
    $pdo = getPdo();

    $query = "INSERT INTO familias (nombre) values (:nombre)";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue( ':nombre', $nombre);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function getFamilia($id){
    $pdo = getPdo();

    $query = "SELECT * FROM familias WHERE id=:id";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue( ':id', $id);
    $stmt->execute();
    $resp = $stmt->fetchAll();

    return json_encode( $resp );
}