<!--
/**********
Page de gestion des participations -> suppression d'une participation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Suppression d'une participation", "modify_participation.png"); 
		$infos->printInfos();
	?>
	<div class="formulaire">
		Êtes-vous sûr de vouloir supprimer la participation de <strong><?php echo strtoupper($participation['nom_participant'])." - ".$participation['prenom_participant']; ?></strong>  dans l'équipe <strong><?php echo $participation['annee_equipe']; ?></strong> ? <br /><br />
		Le participant sera supprimé s'il ne participe pas dans d'autre équipe.
	</div>
	<div align="center">
			<a href="index.php?page=participation&action=6&idEquipe=<?php echo $equipe; ?>&idParticipant=<?php echo $part; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
