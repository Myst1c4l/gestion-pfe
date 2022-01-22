<?php
include "./includes/connexion.php";
if(isset($_POST['envoie']))
{
  $login = $_POST['mail'];
  $pass  = $_POST['mdpass'];
  $query = "select * from administration where login = '".$login."' and motdepasse = '".$pass."'";
  $result= mysqli_query($link,$query);
  $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result))
    {
      session_start();
      $_SESSION['login']=$row['login'];
      header("location: ./listeAdministration.php");
    }
    else
    {
        echo "Email ou mdp incorrectes";
    }
}
else { 

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="login.css" />
  <title>Administration</title>
</head>
<body>
    <div class="container">
    <a href="./Acceuil.php">Accueil</a>
      <div id="left">
        <h1>Connectez-Vous <br/>Espace Administration</h1>
        <form action="Administration.php" method="POST">
          <input
            type="text"
            name="mail"
            placeholder="LogIn"
            class="log" value="<?php if(isset($_COOKIE['emailadmi'])) echo $_COOKIE['emailadmi']; ?>"
          /><br /><br />
          <input 
            type="password" 
            name="mdpass" 
            class="log" value="<?php if(isset($_COOKIE['mdpamdi'])) echo $_COOKIE['mdpamdi']; ?>" 
            placeholder="Mot De Passe"
          /><br /><br />
          <input type="checkbox" name="check" />se souvenir de moi <br><br>
          <input type="submit" name="envoie" value="SE CONNECTER" class="button"/>
        </form>
      </div>
      <div id="right"><img src="./images/image_122.jpg"></div>
    </div>
</body>
</html>

<?php }; ?>