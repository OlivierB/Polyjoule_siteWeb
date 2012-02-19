<!-- // fichier de gestion des equipes


traitements

-->

<?php
	include ('modeles/participant.mo.php');
	include ('modeles/equipe.mo.php');
	
	$actions = array(1,2,3,4,5,6);
	/*
		Action 1 : Ajout d'une equipe
		Action 2 : Modification d'une equipe
		Action 3 : Suppression d'une equipe
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
		/***** Ajout d'une equipe *****/
		case 1 :
			$sousPage="ajouter";
			break;
		
		/***** Modification d'une equipe *****/
		case 2 :
			if (isset($_GET['idEquipe'])) {
				$id=securite($_GET['idEquipe']);
				if (equipeExistante($id)) {
					$equipe=getEquipe($id);
					$sousPage="modifier";
				} else {
					$infos->addError ("L'équipe n'existe pas ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Suppression d'une equipe *****/
		case 3 :
			if (isset($_GET['idEquipe'])) {
				$id=securite($_GET['idEquipe']);
				if (equipeExistante($id)) {
					$equipe=getEquipe($id);
					$sousPage="supprimer";
				} else {
					$infos->addError ("L'équipe n'existe pas ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Traitement ajout *****/
		case 4 :
			if (isset($_POST['annee'])) {
				$annee=securite($_POST['annee']);
				ajouterEquipe($annee);
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="ajouter";
			}
			break;
		
		/***** Traitement MAJ *****/
		case 5 :
			if (isset($_POST['id']) && isset($_POST['annee'])) {
				$id=securite($_POST['id']);
				if (equipeExistante($id)) {
					$annee=securite($_POST['annee']);
					if ($annee!="") {
						MAJEquipe($id,$annee);
						$infos->addSucces ("Mise à jour de l'équipe effectuée.");
						$sousPage="defaut";
					} else {
						$infos->addError ("Les champs ne sont pas tous renseignés. Vous devez donnez une année.");
						$error = true;
						$sousPage="modifier";
					}
				} else {
					$infos->addError ("L'équipe est inexistante ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="modifier";
			}
			break;
		
		/***** Traitement suppression *****/
		case 6 :
			if (isset($_GET['idEquipe'])) {
				$id=securite($_GET['idEquipe']);
				if (equipeExistante($id)) {
					supprimerEquipe($id);
					$infos->addSucces ("Suppression de l'équipe effectuée.");
					$sousPage="defaut";
				} else {
					$infos->addError ("L'équipe n'existe pas ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Affichage page d'accueil *****/
		default :
			$sousPage="defaut";
			break;
	}
	include ('vues/equipe/equipe_'.$sousPage.'.vu.php');
?>
