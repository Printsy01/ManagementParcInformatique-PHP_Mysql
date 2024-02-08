<?php
  session_start();
  require 'serveur.php' ;

  $sql = "SELECT * FROM users" ;
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
                    <a href="Dashboard.php" id="active--link">
                        <span class="icon icon-1"><i class="ri-layout-grid-line"></i></span>
                        <span class="sidebar--item">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="bureau.php">
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
                    <span class="icon icon-3"><i class="fa-solid fa-tablet"></i></span>
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
            <div class="overview">
                <div class="title">
                    <h2 class="section--title">Overview</h2>
     
                </div>
                <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" id="usercard" onmouseover="userover()">
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

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4" >
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
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

                        <!-- Earnings (Monthly) Card Example -->
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

                        <!-- Pending Requests Card Example -->
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


                        <div class="col-xl-3 col-md-6 mb-4" >
                            <div class="card border-left-warning shadow h-100 py-2"  style="border-radius:50%;">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2" style="text-align:center;">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" >                                            
                                          Time
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><p id="hour"></p></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

            <p id="user">

                <div class="recent--patients">
                    <div class="title">
                        <h2 class="section--title">Users</h2>
                        <button class="add" onclick="document.getElementById('id01').style.display='block'" ><i class="ri-add-line"></i>Add user</button>
                        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
                </div>
                <div class="table">
                    <table id="myTable">
                        <thead>
                            <tr>
                                <th>N° utilisateur</th>
                                <th>Pseudo</th>
                                <th>Fonction</th>
                                <th>Bureau</th>
                                <th>Contact</th>
                                <th>Password</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                   <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
                   <?php   $val = $row['user_id'] - 119 ; ?>

                            <tr>
                                <td><?php echo $row['user_id']; ?></td>

                                <td><?php echo ($row['username']); ?></td>
                           

                                <td><?php echo ($row['user_fonction']); ?></td>
                              

                                <td><?php echo ($row['office_id']); ?></td>
                               

                                <td>0<?php echo ($row['contact']); ?></td>
                               

                                <td><?php echo ($row['password']); ?></td>
                             

                                <!-- <td class="pending">pending</td> -->
                                <td><span><a data-toggle="modal" href="#myModal<?php echo $row['user_id']; ?>">Modifier<i class="ri-edit-line edit"></a></i>
                                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                                <a href="delete.php?user_id=<?php echo $row['user_id']; ?>">delete<i class="ri-delete-bin-line delete"></i>
                                <!-- <a href="perso1.php?userin_id=<?php echo $row['user_id']; ?>"><i class="ri-delete-bin-line delete"></i></a> -->
                                </span></a></td>
                                
                            </tr>
                            
                   <?php }; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </p>
        </div>
    </section>
    <script src="assets/js/main.js"></script>
    


 <!-- The Modal INSERT -->
 <div id="id01" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('id01').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
        <!-- <h2>Modal Header</h2> -->
      
<div class="w3-container">
      <form action="insert1.php" method="POST">
  <h2 class="w3-text-blue">Un nouvel utilisateur</h2>
  <p></p>
  <p>      
  <input class="w3-input w3-border" id="nomi" name="nomi" type="text" placeholder="Nom"></p>
  <p>      <br>
  <input class="w3-input w3-border" id="contact" name="contact" type="text" placeholder="Contact"></p>    
  <p>          <br> 
  <input class="w3-input w3-border" id="pwd" name="pwd" type="text" placeholder="Mot de passe"></p>
  <p>      <br>
  <input class="w3-input w3-border" id="fonct" name="fonct" type="text" placeholder="Fonction"></p>
  <p>      <br>
  <label for="standard-select">Bureau  :  </label>
<select  class="w3-input w3-border" style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select></p>

  <br>
  <button class="add w3-blue">Ajouter</button></p>

</form>
<br>
      </div>
      <!-- <footer class="w3-container w3-blue">
        <p>Modal Footer</p>

      </footer> -->
    </div>
  </div>

<!--USERS UPDATE -->
<?php 

      
     $sql = "SELECT * FROM users" ;
     $stt = $pdo -> query($sql);

    while($row = $stt->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 

  <!-- The Modal -->
  <div class="modal fade" id="myModal<?php echo $row['user_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="update.php" method="POST">
          <p>      <br>
  <input class="w3-input w3-border" style="display:none;" id="idu" name="idu" type="text" value="<?php echo ($row['user_id']); ?>"></p>
          <input class="w3-input w3-border" id="nomi" name="nomi" type="text" value="<?php echo ($row['username']); ?>"></p>
  <p>      <br>
  <input class="w3-input w3-border" id="contact" name="contact" type="text" value="<?php echo ($row['contact']); ?>"></p>    
  <p>          <br> 
  <input class="w3-input w3-border" id="pwd" name="pwd" type="text" value="<?php echo ($row['password']); ?>"></p>
  <p>      <br>
  <input class="w3-input w3-border" id="fonct" name="fonct" type="text" value="<?php echo ($row['user_fonction']); ?>"></p>
  <p>      <br>
  <label for="standard-select">Bureau  :  </label>
<select  style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
    <option value="1" id="CIRDOMA">CIRDOMA</option>
    <option value="2" id="BAV 1">BAV 1</option>
    <option value="3" id="BAV 2">BAV 2</option>
    <option value="4" id="BAV 4">BAV 4</option>
    <option value="5" id="ARCHIVE">ARCHIVE</option>
    <option value="6" id="GUICHET">GUICHET</option>
  </select>
</p> 

<input type="submit" class="btn btn-primary" value="Modifier" style="float:right;">
<!-- <button type="button" class="btn btn-danger" data-dismiss="modal" style="float:right;">Close</button> -->
          </form>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
        </div>
        
      </div>
    </div>
  </div>
  
</div>

<?php endwhile; ?>


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
var myVar = setInterval(myTimer, 1000);

function myTimer() {
  var d = new Date();
  document.getElementById("hour").innerHTML = d.toLocaleTimeString();
}

function userover() {
    document.getElementById("usercard").width="5px" ;
}



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