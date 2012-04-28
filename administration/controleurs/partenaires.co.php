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
		Action 4 : Traitement suppression
		Defaut : Affichage de la page d'accueil
	*/
	
	$DirLogo = 'ressources/data/Logos/';
	
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
			if (isset($_POST['nom'], $_POST['adresse'], $_FILES['logo'], $_POST['desciptionFR'], $_POST['desciptionEN'])) {
				if ($_POST['nom'] != "" && $_POST['adresse'] != "" && $_FILES['logo']['name'] != "" && $_POST['desciptionFR'] != "" && $_POST['desciptionEN'] != "")
				{
					// UPLOAD LOGO !
					$error_pict = verify_picture($_FILES['logo'], 5000000);
					if($error_pict == "")
					{
						$filename = save_picture($_FILES['logo'], $DirLogo);
						
						// Ajout
						$site = mysql_real_escape_string($_POST['adresse']);
						addPartenaire (securite($_POST['nom']), $site, $filename, securite($_POST['desciptionFR']), securite($_POST['desciptionEN']));
						$infos->addSucces ("Partenaire ajouté !");
						
						$sousPage 	= "defaut";
					}
					else
					{
						$infos->addError ($error_pict);
						$sousPage 	= "ajouter";
					}
					
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

		case 2: 
			if (isset($_GET['idPart']))
			{	// vérifier qu'il y a bien un partenaire selectionné
				$idPartenaire = securite($_GET['idPart']);
				$infoPartenaire = getInfoPartenaire ($idPartenaire);
				
				if (isset($_POST['nom'], $_POST['adresse'], $_POST['desciptionFR'], $_POST['desciptionEN'])) {
					if ($_POST['nom'] != "" && $_POST['adresse'] != "" && $_POST['desciptionFR'] != "" && $_POST['desciptionEN'] != "")
					{
						// GESTION LOGO
						
						$filename = $infoPartenaire['logo_partenaire'];
						if ( isset ($_FILES['logo']) && $_FILES['logo']['name'] != "")
						{
							$error_pict = verify_picture($_FILES['logo'], 5000000);
							if($error_pict == "")
							{
								delete_file($DirLogo, $infoPartenaire['logo_partenaire']);
								$filename = save_picture($_FILES['logo'], $DirLogo);
							}else
							{
								$infos->addError ($error_pict);
							}
						}
						
						// MAJ
						$site = mysql_real_escape_string($_POST['adresse']);
						updatePartenaire($idPartenaire, securite($_POST['nom']), $site, $filename, securite($_POST['desciptionFR']), securite($_POST['desciptionEN']));
						//$infos->addSucces ("Partenaire modifié !");
						$sousPage = "defaut";
				
					} else 
					{
						$sousPage="modifier";
					}
				} else
				{
					$sousPage="modifier";
				}
				
			} else
			{
				$infos->addError ("Aucun partenaire à modifier");
				$sousPage = "defaut";
			}
			break;

		case 3: 
			if (isset($_GET['idPart']))
			{	// vérifier qu'il y a bien un partenaire selectionné
				$idPartenaire = securite($_GET['idPart']);
				$infoPartenaire = getInfoPartenaire ($idPartenaire);
				
				if (isset($_GET['RR']) && (strcmp ( securite($_GET['RR']) , "yes" ) == 0)) {
					// SUPPRESSION LOGO
					delete_file($DirLogo, $infoPartenaire['logo_partenaire']);
					
					deletePartenaire($idPartenaire);
					$infos->addSucces ("Partenaire supprimé !");
					$sousPage = "defaut";

				} else
				{
					$sousPage="supprimer";
				}
			} else
			{
				$infos->addError ("Aucun partenaire à supprimer");
				$sousPage = "defaut";
			}
			break;
		
		default:
			$sousPage 	= "defaut";
		break;

	}
	if (strcmp ( $sousPage , "defaut" ) == 0)
		$partenaires = get_partenaires();
		
	include ('vues/partenaires/partenaires_'.$sousPage.'.vu.php');
?>
