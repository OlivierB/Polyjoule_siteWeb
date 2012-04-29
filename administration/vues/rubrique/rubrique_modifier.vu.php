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
					<input type="text"  size="60" value="<?php echo $rubrique[3]; ?>" name="titleFR"/> <br/><br/>
				
					<label for="titleEN" >Titre(EN) :</label>
					<input type="text"  size="60" value="<?php echo $rubrique[4]; ?>" name="titleEN"/> <br/><br/>
				
					<label for="rubrique"> Rubrique mère: </label>
					<?php
						listeRubriqueSelected($rubrique[1],$rubrique[0]);
					?><br/><br/>
					
					<?php $idT=$rubrique[2]; ?>
					
					<label for="template">Template :</label>
					<select name="template">
						<option value="1" <?php echo affichageSelected($idT,1); ?> ><?php echo $id1; ?></option>
						<option value="2" <?php echo affichageSelected($idT,2); ?>><?php echo $id2; ?></option>
						<option value="3" <?php echo affichageSelected($idT,3); ?>><?php echo $id3; ?></option>
						<option value="4" <?php echo affichageSelected($idT,4); ?>><?php echo $id4; ?></option>
						<option value="5" <?php echo affichageSelected($idT,5); ?>><?php echo $id5; ?></option>
					</select>
				</p>
		</div>
		
		<h3> Description en français : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionFR" name="descriptionFR" rows="10"><?php echo $rubrique['descFR_rubrique'];?></textarea>
		<h3> Description en anglais : </h3>
		<textarea cols="80" class="ckeditor" id="descriptionEN" name="descriptionEN" rows="10"><?php echo $rubrique['descEN_rubrique'];?></textarea>
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
