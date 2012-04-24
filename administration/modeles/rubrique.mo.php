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

$id1="Contient des articles";
$id2="Contient des albums";
$id3="Historique";
$id4="Est un livre d'or";
$id5="Est une page de personnages clés";

/*Fait la liste des rubriques*/
function listeRubrique(){
	echo "<select name='rubrique'>";
	echo "<option value='null'>Aucune</option>";
	$req2 = mysql_query("SELECT * FROM RUBRIQUE WHERE `id_mere` is null;");
	while($rubrique=mysql_fetch_array($req2))
	{
		echo "<option value='".$rubrique[0]."'>".$rubrique[3]."</option>";
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
			echo $rubrique[3]."</option>";
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
				echo "<option value='".$rubrique[0]."' selected='selected'>".$rubrique[3]."</option>";
			} else {
				echo "<option value='".$rubrique[0]."'>".$rubrique[3]."</option>";
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
				echo $rubrique[3]."</option>";
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
		$req2 = mysql_query("SELECT count(*) FROM ARTICLE WHERE id_rubrique='".$rubrique['id_rubrique']."'") or die(mysql_error());
		$cpt=mysql_fetch_array($req2);
		if($rubrique[0]!=null){
			echo "<tr class='blue_tabular_cell'>";
			echo "<td class='blue_tabular_cell'>".$rubrique[0]."</td>";
			echo "<td class='blue_tabular_cell' style='text-align:\"left\"'>";
			for($i=1;$i<$niveau;$i++){
				echo "---";
			}
			echo " ";
			echo $rubrique[3];
			echo "</td>";
			echo "<td class='blue_tabular_cell'>".$rubrique[4]."</td>";
			echo "<td class='blue_tabular_cell'>".$cpt[0]."</td>";
			echo "<td class='blue_tabular_cell'>";
			echo "<a style=\"text-decoration:none;color:green;\" href='index.php?page=rubrique&action=2&idRubrique=".$rubrique[0]."'>Modifier</a> - ";
			echo "<a style=\"text-decoration:none;color:red;\" href='index.php?page=rubrique&action=3&idRubrique=".$rubrique[0]."'>Supprimer</a>";
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
	$req = mysql_query("DELETE FROM RUBRIQUE WHERE `id_rubrique`=$idRubrique;");
	miseAJourRubriqueFilles($idRubrique);
}

function affichageSelected($idT,$val) {
	$toReturn="";
	if ($idT==$val) {
		$toReturn="selected='selected'";
	}
	return $toReturn;
}

/*fonction d'ajout de rubrique*/
function ajoutRubrique($titreFR,$titreEN,$rubrique,$template,$descFR,$descEN) {
	if ($rubrique=='null') {
		$req="INSERT INTO RUBRIQUE VALUES (NULL,NULL,'".$template."','".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
		mysql_query($req) or die(mysql_error());
	} else {
		$req=mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique='".$rubrique."';");
		$result=mysql_fetch_array($req);
		if (rubriqueExistante($result[0])) {
			$req ="INSERT INTO RUBRIQUE  VALUES (NULL,'".$rubrique."','".$template."','".$titreFR."','".$titreEN."','".$descFR."','".$descEN."')";
			mysql_query($req) or die(mysql_error());
		} else {
			$infos->addError ("La rubrique mère est inexistante.");
			$error = true;
			$sousPage="ajouter";
		}
	}
}

/*fonction de mise à jour de rubrique*/
function MAJRubrique($rubrique,$titreFR,$titreEN,$rubrique_mere,$template,$descFR,$descEN) {
	if ($rubrique_mere=='null') {
		$req="UPDATE RUBRIQUE SET id_mere=NULL, titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', id_template='".$template."' ,descFR_rubrique='".$descFR."', descEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
		mysql_query($req) or die(mysql_error());
	} else {
		$req=mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique=$rubrique");
		$result=mysql_fetch_array($req);
		if (rubriqueExistante($result[0])) {
			$req ="UPDATE RUBRIQUE SET id_mere='".$rubrique_mere."', titreFR_rubrique='".$titreFR."', titreEN_rubrique='".$titreEN."', id_template='".$template."' ,descFR_rubrique='".$descFR."', descEN_rubrique='".$descEN."' WHERE id_rubrique=".$rubrique.";";
			mysql_query($req) or die(mysql_error());
		} else {
			$infos->addError ("La rubrique mère est inexistante.");
			$error = true;
			$sousPage="modifier";
		}
	}
}
?>
