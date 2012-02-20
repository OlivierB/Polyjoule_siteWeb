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

function affichageEquipe() {
	$req = mysql_query("SELECT * FROM EQUIPE ORDER BY annee_equipe DESC");
	while ($equipe=mysql_fetch_array($req)) {
		$req2 = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_equipe='".$equipe['id_equipe']."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$equipe['id_equipe']."</td>";
		echo "<td class='blue_tabular_cell'>".$equipe['annee_equipe']."</td>";
		echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=equipe&action=2&idEquipe=".$equipe['id_equipe']."'>Modifier</a> - ";
		echo "<a href='index.php?page=equipe&action=3&idEquipe=".$equipe['id_equipe']."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function equipeExistante($id) {
	$req = mysql_query("SELECT * FROM EQUIPE WHERE id_equipe=".$id);
	$equipe=mysql_fetch_array($req);
	if ($equipe[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

function getEquipe($id) {
	$req = mysql_query("SELECT * FROM EQUIPE WHERE id_equipe=$id;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

function ajouterEquipe($annee) {
	$req="INSERT INTO EQUIPE VALUES (NULL,'".$annee."')";
	mysql_query($req) or die(mysql_error());
}

function MAJEquipe($id,$annee) {
	$req="UPDATE EQUIPE SET annee_equipe='".$annee."' WHERE id_equipe='".$id."';";
	mysql_query($req) or die(mysql_error());
}

function countEquipeParticipant($idPart) {
	$req2 = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_participant='".$idPart."'") or die(mysql_error());
	$cpt=mysql_fetch_array($req2);
	return $cpt[0];
}

function supprimerEquipe($id) {
	$req=mysql_query("SELECT * FROM COMPOSE WHERE id_equipe='".$id."';") or die(mysql_error());
	while ($compose=mysql_fetch_array($req)) {
		supprimerParticipation($id,$compose['id_participant']);
	}
	$req="DELETE FROM EQUIPE WHERE id_equipe='".$id."';";
	mysql_query($req) or die(mysql_error());
}

?>
