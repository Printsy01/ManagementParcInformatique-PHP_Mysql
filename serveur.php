<?php

try {
    $pdo = new PDO("pgsql:host=localhost;port:5433;dbname=data", "postgres","root");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    (var_dump($e));
    
}
?>