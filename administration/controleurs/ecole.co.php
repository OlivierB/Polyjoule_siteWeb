<!-- // fichier de gestion des écoles


traitements

-->

<?php
	include ('modeles/ecole.mo.php');
	
	$actions = array(1,2,3,4,5,6); // Tableau des actions possibles
	/*
		Action 1 : Ajout d'une école
		Action 2 : Modification d'une école
		Action 3 : Suppression d'une école
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
		/***** Ajout d'une école *****/
		case 1 :
			$sousPage = "ajouter";
			break;
		
		/***** Modification d'une école *****/
		case 2 :
			if (isset($_GET['idEcole'])) {
				$idEcole=securite($_GET['idEcole']);
				if ((ecoleExistante($idEcole))) {
					$ecole=getEcole($idEcole);
					$sousPage="modifier";
				} else {
					$infos->addError ("École inexistante.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucune école sélectionnée.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Suppression d'une école *****/
		case 3 :
			if (isset($_GET['idEcole'])) {
				$idEcole=securite($_GET['idEcole']);
				if ((ecoleExistante($idEcole))) {
					$ecole=getEcole($idEcole);
				} else {
					$infos->addError ("École inexistante.");
					$error = true;
				}
			} else {
				$infos->addError ("Aucune école sélectionnée.");
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
			if (isset($_POST['nom']) && isset($_POST['adresse']) && isset($_FILES['photo']) && isset($_POST['descFR']) && isset($_POST['descEN'])) {
				if ($_FILES['photo']['name']!="") {
					$error_pict = verify_picture($_FILES['photo'],1048576);
					if ($error_pict =="") {
						$nom=securite($_POST['nom']);
						$adresse=securite($_POST['adresse']);
						$filename = save_picture($_FILES['photo'],'ressources/data/Ecoles/');
						if ($nom!="" && $adresse!="") {
							ajouterEcole($nom,$adresse,$filename,securite($_POST['descFR']),securite($_POST['descEN']));
							$infos->addSucces("Ajout effectué avec succès.");
							$sousPage 	= "defaut";
						} else {
							$infos->addError ("Les champs ne sont pas correctement renseignés. Les champs nom et adresse doivent être donnés.");
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
			$error_pict="";
			if (isset($_POST['idEcole']) && isset($_POST['nom']) && isset($_POST['adresse']) && isset($_FILES['photo']) && isset($_POST['descFR']) && isset($_POST['descEN'])) {
				$id=securite($_POST['idEcole']);
				if (ecoleExistante($id)) {
					$req=mysql_query("SELECT photo_ecole FROM ECOLE WHERE id_ecole=".$id.";") or die(mysql_error());
					$name=mysql_fetch_array($req);
					$nom=securite($_POST['nom']);
					$adresse=securite($_POST['adresse']);
					if ($_FILES['photo']['name']!="") {
						$error_pict = verify_picture($_FILES['photo'],1048576);
						if ($error_pict =="") {
							delete_file('ressources/data/Ecoles',$name['photo_ecole']);
							$filename = save_picture($_FILES['photo'],'ressources/data/Ecoles/');
						} else {
							$infos->addError ($error_pict);
							$error = true;
							$sousPage="modifier";
						}
					} else {
						$path =$name['photo_ecole'];
					}
					if ($error == false) {
						if ($nom!="" && $adresse!="") {
							MAJEcole($id,$nom,$adresse,$filename,securite($_POST['descFR']),securite($_POST['descEN']));
							$infos->addSucces("Mise à jour effectué avec succès.");
							$sousPage 	= "defaut";
						} else {
							$infos->addError ("Les champs ne sont pas correctement renseignés. Les champs nom et adresse doivent être donnés.");
							$error = true;
							$sousPage="modifier";
						}
					}
				} else {
					$infos->addError ("École inexistante.");
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
			if (isset($_GET['idEcole'])) {
				$id=securite($_GET['idEcole']);
				if (ecoleExistante($id)) {
					supprimerEcole(securite($_GET['idEcole']));
					$infos->addSucces ("Suppression de l'école et des formations associées effectuée.");
					$sousPage="defaut";
				} else {
					$infos->addError ("L'école est inexistante ou a été supprimée.");
					$error = true;
					$sousPage="defaut";
				}
			} else {
				$infos->addError ("Aucune école sélectionnée.");
				$error = true;
				$sousPage="defaut";
			}
			break;
		
		/***** Affichage page d'accueil *****/
		default :
			$sousPage="defaut";
			break;
	}
	include ('vues/ecole/ecole_'.$sousPage.'.vu.php');
?>
