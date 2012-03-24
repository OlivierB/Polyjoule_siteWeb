<!-- // fichier de gestion du contenu du livre d'Or


traitements

-->

<?php
	include ('modeles/livreOr.mo.php');
	
	$actions = array(1,2);
	
	$postPerPage = 10;
	
	/*
		Action 1 : Accepter le commentaire posté
		Action 2 : Supprimer le commentaire
		Action default : Affichage de la liste des commentaires
	*/
	
	// Traitement de chaque action sur un post
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) {
		$action = securite($_GET['action']);
	} else {
		$action = 0;
	}

	
	switch ($action) {
		/*****  Accepter le commentaire posté *****/
		case 1 :
			if (isset($_GET['idPost']))
			{
				acceptPost(securite($_GET['idPost']));
				$infos->addSucces ("Le post a été accepté !");
			}
			
			break;
		
		/***** Supprimer le commentaire *****/
		case 2 :
			if (isset($_GET['idPost'])) {
				$id = securite($_GET['idPost']);
				supprimerPost ($id);
				$infos->addSucces ("Le post a été supprimé !");
			} else {
				$infos->addError ("Cette action n'est pas valable !'");
			}
			
			
			break;
		
		
		/***** Affichage de la liste des commentaires *****/
		default :
			
			break;
	}
	
	// Traitement de la liste d'affichage en page
	$numPost = countPost();
	$numPage = 1;
	$pageTot = ceil ($numPost/$postPerPage);
	
	if (isset($_GET['numPage'])) {
		$numPage = securite($_GET['numPage']);
	}
	if (($numPage <= 0) || ($numPage > $pageTot)) {
		$numPage = 1;
	}
	
	$listPost = getPost ($numPage, $postPerPage);
	
	
	include ('vues/livreOr.vu.php');
	
?>
