<!-- // fichier de gestion des articles


traitements

-->

<?php

	include("modeles/article.mo.php");
	include("modeles/rubrique.mo.php"); // Appel à certaines fonctions concernant les rubriques
	


$actions = array(1,2,3,4,5); // Tableau des actions possibles
/*
	Action 1 : Ajouter article
	Action 2 : Modifier article
	Action 3 : Traitement d'ajout d'un article
	Action 4 : Traitement de mise à jour d'un article
	Action 5 : Traitement de suppression d'un article
	Defaut 	 : Gestion des rubriques
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
		if(countRubrique()==0)
		{
			$infos->addError ('Impossible de créer un article, veuillez créer une rubrique avant (<a href="index.php?page=rubrique&action=1">Acces rapide</a>)');
			$error = true;
		}
		// calcul de la sous-page
		if ($error)
		{
			$sousPage 	= "defaut";
		} else
		{
			$sousPage 	= "ajouter";
		}
	break;

	case 2: 
		if(countRubrique()==0)
		{
			$infos->addError ('Impossible de créer un article, veuillez créer une rubrique avant ! (<a href="index.php?page=rubrique&action=1">Acces rapide</a>)');
			$error = true;
		}
		if( !isset($_GET['id']) || sizeof($_GET['id'])==0 )
		{
			$infos->addError ('Aucun article sélectionné. (<a href="index.php?page=article">Acces rapide</a>)');
			$error = true;
		}
		if(sizeof($_GET['id'])>1)
		{
			$infos->addError ('Veuillez modifier qu\'un seul article à la fois. (<a href="index.php?page=article">Acces rapide</a>)');
			$error = true;
		}
		$id = securite($_GET['id'][0]);
		if( !exist_article($id))
		{
			$infos->addError ("L'article n'existe pas dans la base.");
			$error = true;
		}
		if( !isAutorOf($id, $_SESSION['pseudo_membre']))
		{
			$infos->addError ("Vous n'êtes pas autorisé à modifier cette article car vous en êtes pas l'auteur.");
			$error = true;
		}
		// calcul de la sous-page
		if ($error)
		{
			$sousPage 	= "defaut";
		} else
		{
			$article = get_article($id);
			$sousPage 	= "modifier";
		}
	break;

	case 3: 
		if(isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && isset($_POST['statut']) && isset($_POST['commentaire']) && isset($_POST['contenuFR']) && isset($_POST['contenuEN']) && isset($_SESSION['pseudo_membre']))
		{
			// verifications :
			// ...
			ajouter_article(securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['statut']),securite($_POST['commentaire']),securite($_POST['contenuFR']),securite($_POST['contenuEN']), $_SESSION['pseudo_membre']);
			$infos->addSucces ("Ajout de l'article effectué");
			$sousPage 	= "defaut";
		} else
		{
			$infos->addError ("Les champs ne sont pas tous renseignés");
			$sousPage 	= "ajouter";
		}
		
	break;

	case 4: 
		if(isset($_POST['id']) && isset($_POST['titleFR']) && isset($_POST['titleEN']) && isset($_POST['rubrique']) && isset($_POST['statut']) && isset($_POST['commentaire']) && isset($_POST['contenuFR']) && isset($_POST['contenuEN']) && isset($_SESSION['pseudo_membre']))
		{
			modify_article(securite($_POST['id']),securite($_POST['titleFR']),securite($_POST['titleEN']),securite($_POST['rubrique']),securite($_POST['statut']),securite($_POST['commentaire']),securite($_POST['contenuFR']),securite($_POST['contenuEN']), $_SESSION['pseudo_membre']);
			$infos->addSucces ("Modification de l'article effectué");
			$sousPage 	= "defaut";
		} else
		{
			$infos->addError ("Les champs ne sont pas tous renseignés");
			$sousPage 	= "modifier";
		}
		
	break;

	case 5:
		if(isset($_GET['id']) && $_GET['id'] != "")
		{
			
			$toDelete 	= securite($_GET['id']);
			$tmpVar 	= delete_articles($toDelete);

			if ($tmpVar != "")
			{
				$infos->addError ("Impossible de supprimer l'article : ".$tmpVar." (<a href='index.php?page=article'>Acces rapide</a>)");
			}
		}
		$sousPage 	= "defaut";
	break;

	default:
		$sousPage 	= "defaut";
	break;

}
if (strcmp ( $sousPage , "defaut" ) == 0)
	$articles = get_articles();

     include ('vues/article/article_'.$sousPage.'.vu.php');
?>


