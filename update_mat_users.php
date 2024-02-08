<?php      
    //    session_start();
       require 'serveur.php' ;
// LAPTOP
if(isset($_POST["caract"]) and isset($_POST["datef"]) and isset($_POST["offtype"])) {
      extract($_POST);      
      $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_caract = ? , date_debut=?,office_id=?
      WHERE matl_id =?") ;
      $getdata->execute(array($caract , $datef ,$offtype,$idl)) ;

if(isset($_POST["obse"])) {
       $updata = $pdo-> prepare("UPDATE materiel_info_laptop SET observation_l = ?  WHERE matl_id= ?") ;
       $updata->execute(array($obse , $idl)) ;
   }

if(isset($_POST["ondul"]) and !empty($_POST["ondul"])) {
    $getdata = $pdo-> prepare("UPDATE materiel_info_laptop SET matl_ondu = ? WHERE matl_id = ?") ;
    $getdata->execute(array($idl , $idl)) ;  
} else {
    //   $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_ondu = ? WHERE mat_id = ?") ;
    //   $getdata->execute(array( , $idb)) ;  
}

session_abort();     
require 'perso1.php'; 
}


// DESKTOP
if(isset($_POST["caractb"]) and isset($_POST["datefb"]) and isset($_POST["offtype"]) and isset($_POST["matn"])) {
    extract($_POST);      
    $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_name = ? , info_caract = ? , date_first=?,office_id=?
    WHERE mat_id =?") ;
    $getdata->execute(array($matn , $caractb , $datefb , $offtype , $idb)) ;

if(isset($_POST["obse"])) {
     $updata = $pdo-> prepare("UPDATE materiel_info_bureau SET observation_b = ?  WHERE mat_id= ?") ;
     $updata->execute(array($obse , $idb)) ;
 }

if(isset($_POST["ondu"]) and !empty($_POST["ondu"])) {
  $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_ondu = ? WHERE mat_id = ?") ;
  $getdata->execute(array($idb , $idb)) ;  
} else {
//   $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET mat_ondu = ? WHERE mat_id = ?") ;
//   $getdata->execute(array( , $idb)) ;  
}

session_abort();     
require 'perso1.php'; 
}


// AUTRES
if(isset($_POST["typ"]) and isset($_POST["marque"])) {
    extract($_POST);      
    $getdata = $pdo-> prepare("UPDATE autres SET marque=?, autre_name=? WHERE autre_id =?") ;
    $getdata->execute(array($marque , $typ , $idau)) ;

session_abort();     
require 'perso1.php'; 
}

// USERS



if(isset($_POST["nomu"]) and isset($_POST["asa"]) and isset($_POST["tel"]) and isset($_POST["pass"])) {
    extract($_POST);  
    
    $stmtu = $pdo->prepare("SELECT * FROM users") ;
    $stmtu->execute() ;
    $utilisateurs = $stmtu->fetchAll();

    foreach($utilisateurs as $us) {
        if($us["username"] == $nomu) {
            header("Location : perso.php") ;
        } else {
            $_SESSION["name"] = $nomu ;
            $_SESSION["password"] = $pass ;

            $getdata = $pdo-> prepare("UPDATE users SET username=?, user_fonction=? , contact=? , password=? ,office_id=? 
            WHERE user_id =?") ;
            $getdata->execute(array($nomu , $asa , $tel ,$pass ,$offtype ,$iu)) ;

            require 'perso1.php'; 
            session_abort();
        }
    }


}
?>