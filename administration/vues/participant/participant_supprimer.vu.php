<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'un participant", "modify_participant.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer le participant <b><?php echo $part[1]." ".$part[2]; ?></b> ?
	</div>
	<div align="center">
			<a href="index.php?page=participant&action=6&idParticipant=<?php echo $part[0]; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
