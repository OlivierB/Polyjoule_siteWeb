<!--
/**********
Page de gestion des formations -> ajout d'une participation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Modification d'une participation", "modify_participation.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=participation&action=5">
		<div class="formulaire">
			<input type="text" hidden="hidden" value="<?php echo $equipe; ?>" name="ancienneEquipe" />
			<input type="text" hidden="hidden" value="<?php echo $part; ?>" name="ancienPart" />
			<label for="equipe" ><strong>Équipe</strong> :</label>
			<?php listeEquipeSelected($equipe); ?><br/><br/>
			
			<label for="participant" ><strong>Participant</strong> :</label>
			<?php listeParticipantSelected($part); ?>
		</div>
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=participation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
