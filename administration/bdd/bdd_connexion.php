<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/

Ce fichier contient uniquement la connexion à la bdd

-->


<?php
/*Connexion à la BDD*/

/* En local Linux, Windows *//*
$bd_nom_serveur	='localhost';
$bd_login		='root';
$bd_mot_de_passe='';
$bd_nom_bd		='Polyjoule'; /**/

/* En local Mac */
$bd_nom_serveur	='localhost';
$bd_login		='root';
$bd_mot_de_passe='root';
$bd_nom_bd		='Polyjoule'; /**/


//Connexion à la base de données
$connexion = mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
if (!$connexion)
{
	die("Connexion à la bdd impossible !");
}
else
{
	$bdd = mysql_select_db($bd_nom_bd);
	if (!$bdd) { die ("Sélection bdd impossible !"); }
	mysql_query("set names 'utf8'");
}


?>
