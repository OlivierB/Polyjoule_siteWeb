<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
-->

<?php

// ouverure d'une session (ou reprise)
session_start();

// importer uniquement les fonctions nécessaires au bon fonctionnement de cette page
// /!\ cette page doit être légère : elle est rechargée à chaque appel
// script de co à la bdd
include ("bdd/bdd_connexion.php");

// fonctions de base
include ("ressources/scripts/php/functions.php");

// création d'un objet pour stoker les informations (erreurs et succes)
$infos = new Informations ();

// création du PATH pour le style
$_SESSION['design_path'] = "ressources/design/style1/";

// calcul de la page à afficher
if (!isset ($_SESSION['id_membre'], $_SESSION['pseudo_membre'])) 
{	// non connecté -> page de co
	header ("Location: connexion.php");
} else
{	// page fournie en lien
	$page = 'accueil';
	if (!empty($_GET['page']))
	{
		$tmpPage = htmlentities($_GET['page']);
		if (is_file('controleurs/'.$tmpPage.'.co.php'))
		{
			$page = $_GET['page'];
		}
	}
}


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="<?php echo $_SESSION['design_path']; ?>/design.css"  />
		<script type="text/JavaScript" src="ressources/scripts/js/functions.js"></script>
		
		<!-- Inclusion de l'éditeur ckeditor et ckfinder -->
		<script type="text/javascript" src="ressources/scripts/js/ckeditor/ckeditor.js"></script>
		<script type="text/javascript" src="ressources/scripts/js/ckfinder/ckfinder.js"></script>
	
		<title>Polyjoule-Administration</title>
	</head>

	<body id="body">
		<div id="entete">
		</div>
		<div id="menu">	
			<div id="menuDeroulant">
				<ul>
					<li>
						<a class="Menu" href="index.php">ADMINISTRATION</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
								<li><a style="color:green;" href="index.php">Panneau d'administration</a></li>
								<li><a href="index.php?page=gestionComptes">Gestion membres Polyjoule</a></li>
								<li><a href="index.php?page=equipe">Equipe Polyjoule</a></li>
								<li><a href="index.php?page=statistiques">Statistiques</a></li>
								<li><a href="index.php?page=profil">Mon profil</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="#">INTERVENANTS</a>
						<ul class="sousMenu">
							<div class="menuH"></div>
								
								<li><a href="index.php?page=participant">Gestion des participants</a></li>
								<li><a href="index.php?page=participation">Gestion des participations</a></li>
								<li><a href="index.php?page=partenaires">Gestion des partenaires</a></li>
								<li><a href="index.php?page=ecole">Gestion des écoles</a></li>
								<li><a href="index.php?page=formation">Gestion des formations</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					
					<li>
						<a href="#"  >CONTENU</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
								<li><a href="index.php?page=article">Gestion des articles</a></li>
								<li><a href="index.php?page=rubrique">Gestion des rubriques</a></li>
								<li><a href="index.php?page=album">Gestion de l'album</a></li>
								<li><a href="index.php?page=livreOr">Gestion du livre d'Or</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="#"  >PROFIL</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
								<li><a href="index.php?page=profil&action=1">Changer le pseudo</a></li>
								<li><a href="index.php?page=profil&action=2">Changer le password</a></li>
								<li><a href="index.php?page=profil&action=3">Changer l'email</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="index.php?page=aide&option=2"  >CONTACT</a>
						<!--
						<ul class="sousMenu"  >
							<div class="menuH"></div>
								<li><a href="index.php?page=aide&option=1">Aide administration</a></li>
								<li><a href="index.php?page=aide&option=2">Contact</a></li>
								<li><a href="index.php?page=aide&option=3">Liens utiles</a></li>
							<div class="menuB"></div>
						</ul>
						-->
					</li>
					<li>
						<a style="color:red;" href="index.php?page=deconnexion"">Déconnexion</a>

					</li>
				</ul>
			</div>
		</div>
		<?php
			// Inclusion de la page demandée (page d'accueil si aucune) 
			// ==> Il faut ajouter une sécurité avec la liste des fichiers qui peuvent être inclus
			// Faire du rewriting sur ces adresses
			include ('controleurs/'.$page.'.co.php');
		?>
		<div class="contenuB"></div>
	<footer>
		Copyright &copy; Polyjoule 2012 - Tous droits réservés.
	</footer>
	</body>
</html>

<?php
// Fermeture session



