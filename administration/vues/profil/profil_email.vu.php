<!--
/**********
Page de gestion du profil -> modif email

**********/
-->

<div class="contenu">
	<?php 
		echo create_title_bar("Modification de l'email", "modify_profil.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<div class="formulaire">
		<form name="formMail" method="post" action="index.php?page=profil&action=6">
			<label for="mail">Nouvel E-mail :</label>
			<input type="email" size="50" value="" name="mail"/><br/><br/>
			
			<label for="mail2">Confirmation :</label>
			<input type="email" size="50" value="" name="mail2"/>
		</form>
	</div>
	<div align="center">
			<a href="javascript:document.formMail.submit();"> <img src="<?php echo $_SESSION['design_path'];?>images/validate.png"/></a>
			<a href="index.php?page=profil"> <img src="<?php echo $_SESSION['design_path'];?>images/cancel.png"/></a>
	</div>
</div>
