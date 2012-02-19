<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des formations
*
-->

<?php

function getFormation ($id) {
	$req = mysql_query("SELECT * FROM FORMATION WHERE id_formation=$id;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

function listeEcole() {
	$req = mysql_query("SELECT count(*) FROM ECOLE;");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	if ($count[0]>0) {
		echo "<select name='ecole'>";
		$req2 = mysql_query("SELECT * FROM ECOLE;");
		while($ecole=mysql_fetch_array($req2))
		{
			echo "<option value='".$ecole[0]."'>- ".$ecole[2]."</option>";
		}
		echo "</select>";
		mysql_free_result($req2);
	} else {
		echo "<p>Vous devez d'abord créer une école avant de pouvoir ajouter une formation.</p>";
	}
}

function listeEcoleSelect($id) {
	$req = mysql_query("SELECT count(*) FROM ECOLE;");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	if ($count[0]>0) {
		echo "<select name='ecole'>";
		$req2 = mysql_query("SELECT * FROM ECOLE;");
		while($ecole=mysql_fetch_array($req2))
		{
			if ($ecole[0]==$id) {
				echo "<option value='".$ecole[0]."' selected='selected'>- ".$ecole[2]."</option>";
			} else {
				echo "<option value='".$ecole[0]."'>- ".$ecole[2]."</option>";
			}
		}
		echo "</select>";
		mysql_free_result($req2);
	} else {
		echo "<p style='margin-left:10px;'>Vous devez d'abord créer une école avant de pouvoir ajouter une formation.</p>";
	}
}

function ecoleExistante($idEcole) {
	$req = mysql_query("SELECT * FROM ECOLE WHERE id_ecole=".$idEcole);
	$ecole=mysql_fetch_array($req);
	if ($ecole[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

function formationExistante($id) {
	$req = mysql_query("SELECT * FROM FORMATION WHERE id_formation=".$id);
	$formation=mysql_fetch_array($req);
	if ($formation[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

function affichageFormations() {
	$req = mysql_query("SELECT * FROM FORMATION NATURAL JOIN ECOLE ORDER BY `id_formation`");
	while ($formation=mysql_fetch_array($req)) {
		$req2 = mysql_query("SELECT count(*) FROM APPARTIENT WHERE id_formation='".$formation['id_formation']."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$formation['id_formation']."</td>";
		echo "<td class='blue_tabular_cell'>".$formation['titreFR_formation']."</td>";
		echo "<td class='blue_tabular_cell'>".$formation['nom_ecole']."</td>";
		echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=formation&action=2&idformation=".$formation['id_formation']."'>Modifier</a> - ";
		echo "<a href='index.php?page=formation&action=3&idformation=".$formation['id_formation']."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function ajouterFormation($nomFR,$nomEN,$idEcole,$lien,$descFR,$descEN) {
	$req="INSERT INTO FORMATION VALUES (NULL,'".$idEcole."','".$nomFR."','".$nomEN."','".$lien."','".$descFR."','".$descEN."')";
	mysql_query($req) or die(mysql_error());
}

function MAJFormation($id,$nomFR,$nomEN,$idEcole,$lien,$descFR,$descEN) {
	$req="UPDATE FORMATION SET id_ecole='".$idEcole."', titreFR_formation='".$nomFR."', titreEN_formation='".$nomEN."', lien_formation='".$lien."', descFR_formation='".$descFR."', descEN_formation='".$descEN."' WHERE id_formation='".$id."';";
	mysql_query($req) or die(mysql_error());
}

function supprimerFormation($id) {
	$req = mysql_query("DELETE FROM FORMATION WHERE id_formation=$id;") or die(mysql_error());
}
?>
