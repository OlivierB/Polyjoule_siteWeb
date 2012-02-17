<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des comptes de la partie admin
*
-->

<?php

function get_members()
{
	$membres = array();
	$i = 0;
	$req = mysql_query('SELECT * FROM MEMBRE;');
	while($membre = mysql_fetch_array($req))
	{
		$membres[$i] = array(
			"id_membre" => $membre["id_membre"],
			"pseudo_membre" => $membre["pseudo_membre"],
			"mdp_membre" => $membre["mdp_membre"],
			"mail_membre" => $membre["mail_membre"],
			"statut_membre" => $membre["statut_membre"],
			"photo_membre" => $membre["photo_membre"]);
		$i++;
	}
	return $membres;
}

function checkmail($email)
{
	/*Deux cas de non validation :
		Mauvais format
		Email déjà pris
	*/
	
	if($email == '')
	{
		return "Erreur d'adresse mail : mail vide.";
	}
	
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email))
	{
		return "Erreur d'adresse mail : mauvais format.";
	}
	else
	{
		$req = mysql_query("SELECT COUNT(*) AS nbr FROM MEMBRE WHERE mail_membre = '".securite($email)."'");		
		$result = mysql_fetch_array($req);
		if($result['nbr'] > 0)
		{
			return "Erreur d'adresse mail : existe déjà dans la base.";
		}
	}
	return "";
}

function checkpseudo($pseudo)
{
	$error = false;
	/*
	Trois cas de non validation :
			pseudo trop court
			pseudo trop long
			pseudo déjà pris
	*/
	if($pseudo == '')
	{
		return "Erreur de pseudo : pseudo vide.";
	}
	else if(strlen($pseudo) < 3)
	{
		return "Erreur de pseudo : trop court.";
	}
	else if(strlen($pseudo) > 32)
	{
		return "Erreur de pseudo : trop long.";
	}
	else if(strtolower($pseudo) == "admin")
	{
		return "Erreur de pseudo : déjà pris.";
	}
	else
	{
		$req = mysql_query("SELECT COUNT(*) AS nbr FROM MEMBRE WHERE pseudo_membre = '".securite($pseudo)."'");
		$result = mysql_fetch_assoc($req);
		
		if($result['nbr'] > 0)
		{
			return "Erreur de pseudo : déjà pris.";
		}
	}
	return "";
}
function send_mail($mail, $subject, $message)
{
	$to = $mail;
	
	
	//headers principaux.
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	//headers supplémentaires
	if(isset($_SESSION['mail_membre']))
	{
		$headers .= 'From: "Administration Polyjoule" <'.$_SESSION['mail_membre'].'>' . "\r\n";
		ini_set('sendmail_from' , ''.$_SESSION['mail_membre'].''); 
	}
	else
	{
		$headers .= 'From: Administration Polyjoule';
	}
	$mail = mail($to, $subject, $message, $headers);
	if($mail) return true;
	return false;
	
}
function add_member($pseudo, $mail, $statut)
{
	$passwd = generate_passwd(); // Génération d'un mot de passe
	
	/* Construction du mail */
	$subject = 'Inscription Administration Polyjoule';
	$message = '<html>
				<head>
					<title></title>
				</head>
				
				<body>
					<div>Bienvenue cher membre de Polyjoule !<br/><br/>
					Un administrateur vient de vous inscrire au système d\'administration du site Polyjoule.<br/>
					Voici vos identifiants de connexion :<br/>
					Pseudo : '.htmlspecialchars($pseudo, ENT_QUOTES).'<br/>
					Mot de passe : '.htmlspecialchars($passwd, ENT_QUOTES).'<br/>
					Ce mot de passe a été généré automatiquement, vous pouvez le changer à partir de votre espace profil.<br/><br/>
					
					En vous remerciant de votre contribution.<br/><br/>
					L\'équipe Polyjoule.
				</body>
			</html>';
			
	if(send_mail($mail, $subject, $message))
	{
		$req = mysql_query("INSERT INTO MEMBRE VALUES (NULL,'".$pseudo."','".sha1($passwd)."','".$mail."','".$statut."','ressources/data/Membres/defaut.png')") or die(mysql_error());
		return "";
	}
	else
	{
		return "L'inscription a échoué.(<a href='index.php?page=gestionComptes&action=1'>Acces rapide</a>)";
	}
}
	
				
function generate_passwd()
{
	$tpass=array();
	$id=0;
	$taille=6;
	// récupération des chiffres et lettre
	for($i=48;$i<58;$i++) $tpass[$id++]=chr($i);
	for($i=65;$i<91;$i++) $tpass[$id++]=chr($i);
	for($i=97;$i<123;$i++) $tpass[$id++]=chr($i);
	$passwd="";
	for($i=0;$i<$taille;$i++)
	{
		$passwd.=$tpass[rand(0,$id-1)];
	}
	return $passwd;
}

function get_member($id)
{
	$req = mysql_query('SELECT * FROM MEMBRE WHERE id_membre='.$id);
	$mbr = mysql_fetch_array($req);
	
	return $mbr;
}

function exist_member($id)
{
	$req = mysql_query('SELECT COUNT(*) FROM MEMBRE WHERE id_membre = '.$id);
	$nb = mysql_fetch_array($req);
	return ($nb[0]==1);
}

function modify_member($id, $pseudo, $mail, $statut, $photo)
{
	if(exist_member($id))
	{
		$membre = get_member($id);
		
		if($pseudo == $membre['pseudo_membre'] && $mail == $membre['mail_membre'] && $statut == $membre['statut_membre'] && $photo=="") // Si pas de modif à effectuer
			return "";
		else
		{				
			/* Construction du mail */
			$subject = 'Administration Polyjoule - Changement d\'identifiants';
			
			$message = '<html>
					<head>
						<title></title>
					</head>
					
					<body>
						<div>Polyjoule - Changement d\'identifiants<br/><br/>
						Un administrateur vient de procéder à un changement de vos identifiants<br/>
						Voici vos nouveaux identifiants de connexion :<br/>
						Pseudo : '.htmlspecialchars($pseudo, ENT_QUOTES).'<br/>
						Staut : '.htmlspecialchars($statut, ENT_QUOTES).'<br/>
						Vous pouvez changer vos identifiants à partir de votre espace profil.<br/><br/>
						
						En nous excusant de la gène occasionnée.<br/><br/>
						L\'équipe Polyjoule.
					</body>
				</html>';
				
			if(send_mail($mail, $subject, $message))
			{
				if($photo == "")
					$photo = $membre['photo_membre'];
				$req = "UPDATE MEMBRE SET pseudo_membre='".$pseudo."',mail_membre='".$mail."',statut_membre='".$statut."', photo_membre='".$photo."' WHERE id_membre=".$id;
				mysql_query($req) or die(mysql_error());
				return "";
			}
			else
			{
				return "La modification a échoué.(<a href='index.php?page=gestionComptes&action=3&id[]=".$id."'>Retenter</a>)";
			}
		}
	}
	else
	{
		return "Le membre n'existe pas";
	}
}

function delete_members($toDelete)
{
	for($i=0;$i<sizeof($toDelete);$i++)
	{
		if(exist_member($toDelete[$i]))
		{
			$membre = get_member($toDelete[$i]);
			if($membre['pseudo_membre'] == "admin") // Impossible de supprimer le compte admin
			{
				return "admin";
			}
			else
			{
				mysql_query('DELETE FROM MEMBRE WHERE id_membre='.$toDelete[$i]) or die(mysql_error());
			}
		}
		else
		{
			$req = mysql_query('SELECT pseudo_membre FROM MEMBRE WHERE id_membre='.$toDelete[$i]) or die(mysql_error());
			$pseudo = mysql_fetch_array($req);
			
			// erreur -> retour du pseudo pour identification
			return $pseudo[0];
			
		}
	}

	return "";
}

?>


