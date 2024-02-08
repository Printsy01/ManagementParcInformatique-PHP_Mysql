<script src="connexion.js"></script>
<?php
   session_start() ;
   require 'serveur.php' ;
   if(isset($_POST['nomi']) and isset($_POST['fonct']) and isset($_POST['offtype']))
 {
   extract($_POST) ;
   

  //  $getdata = $pdo-> prepare ("INSERT INTO office ( office_name ) VALUES (?) ") ;
  //  $getdata->execute(array($offtype)) ;
  //  $offid = $pdo->lastInsertId();
//    var_dump($_POST) ;
   $person = ("SELECT COUNT(*) as nb FROM users WHERE username = '$nomi'") ;
   $req = $pdo->query($person) ;
   $res = $req->fetchAll();

  foreach ($res as $u) {
         $nb = $u['nb'];
  }

   if($nb == 0 && isset($_POST["nomi"]) and !empty($_POST["nomi"]) 
   && isset($_POST["contact"]) and !empty($_POST["contact"])
   && isset($_POST["pwd"])  and !empty($_POST["pwd"])
   && isset($_POST["fonct"]) and !empty($_POST["fonct"])) 
   {

     $getdata = $pdo->prepare("INSERT INTO users (  username , user_fonction ,office_id , contact , password ) VALUES (?,?,?,?,? )");
     $getdata->execute(array ( $nomi , $fonct , $offtype ,$contact, $pwd)) ;
     $id_user = $pdo->lastInsertId();

    
   //echo "val=". $id_user ; 

   // MATERIEL INFORMATIQUE POUR BUREAU EN DESSOUS 
   

   if( isset($_POST["mati"]) and !empty($_POST["mati"])) {
    extract($_POST) ;
    if($mati == "Ordinateur bureau") {
     // var_dump($_POST);
      $getdata = $pdo-> prepare("INSERT INTO materiel_info_bureau ( mat_type , date_first , user_id , office_id , mat_name , info_caract ) VALUES (?,?,?,?,?,?) ") ;
      $getdata->execute(array("Informatique" ,$datef , $id_user , $offtype , "Ordinateur bureau" , $caract )) ;   
      $id_num = $pdo->lastInsertId();

      $_SESSION["nume"] = $id_num ;
      
      $getdata = $pdo-> prepare("UPDATE materiel_info_bureau  SET mat_num = ? , mat_clav = ? , mat_souris = ? , mat_ecr = ? 
      WHERE mat_id = ?;") ;
      $getdata->execute(array("PC-".$id_num , "MEI/CLV/".$id_num , "MEI/SOUR/".$id_num  ,"MEI/ECR/".$id_num  , $id_num)) ;
      
      if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
        $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_ondu = ? WHERE mat_id = ?") ;
        $getdata->execute(array("MEI/OND/".$id_num , $id_num)) ;



      }
    }
    }


 // MATERIEL INFORMATIQUE POUR SERVEUR EN DESSOUS 
   

 if( isset($_POST["mati"]) and !empty($_POST["mati"])) {
  extract($_POST) ;
  if($mati == "Serveur") {
    var_dump($_POST);
    $getdata = $pdo-> prepare("INSERT INTO materiel_info_serveur ( mats_type , date_first , usera_id , office_id , mats_name , info_caract ) VALUES (?,?,?,?,?,?) ") ;
    $getdata->execute(array("Serveur" ,$datef , $id_user , $offtype , "Ordinateur bureau" , $caract )) ;   
    $id_num = $pdo->lastInsertId();
    
    $getdata = $pdo-> prepare("UPDATE materiel_info_bureau  SET mats_num = ? , mats_clav = ? , mats_souris = ? , mats_ecr = ? 
    WHERE mats_id = ?;") ;
    $getdata->execute(array("PCs-".$id_num , "MEI/CLVs/".$id_num , "MEI/SOURs/".$id_num  ,"MEI/ECRs/".$id_num  , $id_num)) ;
    
    if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
      $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mats_ondu = ? WHERE mats_id = ?") ;
      $getdata->execute(array("MEI/ONDs/".$id_num , $id_num)) ;

    }
  }
  }


  
   //MATERIEL INFORMATIQUE POUR LAPTOP EN DESSOUS 

   if(isset($_POST["mati"]) and !empty($_POST["mati"])) {
     extract($_POST) ;
     if( $mati == "Laptop"  ) {

       $getdata = $pdo-> prepare("INSERT INTO materiel_info_laptop ( matl_type , matl_name , user_id , office_id ,matl_caract , date_debut) VALUES (?,?,?,?,?,?) ");
       $getdata->execute(array( "Informatique" ,"Laptop", $id_user , $offtype , $caract , $datef)) ;
       $id_numl = $pdo->lastInsertId();
       
       $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_num = ? WHERE matl_id = ?") ;
       $getdata->execute(array("MEI/LPTP/".$id_numl , $id_numl )) ;
       
       if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
         $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_ondu = ? WHERE matl_id = ?") ;
         $getdata->execute(array("MEI/OND/".$id_numl , $id_numl)) ;
        }
       }
   } 


   //Autres
   if(isset($_POST["matt"]) and !empty($_POST["matt"])) {
     extract($_POST) ;
     if($matt == "Téléphone" || $matt == "Tablette") 
     {
       $getdata = $pdo->prepare("INSERT INTO autres(autre_name , user_id , type) VALUES (?,?,?)") ;
       $getdata->execute(array( $mati , $id_user , "Informatique" )) ;
     }
   }



   if(isset($_POST["immob"]) and !empty($_POST["immob"])){
    extract($_POST) ;
   $getdata = $pdo-> prepare("INSERT INTO materiel_info ( mat_type , date_first , user_id , office_id) VALUES ( ?,?,?,?) ") ;
   $getdata->execute(array("Mobilier" , $datef , $id_user , $offtype)) ;        
   }
  } else {
    header("Location: Dashboard.php") ;
    ?>
    <script>
    // echo "alert('Pseudo déja pris')";
    var txt = document.getElementById("pseudo") ;
    txt.style.display = "block" ;
    </script>
    <?php
    die();
       
} 
}
header("Location: Dashboard.php") ;
?>
  <br>
 Un nouveau profil ajouté
 <br>
 <!-- <button onclick="redirect()">OK</button> -->

 <script>
 function redirect() {
   location.replace("Dashboard.php") ;
 }
 </script>



