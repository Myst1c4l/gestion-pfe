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
    $nom=$_POST['nomEnc'];
    $prenom = $_POST['prenomEnc'];
    $entrep=$_POST['entrep'];
    $tech=$_POST['tech'];
    if(isset($_POST['envoie']))
    {
        $query = "SELECT * FROM encadrants WHERE nom='$nom' AND prenom='$prenom' AND id_entreprise='$entrep'";
        $sql = mysqli_query($link,$query);
        if(mysqli_num_rows($sql)==0)
        { 
           $query0 = "insert into encadrants(nom,prenom,id_entreprise) values('$nom','$prenom','$entrep')";
           $sql0 = mysqli_query($link,$query0);
           $query00 = "select * from encadrants where nom='$nom' and prenom='$prenom' and id_entreprise='$entrep'";
           $sql1 = mysqli_query($link,$query00);
           $row = mysqli_fetch_assoc($sql1);
           $id_encad = $row['id_encadrant'];

           $query000= "insert into oversee(id_encadrant,Apogee) values('$id_encad','".$_SESSION['Apogee']."')";
           $sql2 = mysqli_query($link,$query000); 
        }
        else
        {
            $query1 = "select * from encadrants where nom='$nom' and prenom='$prenom' and id_entreprise='$entrep'";
            $sql1 = mysqli_query($link,$query1);
            $row = mysqli_fetch_assoc($sql1);
            $id_encad = $row['id_encadrant'];
            $query2= "insert into oversee(id_encadrant,Apogee) values('$id_encad','".$_SESSION['Apogee']."')";
            $sql2 = mysqli_query($link,$query2);
        }
        
        $query3 = "insert into stage(technologie,id_entreprise) values('$tech','$entrep')";
        $sql3 = mysqli_query($link,$query3);
        

        $id_stage=mysqli_insert_id($link);


        $query5 = "insert into sujet(intitule,descriptif,id_stage) values('".$_POST['Int']."','".$_POST['Desc']."','$id_stage')";
        $sql5 = mysqli_query($link,$query5);

        $Apog = $_SESSION['Apogee'];
        $query6 = "UPDATE etudiant set id_stage='$id_stage' where Apogee='$Apog'";
        $sql6 = mysqli_query($link,$query6);

        if ($sql1 && $sql2 && $sql3 && $sql5 && $sql6)
        {
            print "Stage ajouté avec succes";
            header("location: ./listeEtudiant.php");
        }
        else
        {
            print "stage non ajoute";
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
    <title>Document</title>
</head>
<body>
    
</body>
</html>