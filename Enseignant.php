<?php
include "./includes/connexion.php";
if(isset($_POST['envoie']))
{
  $login = $_POST['mail'];
  $pass  = $_POST['mdpass'];
  $query = "select * from enseignant where Email = '".$login."' and password = '".$pass."'";
  $result= mysqli_query($link,$query);
  $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) == 1)
    {
      session_start();
      $_SESSION['id_enseignant']=$row['id_enseignant'];
      $_SESSION['prenom']=$row['prenom'];
      $_SESSION['nom']=$row['nom'];
      $_SESSION['Email']=$row['Email'];
      $_SESSION['password']=$row['password'];
      header("location: ./listeEnseignant.php");
    }
    else
    {
        header("location: ./erreur2.html");
    }
}
else { 

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./login.css" />
  <title>Enseignant</title>
</head>
<body>
    <div class="container">
    <a href="./Acceuil.php">Accueil</a>
      <div id="left">
        <h1>Espace Enseignant <br/>Connectez-Vous</h1>
        <form action="./Enseignant.php" method="POST">
          <input
            type="email"
            name="mail"
            placeholder="Email"
            required
            class="log" value="<?php if(isset($_COOKIE['emailEns'])) echo $_COOKIE['emailEns']; ?>"
          /><br /><br />
          <input 
            type="password" 
            name="mdpass" 
            required
            class="log" value="<?php if(isset($_COOKIE['mdpEns'])) echo $_COOKIE['mdpEns']; ?>" 
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