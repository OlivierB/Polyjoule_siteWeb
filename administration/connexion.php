<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* page de connexion de la partie admin
*
-->
<?php
	// ouverure d'une session (ou reprise)
	session_start();
	// calcul de la page à afficher
	if (isset ($_SESSION['id_membre'], $_SESSION['pseudo_membre'])) 
	{	
		header("Location : index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/style1/connexion.css"  />
		<script type="text/JavaScript" src="ressources/scripts/js/functions.js"></script>
		<title>Titre</title>
	</head>

	<body>
	
		<?php
			include("controleurs/connexion.co.php");
		?>
		
		<footer>
			Copyright &copy; Polyjoule 2012 - Tous droits réservés.
		</footer>

	</body>

</html>
