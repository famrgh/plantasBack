<?php
ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);

include( __DIR__. "/../persistencia/conexionBD.php");
$pdo = getPdo();

$query = "SELECT ip FROM ip_publica WHERE fecha = (SELECT max(fecha) FROM ip_publica )";
$stmt = $pdo->prepare($query);
$stmt->execute();

$ipGuardada =  $stmt->fetchAll()[0]['ip'] ?? 0;

$ipActual = trim(file_get_contents('https://api.ipify.org'));

if( $ipActual !=$ipGuardada ){
    $stmt = $pdo->prepare("INSERT INTO ip_publica ( IP ) VALUES (:ip) ");
    $stmt->execute([':ip' => $ipActual]);
    echo file_get_contents( "https://sync.afraid.org/u/jEH8WSaU3RgmmcurXNsngoZW/" );
}