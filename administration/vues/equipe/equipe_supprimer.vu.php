<!--
/**********
Page de gestion des formations -> suppression d'une formation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'une équipe", "modify_equipe.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer l'équipe <?php echo $equipe[1]; ?> ainsi que tous ses participants ?
	</div>
	<div align="center">
			<a href="index.php?page=equipe&action=6&idEquipe=<?php echo $equipe[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=equipe"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
