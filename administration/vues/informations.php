<!--
/**********
Page d'informations concernant les erreurs
Redirection automatique vers l'accueil

Structure du tableau d'informations
	$informations = Array(
							true, // Vrai si information / Faux si erreur
							'Erreur', // Nom de l'information
							'Vous n\'�tes pas autoris� � acc�der � cette page...', // Message d'information (ou d'erreur)
							'index.php', // URL de redirection
							2 // D�lai avant la redirection
							);

**********/
-->
<?php
	/* Si la variable informations n'est pas renseign�e, on d�finie une variable d'informations par d�faut. */
	if(!isset($informations))
	{
		$informations = Array(/*Erreur*/
						true,
						'Erreur',
						'Une erreur interne est survenue...',
						'index.php',
						3
						);
	}

	if($informations[0] === true)
	{
		$type = 'erreur';
		$src = "ressources/design/style1/images/info.png";
	}
	else
	{
		$type = 'information';
		$src = "ressources/design/style1/images/error.png";
	}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Refresh" content="<?php echo $informations[4]; ?>;url=<?php echo $informations[3]; ?>">
	</head>
	<body>
		<style type="text/css">
			#informations {
				text-align : center;
				padding : 30px;
				width : 400px;
				height : 80px;
				background-color : #468093;
				color : white;
				margin : auto auto auto auto;
				border-radius : 10px;
				border : 2px solid white;
				}
			#img_info {
				width : 50px;
				height : 50px;
				margin : -20px auto auto auto;
				}
		</style>
		<div id="informations">
			<img id="img_info" src="<?php echo $src;?>" />
			<div id="<?php echo $type; ?>"><?php echo $informations[2]; ?><br/> Redirection en cours...<br/>
					<a href="<?php echo $informations[3]; ?>">Cliquez ici si vous ne voulez pas attendre...</a>
			</div>
		</div>
		<?php
		unset($informations);
		?>
	</body>
</html>
