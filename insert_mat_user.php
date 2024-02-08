<?php
  session_start() ;
  require 'serveur.php' ;

  $id_user = $_SESSION['numero'] ;

// MATERIEL INFORMATIQUE POUR BUREAU EN DESSOUS 

  if( isset($_POST["mati"]) and !empty($_POST["mati"])) {
    extract($_POST) ;
     // var_dump($_POST);
      $getdata = $pdo-> prepare("INSERT INTO materiel_info_bureau ( mat_type , date_first , user_id , office_id , mat_name , info_caract ) VALUES (?,?,?,?,?,?) ") ;
      $getdata->execute(array("Informatique" ,$datef , $id_user , $offtype , $mati , $caract )) ;   
      $id_num = $pdo->lastInsertId();

      $_SESSION["nume"] = $id_num ;
      
      $getdata = $pdo-> prepare("UPDATE materiel_info_bureau  SET mat_num = ? , mat_clav = ? , mat_souris = ? , mat_ecr = ? 
      WHERE mat_id = ?;") ;
      $getdata->execute(array($id_num , $id_num , $id_num  ,$id_num  , $id_num)) ;
      
      if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
        $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_ondu = ? WHERE mat_id = ?") ;
        $getdata->execute(array($id_num , $id_num)) ;



      
    }
    session_abort();     
    require 'perso1.php'; 
    }

//MATERIEL INFORMATIQUE POUR LAPTOP EN DESSOUS 

   if(isset($_POST["matil"]) and !empty($_POST["matil"])) {
    extract($_POST) ;

      $getdata = $pdo-> prepare("INSERT INTO materiel_info_laptop ( matl_type , matl_name , user_id , office_id ,matl_caract , date_debut) VALUES (?,?,?,?,?,?) ");
      $getdata->execute(array( "Informatique" ,"Laptop", $id_user , $offtype , $caract , $datef)) ;
      $id_numl = $pdo->lastInsertId();
      
      $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_num = ? WHERE matl_id = ?") ;
      $getdata->execute(array($id_numl , $id_numl )) ;
      
      if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
        $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_ondu = ? WHERE matl_id = ?") ;
        $getdata->execute(array($id_numl , $id_numl)) ;
       
      }
  
  session_abort();     
  require 'perso1.php';    
  } else {
      
  }

//Autres
   if(isset($_POST["matt"]) and !empty($_POST["matt"])) {
    extract($_POST) ;
    if($matt == "Téléphone" || $matt == "Tablette") 
    {
      $getdata = $pdo->prepare("INSERT INTO autres(autre_name , user_id , type , marque) VALUES (?,?,?,?)") ;
      $getdata->execute(array( $matt , $id_user , "Informatique" , $marque)) ;

    }

    session_abort();     
    require 'perso1.php'; 
  }

?>   