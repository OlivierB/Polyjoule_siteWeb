<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'un album", "add_album.png"); 
		$infos->printInfos();
	?>
	
	<form name="formAjout" method="post" action="index.php?page=album&action=2">
	
		<div class="formulaire">
			<label for="nom" ><strong>Nom album</strong> :</label>
			<input type="text" size="60" name="nom"/> <br/><br/>
		</div>
		
		<h3> Description en français : </h3>
		<div align="center">
			<textarea  class="editor" id="desciptionFR" name="desciptionFR"></textarea>
		</div>
		<h3> Description en anglais : </h3>
		<div align="center">
			<textarea  class="editor" id="desciptionEN" name="desciptionEN"></textarea>
		</div>
		<script>
			CKEDITOR.replace( 'desciptionFR',
			{
				toolbar : 'Basic',
				uiColor : '#468093',
				height:"150", width:"800",
			});
			CKEDITOR.replace( 'desciptionEN',
			{
				toolbar : 'Basic',
				uiColor : '#468093',
				height:"150", width:"800",
			});
		</script>
		
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=album"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
