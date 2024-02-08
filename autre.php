<?php
  session_start();
  require 'serveur.php' ;

  $tel = ("SELECT * FROM autres ") ;
  $autr = $pdo -> query($tel) ;

if($autr === false){
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
                    <a href="bureau.php" onclick="affbureau()">
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
                    <a href="autre.php"   id="active--link">
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
                        <h2 class="section--title">Les autres</h2>
                        <!-- <button class="add" onclick="document.getElementById('id01').style.display='block'" ><i class="ri-add-line"></i>Ajouter un appareil</button> -->
                        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
                </div>
                <div class="card shadow mb-4">

                        <!-- <div class="card-body"> -->
                <div class="table-responsive">
                    <table id="myTable1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                            <th>N°</th>
                            <th>Propriétaire</th>
                            <th>Type</th>
                            <th>Appareil</th>
                            <th>Marque</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                   <?php while($tab = $autr->fetch(PDO::FETCH_ASSOC)) : ?>
                   

                            <tr>
                            <td><?php echo $tab["autre_id"] ?></td>
                            <td><?php echo $tab["user_id"] ?></td>
                            <td><?php echo $tab["autre_name"] ?></td>    
                            <td><?php echo $tab["type"] ?></td> <br>
                            <td><?php echo $tab["marque"] ?></td>
         <!-- <td class="pending">pending</td> -->
                <td><span><a data-toggle="modal" href="#m3Modal<?php echo $tab['autre_id']; ?>"><i class="ri-edit-line edit"></a></i>
                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                <a href="delete_autre_admin.php?user_id=<?php echo $tab['autre_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                
                            </tr>
                            
                            <?php endwhile; ?>
                            
                        </tbody>
                    </table>
                    <br> <br>
                    <b>Notice:</b>Pour ajouter un appareil il faudra vous connecter avec le profil de l'utilisateur voulu
                    <a href="login.php">Se connecter ?</a>
                </div>
            </div>
            </div>
            </div>
        </p>
        </div>
    </section>
    <script src="assets/js/main.js"></script>
    


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
      <form action="update_mat_admin.php" method="POST">
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
      table = document.getElementById("myTable1");
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