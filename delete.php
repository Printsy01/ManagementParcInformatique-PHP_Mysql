<?php 
       require 'serveur.php' ;
       $id = $_GET['user_id'] ;

    //    var_dump($_GET);
$del = $pdo->exec("DELETE FROM users WHERE user_id = '$id'") ; 

require 'Dashboard.php' ;
?>      
     
 