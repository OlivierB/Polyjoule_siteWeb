<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des écoles
*
-->

<?php

function getEcole($idEcole) {
	$req = mysql_query("SELECT * FROM ECOLE WHERE `id_ecole`=$idEcole;");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
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

function affichageEcoles() {
	$req = mysql_query("SELECT * FROM ECOLE ORDER BY `nom_ecole`");
	while ($ecole=mysql_fetch_array($req)) {
		$req2 = mysql_query("SELECT count(*) FROM FORMATION WHERE id_ecole='".$ecole[0]."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$ecole[0]."</td>";
		echo "<td class='blue_tabular_cell'>".$ecole[1]."</td>";
		echo "<td class='blue_tabular_cell'>".$ecole[2]."</td>";
		echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=ecole&action=2&idEcole=".$ecole[0]."'>Modifier</a> - ";
		echo "<a href='index.php?page=ecole&action=3&idEcole=".$ecole[0]."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function ajouterEcole($nom,$adresse,$photo,$descFR,$descEN) {
	$req="INSERT INTO ECOLE VALUES (NULL,'".$nom."','".$adresse."','".$photo."','".$descFR."','".$descEN."')";
	mysql_query($req) or die(mysql_error());
}

function MAJEcole($id,$nom,$adresse,$photo,$descFR,$descEN) {
	$req="UPDATE ECOLE SET nom_ecole='".$nom."', adresse_ecole='".$adresse."', photo_ecole='".$photo."', descFR_ecole='".$descFR."', descEN_ecole='".$descEN."' WHERE id_ecole='".$id."';";
	mysql_query($req) or die(mysql_error());
}

function supprimerImageEcole($id) {
	$req=mysql_query("SELECT photo_ecole FROM ECOLE WHERE id_ecole=".$id.";") or die(mysql_error());
	$name=mysql_fetch_array($req);
	$old_file = explode('/', $name['photo_ecole']);
	$old_file =$old_file[count($old_file)-1];
	delete_file('ressources/data/Ecoles',$old_file);
}

function supprimerEcole($id) {
	supprimerImageEcole($id);
	supprimerFormations($id);
	$req = mysql_query("DELETE FROM ECOLE WHERE `id_ecole`=$id;") or die(mysql_error());
}

function supprimerFormations($idEcole) {
	$req = mysql_query("DELETE FROM FORMATION WHERE id_ecole=$idEcole;");
}
?>
