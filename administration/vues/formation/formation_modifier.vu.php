<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une formation", "modify_formation.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form method="post" name="formAjout" action="index.php?page=formation&action=5">
		<div class="formulaire">
			<p>
				<input type="text" name="id" hidden="hidden" value="<?php echo $formation[0]; ?>" />
				<label for="titreFR"><strong>Nom (FR)</strong> :</label>
				<input type="text" size="60" value="<?php echo $formation[2]; ?>" name="nomFR"/><br/><br/>
				<label for="titreEN"><strong>Nom (EN)</strong> :</label>
				<input type="text" size="60" value="<?php echo $formation[3]; ?>" name="nomEN"/><br/><br/>
				<label for="idEcole"><strong>Nom de l'école</strong> :</label>
				<?php listeEcoleSelect($formation[1]); ?><br/><br/>
				<label for="lien"><strong>Site internet</strong> :</label>
				<input type="url" size="60" value="<?php echo $formation[4]; ?>" name="lien"/>
			</p>
		</div>
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descFR" name="descFR" rows="10"><?php echo $formation[5];?></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descEN" name="descEN" rows="10"><?php echo $formation[6];?></textarea>
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
		
		<div align="center">
			<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=formation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
