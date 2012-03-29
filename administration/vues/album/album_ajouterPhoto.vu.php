<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une photo","add_photo.png");
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=album&action=3&idAlbum=<?php echo $idAlbum; ?>" name="formAjout" enctype="multipart/form-data">
		<div class="formulaire">
			<label for="nomFr"><strong>Nom (FR) :</strong></label>
			<input type="text" size="60" value="" name="nomFr"/><br/><br/>
			<label for="nomEn"><strong>Nom (EN) :</strong></label>
			<input type="text" size="60" value="" name="nomEn"/><br/><br/>
			<input type="hidden" name="MAX_FILE_SIZE" value="4000000">
			<label for="photo"><strong>Image</strong> : </label>
			<input type="file" name="photo" /><br/><br/>
			
		</div>
	</form>
	<div align="center">
		<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
		<a href="index.php?page=album&action=1&idAlbum=<?php echo $idAlbum; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
