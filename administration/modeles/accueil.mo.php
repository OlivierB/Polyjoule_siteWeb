<!--
/** fichier d'accueil **/


requetes SQL
-->

<?php

// Lister le livre d'or
function livreOr() 
{
	$retour = array();
	$req = mysql_query("SELECT id_post, posteur_post, date_post, message_post FROM LIVRE_OR ORDER BY id_post DESC LIMIT 0,5");
	while ($donnees = mysql_fetch_assoc($req)) {
		$retour[] = $donnees;
	}
	return $retour;
}


// Lister les articles
function articles() 
{
	$retour = array();
	$req = mysql_query("SELECT id_article, titreFR_article, titreEN_article, contenuFR_article, contenuEN_article FROM ARTICLE ORDER BY id_article DESC LIMIT 0,5");
	while ($donnees = mysql_fetch_assoc($req)) {
		$retour[] = $donnees;
	}
	return $retour;
}

?>

