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

function getCourse ($id) {
	$req = mysql_query("SELECT * FROM COURSE WHERE `id_course`=$id;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

function courseExistante($id) {
	$req = mysql_query("SELECT * FROM COURSE WHERE `id_course`=$id;");
	$course=mysql_fetch_array($req);
	if ($course[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

function affichageCourses() {
	$req = mysql_query("SELECT * FROM COURSE NATURAL JOIN EQUIPE ORDER BY `date_course` DESC");
	while ($course=mysql_fetch_array($req)) {
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$course['id_course']."</td>";
		echo "<td class='blue_tabular_cell'>".$course['annee_equipe']."</td>";
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

/* Supprimer toutes les courses où l'idEquipe est égal au paramètre */
function supprimerCourseParEquipe($idEquipe) {

}

function ajouterCourse($equipe,$date,$lieu,$photo,$descFR,$descEN) {
	$req="INSERT INTO COURSE VALUES (NULL,'".$equipe."','".$date."','".$lieu."','".$photo."','".$descFR."','".$descEN."')";
	mysql_query($req) or die(mysql_error());
}

function MAJCourse() {
	
}

function supprimerImageCourse($id) {
	$req=mysql_query("SELECT img_course FROM COURSE WHERE id_course=".$id.";") or die(mysql_error());
	$name=mysql_fetch_array($req);
	$old_file = explode('/', $name['img_course']);
	$old_file =$old_file[count($old_file)-1];
	delete_file('ressources/data/Courses',$old_file);
}

function supprimerCourse($id) {
	supprimerImageCourse($id);
	$req = mysql_query("DELETE FROM COURSE WHERE `id_course`=$id;") or die(mysql_error());
}

?>
