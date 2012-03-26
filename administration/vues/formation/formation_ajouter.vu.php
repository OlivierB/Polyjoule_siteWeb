<!--
/**********
Page de gestion des formations -> ajout d'une formation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une formation", "add_formation.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=formation&action=4">
		<div class="formulaire">
			<label for="nomFR" ><strong>Nom</strong> (FR) :</label>
			<input type="text" size="60" value="" name="nomFR"/> <br/><br/>
		
			<label for="nomEN" ><strong>Nom</strong> (EN) :</label>
			<input type="text" size="60" value="" name="nomEN"/> <br/><br/>
		
			<label for="ecole" ><strong>Nom de l'école</strong> :</label>
			<?php listeEcole(); ?><br/><br/>
			
			<label for="lien"><strong>Site internet</strong> :</label>
			<input type="url" size="60" value="" name="lien"/>
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
		
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=formation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
