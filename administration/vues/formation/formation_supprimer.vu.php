<!--
/**********
Page de gestion des formations -> suppression d'une formation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'une formation", "modify_formation.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer la formation : <?php echo $formation[2]; ?>
	</div>
	<div align="center">
			<a href="index.php?page=formation&action=6&idformation=<?php echo $formation[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=formation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
