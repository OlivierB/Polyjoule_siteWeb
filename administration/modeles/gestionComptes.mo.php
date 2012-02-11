<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des comptes de la partie admin
*
-->

<?php

function get_membres()
{
	$membres = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM MEMBRE;');
	while($membre = mysql_fetch_array($req))
	{
		$membres[$i] = array(
			"id_membre" => $membre["id_membre"],
			"pseudo_membre" => $membre["pseudo_membre"],
			"mdp_membre" => $membre["mdp_membre"],
			"mail_membre" => $membre["mail_membre"],
			"statut_membre" => $membre["statut_membre"]);
		$i++;
	}
	return $membres;
}

?>



