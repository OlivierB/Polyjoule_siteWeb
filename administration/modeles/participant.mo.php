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
		$req2 = mysql_query("SELECT count(*) FROM PARTICIPATION WHERE id_participant='".$part[0]."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
			echo "<td class='blue_tabular_cell'>".$part[0]."</td>";
			echo "<td class='blue_tabular_cell'>".$part[1]."</td>";
			echo "<td class='blue_tabular_cell'>".$part[2]."</td>";
			echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
			echo "<td class='blue_tabular_cell'>";
			echo "<a style='text-decoration:none;color:green;' href='index.php?page=participant&action=2&idParticipant=".$part[0]."'>Modifier</a> - ";
			echo "<a style='text-decoration:none;color:red;' href='index.php?page=participant&action=3&idParticipant=".$part[0]."'>Supprimer</a><br />";
			echo "<a style='text-decoration:none;color:blue;' href='index.php?page=participant&action=7&idParticipant=".$part[0]."'>Modifier photo</a>";
			echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function countParticipant() {
	$req = mysql_query("SELECT count(*) FROM PARTICIPANT;");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}

function listeParticipant() {
	echo "<select name='participant'>";
	$req = mysql_query("SELECT * FROM PARTICIPANT ORDER BY nom_participant, prenom_participant DESC;");
	while($participant=mysql_fetch_array($req))
	{
		echo "<option value='".$participant[0]."'>- ".strtoupper($participant[1])." ".$participant[2]." (".$participant['role_participant'].")</option>";
	}
	echo "</select>";
	mysql_free_result($req);
}

function listeParticipantSelected($id) {
	echo "<select name='participant'>";
	$req = mysql_query("SELECT * FROM PARTICIPANT ORDER BY nom_participant, prenom_participant DESC;");
	while($participant=mysql_fetch_array($req))
	{
		if ($id==$participant[0]) {
			echo "<option value='".$participant[0]."' selected='selected'>- ".strtoupper($participant[1])." ".$participant[2]." (".$participant['role_participant'].")</option>";
		} else {
			echo "<option value='".$participant[0]."'>- ".strtoupper($participant[1])." ".$participant[2]." (".$participant['role_participant'].")</option>";
		}
	}
	echo "</select>";
	mysql_free_result($req);
}

function searchPart($nom,$prenom,$mail) {
	$req=mysql_query("SELECT * FROM PARTICIPANT WHERE nom_participant='".$nom."' AND prenom_participant='".$prenom."' AND mail_participant='".$mail."'  ORDER BY id_participant DESC;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn[0];
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

function ajouterParticipant($nom,$prenom,$mail,$path,$bioFR,$bioEN,$prof) {
	$req="INSERT INTO PARTICIPANT VALUES (NULL,'".$nom."','".$prenom."','".$path."','".$mail."','".$bioFR."','".$bioEN."','".$prof."');";
	mysql_query($req) or die(mysql_error());
}

function MAJParticipant($id,$nom,$prenom,$mail,$bioFR,$bioEN,$prof) {
	$req="UPDATE PARTICIPANT SET nom_participant='".$nom."',prenom_participant='".$prenom."',mail_participant='".$mail."',isProf='".$prof."',bioFR_participant='".$bioFR."',bioEN_participant='".$bioEN."' WHERE id_participant='".$id."';";
	mysql_query($req) or die(mysql_error());
}

function supprimerImageParticipant($id) {
	$req=mysql_query("SELECT photo_participant FROM PARTICIPANT WHERE id_participant=".$id.";") or die(mysql_error());
	$name=mysql_fetch_array($req);
	delete_file('ressources/data/Participants',$name['photo_participant']);
}

function supprimerParticipant($id) {
	supprimerImageParticipant($id);
	$req = mysql_query("DELETE FROM PARTICIPATION WHERE id_participant=$id;") or die(mysql_error());
	$req = mysql_query("DELETE FROM PARTICIPANT WHERE id_participant=$id;") or die(mysql_error());
}

function updatePhoto($id,$path) {
	$req="UPDATE PARTICIPANT SET photo_participant='".$path."' WHERE id_participant='".$id."';";
	mysql_query($req) or die(mysql_error());
}

?>
