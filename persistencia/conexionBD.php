<?php
function getPdo(){
    try {
        $dsn = "pgsql:host=localhost;port=5432;dbname=plantas;";
        $pdo = new PDO($dsn, 'postgres', 'postgres');
    } catch (PDOException $e){
        echo $e->getMessage();
        die;
    }
    return $pdo;
}

?>