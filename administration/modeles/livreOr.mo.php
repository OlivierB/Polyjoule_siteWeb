<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des formations
*
-->

<?php


function countPost(){
	$req = mysql_query("SELECT count(*) FROM LIVRE_OR;");
	$count=mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}


function getPost($pageStart, $nbrElem) {
	$posStart = ($pageStart - 1) * $nbrElem;
	$post = array();

	if ($nbrElem == 0)
		$req = mysql_query("SELECT * FROM LIVRE_OR ORDER BY date_post DESC");
	else
		$req = mysql_query("SELECT * FROM LIVRE_OR ORDER BY date_post DESC LIMIT $posStart, $nbrElem ");
	
	while ($donnees = mysql_fetch_assoc($req)) {
		$post[] = $donnees;
	}

	mysql_free_result($req);
	
	return $post;
}

function acceptPost($id) {
	$req="UPDATE LIVRE_OR SET accept_post='1' WHERE id_post='$id'";
	mysql_query($req) or die(mysql_error());
}


function supprimerPost($id) {
	$req="DELETE FROM LIVRE_OR WHERE id_post='$id'";
	mysql_query($req) or die(mysql_error());
}



?>
