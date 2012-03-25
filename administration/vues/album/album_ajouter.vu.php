<!--
/**********
Page de gestion des équipes -> ajout d'une équipe

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'un album'", "add_formation.png"); 
		$infos->printInfos();
		
	if ($action == 4)
	{ ?>
	<form name="formAjout" method="post" action="index.php?page=album&action=4&idAlbum=<?php echo $idAlbum; ?>&nomAlbum=<?php echo $nomAlbum; ?>>">
	<?php
	} else
	{ ?>
	<form name="formAjout" method="post" action="index.php?page=album&action=2">
	<?php
	} ?>
	
		<div class="formulaire">
			<label for="nom" ><strong>Nom album</strong> :</label>
			<input type="text" size="60" value="<?php if ($action == 4) echo $nameAlbum; ?>" name="nom"/> <br/><br/>
		</div>
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=album"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
