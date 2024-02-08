<?php
    require 'serveur.php' ;

if(isset($_POST["admin"]) and isset($_POST["admip"])) {
    extract($_POST) ;

    $getdata = $pdo->prepare("INSERT INTO user_admin (useraname , password) VALUES (?,?)") ;
    $getdata->execute(array($admin , $admip)) ;

    require 'gest.php';
    } else {
        
    }

    
if(isset($_POST["offi"])) {
        extract($_POST) ;
    
        $getdata = $pdo->prepare("INSERT INTO office (office_name) VALUES (?)") ;
        $getdata->execute(array($offi)) ;
    
        require 'gest.php';
        } else {
            
        }

?>