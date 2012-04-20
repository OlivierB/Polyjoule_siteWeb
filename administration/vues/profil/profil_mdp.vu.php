<!--
/**********
Page de gestion du profil -> modif mdp

**********/
-->


<div class="contenu">
		<?php 
			echo create_title_bar("Modification du mot de passe", "modify_profil.png"); 
			// affichage succès ou erreurs
			$infos->printInfos();
		?>
		<div class="formulaire">
		
			<?php echo create_information("Vous serez déconnecté une fois la procédure achevée si tout s'est bien passé.");?>
			
			<form name="formProfil" method="post" action="index.php?page=profil&action=5">
				<label for="ancien">Mot de passe actuel :</label>
				<input type="password" size="20" value="" name="ancien"/><br/><br/>
				
				<label for="mdp">Mot de passe :</label>
				<input type="password" size="20" value="" name="mdp"/><br/><br/>
				
				<label for="mdp2">Confirmation :</label>
				<input type="password" size="20" value="" name="mdp2"/>
			</form>
		</div>
		<div align="center">
				<a href="javascript:document.formProfil.submit();"> <img src="<?php echo $_SESSION['design_path'];?>images/validate.png"/></a>
				<a href="index.php?page=profil"> <img src="<?php echo $_SESSION['design_path'];?>images/cancel.png"/></a>
		</div>
	</div>
</div>

