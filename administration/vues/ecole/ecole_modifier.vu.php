<div class="contenu">
	<?php 
		echo create_title_bar("Mise à jour d'une école","modify_ecole.png"); 
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=ecole&action=5" name="formMAJ" enctype="multipart/form-data">
		<div class="formulaire">
			<p>
				<input type="text" hidden="hidden" name="idEcole" value="<?php echo $idEcole; ?>"/>
				<label for="nom" style="float : left;"><strong>Nom de l'école</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[1]; ?>" name="nom"/><br /><br />
				<label for="adresse" style="float : left;"><strong>Adresse de l'école</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[2]; ?>" name="adresse"/><br /><br />
				<label for="anciennePhoto" style="float : left;"><strong>Photo de l'école</strong> : </label>
				<img name="anciennePhoto" src="ressources/data/Ecoles/<?php echo $ecole[3]; ?>"/><br /><br />
				
				<label for="photo" style="float : left;"><strong>Changer de photo</strong> : </label>
				<input type="file" name="photo" maxlength="1048576" accept="image/*"/>
			</p>
		</div>
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descFR" name="descFR" rows="10"><?php echo $ecole[4];?></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descEN" name="descEN" rows="10"><?php echo $ecole[5];?></textarea>
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
			<a href="javascript:document.formMAJ.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=ecole"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
