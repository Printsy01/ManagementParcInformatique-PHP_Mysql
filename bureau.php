<?php
  session_start();
  require 'serveur.php' ;

  $sql = ("SELECT * FROM materiel_info_bureau") ;
  $stmt = $pdo -> query($sql);

if($stmt === false){
    die("Erreur");
   }

   $person = ("SELECT COUNT(*) as nb FROM users ") ;
   $req = $pdo->query($person) ;
   $res = $req->fetchAll();

  foreach ($res as $u) {
         $nb = $u['nb'];
  }

  $bureau = ("SELECT COUNT(*) as nbb FROM materiel_info_bureau") ;
  $rea = $pdo->query($bureau) ;
  $reb = $rea->fetchAll();

 foreach ($reb as $u) {
        $nbb = $u['nbb'];
 }

 $laptop = ("SELECT COUNT(*) as nbl FROM materiel_info_laptop") ;
 $rec = $pdo->query($laptop) ;
 $rel = $rec->fetchAll();

foreach ($rel as $u) {
       $nbl = $u['nbl'];
}

$autre = ("SELECT COUNT(*) as nba FROM autres") ;
$red = $pdo->query($autre) ;
$ret = $red->fetchAll();

foreach ($ret as $u) {
      $nba = $u['nba'];
}
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

        <div class="search">
                <input type="text" id="myInput" onkeyup="searchfunction()" placeholder="Rechercher">
                <button><i class="ri-search-2-line"></i></button>
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
                    <a href="Dashboard.php">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="bureau.php"  id="active--link" onclick="affbureau()">
                        <span class="icon icon-2"><i class="fa-solid fa-computer"></i></span>
                        <span class="sidebar--item">Ordinateur bureau</span>
                    </a>
                </li>
                <li>
                    <a href="laptop.php">
                        <span class="icon icon-3"><i class="fa-solid fa-laptop"></i></span>
                        <span class="sidebar--item" style="white-space: nowrap;">Laptop</span>
                    </a>
                </li>
                <li>
                    <a href="autre.php">
                        <span class="icon icon-4"><i class="fa-solid fa-tablet-button"></i></span>
                        <span class="sidebar--item">Autres</span>
                    </a>
                </li>
               
            </ul>
            <ul class="sidebar--bottom-items">
            <li>
                    <a href="gest.php">
                    <span class="icon icon-7"><i class="add"></i></span>
                        <span class="sidebar--item">Gestion interne</span>
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
            <!-- <div class="overview">
                <div class="title">
                    <h2 class="section--title">Overview</h2>
     
                </div>
                <div class="row">

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Users</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nb; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-user"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            PC bureaux</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbb; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-computer"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">PC laptop
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $nbl; ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="">
                                                        <div class="" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-laptop"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                            Autres</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nba; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-tablet-screen-button"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div> -->

            <p id="user">

                <div class="recent--patients">
                    <div class="title">
                        <h2 class="section--title">PC bureaux</h2>
                        
                        <!-- <button class="add" onclick="document.getElementById('id01').style.display='block'" ><i class="ri-add-line"></i>Ajouter un PC bureau</button> -->
                        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
                </div>

                <div class="card shadow mb-4">
                        <div class="card-header py-3">
                           
                        </div>
                        <!-- <div class="card-body"> -->
                <div class="table-responsive">
                    <table id="myTable2" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            
                            <th>Numéro</th>
                            <th>Propriétaire</th>
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
                     
                   <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                   

                            <tr>
                            
                            <td>PC-<?php echo ($row['mat_num']); ?></td>
                            <td><?php echo ($row['user_id']); ?></td>
                            <td>MEI/CLV/<?php echo ($row['mat_clav']); ?></td>
                            <td>MEI/SRS/<?php echo ($row['mat_souris']); ?></td>
            


<?php
if(!empty($row['mat_ondu']))  {
?>
                            <td>MEI/OND/<?php echo ($row['mat_ondu']); ?></td>
<?php
} else {
?>  
                            <td>Pas d'Onduleur</td>
<?php      
      }
?>
                            <td>MEI/ECR/<?php echo ($row['mat_ecr']); ?></td>
                            <td><?php echo ($row['info_caract']); ?></td>
                            <td><?php echo ($row['date_first']); ?></td>
<?php
if(!empty($row['observation_b'])) {
?>

                            <td><?php echo ($row['observation_b']); ?></td>

<?php
} else {
        ?>  
                            <td>Aucune observation</td>
<?php      
      }
      ?>         <!-- <td class="pending">pending</td> -->
                <td><span><a data-toggle="modal" href="#m2Modal<?php echo $row['mat_id']; ?>"><i class="ri-edit-line edit"></a></i>
                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                <a href="delete_desktop_admin.php?user_id=<?php echo $row['mat_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                
            </tr>
                            
                            <?php endwhile; ?>
                            
                        </tbody>
                    </table>
                    <br> <br>
                    <b>Notice : </b>Pour ajouter un appareil il faudra vous connecter avec le profil de l'utilisateur voulu 
                    <a href="login.php">Se connecter ?</a>
                    <!-- </div> -->
                    </div>
                </div>
            </div>
        </p>
        </div>
        
    </section>
    
    <script src="assets/js/main.js"></script>
    

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
  <form action="update_mat_admin.php" method="POST">
<!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
<p>      
<input class="w3-input w3-border" style="display:none;" id="idb" name="idb" type="text" Value="<?php echo $row['mat_id'] ?>"></p>
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


<!-- ADMIN UPDATE   -->

<div class="container mt-3">
 
 <div class="modal fade" id="sot">
   <div class="modal-dialog">
     <div class="modal-content">

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Un nouvel administrateur</h4>
         <button type="button" class="close" data-dismiss="modal">×</button>
       </div>
       
       <!-- Modal body -->
       <div class="w3-container">
           <br>
     <form action="insert_admin.php" method="POST">
 <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
 <p>
 <input class="w3-input w3-border" name="admin" id="admin" cols="30" rows="10" placeholder="Nom"></p>
 <p>
 <input class="w3-input w3-border" name="admip" id="admip" cols="30" rows="10" placeholder="Mot de passe"></p>
 <button type="submit" class="add w3-blue">Ajouter</button></p>
</form>  </div>
       
       <!-- Modal footer -->
       <div class="modal-footer">
       </div>
       
     </div>
   </div>
 </div>
 
</div>
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
      table = document.getElementById("myTable2");
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