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
       $sql="select * from entreprise where nom='".$_POST['n_entrep']."' and tel='".$_POST['tel_entrep']."' and ville='".$_POST['ville_entrep']."'";
       $quer=mysqli_query($link,$sql);
       if(mysqli_num_rows($quer))
       {
           print "Entreprise déjà existente !";
           print "<br/><a href='./stageInfo.php'>Page Stage</a>";
       }
       else
       {
           $query = "insert into entreprise(nom,tel,ville) values('".$_POST['n_entrep']."','".$_POST['tel_entrep']."','".$_POST['ville_entrep']."')" ;
           $result = mysqli_query($link,$query);
           if($result)
             {
               print "Entreprise ajoutée !";
               echo "<a href='./stageInfo.php'>Page Stage</a>";
             }
           else
           {
            print "Entreprise non ajoutée !";
            echo "<a href='./Entreprise.php'>Réessayez</a>";
           }
       }
    }
    else{

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./decoration36.css" rel="stylesheet"/>
    <title>Entreprise</title>
</head>
<body>
    <h2>Ajouter une Entreprise</h2>
    <form action="Entreprise.php" method="POST">
    
       
          <label> Nom : </label>
          <input type="text" name="n_entrep" required/><br/>
     
    
       
          <label>> Tel : </label>
          <input type="tel" name="tel_entrep" required/><br/>
       
      
          <label> Ville : </label>
          <input type="text" name="ville_entrep" required/><br/>
       

    
     <br/><input type="submit" name="envoie" value="Ajouter"/>
     <br/><br/><a href="./stageInfo.php">Page stage</a>
    </form>
</body>
</html>

<?php }; };?>