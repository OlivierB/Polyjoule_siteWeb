<!--
/**********
Page de gestion des formations -> ajout d'une participation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une participation", "add_participation.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=participation&action=4">
		<div class="formulaire">
			<label for="equipe" ><strong>Équipe</strong> :</label>
			<?php listeEquipe(); ?><br/><br/>
			
			<label for="participant" ><strong>Participant</strong> :</label>
			<?php listeParticipant(); ?><br/><br/>
			
			<label for="role" ><strong>Rôle</strong> :</label>
			<input type="text" name="role"/>
		</div>
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=participation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
