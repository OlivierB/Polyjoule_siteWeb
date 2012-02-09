<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de connexion de la partie admin
*
-->

<?php

// Permet la connexion au jeu
function connexion($pseudo, $passe) {
	$req 	= mysql_query("SELECT COUNT(id_membre) AS nbr, id_membre, pseudo_membre, mdp_membre, statut_membre FROM MEMBRE WHERE pseudo_membre='".$pseudo."'") or die(mysql_error());
	$membre = mysql_fetch_array($req);
	if($membre[0]==1)
	{
		if(sha1($passe) == $membre[3])
		{
			$_SESSION['id_membre'] 		= $membre['id_membre'];
			$_SESSION['pseudo_membre'] 	= $membre['pseudo_membre'];
			$_SESSION['statut_membre'] 	= $membre['statut_membre'];
			
			return true;
		}
		else
		{
			$erreur="Erreur de mot de passe";
			return false;
		}
	}
	else
	{
		$erreur="Erreur de login";
		return false;
	}
}

?>



