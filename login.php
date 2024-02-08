<?php
  session_start();
  require 'serveur.php' ;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
      src="connexion.js"
    ></script>
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="assets/css/bootstrap.css"> -->
    <!-- <link rel="stylesheet" href="assets/css/style.css"> -->

    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="" class="sign-in-form" method="POST">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" id="name" name="name"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" id="password" name="password" />
            </div>
            <input type="submit" value="Login" class="btn solid" />
            <p class="social-text">Or Sign in with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>

<?php
     
     function test_input($data) {
           
         $data = trim($data);
         $data = stripslashes($data);
         $data = htmlspecialchars($data);
         return $data;
     }
        
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
           
         $name = test_input($_POST["name"]);
         $password = test_input($_POST["password"]);

         $stmt = $pdo->prepare("SELECT * FROM user_admin");
         $stmt->execute();
         $users = $stmt->fetchAll();   
   
         $stmtn = $pdo->prepare("SELECT * FROM users Where username='$name'");
         $stmtn->execute() ;
         $util = $stmtn->fetchAll();
   
         $_SESSION['name'] = $name ;
         $_SESSION['password'] = $password ;
         
         $n = 3 ;
         
         foreach($users as $user) {
               
             if(($user['useraname'] == $name) && ($user['password'] == $password)) 
             {
                $n = 1 ; 
             }
           //   else {
           //       echo "<script language='javascript'>";
           //       echo "alert('WRONG INFORMATION')";
           //       echo "</script>";
           //       die();
           //   }
         }
   
         foreach($util as $uti) {
   
            if(($uti['username'] == $name) && ($uti['password'] == $password)) 
            {
                $n = 2 ;   
            }
         }

        switch ($n) {
          case 1 : header("Location: http://localhost/projet/Dashboard.php");
          break ;
          case 2 : header("Location: http://localhost/projet/perso1.php") ;
          
          default :   echo "<script language='javascript'>";
                      echo "alert('WRONG INFORMATION')";
                      echo "</script>";
                      die();
                      break ;
        }

     }
       
?>

          <form name="signUp" action="insert.php" onsubmit="return checkForm()" class="sign-up-form" method="POST">
            <h2 class="title">Sign up</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Username" id="nomi" name="nomi"/>
            </div>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="text" placeholder="Contact" id="contact" name="contact" />
            </div>

            <div class="input-field">
            <i class="fa fa-industry" aria-hidden="true"></i>
              <input type="text" placeholder="Fonction" id="fonct" name="fonct" />
            </div>

            <div class="input-field">
              <i class="fa fa-shield" aria-hidden="true"></i>
              <input type="text" placeholder="Mot de passe" id="pwd" name="pwd" />
            </div>

<?php 

  $getdata = "SELECT * FROM office" ;
  $stm = $pdo->query($getdata);  
?>          



<div>
<label for="standard-select">Bureau  :  </label>
<select  style='border:thin solid blue; border-radius:15px;'  name="offtype" id="offtype">
  <?php while($row = $stm->fetch(PDO::FETCH_ASSOC)) : ?>
    <option value="<?php echo $row['office_id']?>"><?php echo $row['office_name'] ?></option>
  <?php endwhile; ?>
  </select>

  <span class="focus"></span>
</div>


            <input type="submit" class="btn" value="Sign up" />
            <p class="social-text">Or Sign up with social platforms</p>
            <div class="social-media">
              <a href="#" class="social-icon">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-google"></i>
              </a>
              <a href="#" class="social-icon">
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>Nouveau ?</h3>
            <p>
              Veuillez cliquer ici pour créer votre profil
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="img/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Vous avez déja un profil ?</h3>
            <p>
               Veuillez cliquer ici pour vous connecter
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Se connecter
            </button>
          </div>
          <img src="img/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="app.js"></script>
  </body>

  <script>
function checkForm() {
  var nom = document.forms["signUp"]["nomi"].value;
      contact = document.forms["signUp"]["contact"].value;
      passw = document.forms["signUp"]["pwd"].value;
      asa = document.forms["signUp"]["fonct"].value;
      
      if(nom == "" || contact == "" || passw == "" || asa == "") {
        alert("Veuillez tout remplir");
        return false;
      }

}
  </script>
</html>
