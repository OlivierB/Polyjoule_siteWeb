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
	$req = mysql_query("SELECT * FROM EQUIPE ORDER BY annee_equipe,id_equipe");
	while ($equipe=mysql_fetch_array($req)) {
		$req2 = mysql_query("SELECT count(*) FROM COMPOSE WHERE id_equipe='".$equipe['id_equipe']."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$equipe['id_equipe']."</td>";
		echo "<td class='blue_tabular_cell'>".$equipe['annee_equipe']."</td>";
		echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=formation&action=2&idformation=".$equipe['id_equipe']."'>Modifier</a> - ";
		echo "<a href='index.php?page=formation&action=3&idformation=".$equipe['id_equipe']."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

?>
