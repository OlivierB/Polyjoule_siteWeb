<!-- // fichier de gestion des participations


traitements

-->

<?php
	include ('modeles/participation.mo.php');
	
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
			$sousPage="ajouter";
			break;
		
		/***** Modification d'une participation *****/
		case 2 :
			
			break;
		
		/***** Suppression d'une participation *****/
		case 3 :
			
			break;
		
		/***** Traitement ajout *****/
		case 4 :
			
			break;
		
		/***** Traitement MAJ *****/
		case 5 :
			
			break;
		
		/***** Traitement suppression *****/
		case 6 :
			
			break;
		
		/***** Affichage page d'accueil *****/
		default :
			$sousPage="defaut";
			break;
	}
	include ('vues/participation/participation_'.$sousPage.'.vu.php');
?>
