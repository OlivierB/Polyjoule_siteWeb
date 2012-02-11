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
		
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/style1/design.css"  />
		<script type="text/JavaScript" src="ressources/scripts/js/functions.js"></script>
		
		<!-- Inclusion de tinyMCE et paramètrage -->
		<script type="text/JavaScript" src="ressources/scripts/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/JavaScript" src="ressources/scripts/js/tinymce/script_options.js"></script>
		<!-- Fin tinyMCE -->
		
		<title>Polyjoule-Administration</title>
	</head>

	<body>
		<div id="entete">
		</div>
		<div id="menu">	
			<div id="menuDeroulant">
				<ul>
					<li>
						<a class="Menu" href="index.php">ADMINISTRATION</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php">Panneau d'administration</a></li>
							<li><a href="#">Statistiques</a></li>
							<li><a href="index.php?page=profil">Mon profil</a></li>
							<li><a href="#">Maintenance</a></li>
							<li><a href="index.php?page=gestionComptes">Gestion des comptes</a></li>
							<li><a href="index.php?page=deconnexion">Déconnexion</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="index.php?page=rubrique"  >MENUS</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php?page=rubrique">Gestion des rubriques</a></li>
							<li><a href="#">Menu principal</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="index.php?page=article"  >CONTENU</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php?page=article">Gestion des articles</a></li>
							<li><a href="#">Gestion des catégories</a></li>
							<li><a href="#">Articles en vedette</a></li>
							<li><a href="#">Gestion des médias</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
						<li>
						<a href="index.php?page=aide"  >AIDE</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php?page=aide&option=1">Aide administration</a></li>
							<li><a href="index.php?page=aide&option=2">Contact</a></li>
							<li><a href="index.php?page=aide&option=3">Liens utiles</a></li>
							<div class="menuB"></div>
						</ul>
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



