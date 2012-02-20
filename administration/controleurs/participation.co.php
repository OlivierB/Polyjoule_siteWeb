<!-- // fichier de gestion des participations


traitements

-->

<?php
	include ('modeles/participation.mo.php');
	include ('modeles/participant.mo.php');
	include ('modeles/equipe.mo.php');
	
	$actions = array(1,2,3,4,5,6);
	/*
		Action 1 : Ajout d'une participation
		Action 2 : Modification d'une participation
		Action 3 : Suppression d'une participation
		Action 4 : Traitement ajout
		Action 5 : Traitement MAJ
		Action 6 : Traitement suppression
		Action default : Affichage page d'accueil
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
		/***** Ajout d'une participation *****/
		case 1 :
			if (countEquipe()==0) {
				$infos->addError ('Il doit y avoir au moins une équipe pour pouvoir ajouter une participation. (<a href="index.php?page=equipe&action=1">Accès rapide</a>)');
				$error = true;
			}
			if (countParticipant()==0) {
				$infos->addError ('Il doit y avoir au moins un participant pour pouvoir ajouter une participation. (<a href="index.php?page=participant&action=1">Accès rapide</a>)');
				$error = true;
			}
			if ($error==true) {
				$sousPage="defaut";
			} else {
				$sousPage="ajouter";
			}
			break;
		
		/***** Modification d'une participation *****/
		case 2 :
			if (isset($_GET['idEquipe']) && isset($_GET['idParticipant'])) {
				$equipe=securite($_GET['idEquipe']);
				$part=securite($_GET['idParticipant']);
				if (!equipeExistante($equipe)) {
					$infos->addError ('L\'équipe sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
				if (!participantExistant($part)) {
					$infos->addError ('Le participant sélectionné n\'existe pas ou a été supprimé.');
					$error = true;
				}
				if (!participationExistante($part,$equipe)) {
					$infos->addError ('La participation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Les champs ne sont pas renseignés.');
				$error = true;
			}
			if ($error==true) {
				$sousPage="defaut";
			} else {
				$participation=getParticipation($part,$equipe);
				$sousPage="modifier";
			}
			break;
		
		/***** Suppression d'une participation *****/
		case 3 :
			if (isset($_GET['idEquipe']) && isset($_GET['idParticipant'])) {
				$equipe=securite($_GET['idEquipe']);
				$part=securite($_GET['idParticipant']);
				if (!equipeExistante($equipe)) {
					$infos->addError ('L\'équipe sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
				if (!participantExistant($part)) {
					$infos->addError ('Le participant sélectionné n\'existe pas ou a été supprimé.');
					$error = true;
				}
				if (!participationExistante($part,$equipe)) {
					$infos->addError ('La participation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Les champs ne sont pas renseignés.');
				$error = true;
			}
			if ($error==true) {
				$sousPage="defaut";
			} else {
				$participation=getParticipation($part,$equipe);
				$sousPage="supprimer";
			}
			break;
		
		/***** Traitement ajout *****/
		case 4 :
			if (isset($_POST['equipe']) && isset($_POST['participant'])) {
				$equipe=securite($_POST['equipe']);
				$part=securite($_POST['participant']);
				if (!equipeExistante($equipe)) {
					$infos->addError ('L\'équipe sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="ajouter";
				}
				if (!participantExistant($part)) {
					$infos->addError ('Le participant sélectionné n\'existe pas ou a été supprimé.');
					$error = true;
					$sousPage="ajouter";
				}
				if (participationExistante($part,$equipe)) {
					$infos->addError ('La participation a déjà été enregistrée.');
					$error = true;
					$sousPage="defaut";
				}
				if ($error!=true) {
					ajouterParticipation($part,$equipe);
					$infos->addSucces ("Ajout de la participation effectué.");
					$sousPage="defaut";
				}
			} else {
				$infos->addError ('Les champs ne sont pas renseignés.');
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Traitement MAJ *****/
		case 5 :
			if (isset($_POST['equipe']) && isset($_POST['participant']) && isset($_POST['ancienneEquipe']) && isset($_POST['ancienPart'])) {
				$equipe=securite($_POST['equipe']);
				$part=securite($_POST['participant']);
				$ancienneEquipe=securite($_POST['ancienneEquipe']);
				$ancienPart=securite($_POST['ancienPart']);
				if (!equipeExistante($ancienneEquipe) || !equipeExistante($equipe)) {
					$infos->addError ('L\'équipe sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
				if (!participantExistant($ancienPart) || !participantExistant($part)) {
					$infos->addError ('Le participant sélectionné n\'existe pas ou a été supprimé.');
					$error = true;
					$sousPage="defaut";
				}
				if (!participationExistante($ancienPart,$ancienneEquipe)) {
					$infos->addError ('La participation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
				if (participationExistante($part,$equipe)) {
					$infos->addError ('La nouvelle participation a déjà été enregistrée.');
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ('Les champs ne sont pas renseignés.');
				$error = true;
				$sousPage="defaut";
			}
			if ($error!=true) {
				MAJParticipation($ancienneEquipe,$ancienPart,$equipe,$part);
				$infos->addSucces ("Mise à jour de la participation effectuée.");
				$sousPage="defaut";
			}
			break;
		
		/***** Traitement suppression *****/
		case 6 :
			if (isset($_GET['idEquipe']) && isset($_GET['idParticipant'])) {
				$equipe=securite($_GET['idEquipe']);
				$part=securite($_GET['idParticipant']);
				if (!equipeExistante($equipe)) {
					$infos->addError ('L\'équipe sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="ajouter";
				}
				if (!participantExistant($part)) {
					$infos->addError ('Le participant sélectionné n\'existe pas ou a été supprimé.');
					$error = true;
					$sousPage="ajouter";
				}
				if (!participationExistante($part,$equipe)) {
					$infos->addError ('La participation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
				if ($error!=true) {
					supprimerParticipation($equipe,$part);
					$infos->addSucces ("Suppression de la participation effectuée.");
					$sousPage="defaut";
				}
			} else {
				$infos->addError ('Les champs ne sont pas renseignés.');
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Affichage page d'accueil *****/
		default :
			$sousPage="defaut";
			break;
	}
	include ('vues/participation/participation_'.$sousPage.'.vu.php');
?>
