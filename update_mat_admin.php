<?php      
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
require 'laptop.php'; 
}


// DESKTOP
if(isset($_POST["caractb"]) and isset($_POST["datefb"]) and isset($_POST["offtype"])) {
    extract($_POST);      
    $getdata = $pdo-> prepare("UPDATE materiel_info_bureau SET info_caract = ? , date_first=?,office_id=?
    WHERE mat_id =?") ;
    $getdata->execute(array($caractb , $datefb , $offtype , $idb)) ;

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
require 'bureau.php'; 
}


// AUTRES
if(isset($_POST["typ"]) and isset($_POST["marque"])) {
    extract($_POST);      
    $getdata = $pdo-> prepare("UPDATE autres SET marque=?, autre_name=? WHERE autre_id =?") ;
    $getdata->execute(array($marque , $typ , $idau)) ;

session_abort();     
require 'autre.php'; 
}


// ADMIN
if(isset($_POST["nomia"]) and isset($_POST["passa"])) {
    extract($_POST);
    $getdata = $pdo-> prepare("UPDATE user_admin SET useraname=? , password=? WHERE usera_id =?") ;
    $getdata->execute(array($nomia,$passa ,$idua)) ;

session_abort();     
require 'gest.php'; 
}

// OFFICE
if(isset($_POST["birao"])) {
    extract($_POST);
    $getdata = $pdo-> prepare("UPDATE office SET office_name=? WHERE office_id=?") ;
    $getdata->execute(array($birao,$bnum)) ;

session_abort();     
require 'gest.php'; 
}
?>