<?php
/*Connexion à la BDD*/
function connexionbdd()
{
	/* En local Linux, Windows */
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='polyjoule';/**/
    
    /* En local Mac *//*
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='root';
	$bd_nom_bd='polyjoule';/**/
	
	//Connexion à la base de données
	$connexion = mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	if (!$connexion)
	{
		die("Connexion impossible");
	}
	else
	{
		mysql_select_db($bd_nom_bd);
		mysql_query("set names 'utf8'");
	}
}
/*Vide la session*/
function vidersession()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}

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
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_rubrique=".$id);
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
		getChildRubriqueSelected($rubrique[0],0,$id_rubrique_mere);
		}
	}
	echo "</select>";
}

/*Faire une liste des rubriques filles + select*/
function getChildRubriqueSelected($idRubrique,$niveau,$id_rubrique_mere) {
	$req = mysql_query("SELECT * FROM RUBRIQUE WHERE id_mere=".$idRubrique);
	$niveau++;
	while ($rubrique=mysql_fetch_array($req)) {
		if($rubrique[0]!=null){
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
			getChildRubriqueSelected($rubrique[0],$niveau,$id_rubrique_mere);
		}
	}
}
?>