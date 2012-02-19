<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des commentaires
*
-->

<?php

	function exist_com($id)
	{
		$req = mysql_query("SELECT COUNT(*) FROM COMMENTAIRE WHERE id_commentaire=".$id);
		$nb = mysql_fetch_array($req);
		return ($nb[0] == 1);
	}
	
	function delete_com($id)
	{
		mysql_query("DELETE FROM COMMENTAIRE WHERE id_commentaire=".$id);
	}
	
	function add_com($id_art, $mess)
	{
		mysql_query("INSERT INTO COMMENTAIRE VALUES (NULL,".$id_art.",now(),'".$_SESSION['pseudo_membre']."','".$_SESSION['mail_membre']."','".$mess."')");
	}
	
	function modify_com($id, $mess)
	{
		mysql_query("UPDATE COMMENTAIRE SET message_commentaire='".$mess."' WHERE id_commentaire=".$id);
	}
?>



