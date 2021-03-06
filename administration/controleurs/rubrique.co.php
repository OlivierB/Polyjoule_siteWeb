<!-- // fichier de gestion des rubriques


traitements

-->

<?php
	include ('modeles/rubrique.mo.php');
	
	$actions = array(1,2,3,4,5,6); // Tableau des actions possibles
	/*
		Action 1 : Ajout d'une rubrique
		Action 2 : Modification d'une rubrique
		Action 3 : Suppression d'une rubrique
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
		/***** Ajout d'une rubrique *****/
		case 1 :
			$sousPage = "ajouter";
			break;
		
		/***** Modification d'une rubrique *****/
		case 2 :
			if(isset($_GET['idRubrique'])) {//vérification de la présence du numéro de la rubrique
				$rubr=securite($_GET['idRubrique']);
				if (rubriqueExistante($rubr)) { //vérification de l'existence de la rubrique
					$rubrique=getRubrique($rubr);
				} else {
					$infos->addError ('La rubrique sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Aucune rubrique sélectionnée.');
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="modifier";
			}
			break;
		
		/***** Suppression d'une rubrique *****/
		case 3 :
			if(isset($_GET['idRubrique'])) {
				$rubr=securite($_GET['idRubrique']);
				if (rubriqueExistante($rubr)) { //vérification de l'existence de la rubrique
					$rubrique=getRubrique($rubr);
				} else {
					$infos->addError ('La rubrique sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
				}
			} else {
				$infos->addError ('Aucune rubrique sélectionnée.');
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="supprimer";
			}
			break;
		
		/***** Traitement ajout d'une rubrique *****/
		case 4 :
			if (isset($_POST['template']) && isset($_POST['descriptionFR']) && isset($_POST['descriptionEN']) && isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique'])) {
				$template=securite($_POST['template']);
				$titreFR=securite($_POST['titleFR']);
				$titreEN=securite($_POST['titleEN']);
				if ($titreFR!="" && $titreEN!="" && $template <=5 && $template >=1) {
					ajoutRubrique($titreFR,$titreEN,securite($_POST['rubrique']),$template,$_POST['descriptionFR'],$_POST['descriptionEN']);
					$infos->addSucces ("Ajout de la rubrique effectué.");
					$sousPage="defaut";
				} else {
					$infos->addError ("Les champs ne sont pas correctement renseignés. Les titres de rubrique doivent être donnés.");
					$error = true;
					$sousPage="ajouter";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="ajouter";
			}
			break;
		
		/***** Traitement modification d'une rubrique *****/
		case 5 :
			if (isset($_POST['template']) && isset($_POST['rubrique_id'])&& isset($_POST['titleFR'])&& isset($_POST['titleEN'])&& isset($_POST['rubrique'])&& isset($_POST['descriptionFR'])&& isset($_POST['descriptionEN'])) {
				$id=securite($_POST['rubrique_id']);
				if (rubriqueExistante($id)) {
					$template=securite($_POST['template']);
					if (securite($_POST['titleFR'])!="" && securite($_POST['titleEN'])!="" && $template <=5 && $template >=1) {
						MAJRubrique(securite($_POST['rubrique_id']),securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),$template,$_POST['descriptionFR'],$_POST['descriptionEN']);
						$infos->addSucces ("Modification de la rubrique effectuée.");
						$sousPage="defaut";
					} else {
						$infos->addError ("Les champs ne sont pas correctement renseignés. Les titres de rubrique doivent être donnés.");
						$error = true;
						$sousPage="modifier";
					}
				} else {
					$infos->addError ('La rubrique sélectionnée n\'existe pas ou a été supprimée.');
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Les champs ne sont pas tous renseignés.");
				$error = true;
				$sousPage="modifier";
			}
			break;
		
		/***** Traitement suppression d'une rubrique *****/
		case 6 :
			if (isset($_GET['idRubrique'])) {
				$idRubrique=securite($_GET['idRubrique']);
				if (rubriqueExistante($idRubrique)) {
					supprimerRubrique($idRubrique);
					$infos->addSucces ("Suppression de la rubrique effectuée.");
					$sousPage="defaut";
				} else {
					$infos->addError ("La rubrique n'existe pas ou a déjà été supprimée.");
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
	include ('vues/rubrique/rubrique_'.$sousPage.'.vu.php');
?>
