<!-- // fichier de connexion


traitements

-->

<?php

	// inclusion des fichiers de scripts
	include ("bdd/bdd_connexion.php");
	include ("ressources/scripts/php/functions.php");

	include ('modeles/connexion.mo.php');
	include ('modeles/gestionComptes.mo.php');
	
	// création d'un objet pour stoker les informations (erreurs et succes)
	$infos = new Informations ();

	$actions = array(1,2,3); // Tableau des actions possibles
	/*
		Action 1 : Traitement connexion
		Action 2 : Mot de passe oublié
		Action 3 : Traitement mot de passe oublié
		Defaut : Formulaire de connexion
	*/
	
	// Traitement de chaque page
	if (isset($_GET['action']) && in_array(securite($_GET['action']),$actions))
		$action = securite($_GET['action']);
	else
		$action = 0;

	$sousPage 	= "defaut";

	// traitement pour chaque type de page et calcul de la page à afficher
	switch ($action)
	{ 

		case 1:
			// gestion de l'identification
			if(isset($_POST['login']) && $_POST['login']!="" && isset($_POST['passwd']) && $_POST['passwd']!="")
			{
				$pseudo = securite ($_POST['login']);
				$passe	= securite ($_POST['passwd']);
				if (connexion ($pseudo, $passe, $infos))
					header('Location: index.php');
				else
				{
					$infos->addError("La connexion a échouée, veuillez retenter dans quelques instants.");
					$sousPage 	= "defaut";
				}
			}
			break;
		case 2:
			$sousPage 	= "reset";
			break;
		case 3:
			if(isset($_POST['mail']))
			{
				$mail = securite ($_POST['mail']);
				$error_reset = reset_mdp($mail);
				if ($error_reset == "")
				{
					$infos->addSucces("Votre nouveau mot de passe vient de vous être envoyé.");
					$sousPage 	= "defaut";
				}
				else
				{
					$infos->addError($error_reset);
					$sousPage 	= "reset";
				}
			}
			else
			{
				$infos->addError("Action impossible !");
				$sousPage 	= "reset";
			}
		break;
		
		
		default :
			$sousPage 	= "defaut";
	}

	include ('vues/connexion/connexion_'.$sousPage.'.vu.php');
?>
