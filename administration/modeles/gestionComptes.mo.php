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

function get_membres()
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
			"statut_membre" => $membre["statut_membre"]);
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
	if($email == '') return 'Mail vide';
	else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'Mauvais format du mail';
	
	else
	{
		$req = mysql_query("SELECT COUNT(*) AS nbr FROM MEMBRE WHERE mail_membre = '".securite($email)."'");		
		$result = mysql_fetch_array($req);
		if($result['nbr'] > 0) return 'Mail déjà existant';
		else return 'ok';
	}
}

function checkpseudo($pseudo)
{
	/*
	Trois cas de non validation :
			pseudo trop court
			pseudo trop long
			pseudo déjà pris
	*/
	if($pseudo == '') return 'Pseudo vide';
	else if(strlen($pseudo) < 3) return 'Pseudo trop court';
	else if(strlen($pseudo) > 32) return 'Pseudo trop long';
	else
	{
		$req = mysql_query("SELECT COUNT(*) AS nbr FROM MEMBRE WHERE pseudo_membre = '".securite($pseudo)."'");
		$result = mysql_fetch_array($req);
		
		if($result['nbr'] > 0 || $pseudo=='admin') return 'Pseudo déjà pris';
		else return 'ok';
	}
}
function send_mail($mail, $subject, $message)
{
	$to = $mail;
	
	
	//headers principaux.
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	//headers supplémentaires
	$headers .= 'From: "ParionsFoot" <parionsfoot@olympe-network.com>' . "\r\n";
	$headers .= 'From: "ParionsFoot" <parionsfoot@olympe-network.com>' . "\r\n";
	ini_set('sendmail_from' , 'parionsfoot@olympe-network.com'); 
	$mail = mail($to, $subject, $message, $headers);
	if($mail) return true;
	return false;
	
}
function register($pseudo, $mail, $statut)
{
	$error_pseudo = checkpseudo($pseudo);
	$error_mail = checkmail($mail);
	if($error_pseudo == 'ok' && $error_mail != "ok")
		$error = $error_mail;
	else if($error_pseudo != 'ok' && $error_mail == "ok")
		$error = $error_pseudo;
	else if($error_pseudo != 'ok' && $error_mail != "ok")
		$error = $error_pseudo."<br/>".$error_mail;
	else
	{
		$passwd = generate_passwd();
		$req = mysql_query("INSERT INTO MEMBRE VALUES (NULL,'".$pseudo."','".sha1($passwd)."','".$mail."','".$statut."')");
		
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
						Mot de passe : '.htmlspecialchars($passwd, ENT_QUOTES).'.<br/>
						Ce mot de passe a été généré automatiquement, vous pouvez le changer à partir de votre espace profil.<br/><br/>
						
						En vous remerciant de votre contribution.<br/><br/>
						L\'équipe Polyjoule.
					</body>
				</html>';
		if(!send_mail($mail, $subject, $message))
		{
			$informations = Array(/*Erreur*/
						false,
						'Erreur',
						'L\'inscription a échoué, veuillez retenter.',
						'index.php?page=gestionComptes&action=1',
						4
						);
			require_once('vues/informations.vu.php');
			exit();
		}
	}
	if(isset($error))
	{
		$informations = Array(/*Erreur*/
						false,
						'Erreur',
						'L\'inscription a échoué : <br/>'.$error,
						'index.php?page=gestionComptes&action=1',
						4
						);
		require_once('vues/informations.vu.php');
		exit();
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
	
?>



