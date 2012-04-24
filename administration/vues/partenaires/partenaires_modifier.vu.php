<!--
/**********
Page de modification d'un partenaire
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Modification d'un partenaire", "modify_partenaires.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<form name="formAjout" method="post" action="index.php?page=partenaires&action=2&idPart=<?php echo $idPartenaire; ?>" enctype="multipart/form-data">
	
		<div class="formulaire">
			<label for="nom" ><strong>Nom partenaire</strong> :</label>
			<input type="text" size="60" name="nom" value="<?php echo $infoPartenaire['nom_partenaire']; ?>" /> 
			<label for="adresse" ><strong>Site Web</strong> :</label>
			<input type="text" size="60" name="adresse" value="<?php echo $infoPartenaire['site_partenaire']; ?>" />
			<label for="logo" ><strong>Lien logo</strong> :</label>
			<input type="text" name="logo" value="<?php echo $infoPartenaire['logo_partenaire']; ?>" /><br/>
		</div>
		
		<h3> Description en français : </h3>
		<textarea  class="editor" id="desciptionFR" name="desciptionFR"><?php echo $infoPartenaire['descFR_partenaire']; ?></textarea>
		<h3> Description en anglais : </h3>
		<textarea  class="editor" id="desciptionEN" name="desciptionEN"><?php echo $infoPartenaire['descEN_partenaire']; ?></textarea>
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
				<a href="index.php?page=partenaires"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
			
</div>
