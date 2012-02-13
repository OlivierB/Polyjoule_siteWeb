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
$baseDonnees=0; //si les modifications de la base de données ont été faites (descriptions rubriques par exemple) égal à 1, 0 sinon.

/*Fait la liste des rubriques*/
function listeRubrique(){
	echo "<select name='rubrique'>";
	echo "<option value='null'>Aucune</option>";
	$req2 = mysql_query("SELECT * FROM RUBRIQUE WHERE `id_mere` is null;");
	while($rubrique=mysql_fetch_array($req2))
	{
		echo "<option value='".$rubrique[0]."'>".$rubrique[2]."</option>";
		getChildRubrique($rubrique[0],0);
	}
	echo "</select>";
}

/*Faire une liste des rubriques filles*/
function getChildRubrique($idRubrique,$niveau) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idRubrique);
	$niveau++;
	while ($rubrique=mysql_fetch_array($req)) {
		if($rubrique[0]!=null){
			echo "<option value='".$rubrique[0]."'>";
			for($i=0;$i<$niveau;$i++){
				echo "----";
			}
			echo ">";
			echo $rubrique[2]."</option>";
			getChildRubrique($rubrique[0],$niveau);
		}
	}
}

/*Vérifie l'existence d'une rubrique*/
function rubriqueExistante($id) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique='".$id."';");
	$rubrique=mysql_fetch_array($req);
	if ($rubrique[0] == null) {
		$toReturn=false;
	} else {
		$toReturn=true;
	}
	return $toReturn;
}

/*Fait la liste des rubriques + select*/
function listeRubriqueSelected($id_rubrique_mere,$id_rubrique){
	echo "<select name='rubrique'>";
	if ($id_rubrique_mere==null) {
		echo "<option value='null' selected='selected'>Aucune</option>";
	} else {
		echo "<option value='null'>Aucune</option>";
	}
	$req2 = mysql_query("SELECT * FROM RUBRIQUE WHERE `id_mere` is null;");
	while($rubrique=mysql_fetch_array($req2))
	{
		if ($rubrique[0]!=$id_rubrique) {
			if ($rubrique[0]==$id_rubrique_mere) {
				echo "<option value='".$rubrique[0]."' selected='selected'>".$rubrique[2]."</option>";
			} else {
				echo "<option value='".$rubrique[0]."'>".$rubrique[2]."</option>";
			}
			getChildRubriqueSelected($rubrique[0],0,$id_rubrique_mere,$id_rubrique);
		}
	}
	mysql_free_result($req2);
	echo "</select>";
}

/*Faire une liste des rubriques filles + select*/
function getChildRubriqueSelected($idRubrique,$niveau,$id_rubrique_mere,$id_rubrique) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idRubrique);
	$niveau++;
	while ($rubrique=mysql_fetch_array($req)) {
		if($rubrique[0]!=null){
			if ($rubrique[0]!=$id_rubrique) {
				if ($rubrique[0]==$id_rubrique_mere) {
					echo "<option value='".$rubrique[0]."' selected='selected'>";
				} else {
					echo "<option value='".$rubrique[0]."'>";
				}
				for($i=0;$i<$niveau;$i++){
					echo "----";
				}
				echo ">";
				echo $rubrique[2]."</option>";
				getChildRubriqueSelected($rubrique[0],$niveau,$id_rubrique_mere,$id_rubrique);
			}
		}
	}
	mysql_free_result($req);
}

/*Fonction qui permet l'affichage des rubriques de manière ordonnée*/
function affichageRubriques($idMere,$niveau) {
	if ($idMere==null) {
		$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere is null");
	} else {
		$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idMere);
	}
	$niveau++;
	while ($rubrique=mysql_fetch_array($req)) {
		if($rubrique[0]!=null){
			echo "<tr class='blue_tabular_cell'>";
			echo "<td class='blue_tabular_cell'>".$rubrique[0]."</td>";
			echo "<td class='blue_tabular_cell' style='text-align:\"left\"'>";
			for($i=1;$i<$niveau;$i++){
				echo "---";
			}
			echo " ";
			echo $rubrique[2];
			echo "</td>";
			echo "<td class='blue_tabular_cell'>".$rubrique[3]."</td>";
			echo "<td class='blue_tabular_cell'>";
			echo "<a href='index.php?page=rubrique&action=2&idRubrique=".$rubrique[0]."'>Modifier</a> - ";
			echo "<a href='index.php?page=rubrique&action=3&idRubrique=".$rubrique[0]."'>Supprimer</a>";
			echo "</td>";
			echo "</tr>";
			affichageRubriques($rubrique[0],$niveau);
		}
	}
	mysql_free_result($req);
}

/*Permet lors de la suppression d'une rubrique de changer toutes les rubriques mères des rubriques filles en null*/
function miseAJourRubriqueFilles($idRubriqueMere) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idRubriqueMere);
	while ($rubrique=mysql_fetch_array($req)) {
		$req2="UPDATE RUBRIQUE SET id_mere=null WHERE id_rubrique=".$rubrique[0].";";
		mysql_query($req2) or die(mysql_error());
		mysql_free_result($req2);
	}
	mysql_free_result($req);
}

/*fonction qui vérifie, lors de la mise à jour d'une rubrique, si il n'y a pas une boucle dans les rubriques mères 1 ok, 0 boucle*/
function verificationBoucleRubrique($idRubrique,$idRubriqueMereNew) {
	$toReturn=4;
	
	if($idRubriqueMereNew==null) {
		$toReturn=1;
	} else if ($idRubriqueMereNew==$idRubrique) {
		$toReturn=0;
	} else {
		$req=mysql_query("SELECT id_mere FROM RUBRIQUE WHERE id_rubrique=".$idRubriqueMereNew);
		$idRubriqueMereNew2=mysql_fetch_array($req);
		$toReturn=verificationBoucleRubrique($idRubrique,$idRubriqueMereNew2[0]);
	}
	
	return $toReturn;
}

/*fonction qui renvoit le message en fonction du code de message*/
function getMessage($idMessage) {
/*
	rubriqueAbsente : la rubrique est inexistante
	procedureAnnulee : la procédure a été annulée
	rubriqueSupprimee : votre rubrique a bien été supprimée
	rubriqueAjoutee : votre rubrique a bien été ajoutée
	erreurFormulaire : il y a une erreur dans le formulaire. veuillez recommancez.
	rubriqueMAJ : votre rubrique a bien été mise à jour
	rubriqueNonSelectionnee : on est sur la page rubrique/modification mais aucune rubrique n'est selectionnée
	sansRubrique : il n'y a pas de rubrique dans la base de données
	default : affichage du contenu du message
*/
	if ($idMessage=="rubriqueAbsente") {
		return "La rubrique est inexistante.";
	} else if ($idMessage=="procedureAnnulee") {
		return "La procédure a été annulée.";
	} else if ($idMessage=="rubriqueSupprimee") {
		return "Votre rubrique a bien été supprimée.";
	} else if ($idMessage=="rubriqueAjoutee") {
		return "Votre rubrique a bien été ajoutée";
	} else if ($idMessage=="erreurFormulaire") {
		return "Il y a une erreur dans le formulaire. Veuillez recommencez.";
	} else if ($idMessage=="rubriqueMAJ") {
		return "Votre rubrique a bien été mise à jour.";
	} else if ($idMessage=="rubriqueNonSelectionnee") {
		return "Aucune rubrique sélectionnée.";
	} else if ($idMessage=="sansRubrique") {
		return "Il n'y a aucune rubrique présente dans la base de données.";
	}/* else if ($idMessage=="") {
		return "";
	}*/ else {
		return $idMessage;
	}
}

/*fonction qui renvoie un tableau avec les informations de la rubrique idRubrique*/
function getRubrique($idRubrique) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique='".$idRubrique."';");
	$toReturn=mysql_fetch_array($req);
	mysql_free_result($req);
	return $toReturn;
}

/*fonction qui compte le nombre de rubrique*/
function countRubrique() {
	$req = mysql_query('SELECT count(*) FROM RUBRIQUE;');
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}

/*fonction de suppression de rubrique*/
function supprimerRubrique($idRubrique) {
	if(isset($idRubrique)) {
		if (rubriqueExistante($idRubrique)) {
			$req = mysql_query("DELETE FROM RUBRIQUE WHERE `id_rubrique`=$idRubrique;");
			mysql_free_result($req);
			miseAJourRubriqueFilles($idRubrique);
			header("Location: index.php?page=rubrique&message=rubriqueSupprimee");
		} else {
			header("Location: index.php?page=rubrique&message=rubriqueAbsente");
		}
	} else {
		header("Location: index.php?page=rubrique");
	}
}

/*fonction d'ajout de rubrique*/
function ajoutRubrique($titreFR,$titreEN,$rubrique,$descFR,$descEN) {
	if ($titreFR!="" && $titreEN!="") {
		if ($rubrique=='null') {
			if ($baseDonnees==1) {
				$req="INSERT INTO RUBRIQUE VALUES (NULL,NULL,'".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
			} else {
				$req="INSERT INTO RUBRIQUE VALUES (NULL,NULL,'".$titreFR."','".$titreEN."')";
			}
			mysql_query($req) or die(mysql_error());
			header("Location: index.php?page=rubrique&message=rubriqueAjoutee");
		} else {
			$req=mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique='".$rubrique."';");
			$result=mysql_fetch_array($req);
			if (rubriqueExistante($result[0])) {
				if ($baseDonnees==1) {
					$req ="INSERT INTO RUBRIQUE  VALUES (NULL,'".$rubrique."','".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
				} else {
					$req ="INSERT INTO RUBRIQUE  VALUES (NULL,'".$rubrique."','".$titreFR."','".$titreEN."')";
				}
				mysql_query($req) or die(mysql_error());
				header("Location: index.php?page=rubrique&message=rubriqueAjoutee");
			} else {
				header("Location: index.php?page=rubrique&message=erreurFormulaire");
			}
		}
	} else {
		header("Location: index.php?page=rubrique&message=erreurFormulaire");
	}
}

/*fonction de mise à jour de rubrique*/
function MAJRubrique($rubrique,$titreFR,$titreEN,$rubrique_mere,$descFR,$descEN) {
	if ($titreFR!="" && $titreEN!="") {
		if ($rubrique_mere=='null') {
			if ($baseDonnees==1) {
				$req="UPDATE RUBRIQUE SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', descriptionFR_rubrique='".$descFR."', descriptionEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
			} else {
				$req="UPDATE RUBRIQUE SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";
			}
			mysql_query($req) or die(mysql_error());
			mysql_free_result($req);
			header("Location: index.php?page=rubrique&message=rubriqueMAJ");
		} else {
			$req=mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique=$rubrique");
			$result=mysql_fetch_array($req);
			if (rubriqueExistante($result[0])) {
				if ($baseDonnees==1) {
					$req ="UPDATE RUBRIQUE SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', descriptionFR_rubrique='".$descFR."', descriptionEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
				} else {
					$req ="UPDATE RUBRIQUE SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."' WHERE id_rubrique=".$rubrique.";";
				}
				mysql_query($req) or die(mysql_error());
				header("Location: index.php?page=rubrique&message=rubriqueMAJ");
			} else {
				header("Location: index.php?page=rubrique&message=erreurFormulaire");
			}
		}
	} else {
		header("Location: index.php?page=rubrique&message=erreurFormulaire");
	}
}
?>
