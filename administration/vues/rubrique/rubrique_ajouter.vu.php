<!--
/**********
Page de gestion des rubriques -> ajout d'une rubrique

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une rubrique", "add_rubrique.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=rubrique&action=4">
		<div class="formulaire">
			<label for="titleFR" >Titre(FR) :</label>
			<input type="text" size="60" value="" name="titleFR"/> <br/><br/>
		
			<label for="titleEN" >Titre(EN) :</label>
			<input type="text" size="60" value="" name="titleEN"/> <br/><br/>
		
			<label for="rubriqueMère" >Rubrique mère :</label>
			<?php listeRubrique(); ?><br/><br/>
			
			<label for="template">Template :</label>
			<select name="template">
				<option value="1"><?php echo $id1; ?></option>
				<option value="2"><?php echo $id2; ?></option>
				<option value="3"><?php echo $id3; ?></option>
				<option value="4"><?php echo $id4; ?></option>
				<option value="5"><?php echo $id5; ?></option>
			</select>
		</div>
		
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionFR" name="descriptionFR" rows="10"></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionEN" name="descriptionEN" rows="10"></textarea>
		<script>
			CKEDITOR.replace( 'descriptionFR',
			{
				toolbar : 'Full',
				fullPage : true,
				entities : true,
				uiColor : '#468093',
				filebrowserBrowseUrl : "ressources/scripts/js//ckfinder/ckfinder.html?Type=Files",
				filebrowserImageBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Images",
				filebrowserFlashBrowseUrl : "ressources/scripts/js/ckfinder/ckfinder.html?Type=Flash",
				filebrowserUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files",
				filebrowserImageUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images",
				filebrowserFlashUploadUrl : "ressources/scripts/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash"
			});
			CKEDITOR.replace( 'descriptionEN',
			{
				toolbar : 'Full',
				fullPage : true,
				entities : true,
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
				<a href="index.php?page=rubrique"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
