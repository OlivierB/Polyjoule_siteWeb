<!--
/**********
Page d'inscription d'un participant
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'un participant", "add_participant.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="addUser" method="post" action="index.php?page=participant&action=4"  enctype="multipart/form-data">
		<div class="formulaire">
				<label for="nom" >Nom : </label>
				<input type="text" size="50" value="" name="nom"/><br/>
				
				<label for="prenom" >Prénom : </label>
				<input type="text" size="50" value="" name="prenom"/><br/>
				
				<label for="mail" >Mail : </label>
				<input type="email" size="50" value="" name="mail"/><br/>
				
				<label for="role" >Rôle : </label>
				<input type="text" size="50" value="" name="role"/><br/>
				
				<label for="equipe" >Équipe : </label>
				<?php listeEquipe(); ?><br />
				
				<label for="photo">Photo : </label>
				<input type="file" name="photo" maxlength="1048576" accept="image/*"/>
		</div>
		
		<h3> Biographie en français : </h3>
		<textarea  class="editor" id="bioFR" name="bioFR"></textarea>
		<h3> Biographie en anglais : </h3>
		<textarea  class="editor" id="bioEN" name="bioEN"></textarea>
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
			<a href="javascript:document.addUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>
