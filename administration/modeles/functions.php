<?php
/*Connexion à la BDD*/
function connexionbdd()
{
	/* En local */
	$bd_nom_serveur='localhost';
	$bd_login='root';
	$bd_mot_de_passe='';
	$bd_nom_bd='Polyjoule';
	
	//Connexion à la base de données
	mysql_connect($bd_nom_serveur, $bd_login, $bd_mot_de_passe);
	mysql_select_db($bd_nom_bd);
	mysql_query("set names 'utf8'");
}
/*Vide les cookies*/
function vider_cookie()
{
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-3600);
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