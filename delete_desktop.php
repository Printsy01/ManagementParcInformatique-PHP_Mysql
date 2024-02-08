<?php 
       require 'serveur.php' ;
       $id = $_GET['user_id'] ;

    //    var_dump($_GET);
$del = $pdo->exec("DELETE FROM materiel_info_bureau WHERE mat_id = '$id'") ; 

require 'perso1.php' ;
?>      
  