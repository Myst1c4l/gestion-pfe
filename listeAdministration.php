<link rel="stylesheet" type="text/css" href="decoration36.css">
<?php
include "./includes/connexion.php";
session_start();
if (empty($_SESSION['login'])){
   print "<p align='center'>Veuillez, vous connecter SVP</p>";
   header("location: ./Administration.php");
}
else
{
   echo "<h1>Bienvenue sur l'espace administratif</h1><br>";
   echo"<form action=\"Administration.php\" method=\"POST\">";
   echo"<input type=\"submit\" name=\"send\" value=\"Se déconnecter\" class=\"decon\"/>";
   echo"</form>";
   echo "<h3>Les étudiants encadré(e)s </h3><br>";
   $requete1="SELECT * FROM enseignant INNER JOIN oversee ON enseignant.id_enseignant=oversee.id_enseignant WHERE oversee.id_enseignant IS NOT NULL";
   $resultats=mysqli_query($link,$requete1);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th>N°Apogée</th>";
   echo "<th>Nom</th>";
   echo "<th>Prénom</th>";
   while($row=mysqli_fetch_assoc($resultats)){
      $requete2="SELECT * FROM etudiant INNER JOIN oversee ON oversee.Apogee=etudiant.Apogee WHERE oversee.Apogee='".$row['Apogee']."'";
      $resultat2=mysqli_query($link,$requete2);
      while ($row2=mysqli_fetch_assoc($resultat2)) {
         $nomens=$row['nom'];
         $prenomens=$row['prenom'];
         echo "<tr>";
         echo "<td>".$row2['Apogee']."</td>";
         echo "<td>".$row2['nom']."</td>";
         echo "<td>".$row2['prenom']."</td>";
         echo "</tr>"; 
      }
   }
   echo "</table>";
   echo"<br><br>";

   echo "<h3>Liste des étudiants encadré(e)s par enseignant</h3><br>";
   $requete6="SELECT * FROM enseignant INNER JOIN oversee ON enseignant.id_enseignant=oversee.id_enseignant WHERE oversee.id_enseignant IS NOT NULL";
   $resultats6=mysqli_query($link,$requete6);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th>Nom et Prénom enseignant</th>";
   echo "<th>Etudiants encadrés</th>";
   echo "<th>N°Apogée</th>";
   while($row6=mysqli_fetch_assoc($resultats6)){
      $enseignant=$row6['id_enseignant'];
      $requete7="SELECT * FROM etudiant INNER JOIN oversee ON oversee.Apogee=etudiant.Apogee WHERE id_enseignant='$enseignant' AND  oversee.Apogee='".$row6['Apogee']."' ";
      $resultat7=mysqli_query($link,$requete7);
      $nomens=$row6['nom'];
      $prenomens=$row6['prenom'];
      while ($row7=mysqli_fetch_assoc($resultat7)) {
         echo "<tr>";
         echo "<td>".$nomens." ".$prenomens."</td>";
         echo "<td>".$row7['nom']." ".$row7['prenom']."</td>";
         echo "<td>".$row7['Apogee']."</td>";
         echo "</tr>"; 
      }
      echo "</td>";
   }
   echo "</table>";
   echo"<br><br>";
   echo "<h3>Rapport des étudiants</h3>";
   $requete11="SELECT * FROM stage INNER JOIN etudiant ON stage.id_stage=etudiant.id_stage INNER JOIN oversee ON etudiant.Apogee=oversee.Apogee WHERE oversee.Apogee is NOT NULL";
   $resultats11=mysqli_query($link,$requete11);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th>Nom</th>";
   echo "<th>Prénom </th>";
   echo "<th>N°Apogée</th>";
   echo "<th>Rapport</th>";
   while($row11=mysqli_fetch_assoc($resultats11)){
      $rapport=$row11['version_finale'];
      $nomettt=$row11['nom'];
      $prenomettt=$row11['prenom'];
      echo "<tr>";
      echo "<td>$nomettt</td>";
      echo "<td>$prenomettt</td>";
      echo "<td>".$row11['Apogee']."</td>";
      echo "<td>$rapport</td>";
      echo "</tr>";
   }
   echo "</table>";
   echo"<br><br>";
   echo "<h3>Les sujets des stages encadrés </h3> ";
   $requete3="SELECT * From sujet INNER JOIN stage ON sujet.id_stage=stage.id_stage INNER JOIN etudiant ON stage.id_stage=etudiant.id_stage";
   $resultat3=mysqli_query($link,$requete3);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th>Intitulé du sujet</th>";
   echo "<th>Descriptif du sujet</th>";
   echo "<th>Nom et Prénom de l'étudiant </th>";
   echo "<th>N°Apogée</th>";
   while ($row3=mysqli_fetch_assoc($resultat3)) {
      $nomett=$row3['nom'];
      $prenomett=$row3['prenom'];
      $requete10=" SELECT * FROM etudiant INNER JOIN oversee ON etudiant.Apogee=oversee.Apogee INNER JOIN enseignant ON enseignant.id_enseignant=oversee.id_enseignant";
      $resultat10=mysqli_query($link,$requete10);
      echo "<tr>";
      echo "<td >".$row3['intitule']."</td>";
      echo "<td>".$row3['descriptif']."</td>";
      echo "<td>$nomett $prenomett</td>";
      echo "<td>".$row3['Apogee']."</td>";
      echo "</tr>"; 
   }
   echo "</table>";
   echo "<br><br>";
   echo "<h3>Etudiants sans encadrant pédagogique </h3>";
   $requete4="SELECT * FROM etudiant where Apogee NOT IN ( SELECT Apogee from oversee)";
   $resultat4=mysqli_query($link,$requete4);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th> Nom</th>";
   echo "<th> Prénom</th>";
   echo "<th>N°Apogée</th>";
   while ($row4=mysqli_fetch_assoc($resultat4)) {
      echo "<tr>";
      echo "<td >".$row4['nom']."</td>";
      echo "<td>".$row4['prenom']."</td>";
      echo "<td>".$row4['Apogee']."</td>";
      echo "</tr>";
   }
   echo "</table>";
   echo "<br><br>";
   echo "<h3>Etudiants Noté(e)s et Validé(e)s pour la soutenance </h3>";
   $requete5="SELECT * FROM etudiant INNER JOIN stage ON etudiant.id_stage=stage.id_stage INNER JOIN soutenance ON stage.id_stage=soutenance.id_stage ";
   $resultat5=mysqli_query($link,$requete5);
   echo"<table border=1 cellpading=1 cellspacing=1>";
   echo "<tr>";
   echo "<th> Nom</th>";
   echo "<th> Prénom</th>";
   echo "<th>N°Apogée</th>";
   echo "<th> Note finale</th>";
   while ($row5=mysqli_fetch_assoc($resultat5)) {
      echo "<tr>";
      echo "<td >".$row5['nom']."</td>";
      echo "<td>".$row5['prenom']."</td>";
      echo "<td>".$row5['Apogee']."</td>";
      echo "<td>".$row5['note']."</td>";
      echo "</tr>";
   }
   echo "</table>";
   echo "<br><br>";
}
?>