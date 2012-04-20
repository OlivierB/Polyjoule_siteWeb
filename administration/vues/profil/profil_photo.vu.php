<!--
/**********
Page de gestion du profil -> modif photo

**********/
-->

<div class="contenu">
	<?php 
		echo create_title_bar("Modification de la photo", "modify_profil.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<div class="photo_membre">
			<img src="<?php echo $profil['photo_membre']; ?>" />
	</div>
		
	<div class="formulaire">
	
		<?php echo create_information("Taille limitée à 1Mo et format image uniquement.");?>
		<form name="formPhoto" method="post" action="index.php?page=profil&action=8" enctype="multipart/form-data">
		
			<label for="photo_membre" >Changer ma photo :</label>
				<input type="file" name="photo_membre" maxlength="1048576" accept="image/*" id="photo_membre" />
				
		</form>
	</div>
	<div align="center">
			<a href="javascript:document.formPhoto.submit();"> <img src="<?php echo $_SESSION['design_path'];?>images/validate.png"/></a>
			<a href="index.php?page=profil"> <img src="<?php echo $_SESSION['design_path'];?>images/cancel.png"/></a>
	</div>
</div>
