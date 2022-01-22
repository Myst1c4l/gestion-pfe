<?php
include "./includes/connexion.php";
session_start();
if (empty($_SESSION['id_enseignant']))
{
    print "<p align='center'>Veuillez, vous connecter SVP</p>";
    header("location: ./Enseignant.php");
}

else
{  
    if(isset($_POST['envoie']))
    { 
        $mdp = $_POST['mdp'];
        $id = $_SESSION['id_enseignant'];
        $sql = "update enseignant set password='$mdp' where id_enseignant='$id'";
        $result = mysqli_query($link,$sql);

        if($result==true)
        {
           header("location: ./Reussie2.html");
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
    <form action="./modification2.php" method="POST">
    
     
       <label> Nouveau mot de passe : </label><br/>
       <input type="text" name="mdp" required/>
     
    <input type="submit" value="Modifier" name="envoie"/>
    </form>
    <br/><a href='./listeEnseignant.php'>Annuler la modification</a>
</body>
</html>
<?php }; }; ?>
