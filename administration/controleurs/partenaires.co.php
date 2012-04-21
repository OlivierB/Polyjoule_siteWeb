<!-- // fichier de gestion des partenaires


traitements

-->

<?php
	include ('modeles/partenaires.mo.php');
	
	
	$actions = array(1,2,3,4,5,6,7,8); // Tableau des actions possibles
	/*
		Action 1 : Ajouter un partenaire
		Action 2 : Modifier un partenaire
		Action 3 : Supprimer un partenaire
		Action 4 : Traitemant ajout
		Action 5 : Traitement MAJ
		Action 6 : Traitement suppression
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
		
	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action)
	{ 

		case 1:
			
		break;

		case 2: 
			
		break;

		case 3: 
			
		break;

		case 4: 
		
		break;

		case 5:
	
		break;
		
		case 6:
		
		break;
		
		default:
			$sousPage 	= "defaut";
		break;

	}
	if (strcmp ( $sousPage , "defaut" ) == 0)
		$partenaires = get_partenaires();
		
	include ('vues/partenaires/partenaires_'.$sousPage.'.vu.php');
?>
