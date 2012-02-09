<!-- // fichier de gestion des articles


traitements

-->

<?php
	include("modeles/article.mo.php");
	
	$articles = get_articles();

     include ('vues/article.vu.php');
?>
