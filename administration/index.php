<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
-->

<?php

// fonctions
include("../modeles/fonctions.php");

// Lancement session : session déjà lancé sur le site principal ?
session_start();


// Connexion à la BDD
//mysql_connect('localhost', 'root', '');
//mysql_select_db('polyjoule');


?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/classique/design.css"  />
		
		<title>Polyjoule-Administration</title>
	</head>

	<body>
		<div id="logo">
		</div>

		<ul id="menuDeroulant">
			<li>
			<a href="?page=acceuil">ADMINISTRATION</a>
			<ul class="sousMenu">
			<li><a href="#">Panneau d'administration</a></li>
			<li><a href="#">Statistiques</a></li>
			<li><a href="#">Mon profil</a></li>
			<li><a href="?page=connexion">Maintenance</a></li>
			<li><a href="#"> <img src="ressources/design/classique/images/shutdown.png" alt="shutdown"/> Déconnexion</a></li>
			</ul>
			</li>
			<li>
			<a href="#">MENUS</a>
			<ul class="sousMenu">
			<li><a href="#">Gestion des rubriques</a></li>
			<li><a href="#">Menu principal</a></li>
			</ul>
			</li>
			<li>
			<a href="#">CONTENU</a>
			<ul class="sousMenu">
			<li><a href="#">Gestion des articles</a></li>
			<li><a href="#">Gestion des catégories</a></li>
			<li><a href="#">Articles en vedette</a></li>
			<li><a href="#">Gestion des médias</a></li>
			</ul>
			</li>
			<li>
			<a href="#">AIDE</a>
			<ul class="sousMenu">
			<li><a href="#">Aide administration</a></li>
			<li><a href="#">Contact</a></li>
			<li><a href="#">Liens utiles</a></li>
			</ul>
			</li>
		</ul>

<?php
// Inclusion de la page demandée (page d'accueil si aucune) ==> Il faut ajouter une sécurité avec la liste des fichiers qui peuvent être inclus
// Faire du rewriting sur ces adresses
if (!empty($_GET['page']) && is_file('controleurs/'.$_GET['page'].'.co.php'))
{
        include ('controleurs/'.$_GET['page'].'.co.php');

}
else
{
        include ('controleurs/acceuil.co.php');

}

?>

	</body>
</html>

<?php
// Fermeture session
mysql_close();
