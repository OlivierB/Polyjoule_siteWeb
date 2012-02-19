<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des rubriques
*
-->

<?php

function affichageParticipant () {
	$req=mysql_query("SELECT * FROM PARTICIPANT ORDER BY nom_participant , prenom_participant");
	while ($part=mysql_fetch_array($req)) {
		$req2 = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_participant='".$part[0]."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
			echo "<td class='blue_tabular_cell'>".$part[1]."</td>";
			echo "<td class='blue_tabular_cell'>".$part[2]."</td>";
			echo "<td class='blue_tabular_cell'>".$part[5]."</td>";
			echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
			echo "<td class='blue_tabular_cell'>";
			echo "<a href='index.php?page=participant&action=2&idParticipant=".$part[0]."'>Modifier</a> - ";
			echo "<a href='index.php?page=participant&action=3&idParticipant=".$part[0]."'>Supprimer</a><br />";
			echo "<a href='index.php?page=participant&action=7&idParticipant=".$part[0]."'>Modifier photo</a>";
			echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function participantExistant($id) {
	$req = mysql_query("SELECT * FROM PARTICIPANT WHERE `id_participant`=$id;");
	$part=mysql_fetch_array($req);
	if ($part[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

function getParticipant($id) {
	$req = mysql_query("SELECT * FROM PARTICIPANT WHERE `id_participant`=$id;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

function ajouterParticipant($nom,$prenom,$mail,$role,$path,$bioFR,$bioEN) {
	$req="INSERT INTO PARTICIPANT VALUES (NULL,'".$nom."','".$prenom."','".$path."','".$mail."','".$role."','".$bioFR."','".$bioEN."');";
	mysql_query($req) or die(mysql_error());
}

function MAJParticipant($id,$nom,$prenom,$mail,$role,$bioFR,$bioEN) {
	$req="UPDATE PARTICIPANT SET nom_participant='".$nom."',prenom_participant='".$prenom."',mail_participant='".$mail."',role_participant='".$role."',bioFR_participant='".$bioFR."',bioEN_participant='".$bioEN."' WHERE id_participant='".$id."';";
	mysql_query($req) or die(mysql_error());
}

function supprimerImageParticipant($id) {
	$req=mysql_query("SELECT photo_participant FROM PARTICIPANT WHERE id_participant=".$id.";") or die(mysql_error());
	$name=mysql_fetch_array($req);
	$old_file = explode('/', $name['photo_participant']);
	$old_file =$old_file[count($old_file)-1];
	delete_file('ressources/data/Participants',$old_file);
}

function supprimerParticipant($id) {
	supprimerImageParticipant($id);
	$req = mysql_query("DELETE FROM PARTICIPANT WHERE id_participant=$id;") or die(mysql_error());
}

function updatePhoto($id,$path) {
	$req="UPDATE PARTICIPANT SET photo_participant='".$path."' WHERE id_participant='".$id."';";
	mysql_query($req) or die(mysql_error());
}

?>
