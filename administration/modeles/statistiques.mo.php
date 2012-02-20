<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page des statistiques
*
-->

<?php

function get_nbArt_par_membre()
{
	$array = array();
	
	$req = mysql_query("SELECT pseudo_membre FROM MEMBRE ORDER BY pseudo_membre ASC") or die(mysql_error());

	while($result = mysql_fetch_array($req))
	{
		$req2 = mysql_query("SELECT COUNT(*) FROM ARTICLE WHERE auteur_article='".$result['pseudo_membre']."'") or die(mysql_error());
		$nbArt = mysql_fetch_array($req2);
		$cle = $result['pseudo_membre'];
		$array[$cle] = $nbArt[0];
	}
	return $array;
}

function get_history_article()
{
	$array = array();
	
	$req = mysql_query("SELECT * FROM ARTICLE ORDER BY date_article ASC") or die(mysql_error());
	$result = mysql_fetch_array($req);
	$date = $result['date_article'];
	
	$array[$date] = 1;
	$interval = new DateInterval('P5D');
	
	$i = 1;
	while($result = mysql_fetch_array($req))
	{
		$i++;
		if(date_create($result['date_article']) < date_add(date_create($date),$interval))
		{
			$array[$date] = $i;
		}
		else
		{
			$date = $result['date_article'];
			$array[$date]  = $i;
		}
	}
	return $array;
}

?>


