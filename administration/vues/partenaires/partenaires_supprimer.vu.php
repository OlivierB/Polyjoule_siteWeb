<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'un partenaire", "modify_partenaire.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer le partenaire <b><?php echo $part[1]." ".$part[2]; ?></b> ?
	</div>
	<div align="center">
			<a href="index.php?page=partenaires&action=6&idPart=<?php echo $part[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=partenaires"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
