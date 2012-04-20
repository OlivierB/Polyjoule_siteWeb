<!-- // fichier de gestion du profil


traitements

-->

<?php
	include ('modeles/profil.mo.php');
	
	include ('modeles/gestionComptes.mo.php');
	
	$profil = get_member($_SESSION['id_membre']);
	
	$actions = array(1,2,3,4,5,6,7,8); // Tableau des actions possibles
	/*
		Action 1 : modifier pseudo
		Action 2 : modifier mot de passe
		Action 3 : modifier email
		Action 4 : Traitement modification pseudo
		Action 5 : Traitement modification mot de passe
		Action 6 : traitement modification email
		Action 7 : modifier photo
		Action 8 : traitement modification photo
		Default : Affichage du profil
	*/
	if(isset($_GET['action']) && in_array($_GET['action'],$actions))
		$action = securite($_GET['action']);
	else
		$action = 0; // page par defaut
	
	$sousPage 	= "defaut";
	
	
	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action)
	{ 

		case 1:
			$sousPage 	= "pseudo";
		break;
		
		case 2:
			$sousPage 	= "mdp";
		break;
		
		case 3:
			$sousPage 	= "email";
		break;
		
		case 4:
			// calcul de la sous-page
			if (isset($_POST['pseudo']))
			{
				$error_pseudo = MAJPseudo(securite($_POST['pseudo']));
				if($error_pseudo == "")
				{
					$informations = Array(/*Information*/
							true,
							'Information',
							'Le changement de pseudo s\'est bien déroulé.<br/>Vous allez maintenant être déconnecté.',
							'index.php?page=deconnexion',
							2
							);
						require_once('vues/informations.vu.php');
						exit();
				}
				else
				{
					$infos->addError($error_pseudo);
					$sousPage 	= "pseudo";
				}
			}
			else
			{
				$infos->addError("Action impossible");
				$sousPage 	= "pseudo";
			}
			
		break;
		
		case 5:
			if (isset($_POST['ancien']) && isset($_POST['mdp']) && isset($_POST['mdp2']))
			{
				$error_mdp = MAJMotDePasse(securite($_POST['ancien']),securite($_POST['mdp']),securite($_POST['mdp2']));
				if($error_mdp == "")
				{
					$informations = Array(/*Information*/
							true,
							'Information',
							'Le changement de votre mot de passe s\'est bien déroulé.<br/>Vous allez maintenant être déconnecté.',
							'index.php?page=deconnexion',
							2
							);
						require_once('vues/informations.vu.php');
						exit();
				}
				else
				{
					$infos->addError($error_mdp);
					$sousPage 	= "mdp";
				}
			}
			else
			{
				$infos->addError("Action impossible");
				$sousPage 	= "mdp";
			}
			
		break;
		
		case 6:
			if (isset($_POST['mail']) && isset($_POST['mail2']))
			{
				$error_mail1 = checkmail(securite($_POST['mail']));
				$error_mail2 = checkmail(securite($_POST['mail2']));
				if($error_mail1 == "" && $error_mail2 == "")
				{
					if(securite($_POST['mail']) == securite($_POST['mail2']))
					{
						MAJMail(securite($_POST['mail']),securite($_POST['mail2']));
						$infos->addSucces("Changement de mail effectué!.");
						$profil = get_member($_SESSION['id_membre']);
						$sousPage 	= "defaut";
					}
					else
					{
						$infos->addError("Vous avez saisi des adresses mails différentes.");
						$sousPage 	= "email";
					}
				}
				else
				{
					$infos->addError($error_mail1);
					$infos->addError($error_mail2);
					$sousPage 	= "email";
				}
			}
			else
			{
				
			}
			break;
			
		case 7:
			$sousPage 	= "photo";
		break;
		
		case 8:
			$error_pict = "";
			if(isset($_FILES['photo_membre']) && $_FILES['photo_membre']['name']!="")
			{
				$error_pict = verify_picture($_FILES['photo_membre'],1048576);
				if($error_pict == "")
				{
					$membre = get_member($_SESSION['id_membre']);
					$old_file = explode('/', $membre['photo_membre']);
					$old_file =$old_file[count($old_file)-1];
					if(strcmp($old_file,'defaut.png')!=0)
						delete_file('ressources/data/Membres',$old_file);
					$path = save_picture($_FILES['photo_membre'],100,100,'ressources/data/Membres/',securite($_SESSION['pseudo_membre']));
					MAJPhoto($path);
					$infos->addSucces("Le changement de votre photo s'est bien déroulé.");
					$sousPage 	= "defaut";
					$profil = get_member($_SESSION['id_membre']);
				}
				else
				{
					$infos->addError($error_pict);
					$sousPage 	= "photo";
				}
			}
			else
			{
				$infos->addError("Action impossible.");
				$sousPage 	= "photo";
			}
		break;
		
		default :
			$authorized_change = changementPseudo();
			if($authorized_change == "")
			{
				$lienChgtPseudo = "<a href='index.php?page=profil&action=1'>Changement du pseudo</a>";
			}
			else
			{
				$infos->addError($authorized_change);
			}
			$profil = get_member($_SESSION['id_membre']);
			$sousPage 	= "defaut";
	}
	
	
	
	include ('vues/profil/profil_'.$sousPage.'.vu.php');
?>
