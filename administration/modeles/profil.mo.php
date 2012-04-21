<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion du profil
*
-->

<?php

function changementPseudo()
{
	$profil = get_member($_SESSION['id_membre']);
	if ($profil['pseudo_membre']=="admin") {//Si c'est le super-administrateur
		return "Changement de pseudo impossible pour le super-administrateur.";
	} else {//Si ce n'est pas le super-admin
		return "";
	}
}

/*vérifie si un pseudo est déjà utilisé (retourne 1) ou non (0)*/
function pseudoUtilise($pseudo) {
	$req = mysql_query("SELECT count(*) FROM MEMBRE WHERE pseudo_membre='".$pseudo."';");
	$result=mysql_fetch_array($req) or die(mysql_error());
	mysql_free_result($req);
	
	return $result[0];
}

function MAJPseudo($pseudo) {
	if ($pseudo!="") {
		if ($_SESSION['pseudo_membre']=="admin") {
			return "Vous ne pouvez pas changer votre pseudo car vous êtes le super-administrateur.";
		} else {
			if ($pseudo=="admin") {
				return "Impossible de choisir le pseudo admin";
			} else {
				if (!pseudoUtilise($pseudo))
				{
					$req="UPDATE MEMBRE SET pseudo_membre='".$pseudo."' WHERE id_membre=".$_SESSION['id_membre'].";";
					mysql_query($req) or die(mysql_error());
					return "";
				}
				else
				{
					return "Le pseudo saisie est déjà pris.";
				}
			}
		}
	} else {
		return "Pseudo vide.";
	}
}

function MAJMotDePasse($ancien,$mdp,$mdp2) {
	$profil = get_member($_SESSION['id_membre']);
	
	if ($profil['mdp_membre']==sha1($ancien)) {
		if ($mdp==$mdp2) {
			$req="UPDATE MEMBRE SET mdp_membre='".sha1($mdp)."' WHERE id_membre=".$_SESSION['id_membre'].";";
			mysql_query($req) or die(mysql_error());
			return "";
		} else {
			return "Mots de passe différents.";
		}
	} else {
		return "Vous avez saisi un mot de passe erroné.";
	}
}

function MAJMail($mail,$mail2)
{
	$req="UPDATE MEMBRE SET mail_membre='".$mail."' WHERE id_membre=".$_SESSION['id_membre'].";";
	mysql_query($req) or die(mysql_error());
}

function MAJPhoto($photo)
{
	$req = "UPDATE MEMBRE SET photo_membre='".$photo."' WHERE id_membre=".$_SESSION['id_membre'];
	mysql_query($req) or die(mysql_error());
}
?>
