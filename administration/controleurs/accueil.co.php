<!--
/** fichier d'accueil **/


traitements
-->

<?php
	
	include ('modeles/accueil.mo.php');
	
	//$livre 		= livreOr();
	$article 	= articles();

	include ('vues/accueil.vu.php');
?>
