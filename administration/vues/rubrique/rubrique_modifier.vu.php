<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une rubrique", "modify_rubrique.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form method="post" name="formAjout" action="index.php?page=rubrique&action=5">
		<div class="formulaire">
				<p>
					<input type="hidden" name="rubrique_id" value="<?php echo $rubrique[0]; ?>"/>
				
					<label for="titleFR">Titre(FR) :</label>
					<input type="text"  size="60" value="<?php echo $rubrique[2]; ?>" name="titleFR"/> <br/><br/>
				
					<label for="titleEN" >Titre(EN) :</label>
					<input type="text"  size="60" value="<?php echo $rubrique[3]; ?>" name="titleEN"/> <br/><br/>
				
					<label for="rubrique"> Rubrique mère: </label>
					<?php
						listeRubriqueSelected($rubrique[1],$rubrique[0]);
					?>
				</p>
		</div>
		
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionFR" name="descriptionFR" rows="10"><?php $rubrique[4];?></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionEN" name="descriptionEN" rows="10"><?php echo $rubrique[5];?></textarea>
		<script>
			CKEDITOR.replace( 'descriptionFR',
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
			CKEDITOR.replace( 'descriptionEN',
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
			<a href="index.php?page=rubrique"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
