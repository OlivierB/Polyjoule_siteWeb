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
/*fonction qui renvoit le message en fonction du code de message*/
function getMessage($idMessage) {
/*
	procedureAnnulee : la procédure a été annulée
	erreurFormulaire : il y a une erreur dans le formulaire. veuillez recommancez.
	pseudoDejaUtilise : le pseudo est déjà utilisé
	mailNonValide : l'adresse mail n'est pas valide
	default : affichage du contenu du message
	changementPseudoImpossibleAdmin : l'admin ne peut pas changer de pseudo
	pseudoImpossibleAdmin : le pseudo admin ne peut pas etre utilisé
	motDePasseDifferent : les mots de passe entrés ne sont pas identiques
	mauvaisAncienMotDePasse : l'ancien mot de passe entré n'est pas le bon
	mailOk : changement de l'adresse mail OK
	mailDifferent : les deux adresses mails ne sont pas les memes
*/
	if ($idMessage=="erreurFormulaire") {
		return "Il y a une erreur dans le formulaire. Veuillez recommencez.";
	} else if ($idMessage=="procedureAnnulee") {
		return "La procédure a été annulée.";
	} else if ($idMessage=="pseudoDejaUtilise") {
		return "Le pseudo est déjà utilisé.";
	} else if ($idMessage=="mailNonValide") {
		return "L'adresse mail n'est pas valide.";
	} else if ($idMessage=="changementPseudoImpossibleAdmin") {
		return "L'administrateur ne peut pas changer de pseudo.";
	} else if ($idMessage=="pseudoImpossibleAdmin") {
		return "Il n'est pas possible de prendre le mot de passe \"admin\".";
	} else if ($idMessage=="motDePasseDifferent") {
		return "Les deux mots de passe entrés ne sont pas identiques.";
	} else if ($idMessage=="mauvaisAncienMotDePasse") {
		return "Le mot de passe actuel n'est pas le bon.";
	} else if ($idMessage=="mailOk") {
		return "La procédure s'est bien déroulée. L'adresse mail a bien été modifiée.";
	} else if ($idMessage=="mailDifferent") {
		return "Les deux adresses mails entrées ne sont pas identiques.";
	}/* else if ($idMessage=="") {
		return "";
	}*/ else {
		echo $idMessage;
	}
}

function email_OK ($email) {
	$Syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#' ;
	if(preg_match($Syntaxe,$email)) {
		return true;
	} else {
		return false; 
	}
}

/*fonction qui renvoie un tableau avec les informations de la rubrique idRubrique*/
function getProfil($idRubrique) {
	$req = mysql_query("SELECT * FROM MEMBRE WHERE id_membre=".$_SESSION['id_membre'].";");
	$toReturn=mysql_fetch_array($req) or die(mysql_error());
	mysql_free_result($req);
	return $toReturn;
}

function affichageProfil() {
	$profil=getProfil(securite($_SESSION['id_membre']));
	echo '<div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left : 20px;">';
	/*Pseudo*/
	echo "<strong>Pseudo</strong> : ";
	echo $profil[1];
	echo "<br />";
	if ($profil[1]=="admin") {//Si c'est l'admin
		echo "Changement de pseudo impossible pour l'administrateur.";
	} else {//Si ce n'est pas l'admin
		echo "<a href='index.php?page=profil&action=1'>Changement du pseudo</a>";
	}
	echo "<br />";echo "<br />";
	/*Mot de passe*/
	echo "<a href='index.php?page=profil&action=2'>Changement du mot de passe</a>";echo "<br />";echo "<br />";
	/*Mail*/
	echo "<strong>Mail</strong> : ";
	echo $profil[3];echo "<br />";
	echo "<a href='index.php?page=profil&action=3'>Changement de l'adresse mail</a>";
	echo "</div>";
}

/*vérifie si un pseudo est déjà utilisé (retourne 1) ou non (0)*/
function pseudoUtilise($pseudo) {
	$req = mysql_query("SELECT count(*) FROM MEMBRE WHERE pseudo_membre=".$pseudo.";");
	$result=mysql_fetch_array($req) or die(mysql_error());
	if ($result[0]==0) {
		$toReturn=0;
	} else {
		$toReturn=1;
	}
	mysql_free_result($req);
	return $toReturn;
}

function MAJPseudo($pseudo) {
	if ($pseudo!="") {
		if ($_SESSION['pseudo_membre']=="admin") {
			header("Location: index.php?page=profil&message=changementPseudoImpossibleAdmin");
		} else {
			if ($pseudo=="admin") {
				header("Location: index.php?page=profil&message=pseudoImpossibleAdmin");
			} else {
				if (!pseudoUtilise($pseudo)) {
					$req="UPDATE MEMBRE SET pseudo_membre='".$pseudo."' WHERE id_membre=".$_SESSION['id_membre'].";";
					mysql_query($req) or die(mysql_error());
					header("Location: $pageDeconnexion");
				} else {
					header("Location: index.php?page=profil&message=pseudoDejaUtilise");
				}
			}
		}
	} else {
		header("Location: index.php?page=profil&message=erreurFormulaire");
	}
}

function MAJMotDePasse($ancien,$mdp,$mdp2) {
	$req=mysql_query("SELECT * FROM MEMBRE WHERE id_membre=".$_SESSION['id_membre'].";");
	$profil=mysql_fetch_array($req);
	if ($profil[2]==$ancien) {
		if ($mdp==$mdp2) {
			$req2="UPDATE MEMBRE SET mdp_membre='".$mdp."' WHERE id_membre=".$_SESSION['id_membre'].";";
			mysql_query($req2) or die(mysql_error());
			header("Location: $pageDeconnexion");
		} else {
			header("Location: index.php?page=profil&message=motDePasseDifferent");
		}
	} else {
		header("Location: index.php?page=profil&message=mauvaisAncienMotDePasse");
	}
}

function MAJMail($mail,$mail2) {
	$mail=securite($_POST['mail']);
	$mail2=securite($_POST['mail2']);
	if ($mail==$mail2) {
		if (email_OK($mail)) {
			$req="UPDATE MEMBRE SET mail_membre='".$mail."' WHERE id_membre=".$_SESSION['id_membre'].";";
			mysql_query($req) or die(mysql_error());
			header("Location: index.php?page=profil&message=mailOk");
		} else {
			header("Location: index.php?page=profil&message=mailNonValide");
		}
	} else {
		header("Location: index.php?page=profil&message=mailDifferent");
	}
}
?>