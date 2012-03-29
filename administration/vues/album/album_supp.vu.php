<!--
/**********
Page de gestion des équipes -> ajout d'une équipe

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Suppresion d'un album'", "add_album.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=album&action=5&idAlbum=<?php echo $idAlbum; ?>&nomAlbum=<?php echo $nomAlbum; ?>>">
		<div class="formulaire">
			<label  align="center" for="nom" ><strong>Supprimer l'album <?php echo $nameAlbum; ?> ?</strong></label>
			<input type="hidden" size="60" value="<?php echo $nameAlbum; ?>" name="nom"/> <br/><br/>
		</div>
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=album"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
