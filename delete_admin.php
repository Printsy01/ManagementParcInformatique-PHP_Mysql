<?php 
       require 'serveur.php' ;
       $id = $_GET['usera_id'] ;

    //    var_dump($_GET);
$del = $pdo->exec("DELETE FROM user_admin WHERE usera_id = '$id'") ; 

require 'gest.php' ;
?>