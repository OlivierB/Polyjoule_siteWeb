<div class="contenu">
	<?php
		echo create_title_bar("Modification d'un album", "add_album.png"); 
		$infos->printInfos();
	?>
	
	<form name="formAjout" method="post" action="index.php?page=album&action=4&idAlbum=<?php echo $idAlbum; ?>&nomAlbum=<?php echo $nomAlbum; ?>>">

	
		<div class="formulaire">
			<label for="nom" ><strong>Nom album</strong> :</label>
			<input type="text" size="60" value="<?php echo $nameAlbum; ?>" name="nom"/> <br/><br/>
		</div>
		
		<h3> Description en français : </h3>
		<textarea  class="editor" id="desciptionFR" name="desciptionFR"><?php echo $infoAlbum['descFR_album'] ?></textarea>
		<h3> Description en anglais : </h3>
		<textarea  class="editor" id="desciptionEN" name="desciptionEN"><?php echo $infoAlbum['descEN_album'] ?></textarea>
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
		
		
		
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=album"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
