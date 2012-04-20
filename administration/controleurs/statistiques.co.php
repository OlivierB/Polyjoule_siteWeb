<!-- // fichier des statistiques du site


traitements

-->

<?php

	// Inclusion de la librairie JpGraph
	//include ("ressources/scripts/php/jpGraph/jpgraph.php");
	//include ("ressources/scripts/php/jpGraph/jpgraph_bar.php");

	include ('modeles/statistiques.mo.php');
	
	$graph1 = get_nbArt_par_membre();
	
	$graph2 = get_history_article();
	
	$sousPage = "defaut";
	
	include ('vues/statistiques/statistiques_'.$sousPage.'.vu.php');
	
	
?>
