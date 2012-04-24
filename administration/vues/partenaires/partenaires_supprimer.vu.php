<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'un partenaire", "modify_partenaires.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer le partenaire <b><?php echo $infoPartenaire['nom_partenaire'].' (<a href="'.$infoPartenaire['site_partenaire'].'"> site </a>)'; ?></b> ?
	</div>
	<div align="center">
			<a href="index.php?page=partenaires&action=3&RR=yes&idPart=<?php echo $idPartenaire; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=partenaires"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
