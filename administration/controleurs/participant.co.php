<!-- // fichier de gestion des participants


traitements

-->

<?php
	include ('modeles/participant.mo.php');
	include ('modeles/participation.mo.php');
	
	$actions = array(1,2,3,4,5,6,7,8); // Tableau des actions possibles
	/*
		Action 1 : Ajouter un participant
		Action 2 : Modifier un participant
		Action 3 : Supprimer un participant
		Action 4 : Traitemant ajout
		Action 5 : Traitement MAJ
		Action 6 : Traitement suppression
		Action 7 : Modification de la photo
		Action 8 : Traitement photo
		Defaut : Affichage de la page d'accueil
	*/
	
	// Traitement de chaque page
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) {
		$action = securite($_GET['action']);
	} else {
		$action = 0;
	}

	$error 		= false;
	$sousPage 	= "defaut";
	
	switch ($action) {
		/***** Ajouter un participant *****/
		case 1 :
			if (countEquipe()>0) {
				$sousPage="ajouter";
			} else {
				$infos->addError ('Une équipe doit être crée avant de pouvoir ajouter un participant. (<a href="index.php?page=equipe&action=1">Accès rapide</a>)');
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Modifier un participant *****/
		case 2 :
			if (isset($_GET['idParticipant'])) {
				$idPart=securite($_GET['idParticipant']);
				if (participantExistant($idPart)) {
					$part=getParticipant($idPart);
					$sousPage="modifier";
				} else {
					$infos->addError ("Participant inexistant ou bien supprimé.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucun participant sélectionné.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Supprimer un participant *****/
		case 3 :
			if (isset($_GET['idParticipant'])) {
				$idPart=securite($_GET['idParticipant']);
				if (participantExistant($idPart)) {
					$part=getParticipant($idPart);
					$sousPage="supprimer";
				} else {
					$infos->addError ("Participant inexistant ou bien supprimé.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucun participant sélectionné.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Traitemant ajout *****/
		case 4 :
			$error_pict="";
			if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_FILES['photo']) && isset($_POST['role']) && isset($_POST['bioFR']) && isset($_POST['bioEN'])) {
				if ($_FILES['photo']['name']!="") {
					$error_pict = verify_picture($_FILES['photo'],1048576);
					if ($error_pict =="") {
						$nom=securite($_POST['nom']);
						$prenom=securite($_POST['prenom']);
						$mail=securite($_POST['mail']);
						$role=securite($_POST['role']);
						if ($nom!="" && $prenom!="" && $mail!="" && $role!="") {
							$path = save_picture($_FILES['photo'],100,100,'ressources/data/Participants/',$nom."-".$prenom);
							ajouterParticipant($nom,$prenom,$mail,$role,$path,securite($_POST['bioFR']),securite($_POST['bioEN']));
							$infos->addSucces("Ajout effectué avec succès.");
							$sousPage 	= "defaut";
						} else {
							$infos->addError ("Les champs ne sont pas correctement renseignés. Les champs nom, prénom, mail et rôle doivent être donnés.");
							$error = true;
							$sousPage="ajouter";
						}
					} else {
						$infos->addError ($error_pict);
						$error = true;
						$sousPage="ajouter";
					}
				} else {
					$infos->addError ("Erreur avec la photo.");
					$error = true;
					$sousPage="ajouter";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="ajouter";
			}
			if ($error!=true) {
				if (isset($_POST['equipe'])) {
					$ecole=securite($_POST['equipe']);
					$idPart=searchPart($nom,$prenom,$mail);
					ajouterParticipation($idPart,$ecole);
				}	
			}
			break;
		
		/***** Traitement MAJ *****/
		case 5 :
			if (isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['role']) && isset($_POST['bioFR']) && isset($_POST['bioEN'])) {
				$id=securite($_POST['id']);
				if (participantExistant($id)) {
					$nom=securite($_POST['nom']);
					$prenom=securite($_POST['prenom']);
					$mail=securite($_POST['mail']);
					$role=securite($_POST['role']);
					if ($nom!="" && $prenom!="" && $mail!="" && $role!="") {
						MAJParticipant($id,$nom,$prenom,$mail,$role,isset($_POST['bioFR']),isset($_POST['bioEN']));
						$infos->addSucces("Mise à jour effectué avec succès.");
					} else {
						$infos->addError ("Les champs ne sont pas correctement renseignés. Les champs nom, prénom, mail et rôle doivent être donnés.");
						$error = true;
					}
				} else {
					$infos->addError ("La participant n'existe pas ou a été supprimé.");
					$error = true;
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
			}
			if ($error==true) {
				$sousPage="modifier";
			} else {
				$sousPage="defaut";
			}
			break;
		
		/***** Traitement suppression *****/
		case 6 :
			if (isset($_GET['idParticipant'])) {
				$idPart=securite($_GET['idParticipant']);
				if (participantExistant($idPart)) {
					supprimerParticipant($idPart);
					$infos->addSucces ("Suppression du participant effectuée.");
				} else {
					$infos->addError ("Participant inexistant ou bien supprimé.");
					$error = true;
				}
			} else {
				$infos->addError ("Aucun participant sélectionné.");
				$error = true;
			}
			$sousPage="defaut";
			break;
		
		/***** Modification de la photo *****/
		case 7 :
			if (isset($_GET['idParticipant'])) {
				$idPart=securite($_GET['idParticipant']);
				if (participantExistant($idPart)) {
					$part=getParticipant($idPart);
					$sousPage="photo";
				} else {
					$infos->addError ("Participant inexistant ou bien supprimé.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucun participant sélectionné.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Traitement photo *****/
		case 8 :
			$error_pict="";
			if (isset($_POST['id']) && isset($_FILES['photo'])) {
				$idPart=securite($_POST['id']);
				if (participantExistant($idPart)) {
					$part=getParticipant($idPart);
					$req=mysql_query("SELECT photo_participant FROM PARTICIPANT WHERE id_participant=".$idPart.";") or die(mysql_error());
					$name=mysql_fetch_array($req);
					if ($_FILES['photo']['name']!="") {
						$error_pict = verify_picture($_FILES['photo'],1048576);
						if ($error_pict == "") {
							$old_file = explode('/', $name['photo_participant']);
							$old_file =$old_file[count($old_file)-1];
							delete_file('ressources/data/Participants',$old_file);
							$path = save_picture($_FILES['photo'],100,100,'ressources/data/Participants/',$part['nom_participant']."-".$part['prenom_participant']);
							updatePhoto($idPart,$path);
							$infos->addSucces("Mise à jour effectué avec succès.");
							$sousPage 	= "defaut";
						} else {
							$infos->addError ($error_pict);
							$error = true;
							$sousPage="photo";
						}
					} else {
						$infos->addError ("Erreur photo.");
						$error = true;
						$sousPage="photo";
					}
				} else {
					$infos->addError ("Participant inexistant ou bien supprimé.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Defaut *****/
		defaut  :
			$sousPage="defaut";
			break;
	}
	include ('vues/participant/participant_'.$sousPage.'.vu.php');
?>
