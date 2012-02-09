<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des articles
*
-->

<?php

function get_articles()
{
	$articles = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM ARTICLE;');
	while($art = mysql_fetch_array($req))
	{
		$req1 = mysql_query("SELECT titreFR_rubrique FROM RUBRIQUE WHERE id_rubrique=".$art["id_rubrique"]);
		$titreRub = mysql_fetch_array($req1);
		
		$articles[$i] = array(
			"id_article" => $art["id_article"],
			"id_rubrique" => $art["id_rubrique"],
			"titreFR_rubrique" => $titreRub["titreFR_rubrique"],
			"titreFR_article" => $art["titreFR_article"],
			"titreEN_article" => $art["titreEN_article"],
			"contenuFR_article" => $art["contenuFR_article"],
			"contenuEN_article" => $art["contenuEN_article"],
			"auteur_article" => "auteur",  /* AJOUTER ARTICLE.AUTEUR DANS BDD */
			"statut_article" => 1,  /* AJOUTER ARTICLE.STATUT DANS BDD */
			"autorisation_com" => $art["autorisation_com"] );
		$i++;
	}
	return $articles;
}

?>



