<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des partenaires
*
-->

<?php

function get_partenaires()
{
	$partenaires = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM PARTENAIRE;');
	while($part = mysql_fetch_array($req))
	{
		$partenaires[$i] = array(
			"id_partenaire" => $part["id_partenaire"],
			"id_article" => $part["id_article"],
			"nom_partenaire" => $part["nom_partenaire"],
			"logo_partenaire" => $part["logo_partenaire"],
			"site_partenaire" => $part["site_partenaire"],
			"descFR_partenaire" => $part["descFR_partenaire"],
			"descEN_partenaire" => $part["descEN_partenaire"]);
		$i++;
	}
	return $partenaires;
}

?>
