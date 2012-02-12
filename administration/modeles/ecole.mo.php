<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des articles
*
-->

<?php

function getMessage($idMessage) {
/*
	erreurFormulaire : Il y a une erreur dans le formulaire. Veuillez recommencez.
	ecoleAjoutee : L'école a bien été ajoutée.
	ecoleNonSelectionnee : Aucune école n'a été sélectionnée.
	ecoleInexistante : L'école est inexistante.
	ecoleMAJ : L'école a bien été mise à jour.
	ecoleSupprimee : L'école a bien été supprimée.
	default : affichage du contenu du message
*/
	if ($idMessage=="erreurFormulaire") {
		$toReturn="Il y a une erreur dans le formulaire. Veuillez recommencez.";
	} else if ($idMessage=="ecoleAjoutee") {
		$toReturn="L'école a bien été ajoutée.";
	} else if ($idMessage=="ecoleNonSelectionnee") {
		$toReturn="Aucune école n'a été sélectionnée.";
	} else if ($idMessage=="ecoleInexistante") {
		$toReturn="L'école est inexistante.";
	} else if ($idMessage=="ecoleMAJ") {
		$toReturn="L'école a bien été mise à jour.";
	} else if ($idMessage=="ecoleSupprimee") {
		$toReturn="L'école a bien été supprimée.";
	} else {
		$toReturn=$idMessage;
	}
	return $toReturn;
}

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
		echo "<tr class='blue_tabular_cell'>";
		echo "<td class='blue_tabular_cell'>".$ecole[0]."</td>";
		echo "<td class='blue_tabular_cell'>".$ecole[1]."</td>";
		echo "<td class='blue_tabular_cell'>".$ecole[2]."</td>";
		echo "<td class='blue_tabular_cell'>";
		echo "<a href='index.php?page=ecole&action=2&idEcole=".$ecole[0]."'>Modifier</a> - ";
		echo "<a href='index.php?page=ecole&action=6&idEcole=".$ecole[0]."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function ajouterEcole($nom,$adresse,$photo,$descFR,$descEN) {
	if ($nom!="" && $adresse!="") {
		$req="INSERT INTO ECOLE VALUES (NULL,'".$nom."','".$adresse."',NULL,'".$descFR."','".$descEN."')";
		mysql_query($req) or die(mysql_error());
		mysql_free_result($req);
		header("Location: index.php?page=ecole&message=ecoleAjoutee");
	} else {
		header("Location:index.php?page=ecole&message=erreurFormulaire");
	}
}

function MAJEcole($id,$nom,$adresse,$photo,$descFR,$descEN) {
	if (ecoleExistante($id)) {
		if ($nom!="" && $adresse!="") {
			$req="UPDATE ECOLE SET nom_ecole='".$nom."', adresse_ecole='".$adresse."', photo_ecole='".$photo."', descFR_ecole='".$descFR."', descEN_ecole='".$descEN."' WHERE id_ecole='".$id."';";
			mysql_query($req) or die(mysql_error());
			mysql_free_result($req);
			header("Location: index.php?page=ecole&message=ecoleMAJ");
		} else {
			header("Location:index.php?page=ecole&message=erreurFormulaire");
		}
	} else {
		header("Location:index.php?page=ecole&message=ecoleInexistante");
	}
}

function supprimerEcole($id) {
	if (ecoleExistante($id)) {
		supprimerFormations($id);
		$req = mysql_query("DELETE FROM ECOLE WHERE `id_ecole`=$id;");
		header("Location: index.php?page=ecole&message=ecoleSupprimee");
	} else {
		header("Location: index.php?page=ecole&message=erreurFormulaire");
	}
}

function supprimerFormations($idEcole) {
	$req = mysql_query("DELETE FROM FORMATION WHERE id_ecole=$idEcole;");
}
?>
