<?php
/*Connexion à la BDD*/
function connexionbdd()
{
	/* En local */
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='polyjoule';
	
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
?>