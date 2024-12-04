<?php

function persistirFoto($url, $descripcion){
    require( __DIR__."/conexionBD.php" );
    $pdo = getPdo();

    $stmt = $pdo->prepare("INSERT INTO fotos (url, descripcion) VALUES( :url, :descripcion )");
    $stmt->bindParam( ':url', $url );
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->execute();

    return $pdo->lastInsertId() ;
}

?>