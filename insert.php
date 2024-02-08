<script src="connexion.js"></script>
<?php
   session_start() ;
   require 'serveur.php' ;
   if(isset($_POST['nomi']) and isset($_POST['fonct']) and isset($_POST['offtype']) and isset($_POST['pwd']))
 {
   extract($_POST) ;
   

  //  $getdata = $pdo-> prepare ("INSERT INTO office ( office_name ) VALUES (?) ") ;
  //  $getdata->execute(array($offtype)) ;
  //  $offid = $pdo->lastInsertId();

   $person = ("SELECT COUNT(*) as nb FROM users WHERE username = '$nomi'") ;
   $req = $pdo->query($person) ;
   $res = $req->fetchAll();

  foreach ($res as $u) {
         $nb = $u['nb'];
        }
        
        if($nb == 0) {
          
          $getdata = $pdo->prepare("INSERT INTO users ( username , user_fonction ,office_id , contact , password ) VALUES (?,?,?,?,?)");
          $getdata->execute(array ( $nomi , $fonct , $offtype ,$contact, $pwd)) ;
          $id_user = $pdo->lastInsertId();
          
        } else {
          echo "<script>";
          echo "if (confirm('Pseudo déja pris ! Choisir un autre !')) {";
          echo "location.replace('login.php')";
          echo "} else {";
          echo "location.replace('login.php')" ;
          echo "}";
          echo "</script>";
          die();
        }
      }


  
 // MATERIEL INFORMATIQUE POUR SERVEUR EN DESSOUS 
   

//  if( isset($_POST["mati"]) and !empty($_POST["mati"])) {
//   extract($_POST) ;
//   if($mati == "Serveur") {
//     var_dump($_POST);
//     $getdata = $pdo-> prepare("INSERT INTO materiel_info_serveur ( mats_type , date_first , usera_id , office_id , mats_name , info_caract ) VALUES (?,?,?,?,?,?) ") ;
//     $getdata->execute(array("Serveur" ,$datef , $id_user , $offtype , "Ordinateur bureau" , $caract )) ;   
//     $id_num = $pdo->lastInsertId();
    
//     $getdata = $pdo-> prepare("UPDATE materiel_info_bureau  SET mats_num = ? , mats_clav = ? , mats_souris = ? , mats_ecr = ? 
//     WHERE mats_id = ?;") ;
//     $getdata->execute(array("PCs-".$id_num , "MEI/CLVs/".$id_num , "MEI/SOURs/".$id_num  ,"MEI/ECRs/".$id_num  , $id_num)) ;
    
//     if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
//       $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mats_ondu = ? WHERE mats_id = ?") ;
//       $getdata->execute(array("MEI/ONDs/".$id_num , $id_num)) ;

//     }
//   }
//   }


//    if(isset($_POST["immob"]) and !empty($_POST["immob"])){
//     extract($_POST) ;
//    $getdata = $pdo-> prepare("INSERT INTO materiel_info ( mat_type , date_first , user_id , office_id) VALUES ( ?,?,?,?) ") ;
//    $getdata->execute(array("Mobilier" , $datef , $id_user , $offtype)) ;        
//    }
//     header("Location:login.php") ;
//     ?>
//     <script>
//     // echo "alert('Pseudo déja pris')";
//     var txt = document.getElementById("pseudo") ;
//     txt.style.display = "block" ;
//     </script>
//     <?php
//     die();
       
// }



// ?>
  <br>
 Veuillez valider votre profil 
 <br>
 <button onclick="redirect()">OK</button>

 <script>
 function redirect() {
   location.replace("login.php") ;
 }
 </script>



