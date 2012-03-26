<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une école","add_ecole.png");
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=ecole&action=4" name="formAjout" enctype="multipart/form-data">
		<div class="formulaire">
			<label for="nom"><strong>Nom de l'école</strong> :</label>
			<input type="text" size="60" value="" name="nom"/><br /><br />
			<label for="adresse"><strong>Adresse de l'école</strong> :</label>
			<input type="text" size="60" value="" name="adresse"/><br /><br />
			<label for="photo"><strong>Photo de l'école</strong> : </label>
			<input type="file" name="photo" maxlength="1048576" accept="image/*"/><br /><br />
		</div>
		
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descFR" name="descFR" rows="10"></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descEN" name="descEN" rows="10"></textarea>
		<script>
			CKEDITOR.replace( 'descFR',
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
			CKEDITOR.replace( 'descEN',
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
		<a href="index.php?page=ecole"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
