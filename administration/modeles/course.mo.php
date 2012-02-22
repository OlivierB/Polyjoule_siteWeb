<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des courses
*
-->

<?php

function affichageCourses() {
	$req = mysql_query("SELECT * FROM COURSE NATURAL JOIN EQUIPE ORDER BY `date_course` DESC");
	while ($course=mysql_fetch_array($req)) {
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$course['id_course']."</td>";
		echo "<td class='blue_tabular_cell'>".$course['nom-equipe']."</td>";
		echo "<td class='blue_tabular_cell'>".$course['date_course']."</td>";
		echo "<td class='blue_tabular_cell'>".$course['lieu_course']."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=course&action=2&idCourse=".$course['id_course']."'>Modifier</a> - ";
		echo "<a href='index.php?page=course&action=3&idCourse=".$course['id_course']."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

?>
