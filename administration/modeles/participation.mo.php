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
	//echo "<ul class='section_name'>";
	$req = mysql_query("SELECT * FROM EQUIPE ORDER BY annee_equipe DESC");
	while ($equipe=mysql_fetch_array($req)) {
		echo "<ul class='section_name'><li>".$equipe['annee_equipe']."</li></ul>";
		?>
			<table class="blue_tabular">
				<tr class="blue_tabular_title">
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

?>
