<!--
/**********
Page de gestion des rubriques -> suppression d'une rubrique

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une rubrique", "modify_rubrique.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer la rubrique : <?php echo $rubrique[2]; ?>
	</div>
	<div align="center">
			<a href="index.php?page=rubrique&action=6&idRubrique=<?php echo $rubrique[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=rubrique"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
