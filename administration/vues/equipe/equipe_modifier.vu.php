<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une équipe", "modify_equipe.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form method="post" name="formAjout" action="index.php?page=equipe&action=5">
		<div class="formulaire">
			<p>
				<input type="text" name="id" hidden="hidden" value="<?php echo $equipe[0]; ?>" />
				
				<label for="annee"><strong>Année<strong> :</label>
				<input type="text" value="<?php echo $equipe[1]; ?>" name="annee" /><br/><br/>
			</p>
		</div>
		<div align="center">
			<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=equipe"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
