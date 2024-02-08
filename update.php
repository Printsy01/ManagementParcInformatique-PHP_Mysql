<?php 
       
       require 'serveur.php' ;
     
if(isset($_POST["nomi"]) and isset($_POST["contact"]) and isset($_POST["pwd"]) and isset($_POST["fonct"])) {
      extract($_POST);      
      $getdata = $pdo-> prepare("UPDATE users SET username=? , user_fonction=?,office_id=?,contact=?,password=?
      WHERE user_id=?") ;
      $getdata->execute(array($nomi , $fonct ,$offtype ,$contact ,$pwd , $idu)) ;

  require 'Dashboard.php' ;
  }

  ?>