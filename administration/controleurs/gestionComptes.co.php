<!-- // fichier de gestion des comptes


traitements

-->

<?php
	include ('ressources/scripts/php/sendMail.php');
	include ('modeles/gestionComptes.mo.php');
	
	$membres = get_members();
	
   /* Vérification du statut du membre : si admin autorisation d'accéder à cette page sinon redirection vers l'accueil */
	if(isset($_SESSION['statut_membre']) && $_SESSION['statut_membre']!='admin')
	{
		$informations = Array(/*Erreur*/
						true,
						'Erreur',
						'Vous n\'êtes pas autorisé à accéder à cette page...',
						'index.php',
						2
						);
	require_once('vues/informations.vu.php');
	exit();
	}
	
	$actions = array(1,2,3,4,5); // Tableau des actions possibles
	/*
		Action 1 : Inscrire un membre
		Action 2 : Traitement de l'inscription
		Action 3 : Modifier les informations sur un membre
		Action 4 : Traitement de mise à jour des informations d'un membre
		Action 5 : Traitement de suppression d'un membre
		Defaut : Gestion des membres
	*/

	// Traitement de chaque page
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions))
		$action = securite($_GET['action']);
	else
		$action = 0;

	$error 		= false;
	$sousPage 	= "defaut";
	
	switch($action)
	{
		case 1:
			// calcul de la sous-page
			if ($error)
			{
				$sousPage 	= "defaut";
			} else
			{
				$sousPage 	= "ajouter";
			}
			break;
			
		case 2:
			if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['statut']))
			{
				$pseudo = securite($_POST['pseudo']);
				$mail = securite($_POST['mail']);
				$statut = securite($_POST['statut']);				
				
				$error_pseudo = checkPseudo($pseudo);
				$error_mail = checkMail($mail);
				
				if($error_pseudo == "" && $error_mail == "")
				{
					$error_add = add_member(securite($_POST['pseudo']), securite($_POST['mail']), securite($_POST['statut']));
					if($error_add == "")
					{
						$infos->addSucces("Inscription réussie.");
						$sousPage 	= "defaut";
					}
					else
					{
						$infos->addError($error_add);
					}
				}
				else
				{
					$infos->addError($error_pseudo);
					$infos->addError($error_mail);
					$sousPage 	= "ajouter";
					
				}
			}
			else
			{
				$infos->addError ("Action impossible !");
				$sousPage 	= "defaut";
			}
			
			break;
			
		case 3:
			if( !isset($_GET['id']) || sizeof($_GET['id'])==0 )
			{
				$infos->addError ('Aucun membre sélectionné. (<a href="index.php?page=gestionComptes">Acces rapide</a>)');
				$error = true;
			}
			else if(sizeof($_GET['id'])>1)
			{
				$infos->addError ('Veuillez modifier qu\'un seul membre à la fois. (<a href="index.php?page=gestionComptes">Acces rapide</a>)');
				$error = true;
			}
			else
			{
				$id = securite($_GET['id'][0]);
				if( !exist_member($id))
				{
					$infos->addError ("Le membre n'existe pas dans la base.");
					$error = true;
				}
				// calcul de la sous-page
				if ($error)
				{
					$sousPage 	= "defaut";
				} else
				{
					$membre= get_member($id);
					if($membre['pseudo_membre']=="admin")
					{
						$infos->addError ("Impossible de modifier les informations du membre admin.");
						$sousPage 	= "defaut";
					}
					else
					{
						$sousPage 	= "modifier";
					}
				}
			}
			break;
			
		case 4:
			if(isset($_POST['id']) && isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['statut']))
			{
				$error_modify = "";
				$error_pict = "";
				if(isset($_FILES['photo_membre']) && $_FILES['photo_membre']['name']!="")
				{
					$error_pict = verify_picture($_FILES['photo_membre'],1048576);
					if($error_pict == "")
					{
						$membre = get_member($_POST['id']);
						$old_file = explode('/', $membre['photo_membre']);
						$old_file =$old_file[count($old_file)-1];
						if(strcmp($old_file,'defaut.png')!=0)
							delete_file('ressources/data/Membres',$old_file);
						$filename = save_picture($_FILES['photo_membre'],'ressources/data/Membres/');
						$error_modify = modify_member(securite($_POST['id']), securite($_POST['pseudo']),securite($_POST['mail']),securite($_POST['statut']),$filename);
					}
				}
				else
				{
					$error_modify = modify_member(securite($_POST['id']), securite($_POST['pseudo']),securite($_POST['mail']),securite($_POST['statut']),0);
				}
				if( $error_modify == "" && $error_pict=="")
				{
					$infos->addSucces ("Modification du membre effectué");
					if($_POST['id'] == $_SESSION['id_membre']) // Si on a modifier ses propres informations => deconnexion
					{
						$informations = Array(/*Information*/
							true,
							'Information',
							'Vous avez modifié vos propres informations, vous allez donc être déconnecté.',
							'index.php?page=deconnexion',
							2
							);
						require_once('vues/informations.vu.php');
						exit();
					}
					$sousPage 	= "defaut";
				}
				else if($error_modify != "" && $error_pict=="")
				{
					$infos->addError ($error_modify);
					$sousPage 	= "defaut";
				}
				else
				{
					$infos->addError ($error_pict);
					$sousPage 	= "modifier";
				}
				$membre = get_member($_POST['id']);		
			}
			else
			{
				$infos->addError ("Les champs ne sont pas tous renseignés");
				$sousPage 	= "modifier";
			}
			break;
		case 5:
			if(isset($_GET['id']) && $_GET['id'] != "")
			{
			
				$toDelete 	= $_GET['id'];
				$tmpVar 	= delete_members($toDelete);

				if ($tmpVar != "")
				{
					$infos->addError ("Impossible de supprimer le membre : ".$tmpVar." (<a href='index.php?page=gestionComptes'>Acces rapide</a>)");
				}
			} else
			{
				$infos->addError ("Action impossible !");
			}
			$sousPage 	= "defaut";
			break;

		default:
			$sousPage 	= "defaut";
		break;
	}
	if (strcmp ( $sousPage , "defaut" ) == 0)
		$membres = get_members();

     include ('vues/gestionComptes/gestionComptes_'.$sousPage.'.vu.php');
?>
