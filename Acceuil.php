<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="./acceuil.css">
	<link href="https://fonts.googleapis.com/css2?family=Tangerine:wght@700&display=swap" rel="stylesheet">
	<title>Acceuil</title>
</head>
<body>
	<div id="entete">
		<header>
	        <nav>
	        	<ul id="menu">
					<li><a href="" id="gestion">Gestion Stages PFE</a></li>
	        		<li><a href="#Accueil">Accueil</a></li>
	                <li><a href="#etudiant">Etudiant</a></li>
	                <li><a href="#enseignant">Enseignant</a></li>
	                <li><a href="#administration">Administration</a></li>
	                <li><a href="mailto:marwane.bouhaddou@uit.ac.ma" class="button">Contact</a></li>
	            </ul>
	        </nav>
	    </header>
	    <div class="bienvenue">
	    	<h1 class="titre">SOYEZ LES BIENVENUS </h1>
	    	<div class="parag">Ce site est dédié à accompagner les <strong>Etudiants</strong>, les <strong>Professeurs</strong> et l'<strong>Administration</strong> de L'<strong>ENSA Kénitra</strong> <br/> tout au long de la période des <strong>stages PFE</strong>.</div>
	    </div><br/>
	    	<div class="button1"><a href="https://ensa.uit.ac.ma/">En savoir plus sur ENSAK</a></div>
    </div>

	<div class="corps">
			<div id="container1">
			    <div class="milieu">
			    	<a name="etudiant"></a>
			    	<h1 class="noire">Espace Etudiant </h1>
				<div class="Infos">
			    	<p>Accédez à votre profil en entrant votre E-Mail et mot de passe ci-dessous pour un bon rensignement sur votre Stage PFE </p>
			    	<p>Vous trouveriez sur cet espace tous vos informations concernant votre état civil, ou bien en rapport avec votre stage
						si vous en avez un bien sûr.</p><br/>
				</div>
			    	<a href="./Etudiant.php" class="lien">SE CONNECTER</a>
                	
			    </div>
			</div>		
	   
		<div id="container2">
		    	<a name="enseignant"></a>
		    	<h1 class="noire">Espace Enseignant </h1>
			<div class="Infos">
		    	<p>Etes-vous un enseignant qui trouve la gestion des stages PFE compliquée , ce n'est plus le cas !</p>
		    	<p id="explication">Modifiez, visualisez, Traquez et notez. </p>
		    	<p>En vous connectant, vous  allez pouvoir visualiser tous les stages avec une liste compléte des étudiants, choisir ceux à encadrer, tout en attribuant une note finale aprés la validation pour le stage.</p> <br/>
			</div>
		    	<a href="./Enseignant.php" class="lien">SE CONNECTER</a>
            
		 </div>
	    
	 
		<div id="container3">
		 	<a name="administration"></a>
		    	<h1 class="noire">Espace Administration </h1>
			<div class="Infos">
		    	<p>Veillez au bon déroulement de la gestion des stages PFE, et renseignez-vous sur les étudiants ainsi que leurs encadrants. Connectez-vous ci-dessous :</p> <br/>
			</div>
		    	<a href="./Administration.php" class="lien">SE CONNECTER</a>
            
		</div>
	</div>


	<div class="footer">
		<div id="contact">
		<h2>Contactez-nous</h2><br/>
		<h3>Merci de nous envoyer Vos suggestions.</h3><br/> 
	    	<form action="" method="POST">
          		<input type="text" name="nom" placeholder="Nom"><br/>
		  		<input type="mail" name="mail" placeholder="Email"><br/>
		  		<input type="textarea" name="message" placeholder="Message"><br/>
		  		<input type="submit" name="envoie" value="ENVOYER" id="last">
			</form>
		</div>
	 	<div id="cont3">
       		<strong>
			Ecole Nationale des Sciences Appliquées, Kénitra<br/>
       		+2126 99 33 82 74<br/><br>
       		marwane.bouhaddou@uit.ac.ma<br>
       		hamza.tazi@uit.ac.ma 
            </strong>
	 	</div>
	</div>
</body>
</html>