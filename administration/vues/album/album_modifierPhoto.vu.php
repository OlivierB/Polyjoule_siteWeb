<div class="contenu">
	<?php
		echo create_title_bar("Modifier une photo","add_photo.png");
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=album&action=6&idAlbum=<?php echo $idAlbum; ?>&idPhoto=<?php echo $idPhoto; ?>" name="formAjout" >
		<div class="formulaire">
			<label for="nomFr"><strong>Nom (FR) :</strong></label>
			<input type="text" size="60" value="<?php echo $infoPhoto['titreFR_photo'] ?>" name="nomFr" /><br/><br/>
			<label for="nomEn"><strong>Nom (EN) :</strong></label>
			<input type="text" size="60" value="<?php echo $infoPhoto['titreEN_photo'] ?>" name="nomEn" /><br/><br/>
			
		</div>
		
		<h3> Description en français : </h3>
		<textarea  class="editor" id="desciptionFR" name="desciptionFR"  ><?php echo $infoPhoto['descFR_photo'] ?></textarea>
		<h3> Description en anglais : </h3>
		<textarea  class="editor" id="desciptionEN" name="desciptionEN" ><?php echo $infoPhoto['descEN_photo'] ?></textarea>
		<script>
			CKEDITOR.replace( 'desciptionFR',
			{
				toolbar : 'Full',
				uiColor : '#468093',
				filebrowserBrowseUrl : "ressources/scripts/js//ckfinder/ckfinder.html?Type=Files",
				filebrowserImageBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Images",
				filebrowserFlashBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Flash",
				filebrowserUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
			});
			CKEDITOR.replace( 'desciptionEN',
			{
				toolbar : 'Full',
				uiColor : '#468093',
				filebrowserBrowseUrl : "ressources/scripts/js//ckfinder/ckfinder.html?Type=Files",
				filebrowserImageBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Images",
				filebrowserFlashBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Flash",
				filebrowserUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
			});
		</script>
	</form>
	<div align="center">
		<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
		<a href="index.php?page=album&action=1&idAlbum=<?php echo $idAlbum; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
