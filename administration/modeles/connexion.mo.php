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

// Permet la connexion au site
function connexion($pseudo, $passe, &$infos) {
	$req 	= mysql_query("SELECT COUNT(id_membre) AS nbr, id_membre, pseudo_membre, mdp_membre, statut_membre, mail_membre FROM MEMBRE WHERE pseudo_membre= BINARY'".$pseudo."'") or die(mysql_error());
	$membre = mysql_fetch_array($req);
	if($membre[0]==1)
	{
		if(sha1($passe) == $membre[3])
		{
			$_SESSION['id_membre'] 		= $membre['id_membre'];
			$_SESSION['pseudo_membre'] 	= $membre['pseudo_membre'];
			$_SESSION['mail_membre'] 	= $membre['mail_membre'];
			$_SESSION['statut_membre'] 	= $membre['statut_membre'];
			
			return true;
		}
		else
		{
			$infos->addError ("Erreur de mot de passe");
			return false;
		}
	}
	else
	{
		$infos->addError("Erreur de login");
		return false;
	}
}

function reset_mdp($mail)
{
	$req 	= mysql_query("SELECT COUNT(id_membre) AS nbr, id_membre, pseudo_membre FROM MEMBRE WHERE mail_membre= BINARY'".$mail."'") or die(mysql_error());
	$membre = mysql_fetch_array($req);
	if($membre[0]==1)
	{
		$passwd = generate_passwd(); // Génération d'un mot de passe
	
		/* Construction du mail */
		$subject = 'Administration Polyjoule - Changement de mot de passe';
		$message = '<html>
					<head>
						<title></title>
					</head>
					
					<body>
						<div>Cher membre de Polyjoule,<br/><br/>
						Vous avez demandé un changement de mot de passe.<br/>
						Voici vos nouveaux identifiants de connexion :<br/>
						Pseudo : '.htmlspecialchars($membre['pseudo_membre'], ENT_QUOTES).'<br/>
						Mot de passe : '.htmlspecialchars($passwd, ENT_QUOTES).'<br/>
						Ce mot de passe a été généré automatiquement, vous pouvez le changer à partir de votre espace profil.<br/><br/>
						
						En vous remerciant de votre contribution.<br/><br/>
						L\'équipe Polyjoule.
					</body>
				</html>';
				
		if(send_mail($mail, $subject, $message))
		{
			$req = mysql_query("UPDATE MEMBRE SET mdp_membre='".sha1($passwd)."' WHERE id_membre=".$membre['id_membre']) or die(mysql_error());
			return "";
		}
		else
		{
			return "L'opération a échoué, veuillez retenter dans quelques instants.";
		}
	}
	else
	{
		return "L'adresse mail saisie n'est pas présente dans la base.";
	}
}

?>



