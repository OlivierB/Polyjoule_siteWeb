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

function getParticipation($idPart,$equipe) {
	$req = mysql_query("SELECT * FROM PARTICIPANT NATURAL JOIN COMPOSE NATURAL JOIN EQUIPE WHERE id_participant=$idPart AND id_equipe=$equipe;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

function affichageEquipe2() {
	//echo "<ul class='section_name'>";
	$req = mysql_query("SELECT * FROM EQUIPE ORDER BY annee_equipe DESC");
	while ($equipe=mysql_fetch_array($req)) {
		$cpt=countParticipation($equipe['id_equipe']);
		$s= ($cpt!=1) ? "s" : "";
		echo "<ul class='section_name'><li>Année ".$equipe['annee_equipe']." (".$cpt." participant".$s.")</li></ul>";
		?>
			<table class="blue_tabular">
				<tr class="blue_tabular_title">
					<th class="blue_tabular_title">
						ID
					</th>
					<th class="blue_tabular_title">
						Nom
					</th>
					<th class="blue_tabular_title">
						Prénom
					</th>
					<th class="blue_tabular_title">
						Rôle
					</th>
					<th class="blue_tabular_title">
						Administration
					</th>
				</tr>
				<?php
					$req2 = mysql_query("SELECT * FROM COMPOSE NATURAL JOIN PARTICIPANT WHERE id_equipe='".$equipe['id_equipe']."' ORDER BY nom_participant, prenom_participant");
					while ($part=mysql_fetch_array($req2)) {
						echo "<tr class='blue_tabular_cell'>";
						echo "<td class='blue_tabular_cell'>".$part['id_participant']."</td>";
						echo "<td class='blue_tabular_cell'>".$part['nom_participant']."</td>";
						echo "<td class='blue_tabular_cell'>".$part['prenom_participant']."</td>";
						echo "<td class='blue_tabular_cell'>".$part['role_participant']."</td>";
						echo "<td class='blue_tabular_cell'>";
						echo "<a href='index.php?page=participation&action=2&idEquipe=".$equipe['id_equipe']."&idParticipant=".$part['id_participant']."'>Modifier</a> - ";
						echo "<a href='index.php?page=participation&action=3&idEquipe=".$equipe['id_equipe']."&idParticipant=".$part['id_participant']."'>Supprimer</a>";
						echo "</td>";
						echo "</tr>";
					}
				?>
			</table>
		<?php
	}
	//echo "</ul>";
	mysql_free_result($req);
}

function countParticipation($idEquipe) {
	$req = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_equipe=$idEquipe;");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}

function participationExistante($idPart,$equipe) {
	$req = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_participant='".$idPart."' AND id_equipe='".$equipe."';");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}

function ajouterParticipation($idPart,$equipe) {
	$req="INSERT INTO COMPOSE VALUES ('".$idPart."','".$equipe."');";
	mysql_query($req) or die(mysql_error());
}

function supprimerParticipation($equipe,$part) {
	$req="DELETE FROM COMPOSE WHERE id_participant='".$part."' AND id_equipe='".$equipe."';";
	mysql_query($req) or die(mysql_error());
	if (countEquipeParticipant($part)==0) {
		supprimerParticipant($part);
	}
}

function MAJParticipation($equipe,$part,$newEquipe,$newPart) {
	$req="DELETE FROM COMPOSE WHERE id_participant='".$part."' AND id_equipe='".$equipe."';";
	mysql_query($req) or die(mysql_error());
	ajouterParticipation($newPart,$newEquipe);
}

?>
