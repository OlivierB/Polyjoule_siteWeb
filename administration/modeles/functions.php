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
?>