<?php
  session_start() ;
  require 'serveur.php' ;
  
  $name = $_SESSION['name'] ;
  $password = $_SESSION['password'] ;

  $_SESSION["nom"] = $name ;
  $_SESSION["mdp"] = $password ;
  // var_dump($_SESSION) ;

  if(!empty($_SESSION['name'] and !empty($_SESSION['password']))) 
  {

    
    // $stmt = ("SELECT user_id FROM users WHERE username = '$name' ");
    // // $stmt->execute(array($name)) ;
    // $res = $pdo->query($stmt);
    // $num = $res->fetchAll() ;
    
    $stmt = $pdo->prepare("SELECT * FROM users") ;
    $stmt->execute() ;
    $utilisateur = $stmt->fetchAll();
    
    foreach($utilisateur as $u) {

      if($u['username'] == $name) {
        $num = $u['user_id'] ;
      } 
      
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

    // $users = $pdo->prepare("SELECT * FROM users WHERE user_id = ?") ;
    // $users->execute(array($num)) ;
    // $util = $users->fetchAll();
    
    // $stm = $pdo->prepare(" SELECT * FROM users WHERE username = ? ") ;
    // $stm->execute(array($name));
    // $user = $stm->fetchAll();
    
    $stmtn = ("SELECT * FROM materiel_info_bureau WHERE user_id = $num ");
    $info = $pdo->query($stmtn);
    
    // $pc = $pdo->prepare("SELECT mat_id FROM materiel_info_bureau WHERE") ;
    // // $last = $pdo->lastId() ;
    // $_SESSION["nume"] = $last ;
    
    $stmtnt = ("SELECT * FROM materiel_info_laptop WHERE user_id = $num");
    $laptop = $pdo->query($stmtnt);

    $tel = ("SELECT * FROM autres WHERE user_id = $num") ;
    $autre = $pdo->query($tel) ;
    
    ?> 

  <?php
  while($row = $util->fetch(PDO::FETCH_ASSOC)) :
    ?>

  
  Pseudo : <?php echo ($row["username"]) ?> <br>
  Fonction : <?php echo ($row["user_fonction"])?> <br>
  Bureau : <?php echo ($row["office_id"])?> <br>
  Contact : <?php echo ($row["contact"])?> <br>
  Mot de passe actuel :<?php echo ($row["password"]) ?>
   

    <?php endwhile; ?>
    <br> <br>

    <h2>Vos matériels informatiques</h2> <br> 

<h4><u>Bureau</u></h4> <br>
<table border="1">
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
       <td><?php echo ($raw['mat_num']); ?></td>
       <td><?php echo ($raw['mat_clav']); ?></td>
       <td><?php echo ($raw['mat_souris']); ?></td>

<?php
if(!empty($row['mat_ondu']))  {
?>
       <td><?php echo ($row['mat_ondu']); ?></td>
<?php
} else {
?>  
       <td>Pas d'Onduleur</td>
<?php      
      }
?>
       <td><?php echo ($raw['mat_ecr']); ?></td>
       <td><?php echo ($raw['info_caract']); ?></td>
       <td><?php echo ($raw['date_first']); ?></td>

<?php
       if(!empty($raw['observation'])) {
         ?>

      <td><?php echo ($raw['observation']); ?></td>

<?php
      }else {
        ?>  
      <td>Aucune observation</td>
<?php      
      }
      ?>
        </tr>
<?php endwhile; ?>
</tbody>
</table>
 <br> <br> <br>
<h4><u>Laptop</u></h4>

 <table border="1">
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

 <tr>
 <td><?php echo ($row['matl_name']); ?></td>
 <td><?php echo ($row['matl_num']); ?></td>
<?php
if(!empty($row['matl_ondu']))  {
  ?>

 <td><?php echo ($row['matl_ondu']); ?></td>

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
if(!empty($row['Observation'])) {
  ?> 
 <td><?php echo ($row['Observation']); ?></td>
 <?php
} else {
  ?>   
 <td>Non définie</td>
<?php
  }
  ?> 
 </tr>

 <?php endwhile; ?>
 </tbody>
 </table> <br> <br>

<h4>Autres</h4>
<table border="1">
<tr>
<thead>
<th>Type</th>
<th>Appareil</th>
</thead>
</tr>

<tbody>
<?php while ($tab = $autre->fetch(PDO::FETCH_ASSOC)) :?>
<tr>
<td><?php echo $tab["type"] ?></td> <br>
<td><?php echo $tab["autre_name"] ?></td>
</tr> 
<br> <br>
 <?php endwhile; ?>
</tbody>

</table>
<a href="update.php"><input type="button" value="Ajouter un matériel"></a>
<?php
} else {
  header("Location : Admin/login.php ") ;
}
?>