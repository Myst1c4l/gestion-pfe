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
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./decoration36.css" rel="stylesheet"/>
    <title>Stage PFE</title>
</head>
<body>
    <h2> Remplissez ces informations concernant votre Stage PFE </h2>
    
      <form action="./ajoutStage.php" method="POST">
       
            <label> Entreprise : </label>
            <select name="entrep" required>
            <?php
              $sql = "select * from entreprise";
              $result=mysqli_query($link,$sql);
              while($liste_entrep=mysqli_fetch_assoc($result))
              {
                echo '<option value='.$liste_entrep['id_entreprise'].'>';
                echo $liste_entrep['nom'];
                echo '</option>';
              }
            ?>
            </select><br/>
            
             <a href="./Entreprise.php">Ajouter une entreprise</a> 
        
          <br/><br/>
            <label> Nom de l'encadrant : </label>
             <input type="text" name="nomEnc" placeholder="Nom" required/><br/>
            <label> Prénom de l'encadrant : </label>
            <input type="text" name="prenomEnc" placeholder="Prénom" required/><br/>
        
       
            <label> Intitulé du sujet </label>
           <input type="text" name="Int" required/> <br/>
        
       
            <label> Description du sujet </label>
             <input type="text" name="Desc" required/> <br/>
        
      
            <label>Technologies utilisées </label>
            <input type="text" name="tech" required/> <br/>
        
        <br/><input type="submit" name="envoie" value="Ajouter le stage">
      
    <br/><br/><a href="./listeEtudiant.php">Votre Profil</a>
</body>
</html>

<?php  }; ?>