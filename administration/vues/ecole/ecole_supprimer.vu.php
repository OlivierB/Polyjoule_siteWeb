<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'une école", "modify_ecole.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer l'école <b><?php echo $ecole[1]; ?></b> ainsi que toutes les formations associées à cette école ?
	</div>
	<div align="center">
			<a href="index.php?page=ecole&action=6&idEcole=<?php echo $ecole[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=ecole"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
