<!-- // fichier de gestion des formations


traitements

-->

<?php
	include ('modeles/formation.mo.php');
	
	$actions = array(1,2,3,4,5,6); // Tableau des actions possibles
	/*
		Action 1 : Ajout d'une formation
		Action 2 : Modification d'une formation
		Action 3 : Suppression d'une formation
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
	
	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action) {
		/***** Ajout d'une formation *****/
		case 1 :
			if (countEcole()>0) {
				$sousPage = "ajouter";
			} else {
				$infos->addError ('Un école doit être crée avant de pouvoir créer une formation. (<a href="index.php?page=ecole&action=1">Accès rapide</a>)');
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Modification d'une formation *****/
		case 2 :
			if(isset($_GET['idformation'])) {
				$id=securite($_GET['idformation']);
				if (formationExistante($id)) {
					$formation=getFormation($id);
				} else {
					$infos->addError ('La formation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Aucune formation sélectionnée.');
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="modifier";
			}
			break;
		
		/***** Suppression d'une formation *****/
		case 3 :
			if(isset($_GET['idformation'])) {
				$id=securite($_GET['idformation']);
				if (formationExistante($id)) {
					$formation=getFormation($id);
				} else {
					$infos->addError ('La formation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Aucune formation sélectionnée.');
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="supprimer";
			}
			break;
		
		/***** Traitement ajout d'une formation *****/
		case 4 :
			if (isset($_POST['nomFR']) && isset($_POST['nomEN']) && isset($_POST['ecole'])) {
				$nomFR=securite($_POST['nomFR']);
				$nomEN=securite($_POST['nomEN']);
				if ($nomFR!="" && $nomEN!="") {
					ajouterFormation($nomFR,$nomEN,securite($_POST['ecole']),securite($_POST['lien']),securite($_POST['descFR']),securite($_POST['descEN']));
					$infos->addSucces ("Ajout de la formation effectué.");
					$sousPage="defaut";
				} else {
					$infos->addError ("Les champs ne sont pas correctement renseignés. Les noms de formation doivent être donnés.");
					$error = true;
					$sousPage="ajouter";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="ajouter";
			}
			break;
		
		/***** Traitement modification d'une formation *****/
		case 5 :
			if (isset($_POST['id']) && isset($_POST['nomFR']) && isset($_POST['nomEN']) && isset($_POST['ecole'])) {
				$id=securite($_POST['id']);
				if (formationExistante($id)) {
					$nomFR=securite($_POST['nomFR']);
					$nomEN=securite($_POST['nomEN']);
					if ($nomFR!="" && $nomEN!="") {
						MAJFormation($id,$nomFR,$nomEN,securite($_POST['ecole']),securite($_POST['lien']),securite($_POST['descFR']),securite($_POST['descEN']));
						$infos->addSucces ("Mise à jour de la formation effectuée.");
						$sousPage="defaut";
					} else {
						$infos->addError ("Les champs ne sont pas correctement renseignés. Les noms de formation doivent être donnés.");
						$error = true;
						$sousPage="ajouter";
					}
				} else {
					$infos->addError ('La formation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="ajouter";
			}
			break;
		
		/***** Traitement suppression d'une formation *****/
		case 6 :
			if (isset($_GET['idformation'])) {
				$id=securite($_GET['idformation']);
				if (formationExistante($id)) {
					supprimerFormation($id);
					$infos->addSucces ("Suppression de la formation effectuée.");
					$sousPage="defaut";
				} else {
					$infos->addError ('La formation sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Afichage par défaut *****/
		default :
			$sousPage="defaut";
			break;
	}
	include ('vues/formation/formation_'.$sousPage.'.vu.php');
?>
