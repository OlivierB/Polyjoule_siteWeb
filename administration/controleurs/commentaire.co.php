<!-- // fichier de gestion des commentaires des articles


traitements

-->

<?php

	include("modeles/article.mo.php");
	include("modeles/commentaire.mo.php");
	
	if(!isset($_GET['id_article']))
	{
		header("Location: index.php?page=article");
	}
	if(!exist_article($_GET['id_article']))
	{
		header("Location: index.php?page=article");
	}
	
	$id_article = $_GET['id_article'];
	
	$actions = array(1,2,3,4,5); // Tableau des actions possibles
	/*
		Action 1 : Ajouter un commentaire
		Action 2 : Modifier un commentaire
		Action 3 : Supprimer un commentaire
		Action 4 : Traitement d'ajout d'un commentaire
		Action 5 : Traitement de modification d'un commentaire
		Defaut 	 : Gestion des commentaires
	*/

	
	// Traitement de chaque page
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions))
		$action = securite($_GET['action']);
	else
		$action = 0;

	$error 		= false;
	$sousPage 	= "defaut";

	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action)
	{ 

		case 1:
			$article = get_article($id_article);
					
			if($article['autorisation_com'] == 1)
			{
				$commentaires = get_commentaires($id_article);
				$sousPage = "ajouter";
			}
			else
			{
				$infos->addError ('Les commentaires ne sont pas autorisés sur cet article. Pour changer cette option : <a href="index.php?page=article&action=2&id[]='.$id_article.'">Acces rapide</a>');
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			break;

		case 2:
			if( !isset($_GET['id_com']))
			{
				$infos->addError ('Action impossible !');
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			else if(!exist_com(securite($_GET['id_com'])))
			{
				$infos->addError ('Le commentaire n\'existe pas.');
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			else
			{
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage 	= "modifier";
				$id_com = $_GET['id_com'];
			}
			break;
		case 3:
			if( !isset($_GET['id_com']))
			{
				$infos->addError ('Action impossible !');
				$sousPage 	= "defaut";
			}
			else if(!exist_com(securite($_GET['id_com'])))
			{
				$infos->addError ('Le commentaire n\'existe pas.');
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			else
			{
				delete_com(securite($_GET['id_com']));
				$infos->addSucces ("Suppression du commentaire effectué");
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			break;
			
		case 4: 
			if(isset($_POST['message']))
			{

				add_com($id_article, securite($_POST['message']));
				$infos->addSucces ("Ajout du commentaire effectué");
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			else
			{
				$infos->addError ("Les champs ne sont pas tous renseignés");
				$sousPage 	= "ajouter";
			}
		
		break;

		case 5: 
			if(isset($_POST['id_com']) && isset($_POST['message']))
			{

				modify_com($_POST['id_com'], securite($_POST['message']));
				$infos->addSucces ("Modification du commentaire effectué");
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			else
			{
				$infos->addError ("Les champs ne sont pas tous renseignés");
				$sousPage 	= "modifier";
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
			}
		
		break;

		default:
			
			if( !isset($_GET['id_article'][0]) )
			{
				header("Location: index.php?page=article");
			}
			else if( !exist_article(securite($_GET['id_article'][0])))
			{
				header("Location: index.php?page=article");
			}
			else
			{
				$id_article = securite($_GET['id_article'][0]);
				$article = get_article($id_article);
				$commentaires = get_commentaires($id_article);
				$sousPage = "defaut";
			}
			break;
	}
		if(strcmp($sousPage,'ajouter') == 0 || strcmp($sousPage,'ajouter') == 0)
		{
     		include ('vues/commentaire/commentaire_defaut.vu.php');
     		include ('vues/commentaire/commentaire_'.$sousPage.'.vu.php');
     	}
     	else
     	{
     		include ('vues/commentaire/commentaire_'.$sousPage.'.vu.php');
     	}
     	echo "</div>";
?>


