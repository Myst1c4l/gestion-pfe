<?php
include "./includes/connexion.php";
session_start();
if (empty($_SESSION['id_enseignant']))
{
    print "<p align='center'>Veuillez, vous connecter SVP</p>";
    print "<br/><a href='./Enseignant.php'>Connexion</a>";
}

else
{ 
   $prenom = $_SESSION['prenom'];
   $nom = $_SESSION['nom'];
   $mail = $_SESSION['Email']; 
   $pass = $_SESSION['password'];
   print "<h2>Bonjour ".$nom." ".$prenom."</h2>" ;
   if(isset($_POST['send']))
   {
    session_destroy();
    header("location: ./Enseignant.php");
   }
   else if(isset($_POST['envoie2']))//encadrer le stage
   {
     
     $Apog=$_POST['stud'];
     $id_enseignant=$_SESSION['id_enseignant'];
     $q="UPDATE oversee set id_enseignant='$id_enseignant' WHERE Apogee='$Apog'";
     $result= mysqli_query($link,$q);
     
   }
   else if(isset($_POST['envoie3']))
   {
    $c="INSERT INTO soutenance(id_stage) VALUES('".$_POST['soutn']."')";
    $m=mysqli_query($link,$c);
    if($m)
    {
       print "Stage PFE validé pour la soutenance !";
    }
    else
    {
       print "Validation échouée";
    }
   }
   else if(isset($_POST['envoie_last']))
   {
      $id_stage = $_POST['sx'];
      $note = $_POST['score'];
      $d="UPDATE soutenance SET note='$note' WHERE id_stage='$id_stage'";
      $r = mysqli_query($link,$d);
   }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./decoration36.css" rel="stylesheet"/>
   <title>Enseignant</title>
</head>
<body>
   <form action="./listeEnseignant.php" method="POST">
      <input type="submit" name="send" value="Se déconnecter" class="decon"/>
   </form>
<h2> Enseignant </h2>
    
    <form action="" method="POST">

      <label>Nom : </label>
      <input type="text" name="nom" value=<?php echo $nom;?> disabled/> <br/>
     
    
      <label>Prénom :</label>
      <input type="text" name="prenom" value=<?php echo $prenom;?> disabled/><br/>
     
     
      <label>Email : </label>
      <input type="text" name="mail" value=<?php echo $mail;?> disabled/> <br/>
   
   </form>

   <h2>Modifier</h2>
   
   <form action="" method="POST">
      
          <label>Mot de passe :</label>
          <input type="password" name="mdp" value=<?php echo $pass ;?> disabled/> <br/>
     
    </form>
   </table>
   <br/>
   <a href="./modification2.php">Modifier le mot de passe</a>
   <h2>Stage PFE</h2>
<?php  
   $query="select id_stage from stage";
   $sql = mysqli_query($link,$query);
   
   if(mysqli_num_rows($sql))
   {  
?>  
    <h3>Stages sans enseignant</h3>
    <form action="./listeEnseignant.php" method="POST">
    <?php  
      $query0="SELECT * FROM oversee INNER JOIN etudiant ON oversee.Apogee=etudiant.Apogee WHERE etudiant.id_stage IS NOT NULL AND oversee.id_enseignant IS NULL";
      $sql0=mysqli_query($link,$query0);
      
      while($row = mysqli_fetch_assoc($sql0))
      { 
         $Apog=$row['Apogee'];
         echo "<input type='checkbox' name='stud' value='$Apog'><strong>Nom :</strong>  ".$row['nom']."&nbsp; &nbsp; &nbsp; &nbsp;  <strong>Prenom :</strong> ".$row['prenom']."&nbsp; &nbsp; &nbsp; &nbsp; <strong>Apogee :</strong> ".$row['Apogee']."<br/>";
      }
   ?>  
      <br/>
      <input type="submit" name="envoie2" value="Encadrer"/>
      </form>
    <h3>Stages encadrés </h3>
    <table border="1" cellspacing="1" cellpadding="4" >
    <tr> 
            <th>Numéro Appogé</th>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Enseignant</th>
    </tr>
    
    <?php   
     $query1="SELECT * FROM oversee INNER JOIN etudiant ON oversee.Apogee=etudiant.Apogee WHERE  oversee.id_enseignant IS NOT NULL ";
     $sql1 = mysqli_query($link,$query1);

     while($row1 = mysqli_fetch_assoc($sql1))
     {
      $query2="SELECT * FROM enseignant INNER JOIN oversee ON enseignant.id_enseignant=oversee.id_enseignant WHERE oversee.Apogee=".$row1['Apogee']." ";
      $sql2 = mysqli_query($link,$query2);
      $row2 = mysqli_fetch_assoc($sql2);
      $ensNom=$row2['nom'];
      $ensPrenom=$row2['prenom'];
      echo "<tr>";
      echo "<td>".$row1['Apogee']."</td>";
      echo "<td>".$row1['nom']."</td>";
      echo "<td>".$row1['prenom']."</td>";
      echo "<td>$ensNom $ensPrenom</td>";
      echo "</tr>";      
     }
    ?>


    </table>
    <h3>Vailder pour la soutenance</h3>
    
    <?php   
     $query1="SELECT * FROM oversee INNER JOIN etudiant ON oversee.Apogee=etudiant.Apogee WHERE  oversee.id_enseignant='".$_SESSION['id_enseignant']."' ";
     $sql1 = mysqli_query($link,$query1);
    if(mysqli_num_rows($sql1))
    { 
      echo "<form action='' method='POST'>";
     while($row1 = mysqli_fetch_assoc($sql1))
     {
      echo "<form action='./listeEnseignant.php' method='POST'>";
      $query2="SELECT * FROM enseignant INNER JOIN oversee ON enseignant.id_enseignant=oversee.id_enseignant WHERE oversee.Apogee=".$row1['Apogee']." ";
      $sql2 = mysqli_query($link,$query2);
      $row2 = mysqli_fetch_assoc($sql2);
      $ensNom=$row2['nom'];
      $ensPrenom=$row2['prenom'];
      $id_stage=$row1['id_stage'];
      $query000="SELECT * FROM soutenance WHERE id_stage='$id_stage' ";
      $sql000 = mysqli_query($link,$query000);
      if(!mysqli_num_rows(($sql000)))
      {
      echo "<input type='checkbox' name='soutn' value='$id_stage'><strong>Etudiant :</strong>  ".$row1['nom']." ".$row1['prenom']."&nbsp; &nbsp; &nbsp; &nbsp; <strong>Apogee :</strong> ".$row1['Apogee']."&nbsp; &nbsp; &nbsp; &nbsp; <strong>Enseignant :</strong> ".$ensNom." ".$ensPrenom."<br/>";
      echo '<br/><input type="submit" name="envoie3" value="Valider"/>';
      echo '</form>';
      }
     }
    }
    else
    {
       print "Vous n'encadrez aucun stage pour le moment !";
    }
    ?>
    <h3>Note finale</h3>
      <?php  
    
      $qqq="SELECT * FROM soutenance INNER JOIN stage ON soutenance.id_stage=stage.id_stage INNER JOIN etudiant ON stage.id_stage=etudiant.id_stage INNER JOIN oversee ON etudiant.Apogee=oversee.Apogee WHERE soutenance.note IS NULL AND soutenance.id_stage='$id_stage' AND oversee.id_enseignant='".$_SESSION['id_enseignant']."'";
      $rrr=mysqli_query($link,$qqq);
      if(mysqli_num_rows($rrr))
      { 
      while($t=mysqli_fetch_assoc($rrr))
     {   
         $nom = $t['nom'];
         $prenom = $t['prenom'];
         $Apog = $t['Apogee'];
         $id_stage = $t['id_stage'];
         $tech = $t['technologie'];
         echo "<form action='./listeEnseignant.php' method='POST'>";
         echo "<input type='hidden' name='sx' value='$id_stage' /><br/>";
         echo "<label>Nom :</label><input type='text' name='nom' value=$nom disabled><br/>";
         echo "<label>Penom :</label><input type='text' name='prenom' value=$prenom disabled><br/>";
         echo "<label>N°Apogee :</label><input type='text' name='Apog' value=$Apog disabled><br/>";
         echo "<label>technologie:</label><input type='text' name='tech' value=$tech disabled><br/>";
         echo "<label>Note :</label><input type='number' name='score'/>";
         echo "&nbsp; &nbsp; &nbsp;<input type='submit' name='envoie_last' value='Noter'/><br/>";
         echo "</form>";
   
     }
   }
   else 
   {
      echo "Vous n'avez plus de stages à noter.";
   }
   ?>
<h3>Soutenance notés par vous</h3>
<?php
$ut="SELECT * FROM soutenance INNER JOIN stage ON soutenance.id_stage=stage.id_stage INNER JOIN etudiant ON stage.id_stage=etudiant.id_stage INNER JOIN oversee ON etudiant.Apogee=oversee.Apogee WHERE soutenance.note IS NOT NULL AND oversee.id_enseignant='".$_SESSION['id_enseignant']."'";
$rut=mysqli_query($link,$ut);
if(mysqli_num_rows($rut))
{ 
   $i=1;
while($ow=mysqli_fetch_assoc($rut))
{
   
   echo "<h4><u>Elève $i</u></h4>";
$Apog = $ow['Apogee'];
$nom = $ow['nom'];
$prenom = $ow['prenom'];
$note = $ow['note'];
  
   echo "<form action='' method='POST'>";

   echo "<label>Apogee :</label><input type='text' name='Apogee' value='$Apog' disabled><br/>";
   echo "<label>Nom : </label><input type='text' name='nom' value='$nom' disabled><br/>";
   echo "<label>Prenom : </label><input type='text' name='prenom' value='$prenom' disabled><br/>";
   echo "<label>Note :</label><input type='text' name='note' value='$note' disabled><br/>";
   echo "</form>";

   $i++;
   echo "<hr>";
}
}
else
{
   print "Vous n'avez pas encore valider un stage ou noter une soutenance.";
}
?>

<?php
   }
   else
   {
      print "Y'a pas de stages pour l'instant...";
   }

?>
</body>
</html>