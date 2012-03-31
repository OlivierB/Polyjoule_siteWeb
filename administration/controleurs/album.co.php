<!-- // fichier de gestion des albums photo


traitements

-->

<?php
	include ('modeles/album.mo.php');
	
	$actions = array(1,2,3,4,5,6,7);
	
	$DirPhoto = 'ressources/data/Photo/';

	/*
		Action 1 : Affichage de la liste des photos d'un album
		Action 2 : Ajouter un album 
		Action 3 : Ajouter une photo
		Action 4 : Modifier un album 
		Action 5 : Supprimer un album 
		Action 6 : Modifier une photo
		Action 7 : Supprimer une photo
		Action default : Affichage de la liste des albums
	*/
	
	// Traitement de chaque action sur un post
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) {
		$action = securite($_GET['action']);
	} else {
		$action = 0;
	}
	
	
	switch ($action) {
		/*****  Affichage de la liste des photos d'un album *****/
		case 1 :
			if (isset($_GET['idAlbum']))
			{
				$idAlbum = securite($_GET['idAlbum']);
				$listPhoto = getListPhoto($idAlbum);
				$sousPage = "photo";
			} else
			{
				$infos->addError ("Aucun album sélectionné");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}
			
			break;
		
		
		/*****  Ajouter un album  *****/
		case 2 :
			if (isset($_POST['nom'])) {
				$nom=securite($_POST['nom']);
				if ($nom != "")
				{
					addAlbum($nom);
					//mkdir ($DirPhoto.);
					$infos->addSucces ("Album ajouté !");
					$listAlbum = getListAlbum();
					$sousPage = "defaut";
				} else
				{
					$infos->addError ("Les champs ne sont pas tous renseignés.");
					$sousPage="ajouter";
				}
				
			} else {
				$sousPage="ajouter";
			}
			
			break;
		
		/*****  Ajouter une photo  *****/
		case 3 :
			
			if (isset($_GET['idAlbum']))
			{
				$idAlbum = securite($_GET['idAlbum']);
				$sousPage="ajouterPhoto";
				
				if (isset($_POST['nomFr']) && isset($_POST['nomEn']) && isset($_FILES['photo']) && isset($_POST['desciptionFR']) && isset($_POST['desciptionEN'])) {
					
					if ($_POST['nomFr'] != "" && $_POST['nomEn'] != "" && $_POST['desciptionFR'] != "" && $_POST['desciptionEN'] != "")
					{
						$res = uploadImg ($infos, $_FILES['photo'], $DirPhoto, 3000000, array('.png', '.jpg', '.jpeg'), 100);
						if ($res != "")
						{
							addPhoto($idAlbum, securite($_POST['nomFr']), securite($_POST['nomEn']), $res, securite($_POST['desciptionFR']), securite($_POST['desciptionEN']));
							$listPhoto = getListPhoto($idAlbum);
							$sousPage = "photo";
						}
						
					} else
					{
						$infos->addError ("Les champs ne sont pas tous renseignés.");
						$sousPage="ajouterPhoto";
					}
					
					
				} else {
					
					$sousPage="ajouterPhoto";
				}

				
			} else
			{
				$infos->addError ("Aucun album sélectionné");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}

			break;
		
		/*****  Modifier un album   *****/
		case 4 :
			if (isset($_GET['idAlbum']))
			{
				$idAlbum = securite($_GET['idAlbum']);
				if (isset($_GET['nomAlbum']))
					$nameAlbum = securite($_GET['nomAlbum']);
				else 
					$nameAlbum = "";
				
				if (isset($_POST['nom'])) 
				{
					$nom=securite($_POST['nom']);
					if ($nom != "")
					{
						updateAlbum($idAlbum,$nom);
						$infos->addSucces ("Album modifié !");
						$listAlbum = getListAlbum();
						$sousPage = "defaut";
					} else
					{
						$infos->addError ("Les champs ne sont pas tous renseignés.");
						$sousPage="ajouter";
					}
				
				} else 
				{
					$sousPage="ajouter";
				}

			} else
			{
				$infos->addError ("Aucun album à modifier");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}

			break;
		
		/*****  Supprimer un album   *****/
		case 5 :
			if (isset($_GET['idAlbum']))
			{
				$idAlbum = securite($_GET['idAlbum']);
				if (isset($_GET['nomAlbum']))
					$nameAlbum = securite($_GET['nomAlbum']);
				else 
					$nameAlbum = "";
				
				if (isset($_POST['nom'])) 
				{
					$nom=securite($_POST['nom']);
					if ($nom != "")
					{
						deleteAlbum($idAlbum);
						$infos->addSucces ("Album supprimé !");
						$listAlbum = getListAlbum();
						$sousPage = "defaut";
					} else
					{
						$infos->addError ("Les champs ne sont pas tous renseignés.");
						$sousPage="supp";
					}
				
				} else 
				{
					$sousPage="supp";
				}

			} else
			{
				$infos->addError ("Aucun album à modifier");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}
			break;
			
			
		/*****  Modifier une photo   *****/
		case 6 :
			$infos->addError ("Aucun album à modifier");
			$listAlbum = getListAlbum();
			$sousPage = "defaut";
			break;
		
		/*****  Supprimer une photo   *****/
		case 7 :
			if (isset($_GET['idAlbum']))
			{
				$idAlbum = securite($_GET['idAlbum']);
				if (isset($_GET['nomAlbum']))
					$nameAlbum = securite($_GET['nomAlbum']);
				else 
					$nameAlbum = "";
				
				if (isset($_GET['idPhoto']))
				{
					$idPhoto = securite($_GET['idPhoto']);
					
					// nom des fichiers
					/*$myFile = $val['lien_photo'];
					$nomFmin = $DirPhoto.$myFile;
					$myFile = str_replace ('_', '', $myFile);
					$nomFmax = $DirPhoto.$myFile;
					
					
					deletePhoto($idPhoto);*/
					
					$infos->addSucces ("Photo supprimée ! (pas encore activé)");
					
				} else
				{
					$infos->addError ("Aucune photo a supprimer !");
				}
				
				$listPhoto = getListPhoto($idAlbum);
				$sousPage = "photo";

			} else
			{
				$infos->addError ("Aucun album à afficher");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}
			break;
		
		
		
		/***** Affichage de la liste des albums *****/
		default :
			$listAlbum = getListAlbum();
			$sousPage = "defaut";
			break;
	}

	

	
	
	include ('vues/album/album_'.$sousPage.'.vu.php');
	
?>
