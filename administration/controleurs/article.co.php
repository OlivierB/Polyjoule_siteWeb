<!-- // fichier de gestion des articles


traitements

-->

<?php
	include("modeles/article.mo.php");
	include("modeles/rubrique.mo.php"); // Appel � certaines fonctions concernant les rubriques
	
	$articles = get_articles();

     include ('vues/article.vu.php');
?>
