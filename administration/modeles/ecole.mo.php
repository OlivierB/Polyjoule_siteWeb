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
	erreurFormulaire : 
	ecoleAjoutee : 
	default : affichage du contenu du message
*/
	$toReturn=$idMessage;
	
	return $toReturn;
}

function affichageEcoles() {
	$req = mysql_query("SELECT * FROM ECOLE ORDER BY `nom_ecole`");
	while ($ecole=mysql_fetch_array($req)) {
		echo "<tr class='article' onMouseOver='this.style.backgroundColor=\"#AAAAAA\"' onMouseOut='this.style.backgroundColor=\"\"'>";
		echo "<td class='article'>".$ecole[0]."</td>";
		echo "<td class='article' style='text-align:left;'>".$ecole[1]."</td>";
		echo "<td class='article' style='text-align:left;'>".$ecole[2]."</td>";
		echo "<td class='article'>";
		echo "<a href='index.php?page=ecole&action=2&idEcole=".$ecole[0]."'>Modifier</a> - ";
		echo "<a href='index.php?page=ecole&action=3&idEcole=".$ecole[0]."'>Supprimer</a>";
		echo "</td>";
		echo "</tr>";
	}
	mysql_free_result($req);
}

function ajouterEcole($nom,$adresse,$photo,$descFR,$descEN) {
	if ($nom!="" && $adresse!="" && $descFR!="" && $descEN!="") {
		$req="INSERT INTO ecole VALUES (NULL,'".$nom."','".$adresse."',NULL,'".$descFR."','".$descEN."')";
		mysql_query($req) or die(mysql_error());
		mysql_free_result($req);
		header("Location: index.php?page=ecole&message=ecoleAjoutee");
	} else {
		header("Location:index.php?page=ecole&message=erreurFormulaire");
	}
}
?>