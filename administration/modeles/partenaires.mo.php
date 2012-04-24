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

function addPartenaire ($nom, $adresse, $logo, $desciptionFR, $desciptionEN)
{
 	$req="INSERT INTO PARTENAIRE VALUES ('', '', '".$nom."', '".$logo."', '".$adresse."', '".$desciptionFR."', '".$desciptionEN."');";
	mysql_query($req) or die(mysql_error());
}

function getInfoPartenaire ($id)
{
	$listPart = array();
	$req = mysql_query("SELECT * FROM PARTENAIRE WHERE id_partenaire='".$id."';");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listPart[] = $donnees;
	}

	mysql_free_result($req);

	if (!empty ($listPart))
		return $listPart[0];
	else
		return Array ("nom_partenaire" => "...", "logo_partenaire" => "...", "site_partenaire" => "...",  "descFR_partenaire" => "description FR", "descEN_partenaire" => "description EN",);
}

function updatePartenaire ($id, $nom, $adresse, $logo, $desciptionFR, $desciptionEN)
{
	$req="UPDATE PARTENAIRE SET nom_partenaire='$nom', logo_partenaire='$logo', site_partenaire='$adresse', descFR_partenaire='$desciptionFR',  descEN_partenaire='$desciptionEN' WHERE id_partenaire='$id'";
	mysql_query($req) or die(mysql_error());

}

function deletePartenaire($id)
{
	$req="DELETE FROM PARTENAIRE WHERE id_partenaire='$id'";
	mysql_query($req) or die(mysql_error());
}


?>
