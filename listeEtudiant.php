<?php
include "./includes/connexion.php";
session_start();
if (empty($_SESSION['Apogee'])){
print "<p align='center'>Veuillez, vous connecter SVP</p>";
header("location: ./Etudiant.php");
}
else if (isset($_POST['send']))
{
   session_destroy();
   header("location: ./Etudiant.php");
}
else
{ 
   $apog = $_SESSION['Apogee'];
   $prenom = $_SESSION['prenom'];
   $nom = $_SESSION['nom'];
   $mail = $_SESSION['Email']; 
   $pass = $_SESSION['password'];
   

   print "<h2>Bonjour ".$nom." ".$prenom."</h2><br/>" ;
   if(isset($_POST['sub']))
   {
     $Apog=$_SESSION['Apogee'];
     if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
	{
		$dossier= 'images/';
		$temp_name=$_FILES['fichier']['tmp_name'];
		if(!is_uploaded_file($temp_name))
		{
		exit("le fichier est untrouvable");
		}
		if ($_FILES['fichier']['size'] >= 1000000){
			exit("Erreur, le fichier est volumineux");
		}
		$infosfichier = pathinfo($_FILES['fichier']['name']);
		$extension_upload = $infosfichier['extension'];
		
		$extension_upload = strtolower($extension_upload);
		$extensions_autorisees = array('png','jpeg','jpg');
		if (!in_array($extension_upload, $extensions_autorisees))
		{
		exit("Erreur, Veuillez inserer une image svp (extensions autorisées: png)");
		}
		$nom_photo=$Apog.".".$extension_upload;
		if(!move_uploaded_file($temp_name,$dossier.$nom_photo))
    {
		exit("Problem dans le telechargement de l'image, Ressayez");
		}
		$ph_name=$nom_photo;
	}
	else{
		$ph_name="inconnu.jpg";
	}
	$requette="UPDATE etudiant SET photo='$ph_name' WHERE Apogee=$Apog";
	$resultat=mysqli_query($link,$requette);
}

else if(isset($_POST['sub1']))
{  
  $Apog=$_SESSION['Apogee'];
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
{
 $dossier= 'documents/';
 $temp_name=$_FILES['fichier']['tmp_name'];
 if(!is_uploaded_file($temp_name))
 {
 exit("le fichier est untrouvable");
 }

 $infosfichier = pathinfo($_FILES['fichier']['name']);
 $extension_upload = $infosfichier['extension'];
 
 $extension_upload = strtolower($extension_upload);
 $extensions_autorisees = array('pdf');
 if (!in_array($extension_upload, $extensions_autorisees))
 {
 exit("Erreur, Veuillez inserer une image svp (extensions autorisées: .pdf )");
 }
 $nom_fichier=$Apog."(1).".$extension_upload;
 if(!move_uploaded_file($temp_name,$dossier.$nom_fichier))
 {
 exit("Problem dans le telechargement de l'image, Ressayez");
 }
 $f1=$nom_fichier;
 $_SESSION['f1']=$f1;
 $q = "SELECT * FROM etudiant WHERE Apogee=$Apog";
$r=mysqli_query($link,$q);
$u=mysqli_fetch_assoc($r);
$id_stage = $u['id_stage'];
$requette="UPDATE stage SET version_finale='$f1' WHERE id_stage=$id_stage";
$resultat=mysqli_query($link,$requette);
}
else
 {
  print "Veuillez ajouter un fichier !";
 }
 
}



 


else if(isset($_POST['sub2']))
{  
  $Apog=$_SESSION['Apogee'];
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
{
 $dossier= 'documents/';
 $temp_name=$_FILES['fichier']['tmp_name'];
 if(!is_uploaded_file($temp_name))
 {
 exit("le fichier est untrouvable");
 }

 $infosfichier = pathinfo($_FILES['fichier']['name']);
 $extension_upload = $infosfichier['extension'];
 
 $extension_upload = strtolower($extension_upload);
 $extensions_autorisees = array('pdf');
 if (!in_array($extension_upload, $extensions_autorisees))
 {
 exit("Erreur, Veuillez inserer une image svp (extensions autorisées: .pdf )");
 }
 $nom_fichier=$Apog."(2).".$extension_upload;
 if(!move_uploaded_file($temp_name,$dossier.$nom_fichier))
 {
 exit("Problem dans le telechargement de l'image, Ressayez");
 }
 $f2=$nom_fichier;
 $_SESSION['f2']=$f2;
 $q = "SELECT * FROM etudiant WHERE Apogee=$Apog";
$r=mysqli_query($link,$q);
$u=mysqli_fetch_assoc($r);
$id_stage = $u['id_stage'];
$requette="UPDATE stage SET version_finale='$f2' WHERE id_stage=$id_stage";
$resultat=mysqli_query($link,$requette);
}
else
 {
  print "Veuillez ajouter un fichier !";
 }
 
}
   
else if(isset($_POST['sub3']))
{  
  $Apog=$_SESSION['Apogee'];
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
{
 $dossier= 'documents/';
 $temp_name=$_FILES['fichier']['tmp_name'];
 if(!is_uploaded_file($temp_name))
 {
 exit("le fichier est untrouvable");
 }
 
 $infosfichier = pathinfo($_FILES['fichier']['name']);
 $extension_upload = $infosfichier['extension'];
 
 $extension_upload = strtolower($extension_upload);
 $extensions_autorisees = array('pdf','docx','pptx');
 if (!in_array($extension_upload, $extensions_autorisees))
 {
 exit("Erreur, Veuillez inserer une image svp (extensions autorisées: .pdf, .docx et .pptx)");
 }
 $nom_fichier=$Apog."(3).".$extension_upload;
 if(!move_uploaded_file($temp_name,$dossier.$nom_fichier))
 {
 exit("Problem dans le telechargement de l'image, Ressayez");
 }
 $f3=$nom_fichier;
 $q = "SELECT * FROM etudiant WHERE Apogee=$Apog";
$r=mysqli_query($link,$q);
$u=mysqli_fetch_assoc($r);
$id_stage = $u['id_stage'];
$requette="UPDATE stage SET presentation='$f3' WHERE id_stage=$id_stage";
$resultat=mysqli_query($link,$requette);
}
else
 {
  print "Veuillez ajouter un fichier !";
 }
 
}





else if(isset($_POST['sub4']))
{  
  $Apog=$_SESSION['Apogee'];
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
{
 $dossier= 'documents/';
 $temp_name=$_FILES['fichier']['tmp_name'];
 if(!is_uploaded_file($temp_name))
 {
 exit("le fichier est untrouvable");
 }
 
 $infosfichier = pathinfo($_FILES['fichier']['name']);
 $extension_upload = $infosfichier['extension'];
 
 $extension_upload = strtolower($extension_upload);
 $extensions_autorisees = array('pdf');
 if (!in_array($extension_upload, $extensions_autorisees))
 {
 exit("Erreur, Veuillez inserer une image svp (extensions autorisées: .pdf)");
 }
 $nom_fichier=$Apog."(4).".$extension_upload;
 if(!move_uploaded_file($temp_name,$dossier.$nom_fichier))
 {
 exit("Problem dans le telechargement de l'image, Ressayez");
 }
 $f4=$nom_fichier;
 $q = "SELECT * FROM etudiant WHERE Apogee=$Apog";
$r=mysqli_query($link,$q);
$u=mysqli_fetch_assoc($r);
$id_stage = $u['id_stage'];
$requette="UPDATE stage SET attestation='$f4' WHERE id_stage=$id_stage";
$resultat=mysqli_query($link,$requette);
}
else
 {
  print "Veuillez ajouter un fichier !";
 }
 
}




else if(isset($_POST['sub5']))
{  
  $Apog=$_SESSION['Apogee'];
  if(isset($_FILES['fichier']) and $_FILES['fichier']['error']==0)
{
 $dossier= 'documents/';
 $temp_name=$_FILES['fichier']['tmp_name'];
 if(!is_uploaded_file($temp_name))
 {
 exit("le fichier est untrouvable");
 }
 $infosfichier = pathinfo($_FILES['fichier']['name']);
 $extension_upload = $infosfichier['extension'];
 
 $extension_upload = strtolower($extension_upload);
 $extensions_autorisees = array('pdf','docx');
 if (!in_array($extension_upload, $extensions_autorisees))
 {
 exit("Erreur, Veuillez inserer une image svp (extensions autorisées: .pdf )");
 }
 $nom_fichier=$Apog."(5).".$extension_upload;
 if(!move_uploaded_file($temp_name,$dossier.$nom_fichier))
 {
 exit("Problem dans le telechargement de l'image, Ressayez");
 }
 $f5=$nom_fichier;
 $q = "SELECT * FROM etudiant WHERE Apogee=$Apog";
$r=mysqli_query($link,$q);
$u=mysqli_fetch_assoc($r);
$id_stage = $u['id_stage'];
$requette="UPDATE stage SET fiche_evaluation='$f5' WHERE id_stage=$id_stage";
$resultat=mysqli_query($link,$requette);
}
else
 {
  print "Veuillez ajouter un fichier !";
 }
 
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
    <title>Etudiant</title>
</head>
<body>
   <form action="./listeEtudiant.php" method="POST">
      <input type="submit" name="send" value="Se déconnecter" class="decon"/>
   </form>
    <h2> Informations </h2>

    <form action="" method="POST">
     
      <label>N°Apogee : </label>
      <input type="text" name="apog" value=<?php echo $apog;?> disabled/> 
     <br/>
     
      <label>Nom : </label>
      <input type="text" name="nom" value=<?php echo $nom;?> disabled/> 
      <br/>

      <label>Prénom :</label>
       <input type="text" name="prenom" value=<?php echo $prenom;?> disabled/>
       <br/>
     
        <label>Email : </label>
        <input type="text" name="mail" value=<?php echo $mail;?> disabled/> 
        <br/>
     
   </form>
   <h2>Photo de profil</h2>
   <?php 
   $Apog=$_SESSION['Apogee'];
   $a="SELECT * FROM etudiant WHERE Apogee=$Apog";
   $p=mysqli_query($link,$a);
   $c=mysqli_fetch_assoc($p);
   $photo = $c['photo'];
   if($photo==NULL)
   {
   ?>
   <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
   <label for="fichier">Photo:</label>
			<input type="file" name="fichier"/><br/>
			<input type="submit" name="sub" value="Valider" style="width: 200px;text-align: center;"/>
   </form>
   <?php   
   }
   else
   {
     $a="SELECT * FROM etudiant WHERE Apogee=$Apog";
     $r=mysqli_query($link,$a);
     $o=mysqli_fetch_assoc($r);
     $photo=$o['photo'];
     echo "<img src=\"images/$photo\" alt=\"image\" height=150 width=150/><br/>";
   }
   
   ?>
   
   <h2>Modifier</h2>
   
   <form action="" method="POST">
      
          <label>Mot de passe :</label>
          <input type="password" name="mdp" value=<?php echo $pass ;?> disabled/>
      
    </form>
   

   </form>
   <a href="modification.php">Modifier le mot de passe</a><br/><br/>
   <h2>Stage PFE</h2>
   <?php
   $Apog=$_SESSION['Apogee'];
   $ui="SELECT * FROM etudiant WHERE Apogee =$Apog";
   $rui=mysqli_query($link,$ui);
   $roui=mysqli_fetch_assoc($rui);
   $_SESSION['id_stage']=$roui['id_stage'];
   $id_stage = $_SESSION['id_stage'];
    if($id_stage==NULL)
    {
      echo "Vous n'avez pas encore de stage PFE !<br/>";
      echo "N'hésitez pas à remplir les informations le concernant une fois trouvé en clickant le lien ci dessous !<br/>";
      echo "<br/><a href='./stageInfo.php'>Stage PFE</a>";
    }
    else { 
   ?>
   <h3>Entreprise</h3>
   <?php 
   $Apog = $_SESSION['Apogee'];
   $query0 = "SELECT * FROM entreprise WHERE id_entreprise IN (SELECT id_entreprise FROM encadrants WHERE id_encadrant IN (SELECT id_encadrant FROM oversee WHERE Apogee IN (SELECT Apogee FROM etudiant WHERE Apogee='$Apog' )))";
   $sql0 = mysqli_query($link,$query0);
   $row0 = mysqli_fetch_assoc($sql0);
   $NomEnt=$row0['nom'];
   $TelEnt = $row0['tel'];
   $VilleEnt=$row0['ville'];
   ?>
   
     <form action="" method="POST">
     
         <label>Nom de l'entreprise : </label>
        <input type="text" name="nomEnt" value=<?php echo $row0['nom'];?> disabled/><br/>
      
      
     
       <label>Tel de l'entreprise : </label>
       <input type="text" name="TelEnt" value=<?php echo $row0['tel'];?> disabled/><br/>
       

      
        <label> Ville : </label>
        <input type="text" name="villeEnt" value=<?php echo $row0['ville'];?> disabled /><br/>
       
     </form>

   
   <h3>Encadrant</h3>
   <?php 
   $Apog = $_SESSION['Apogee'];
   $query1 = "SELECT * FROM encadrants WHERE id_encadrant IN (SELECT id_encadrant FROM oversee WHERE Apogee IN (SELECT Apogee FROM etudiant WHERE Apogee='$Apog' ))";
   $sql1 = mysqli_query($link,$query1);
   $row1 = mysqli_fetch_assoc($sql1);
   $NomEnc=$row1['nom'];
   $PreNomEnc = $row1['prenom'];
   ?>
   
     <form action="" method="POST">
       
          <label>Nom : </label>
          <input type="text" name="nomEnc" value=<?php echo $row1['nom'];?> disabled/><br/>
      
      
          <label>Prénom : </label>
          <input type="text" name="prenomEnc" value=<?php echo $row1['prenom']; ?> disabled/><br/>
     
     </form>

   
   <h3>Enseignant</h3>
   <form action="" method="POST">
  <?php 
   $q="SELECT * from oversee WHERE Apogee='".$_SESSION['Apogee']."'";
   $r=mysqli_query($link,$q);
   $roww=mysqli_fetch_assoc($r);
   if($roww['id_enseignant'])
   {
      $id_enseignant = $roww['id_enseignant'];
      $a="SELECT * FROM enseignant WHERE id_enseignant='$id_enseignant'";
      $x=mysqli_query($link,$a);
      $roo=mysqli_fetch_assoc($x); ?>
      
         
            <label>Nom : </label>
            <input type="text" name="nomEns" value=<?php echo $roo['nom']; ?> disabled/><br/>
         
          
            <label>Prenom : </label>
            <input type="text" name="prenomEns" value=<?php echo $roo['prenom'];?> disabled/><br/>
         
      
  <?php
      }
   else
   {
      print "Vous n'avez pas encore d'enseignant qui vous encadre !<br/>";
   }
 ?>
   
    <h3>Sujet</h3>
   <?php 
   $Apog = $_SESSION['Apogee'];
   $id_stage = $_SESSION['id_stage'];
   $query2 = "SELECT * FROM sujet WHERE id_stage=$id_stage";
   $sql2 = mysqli_query($link,$query2);
   $row2 = mysqli_fetch_assoc($sql2);
   $Int  = $row2['intitule'];
   $Desc = $row2['descriptif'];
   ?>
   
     <table border=1 cellspacing=1 cellpadding=1>
      <tr>
       <th>Intitulé </th>
       <td>
       <?php 
       echo $Int
       ?> </td>
      </tr>
      <tr>
       <th>Description </th>
       <td>
       <?php echo $Desc ;?> </td><br/>
  </tr>
     </table>
   
   
   <h3>Technologie Utilisée</h3>
   <?php 
   $Apog = $_SESSION['Apogee'];
   $query3 = "SELECT * FROM stage where id_stage IN (SELECT id_stage FROM etudiant WHERE Apogee='$Apog')";
   $sql3 = mysqli_query($link,$query3);
   $row3 = mysqli_fetch_assoc($sql3);
   $tech = $row3['technologie'];
   ?>
   <table border=1 cellpadding=1 cellspacing=1>
     <tr><td><?php echo $tech;?> </td></tr>
  </table>
<h2>Déposer</h2>
<label for="fichier">Première version du rapport :</label>

  <?php  
  $q = "SELECT * FROM stage WHERE id_stage=$id_stage";
  $r = mysqli_query($link,$q);
  $u = mysqli_fetch_assoc($r);
  if($u['version1']==NULL)
  { 
  ?>
  <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
  
  <input type="file" name="fichier" required/><br/><br/>
  <input type="submit" name="sub1" value="Ajouter" style="width: 200px;text-align: center;"/>
</form>
<?php 
  }
  
  else
  {
    $f1 = $u['version1'];
    echo "Fichier déposé.<br/>";
    echo "<embed type='application/pdf' src='documents/$f1' width='500' height='300' class='doc'>";
  }
?>
<hr>
<label for="fichier">Version corrigée du rapport :</label>
<?php  
  $q = "SELECT * FROM stage WHERE id_stage=$id_stage";
  $r = mysqli_query($link,$q);
  $u = mysqli_fetch_assoc($r);
  if($u['version_finale']==NULL)
  { 
  ?>
   <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
    <input type="file" name="fichier" required/><br/><br/>
			<input type="submit" name="sub2" value="Ajouter" style="width: 200px;text-align: center;"/>
   </form>
   <?php 
  }
  
  else
  {
    $f2=$u['version_finale'];
    echo "Fichier déposé.<br/>";
    echo "<embed type='application/pdf' src='documents/$f2' width='500' height='300' class='doc'>";
  }
?>
<hr>
<label for="fichier">Présentation</label>
<?php  
  $q = "SELECT * FROM stage WHERE id_stage=$id_stage";
  $r = mysqli_query($link,$q);
  $u = mysqli_fetch_assoc($r);
  if($u['presentation']==NULL)
  { 
  ?>
   <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
  
			<input type="file" name="fichier" required/><br/><br/>
			<input type="submit" name="sub3" value="Ajouter" style="width: 200px;text-align: center;"/>
   </form>
   <?php 
  }
  
  else
  {
    echo "Fichier déposé.";
  }
?>
<hr>
<label for="fichier">Attestation de stage :</label>
<?php  
  $q = "SELECT * FROM stage WHERE id_stage=$id_stage";
  $r = mysqli_query($link,$q);
  $u = mysqli_fetch_assoc($r);
  if($u['attestation']==NULL)
  { 
  ?>
   <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
   
			<input type="file" name="fichier" required/><br/><br/>
			<input type="submit" name="sub4" value="Ajouter" style="width: 200px;text-align: center;"/>
   </form>
   <?php 
  }
  
  else
  {
    echo "Fichier déposé.<br/>";
    $f4 = $u['attestation'];
    echo "<embed type='application/pdf' src='documents/$f4' width='500' height='300' class='doc'>";
  }
?>
<hr>
<label for="fichier">Fiche d'évaluation :</label>
<?php  
  $q = "SELECT * FROM stage WHERE id_stage=$id_stage";
  $r = mysqli_query($link,$q);
  $u = mysqli_fetch_assoc($r);
  if($u['fiche_evaluation']==NULL)
  { 
  ?>
   <form action="./listeEtudiant.php" method="POST" enctype="multipart/form-data">
  
			<input type="file" name="fichier" required/><br/><br/>
			<input type="submit" name="sub5" value="Ajouter" style="width: 200px;text-align: center;"/>
   </form>
   <?php 
  }
  
  else
  {
    echo "Fichier déposé.<br/>";
    $f5 = $u['fiche_evaluation'];
    echo "<embed type='application/pdf' src='documents/$f5' width='500' height='300' class='doc'>";
  }
?>

</body>
</html>

<?php }; ?>