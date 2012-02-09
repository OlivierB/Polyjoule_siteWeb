<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* page de connexion de la partie admin
*
-->

<?php

// ouverure d'une session (ou reprise)
session_start();

// inclusion des fichiers de scripts
include ("bdd/bdd_connexion.php");
include ("ressources/scripts/php/functions.php");
include ("modeles/connexion.mo.php");


// gestion de l'identification d'un admin
if(isset($_POST['login']) && $_POST['login']!="" && isset($_POST['passwd']) && $_POST['passwd']!="")
{
	$pseudo = securite ($_POST['login']);
	$passe	= securite ($_POST['passwd']);
	if (connexion ($pseudo, $passe))
		header('Location: index.php');
}

?>



<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/style1/connexion.css"  />
		<script type="text/JavaScript" src="ressources/scripts/js/functions.js"></script>
		<title>Titre</title>
	</head>

	<body>
	
		<div id='connexion'>
		
			<div class="centre">
				<h2>Service d'authentification du site Polyjoule</h2>
				
				<p>Pour vous identifier et accéder à l'interface d'administration, veuillez entrer 
					vos codes personnels et valider en cliquant sur le bouton connexion.</p>
			</div>
			
			<div id="cadena">
				<img src="ressources/design/classique/images/lock.png"/>
			</div>
			
			<div id="form_connexion">
			
				<form name="connexion" method="post" action="connexion.php">
					<p>
						<strong><label for="login">Login :</label></strong>
						<input id="login" type="text" value="" name="login" onKeyPress="Submit_enter(this,event);"/>
					</p>
					<p>
						<strong><label for="passwd">Password : </label></strong>
						<input id="passwd" type="password" value="" name="passwd" onKeyPress="Submit_enter(this,event);"/>
					</p>
					<p id="bouton_connexion">
						<a class="button" href="javascript:document.connexion.submit()" >Connexion</a>
					</p>
				</form>
				
				<?php
				if(isset($erreur))
					echo $erreur;
				?>
			</div>
		</div>

	</body>

</html>
