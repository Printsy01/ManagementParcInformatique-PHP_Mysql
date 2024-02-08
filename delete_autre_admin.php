<?php 
       require 'serveur.php' ;
       $id = $_GET['user_id'] ;

    //    var_dump($_GET);
$del = $pdo->exec("DELETE FROM autres WHERE autre_id = '$id'") ; 

require 'autre.php' ;
?>      
  