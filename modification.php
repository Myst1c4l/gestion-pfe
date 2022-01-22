<?php
include "./includes/connexion.php";
session_start();
if (empty($_SESSION['Apogee']))
{
    print "<p align='center'>Veuillez, vous connecter SVP</p>";
    header("location: ./Etudiant.php");
}

else
{  
    if(isset($_POST['envoie']))
    { 
        $mdp = $_POST['mdp'];
        $apog = $_SESSION['Apogee'];
        $sql = "update etudiant set password='$mdp' where Apogee='$apog'";
        $result = mysqli_query($link,$sql);

        if($result==true)
        {
              header("location: ./Reussie.html");
        }
        else
        { 
           echo "Erreur de la modification";
        }
    }
    else
    {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./decoration36.css" rel="stylesheet"/>
    <title>Document</title>
</head>
<body>
    <form action="./modification.php" method="POST">
    
    
        <strong>Nouveau mot de passe : </strong><br/>
        <input type="text" name="mdp" required/><br/><br/>
     
   
    <input type="submit" value="Modifier" name="envoie"/>
    </form>
    <br/><a href='./listeEtudiant.php'>Annuler la modification</a>
</body>
</html>
<?php }; }; ?>



