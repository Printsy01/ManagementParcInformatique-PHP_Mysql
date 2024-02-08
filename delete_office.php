<?php 
       require 'serveur.php' ;
       $id = $_GET['office_id'] ;

    //    var_dump($_GET);
$del = $pdo->exec("DELETE FROM office WHERE office_id = '$id'") ; 

require 'gest.php' ;
?>