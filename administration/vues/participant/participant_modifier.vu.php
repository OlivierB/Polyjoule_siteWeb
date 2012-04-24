<!--
/**********
Page de modification d'un participant
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Modification d'un participant", "modify_participant.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="editUser" method="post" action="index.php?page=participant&action=5"  enctype="multipart/form-data">
		<div class="formulaire">
			<input type="text" hidden="hidden" name="id" value="<?php echo $idPart; ?>" />
			
			<label for="nom" >Nom : </label>
			<input type="text" size="50" value="<?php echo $part[1]; ?>" name="nom"/><br/><br/>
			
			<label for="prenom" >Prénom : </label>
			<input type="text" size="50" value="<?php echo $part[2]; ?>" name="prenom"/><br/><br/>
			
			<label for="mail" >Mail : </label>
			<input type="email" size="50" value="<?php echo $part[4]; ?>" name="mail"/><br/><br/>
			
			<label for="role" >Rôle : </label>
			<input type="text" size="50" value="<?php echo $part[5]; ?>" name="role"/><br/><br/>
			
			<label for="photo">Photo : </label>
			<img src="ressources/data/Participants/<?php echo $part['photo_participant']; ?>" width="100px" height="100px"/><br/>
		</div>
		<h3> Biographie en français : </h3>
		<textarea  class="editor" id="bioFR" name="bioFR"><?php echo $part[6];?></textarea>
		<h3> Biographie en anglais : </h3>
		<textarea  class="editor" id="bioEN" name="bioEN"><?php echo $part[7];?></textarea>
		<script>
			CKEDITOR.replace( 'bioFR',
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
			CKEDITOR.replace( 'bioEN',
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
			<a href="javascript:document.editUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>
