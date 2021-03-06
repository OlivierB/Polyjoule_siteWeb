<!--
/**********
Page de gestion du profil -> modif du pseudo

**********/
-->

<div class="contenu">
	<?php 
		echo create_title_bar("Modification du pseudo", "modify_profil.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<div class="formulaire">
		<?php echo create_information("Vous serez déconnecté une fois la procédure achevée si tout s'est bien passé.");?>
		
		<form name="formPseudo" method="post" action="index.php?page=profil&action=4">
			<label for="pseudo">Pseudo :</label>
			<input type="text" size="20" value="<?php echo $_SESSION['pseudo_membre']; ?>" name="pseudo"/>
		</form>
	</div>
	
	<div align="center">
			<a href="javascript:document.formPseudo.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=profil"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
