<?php
  session_start();
  require 'serveur.php' ;

//   $nam = $_GET['userin_id'];
  
  $name = $_SESSION['name'] ;
  $password = $_SESSION['password'] ;

  $_SESSION["nom"] = $name ;
  $_SESSION["mdp"] = $password ;

  $sql = "SELECT * FROM users" ;
  $stmt = $pdo -> query($sql);

if($stmt === false){
    die("Erreur");
   }

   if(!empty($_SESSION['name'] and !empty($_SESSION['password']))) 
   {
     
     $stmt = $pdo->prepare("SELECT * FROM users") ;
     $stmt->execute() ;
     $utilisateur = $stmt->fetchAll();
     
     foreach($utilisateur as $u) {
 
       if($u['username'] == $name) {
         $num = $u['user_id'] ;
         $_SESSION['numero'] = $u['user_id'];
       }     
     }
     
    } else {
        $num = $nam;
    }

     $res = ("SELECT * FROM users WHERE user_id = $num") ;
     $util = $pdo-> query($res) ;
     
     $re = $pdo->prepare("SELECT * FROM users WHERE user_id = $num") ;
     $re->execute() ;
     $upd = $re->fetchAll() ;
 
     foreach($upd as $perso)
     {
       $_SESSION["nom"] = $perso["username"] ;
     }
     
     $stmtn = ("SELECT * FROM materiel_info_bureau WHERE user_id = $num ");
     $info = $pdo->query($stmtn);
    
     $stmtnt = ("SELECT * FROM materiel_info_laptop WHERE user_id = $num");
     $laptop = $pdo->query($stmtnt);
 
     $tel = ("SELECT * FROM autres WHERE user_id = $num") ;
     $autre = $pdo->query($tel) ;
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="fontawesome/css/all.css" rel="stylesheet">
        <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="assets/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
    </style>
    <title>Dashboard</title>
</head>

<body>
    <section class="header">
        <div class="logo">
            <i class="ri-menu-line icon icon-0 menu"></i>
            <h2>Mat <span> Database</span></h2>
        </div>
        <div class="search--notification--profile">

        <div class="">
                <!-- <input type="text" id="myInput" onkeyup="searchfunction()" placeholder="Rechercher">
                <button><i class="ri-search-2-line"></i></button> -->
            </div>

                <div class="picon profile">
                <i class="fa-solid fa-user" style="float:right"></i>
                    <!-- <i class="fa-solid fa-user"></i> -->
                </div>
            </div>
        </div>
    </section>
    <section class="main">
        <div class="sidebar">
            <ul class="sidebar--items">
                <li>
                    <a href="perso1.php" id="active--link">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
               
            </ul>
            <ul class="sidebar--bottom-items">
            
                <li>
                    <a data-toggle="modal" href="#set">
                        <span class="icon icon-7"><i class="ri-settings-3-line"></i></span>
                        <span class="sidebar--item">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <span class="icon icon-8"><i class="ri-logout-box-r-line"></i></span>
                        <span class="sidebar--item">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
      <div class="main--content">
              
                <div class="title">
                    <h2 class="section--title">Vos matériels</h2>
     
                </div>
               
            <p id="user">

                <div class="recent--patients">
                    <div class="title">
                        <h2 class="section--title">Laptop</h2>
                        <button class="add" onclick="document.getElementById('id01').style.display='block'" ><i class="ri-add-line"></i>Ajouter un Laptop</button>
                        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
                </div>
                <div class="table">
                    <table id="myTable">
                        <thead>
                            <tr>
                            <th>Type</th>
                            <th>Numéro</th>
                            <th>Onduleur</th>
                            <th>Caractéristiques</th>
                            <th>Date début affectation</th>
                            <th>Observation</th>
                                                    </tr>
                        </thead>
                        <tbody>
                     
                   <?php while($row = $laptop->fetch(PDO::FETCH_ASSOC)) : ?>
                   <?php   $vall = $row['matl_id'] - 23 ; ?>

                            <tr>
                            <td><?php echo ($row['matl_name']); ?></td>
                            <td>MEI/LPTP/<?php echo $vall; ?></td>
<?php
if(!empty($row['matl_ondu']))  {
?>

                            <td>MEI/ONDU/<?php echo $vall ?></td>
<?php
} else {
?>  

                            <td>Pas d'Onduleur</td>
<?php
}
?>
                            <td><?php echo ($row['matl_caract']); ?></td>
<?php
if(!empty($row['date_debut'])) {
?> 
                            <td><?php echo ($row['date_debut']); ?></td>
<?php
} else {
?>   
                            <td>Non définie</td>
<?php
}
?> 

<?php
if(!empty($row['observation_l'])) {
?> 
                            <td><?php echo ($row['observation_l']); ?></td>
<?php
} else {
?>   
                            <td>Non définie</td>
<?php
}
?> 
                             

                                <!-- <td class="pending">pending</td> -->
                                <td><span><a data-toggle="modal" href="#m1Modal<?php echo $row['matl_id']; ?>"><i class="ri-edit-line edit"></a></i>
                                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                                <a href="delete_laptop.php?user_id=<?php echo $row['matl_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                                
                            </tr>
                            
                            <?php endwhile; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </p>

        <p id="user">

<div class="recent--patients">
    <div class="title">
        <h2 class="section--title">Bureaux</h2>
        <button class="add" onclick="document.getElementById('id02').style.display='block'" ><i class="ri-add-line"></i>Ajouter un PC bureau</button>
        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
</div>
<div class="table">
    <table id="myTable">
        <thead>
            <tr>
            <th>Type</th>
            <th>Numéro</th>
            <th>Clavier</th>
            <th>Souris</th>
            <th>Onduleur</th>
            <th>Ecran</th>
            <th>Caractéristiques</th>
            <th>Date début affectation</th>
            <th>Observation</th>
            </tr>
        </thead>
        <tbody>
     
    <?php while($raw = $info->fetch(PDO::FETCH_ASSOC)) : ?>
   

            <tr>
            <td><?php echo ($raw['mat_name']); ?></td>
            <td>PC-<?php echo ($raw['mat_num']); ?></td>
            <td>MEI/CLV/<?php echo ($raw['mat_clav']); ?></td>
            <td>MEI/SRS/<?php echo ($raw['mat_souris']); ?></td>
            
<?php
if(!empty($raw['mat_ondu']))  {
?>
            <td>MEI/OND/<?php echo ($raw['mat_ondu']); ?></td>
<?php
} else {
?>  
            <td>Pas d'Onduleur</td>
<?php      
      }
?>
            <td>MEI/ECR/<?php echo ($raw['mat_ecr']); ?></td>
            <td><?php echo ($raw['info_caract']); ?></td>
            <td><?php echo ($raw['date_first']); ?></td>
<?php
if(!empty($raw['observation_b'])) {
?>

            <td><?php echo ($raw['observation_b']); ?></td>

<?php
} else {
        ?>  
            <td>Aucune observation</td>
<?php      
      }
      ?>         <!-- <td class="pending">pending</td> -->
                <td><span><a data-toggle="modal" href="#m2Modal<?php echo $raw['mat_id']; ?>"><i class="ri-edit-line edit"></a></i>
                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                <a href="delete_desktop.php?user_id=<?php echo $raw['mat_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                
            </tr>
            
            <?php endwhile; ?>
            
        </tbody>
    </table>
</div>
</div>
</p>

        <p id="user">

<div class="recent--patients">
    <div class="title">
        <h2 class="section--title">Autres</h2>
        <button class="add" onclick="document.getElementById('id03').style.display='block'" ><i class="ri-add-line"></i>Ajouter un appareil</button>
        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
</div>
<div class="table">
    <table id="myTable">
        <thead>
            <tr>
            <th>N°</th>
            <th>Type</th>
            <th>Appareil</th>
            <th>Marque</th>
            </tr>
        </thead>
        <tbody>
     
   <?php while ($tab = $autre->fetch(PDO::FETCH_ASSOC)) :?>
  
            <tr>
            <td><?php echo $tab["autre_id"] ?></td> <br>
            <td><?php echo $tab["autre_name"] ?></td>    
            <td><?php echo $tab["type"] ?></td> <br>
            <td><?php echo $tab["marque"] ?></td>
         <!-- <td class="pending">pending</td> -->
                <td><span><a data-toggle="modal" href="#m3Modal<?php echo $tab['autre_id']; ?>"><i class="ri-edit-line edit"></a></i>
                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                <a href="delete_autre.php?user_id=<?php echo $tab['autre_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                
            </tr>
            
            <?php endwhile; ?>
            
        </tbody>
    </table>
</div>
</div>
</p>



        </div>
    </section>
    <script src="assets/js/main.js"></script>
    
 
 <!-- The Modal 01-->
 <div id="id01" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <!-- <h2>Modal Header</h2> -->
      
<div class="w3-container">
      <form action="insert_mat_user.php" method="POST">
  <h2 class="w3-text-blue">Un nouvel matériel</h2>
  <p>      
  <input class="w3-input w3-border" id="matil" name="matil" type="text" Value="Laptop"></p>
  <p>
  Insérer caractéristiques :
  <input class="w3-input w3-border" name="caract" id="caract" cols="30" rows="10" value="Ram: 
                                                                HDD:"></p>
                                                                       

    <p><input class="w3-input w3-border" id="datef" name="datef" type="date"></p>
    
<label >Bureau  :  </label>
<select  class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select></p>
  Avec un nouvel onduleur  ?  <input  type="checkbox" name="ondu" id="ondu" value="ondu">  
  

  <br> <br>
  <button class="add w3-blue">Ajouter</button></p>

</form>
<br>
      </div>
      <!-- <footer class="w3-container w3-blue">
        <p>Modal Footer</p>

      </footer> -->
    </div>
  </div>


<!-- The Modal 02-->
<div id="id02" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('id02').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <!-- <h2>Modal Header</h2> -->
      
<div class="w3-container">
      <form action="insert_mat_user.php" method="POST">
  <h2 class="w3-text-blue">Un nouvel matériel</h2>
  <p>      
  <input class="w3-input w3-border" id="mati" name="mati" type="text" Value="Ordinateur bureau"></p>
  <p>
  Insérer caractéristiques :
  <input class="w3-input w3-border" name="caract" id="caract" cols="30" rows="10" value="Ram: 
                                                                HDD:"></p>
                                                                       

    <p><input class="w3-input w3-border" id="datef" name="datef" type="date"></p>
    
   <label for="standard-select">Bureau  :  </label>
<select  class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select>
  </p>
  Avec un nouvel onduleur  ?  <input  type="checkbox" name="ondu" id="ondu" value="ondu">  
  

  <br> <br>
  <button class="add w3-blue">Ajouter</button></p>

</form>
<br>
      </div>
      <!-- <footer class="w3-container w3-blue">
        <p>Modal Footer</p>

      </footer> -->
    </div>
  </div>


<!-- The Modal 03-->
<div id="id03" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('id03').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <!-- <h2>Modal Header</h2> -->
      
<div class="w3-container">
      <form action="insert_mat_user.php" method="POST">
  <h2 class="w3-text-blue">Un nouvel matériel</h2>

  <select class="w3-input w3-border" name="matt" id="matt"> 
            <option value="Téléphone" id="Téléphone">Téléphone</option>
            <option value="Tablette" id="Tablette">Tablette</option>
  </select> 
  <br>
  <p>
  <input class="w3-input w3-border" name="marque" id="marque" cols="30" rows="10" placeholder="Marque"></p>
                                                                          
  <button class="add w3-blue">Ajouter</button></p>

</form>
<br>
      </div>
      <!-- <footer class="w3-container w3-blue">
        <p>Modal Footer</p>

      </footer> -->
    </div>
  </div>



 <!-- The Modal update 1-->
<?php 
 
     $sql = "SELECT * FROM materiel_info_laptop" ;
     $sttl = $pdo -> query($sql);

    while($row = $sttl->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 

  <div class="modal fade" id="m1Modal<?php echo $row['matl_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="w3-container">
      <form action="update_mat_users.php" method="POST">
  <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
  <p>      
  <input class="w3-input w3-border" style="display:none;" id="idl" name="idl" type="text" Value="<?php echo $row['matl_id'] ?>"></p>
  <p>
  Insérer caractéristiques :
  <input class="w3-input w3-border" name="caract" id="caract" cols="30" rows="10" value="<?php echo $row['matl_caract']; ?>"></p>
                                                                       

  <p><input class="w3-input w3-border" id="datef" name="datef" type="date" value="<?php echo $row['date_debut']; ?>"></p>
      
<select class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select></p>
  Observation :
  <p><input class="w3-input w3-border" id="obse" name="obse" type="text"  value="<?php echo $row['observation_l']; ?>"></p>
  Avec un nouvel onduleur  ?  <input  type="checkbox" name="ondul" id="ondul">  
  

  <br> <br> 
  

  <button type="submit" class="add w3-blue">Modifier</button></p>

</form>  </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
  
</div>

<?php endwhile;?>

<!-- The Modal update 2-->
<?php 
 
     $sql = "SELECT * FROM materiel_info_bureau" ;
     $sttb = $pdo -> query($sql);

    while($row = $sttb->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 


  <div class="modal fade" id="m2Modal<?php echo $row['mat_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="w3-container">
      <form action="update_mat_users.php" method="POST">
  <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> --> 
  <p>      
  <input class="w3-input w3-border" style="display:none;" id="idb" name="idb" type="text" Value="<?php echo $row['mat_id'] ?>"></p>
  <p>      
  <input class="w3-input w3-border" id="matn" name="matn" type="text" Value="<?php echo $row['mat_name'] ?>"></p>
  <p>
  Insérer caractéristiques :
  <input class="w3-input w3-border" name="caractb" id="caractb" cols="30" rows="10" value="<?php echo $row['info_caract']; ?>"></p>
                                                                       

  <p><input class="w3-input w3-border" id="datefb" name="datefb" type="date" value="<?php echo $row['date_first']; ?>"></p>
      
<select class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select></p>
  <p><input class="w3-input w3-border" id="obse" name="obse" type="textarea" placeholder="Ajouter une observation" value="<?php echo $row['observation_b']; ?>"></p>
  Avec un nouvel onduleur  ?  <input  type="checkbox" name="ondul" id="ondul">  <br><br>
  <button type="submit" class="add w3-blue">Modifier</button></p>

</form>  </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
  
</div>

<?php endwhile;?>



<!-- The Modal update 3-->
<?php 
 
     $sql = "SELECT * FROM autres" ;
     $stta = $pdo -> query($sql);

    while($row = $stta->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 
  <div class="modal fade" id="m3Modal<?php echo $row['autre_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="w3-container">
            <br>
      <form action="update_mat_users.php" method="POST">
  <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
  <p>      
  Marque :    
  <input class="w3-input w3-border" style="display:none;" id="idau" name="idau" type="text" Value="<?php echo $row['autre_id'] ?>"></p>
  <p>
  <input class="w3-input w3-border" name="marque" id="marque" cols="30" rows="10" value="<?php echo $row['marque']; ?>"></p>
  <select class="w3-input w3-border" name="typ" id="typ">
      <option value="Téléphone">Téléphone</option>
      <option value="Tablette">Tablette</option>
  </select>
     <br>                                                                   
  <button type="submit" class="add w3-blue">Modifier</button></p>

</form>  </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
  
</div>


<?php endwhile; 

$ret = ("SELECT * FROM users WHERE user_id = $num") ;
$um = $pdo-> query($ret) ;

while($row = $um->fetch(PDO::FETCH_ASSOC)) : 
?>


<div class="container mt-3">
 
 <div class="modal fade" id="set">
   <div class="modal-dialog">
     <div class="modal-content">

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Mettre à jours vos informations</h4>
         <button type="button" class="close" data-dismiss="modal">×</button>
       </div>
       
       <!-- Modal body -->
       <div class="w3-container">
           <br>
     <form action="update_mat_users.php" method="POST">
 <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
 <p>
         
 <input class="w3-input w3-border" style="display:none;" id="iu" name="iu" type="text" Value="<?php echo $row['user_id'];  ?>"></p>
 <p>
 Nom :<input class="w3-input w3-border" name="nomu" id="nomu" cols="30" rows="10" value="<?php echo $row['username']; ?>"></p>
 <p>
 Fonction :<input class="w3-input w3-border" name="asa" id="asa" cols="30" rows="10" value="<?php echo $row['user_fonction']; ?>"></p>
 <p>
 Contact :<input class="w3-input w3-border" name="tel" id="tel" cols="30" rows="10" value="<?php echo $row['contact']; ?>"></p>
 <p>
 Mot de passe :<input class="w3-input w3-border" name="pass" id="pass" cols="30" rows="10" value="<?php echo $row['password']; ?>"></p>

Bureau :<select class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select>
    <br>        
    <!-- <b>Note :</b>En cas de modification, il faudra vous reconnecter ! <br>                                                             -->
 <button type="submit" class="add w3-blue">Modifier</button></p>

</form>  </div>
       
       <!-- Modal footer -->
       <div class="modal-footer">
       </div>
       
     </div>
   </div>
 </div>
 
</div>
<?php endwhile;

?>


</body>
<script>

function affbureau() {
    document.getElementById("myInput").placeholder="Rechercher un matériel" ;
    document.getElementsBy ("user").style.display="none";
}

function searchfunction() {
      // Declare variables
      var input, filter, table, tr, td, i, txtValue,j;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
    
      // Loop through all table rows, and hide those who don't match the search query
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        for(j=0;j<td.length;j++){
          if(td[j]){
            txtValue = td[j].textContent || td[j].innerText;
            txtValue= txtValue.toUpperCase();
             if (txtValue.indexOf(filter) > -1) {
              tr[i].style.display = "";
              break;
             }else {
            tr[i].style.display = "none";
          }
        
          }
        }
       
      
    }
  }


</script>
</html>