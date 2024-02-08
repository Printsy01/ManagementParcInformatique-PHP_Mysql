<?php
  session_start();
  require 'serveur.php' ;

  $sql = "SELECT * FROM user_admin" ;
  $stmt = $pdo -> query($sql);

if($stmt === false){
    die("Erreur");
   }

   $sqlt = "SELECT * FROM office" ;
   $stmto = $pdo -> query($sqlt);
 
 if($stmto === false){
     die("Erreur");
    }

   $person = ("SELECT COUNT(*) as nb FROM office ") ;
   $req = $pdo->query($person) ;
   $res = $req->fetchAll();

  foreach ($res as $u) {
         $nb = $u['nb'];
  }

  $bureau = ("SELECT COUNT(*) as nbb FROM user_admin") ;
  $rea = $pdo->query($bureau) ;
  $reb = $rea->fetchAll();

 foreach ($reb as $u) {
        $nbb = $u['nbb'];
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
                        <span class="icon icon-4"><i class="fa-solid fa-tablet-button"></i></span>
                        <span class="sidebar--item">Autres</span>
                    </a>
                </li>
               
            </ul>
            <ul class="sidebar--bottom-items">
            
             
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
                                            Les bureaux</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nb; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-table"></i>
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
                                            Les Admins</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $nbb; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fa-solid fa-user"></i>
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
                        <h2 class="section--title">Les Admins</h2>
                        <button class="add" onclick="document.getElementById('sot').style.display='block'" ><i class="ri-add-line"></i>Ajouter un admin</button>
                        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
                </div>
                <div class="table">
                    <table id="myTable">
                        <thead>
                            <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Mot de passe</th>
                            </tr>
                        </thead>
                        <tbody>
                     
                   <?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
                 

                            <tr>
                            <td><?php echo $row['usera_id']; ?></td>
                            <td><?php echo $row['useraname']; ?></td>
                                <td><?php echo $row['password']; ?></td>
                             

                                <!-- <td class="pending">pending</td> -->
                                <td><span><a data-toggle="modal" href="#myModal<?php echo $row['usera_id']; ?>"><i class="ri-edit-line edit"></a></i>
                                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                                <a href="delete_admin.php?usera_id=<?php echo $row['usera_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                                
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
        <h2 class="section--title">Les bureaux</h2>
        <button class="add" onclick="document.getElementById('bure').style.display='block'" ><i class="ri-add-line"></i>Ajouter un bureau</button>
        <!-- <a data-toggle="modal" href="#myModal">Open Modal</a> -->
</div>
<div class="table">
    <table id="myTable">
        <thead>
            <tr>
            <th>Numéro</th>
            <th>Bureaux</th>
            </tr>
        </thead>
        <tbody>
     
   <?php while($row = $stmto->fetch(PDO::FETCH_ASSOC)) : ?>
 

            <tr>
            <td><?php echo $row['office_id']; ?></td>
            <td><?php echo $row['office_name']; ?></td>

             

                <!-- <td class="pending">pending</td> -->
                <td><span><a data-toggle="modal" href="#myModal1<?php echo $row['office_id']; ?>"><i class="ri-edit-line edit"></a></i>
                <!-- <td><button onclick="document.getElementById('id02').style.display='block'"><span><i class="ri-edit-line edit"></i></button> -->
                <a href="delete_office.php?office_id=<?php echo $row['office_id']; ?>"><i class="ri-delete-bin-line delete"></i></span></a></td>
                
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
    
 
 <!-- The Modal INSERT -->
 <div id="bure" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('bure').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
  

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Un nouvel bureau</h4>
       </div>
       
       <!-- Modal body -->
       <div class="w3-container">
           <br>
     <form action="insert_admin.php" method="POST">
 <!-- <h2 class="w3-text-blue">Un nouvel matériel</h2> -->
 <p>
 <input class="w3-input w3-border" name="offi" id="offi" cols="30" rows="10" placeholder="Nom"></p>
 <p>
 <button type="submit" class="add w3-blue">Ajouter</button></p>
</form>  </div>
       
       <!-- Modal footer -->
       <div class="modal-footer">
       </div>
       
     </div>
   </div>
 </div>
 
</div>

<!--USERS UPDATE -->
<?php 

      
     $sql = "SELECT * FROM user_admin" ;
     $stt = $pdo -> query($sql);

    while($row = $stt->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 

  <!-- The Modal -->
  <div class="modal fade" id="myModal<?php echo $row['usera_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="update_mat_admin.php" method="POST">
          <p>      <br>
  <input class="w3-input w3-border" style="display:none;" id="idua" name="idua" type="text" value="<?php echo ($row['usera_id']); ?>"></p>
          <input class="w3-input w3-border" id="nomia" name="nomia" type="text" value="<?php echo ($row['useraname']); ?>"></p>
          <p> <input class="w3-input w3-border" id="passa" name="passa" type="text" value="<?php echo ($row['password']); ?>"></p>
 

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

<!--USERS UPDATE -->
<?php 

      
     $sql = "SELECT * FROM office" ;
     $strt = $pdo -> query($sql);

    while($row = $strt->fetch(PDO::FETCH_ASSOC)) : 
?>

<div class="container mt-3">
 

  <!-- The Modal -->
  <div class="modal fade" id="myModal1<?php echo $row['office_id']; ?>">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Apporter une modification</h4>
          <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <form action="update_mat_admin.php" method="POST">
          <p>      <br>
  <input class="w3-input w3-border" style="display:none;" id="bnum" name="bnum" type="text" value="<?php echo ($row['office_id']); ?>"></p>
          <input class="w3-input w3-border" id="birao" name="birao" type="text" value="<?php echo ($row['office_name']); ?>"></p>
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

 <div id="sot" class="w3-modal" style="" >
    <div style="width:500px;border-radius:10px;" class="w3-modal-content w3-animate-top w3-card-4">
      <!-- <header class="w3-container w3-blue">  -->
        <span onclick="document.getElementById('sot').style.display='none'" 
        class="w3-button w3-display-topright">&times;</span>
  

       <!-- Modal Header -->
       <div class="modal-header">
         <h4 class="modal-title">Un nouvel administrateur</h4>
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