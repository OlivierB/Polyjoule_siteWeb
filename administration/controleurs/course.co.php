<!-- // fichier de gestion des courses


traitements

-->

<?php
	include ('modeles/course.mo.php');
	include ('modeles/equipe.mo.php');
	
	$actions = array(1,2,3,4,5,6); // Tableau des actions possibles
	/*
		Action 1 : Ajout d'une course
		Action 2 : Modification d'une course
		Action 3 : Suppression d'une course
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
		/***** Ajout d'une course *****/
		case 1 :
			if (countEquipe()==0) {
				$infos->addError ('Une équipe doit être crée avant de pouvoir créer une course. (<a href="index.php?page=equipe&action=1">Accès rapide</a>)');
				$error = true;
			}
			if ($error==true) {
				$sousPage="defaut";
			} else {
				$sousPage="ajouter";
			}
			break;
		
		/***** Modification d'une course *****/
		case 2 :
			if (isset($_GET['idCourse'])) {
				$idCourse=securite($_GET['idCourse']);
				if ((courseExistante($idCourse))) {
					$course=getCourse($idCourse);
				} else {
					$infos->addError ("Course inexistante.");
					$error = true;
				}
			} else {
				$infos->addError ("Aucune course sélectionnée.");
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="modifier";
			}
			break;
		
		/***** Suppression d'une course *****/
		case 3 :
			if (isset($_GET['idCourse'])) {
				$idCourse=securite($_GET['idCourse']);
				if ((courseExistante($idCourse))) {
					$course=getCourse($idCourse);
				} else {
					$infos->addError ("Course inexistante.");
					$error = true;
				}
			} else {
				$infos->addError ("Aucune course sélectionnée.");
				$error = true;
			}
			if ($error) {
				$sousPage="defaut";
			} else {
				$sousPage="supprimer";
			}
			break;
		
		/***** Traitement ajout *****/
		case 4 :
			$error_pict="";
			if (isset($_POST['equipe']) && isset($_POST['date']) && isset($_POST['lieu']) && isset($_FILES['photo']) && isset($_POST['descFR']) && isset($_POST['descEN'])) {
				if ($_FILES['photo']['name']!="") {
					$error_pict = verify_picture($_FILES['photo'],1048576);
					if ($error_pict =="") {
						$equipe=securite($_POST['equipe']);
						if (equipeExistante($equipe)) {
							$date=securite($_POST['date']);
							$lieu=securite($_POST['lieu']);
							if ($date!="" && $lieu!="") {
								$path = save_picture($_FILES['photo'],100,100,'ressources/data/Courses/',$equipe."-".$date."-".$lieu);
								ajouterCourse($equipe,$date,$lieu,$path,securite($_POST['descFR']),securite($_POST['descEN']));
								$infos->addSucces("Ajout effectué avec succès.");
								$sousPage 	= "defaut";
							} else {
								$infos->addError ("Les champs ne sont pas correctement renseignés. La date et le lieu doivent être précisés.");
								$error = true;
								$sousPage="ajouter";
							} 
							$path = save_picture($_FILES['photo'],100,100,'ressources/data/Courses/',$equipe."-".$date."-".$lieu);
						} else {
							$infos->addError ("Les champs ne sont pas correctement renseignés. L'équipe sélectionnée n'existe pas ou a été supprimée.");
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
			break;
		
		/***** Traitement MAJ *****/
		case 5 :
			
			break;
		
		/***** Traitement suppression *****/
		case 6 :
			if (isset($_GET['idCourse'])) {
				$id=securite($_GET['idCourse']);
				if (courseExistante($id)) {
					supprimerCourse($id);
					$infos->addSucces ("Suppression de la course effectuée.");
					$sousPage="defaut";
				} else {
					$infos->addError ("La course est inexistante ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucune course sélectionnée.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Affichage page d'accueil *****/
		default  :
			$sousPage="defaut";
			break;
	}
	include ('vues/course/course_'.$sousPage.'.vu.php');
?>
