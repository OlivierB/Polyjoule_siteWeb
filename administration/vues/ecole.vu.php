<!--
/**********
Page de gestion des écoles

**********/
-->


<?php 
$actions = array(1,2,4,5,6); // Tableau des actions possibles
/*
	Action 1 : Ajouter école
	Action 2 : Modifier école
	Action 4 : Traitement d'ajout de école
	Action 5 : Traitement de mise à jour d'une école
	Action 6 : Traitement de suppression d'une école
	Defaut : Gestion des écoles
*/

if(isset($_GET['action']) && in_array($_GET['action'],$actions)) {
	$action = securite($_GET['action']);
	if ($action==1) { //ajouter une école
		
	} else if ($action==2) { //modification d'une école
		
	} else if ($action==4) { //traitement d'ajout de école
		
	} else if ($action==5) { //traitement de mise à jour de école
		
	} else if ($action==6) { //traitement de suppression de école
		if (isset($_GET['idEcole'])) {
			supprimerEcole(securite($_GET['idEcole']));
		} else {
			header("Location:index.php?page=ecole&message=ecoleNonSelectionnee");
		}
	} else { //gestion des écoles
		header("Location: index.php?page=ecole");
	}
} else {
	
}
?>
