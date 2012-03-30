<!-- // fichier de gestion des albums photo


traitements

-->

<?php
	include ('modeles/album.mo.php');
	
	$actions = array(1,2,3,4,5,6,7);
	// ce qu'il ne doit pas y avoir dans le nom des dossiers
	$warningSymb = array("/", " ", ".", "'", "\"");
	
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
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);
				
				$listPhoto = getListPhoto($idAlbum);
				$nameAlbum = getNameAlbum ($idAlbum);
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
					// $nom = formatString ($nom) : trop extreme ?
					$nom = str_replace($warningSymb, "_", $nom);
					$nom = multipleName ($nom);
					if  (mkdir ($DirPhoto.$nom))
					{
						addAlbum($nom);
						$infos->addSucces ("Album ajouté !");
						$listAlbum = getListAlbum();
						$sousPage = "defaut";
					} else
					{
						$infos->addError ("Le dossier de l'album n'a pas été créé.");
						$sousPage="ajouter";
					}

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
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);
				$sousPage="ajouterPhoto";
				
				if (isset($_POST['nomFr']) && isset($_POST['nomEn']) && isset($_FILES['photo']) && isset($_POST['desciptionFR']) && isset($_POST['desciptionEN'])) {
					
					if ($_POST['nomFr'] != "" && $_POST['nomEn'] != "" && $_POST['desciptionFR'] != "" && $_POST['desciptionEN'] != "")
					{
						$nameAlbum = getNameAlbum ($idAlbum);
						
						$res = uploadImg ($infos, $_FILES['photo'], $DirPhoto.$nameAlbum."/", 3000000, array('.png', '.jpg', '.jpeg'), 100);
						if ($res != "")
						{
							addPhoto($idAlbum, securite($_POST['nomFr']), securite($_POST['nomEn']), $res, securite($_POST['desciptionFR']), securite($_POST['desciptionEN']));
							$listPhoto = getListPhoto($idAlbum);
							$nameAlbum = getNameAlbum ($idAlbum);
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
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);
				/*if (isset($_GET['nomAlbum']))
					$nameAlbum = securite($_GET['nomAlbum']);
				else 
					$nameAlbum = "";*/
				$nameAlbum = getNameAlbum ($idAlbum);
				
				if (isset($_POST['nom'])) 
				{
					$nom=securite($_POST['nom']);
					if ($nom != "")
					{
						// $nom = formatString ($nom) : trop extreme ?
						$nom = str_replace($warningSymb, "_", $nom);
						$oldNameAlbum = getNameAlbum ($idAlbum);
						
					
						if (rename ($DirPhoto.$oldNameAlbum , $DirPhoto.$nom))
						{
							updateAlbum($idAlbum,$nom);
							$infos->addSucces ("Album modifié !");
							$listAlbum = getListAlbum();
							$sousPage = "defaut";
						} else
						{
							$infos->addError ("Renommage du dossier impossible.");
							$sousPage="ajouter";
						}
						
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
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);
				$nameAlbum = getNameAlbum ($idAlbum);
				
				if (isset($_POST['nom'])) 
				{
					$nom=securite($_POST['nom']);
					if ($nom != "")
					{
						// supprimer les photo du dossier
						$nameAlbum = getNameAlbum ($idAlbum);
						delTree($DirPhoto.$nameAlbum);
					
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
			

			
			if (isset($_GET['idAlbum']))
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);
				$sousPage="modifierPhoto";
				
				
				if (isset($_GET['idPhoto']))
				{
					$idPhoto = securite($_GET['idPhoto']);
					$infoPhoto = getInfoPhoto ($idPhoto);
					
					if (isset($_POST['nomFr']) && isset($_POST['nomEn']) && isset($_POST['desciptionFR']) && isset($_POST['desciptionEN'])) 
					{
					
						if ($_POST['nomFr'] != "" && $_POST['nomEn'] != "" && $_POST['desciptionFR'] != "" && $_POST['desciptionEN'] != "")
						{
							updatePhoto($idPhoto, securite($_POST['nomFr']), securite($_POST['nomEn']), securite($_POST['desciptionFR']), securite($_POST['desciptionEN']));
							
						$infos->addSucces ("Photo modifiée !");	
									
							$listPhoto = getListPhoto($idAlbum);
							$nameAlbum = getNameAlbum ($idAlbum);
							$sousPage = "photo";

						} else
						{
							$infos->addError ("Les champs ne sont pas tous renseignés.");
							$sousPage="modifierPhoto";
						}
					
					
					} else {
						$sousPage="modifierPhoto";
					}
					
				} else
				{
					$infos->addError ("Aucune photo a modifier !");
					$listAlbum = getListAlbum();
					$sousPage = "defaut";
				}

			} else
			{
				$infos->addError ("Aucun album sélectionné");
				$listAlbum = getListAlbum();
				$sousPage = "defaut";
			}
			
			
			
			break;
		
		/*****  Supprimer une photo   *****/
		case 7 :
			if (isset($_GET['idAlbum']))
			{	// vérifier qu'il y a bien un album d'ouvert
				$idAlbum = securite($_GET['idAlbum']);

				
				if (isset($_GET['idPhoto']))
				{
					$idPhoto = securite($_GET['idPhoto']);
					
					$nameAlbum = getNameAlbum ($idAlbum);
					$fileMinName = getLinkPhoto ($idPhoto);
					
					delete_file($DirPhoto.$nameAlbum, $fileMinName);
					delete_file($DirPhoto.$nameAlbum,  str_replace ('_', '', $fileMinName));
					
					
					deletePhoto($idPhoto);
					
					$infos->addSucces ("Photo supprimée !");
					
				} else
				{
					$infos->addError ("Aucune photo a supprimer !");
				}
				
				$listPhoto = getListPhoto($idAlbum);
				$nameAlbum = getNameAlbum ($idAlbum);
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
