<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une école","add_ecole.png");
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=ecole&action=4" name="formAjout" enctype="multipart/form-data">
		<div class="formulaire">
			<label for="nom"><strong>Nom de l'école</strong> :</label>
			<input type="text" size="60" value="" name="nom"/><br /><br />
			<label for="adresse"><strong>Adresse de l'école</strong> :</label>
			<input type="text" size="60" value="" name="adresse"/><br /><br />
			<label for="photo"><strong>Photo de l'école</strong> : </label>
			<input type="file" name="photo" maxlength="1048576" accept="image/*"/><br /><br />
			<input type="text" hidden="hidden" name="photo" value=""/>
		</div>
			<p>
				<!-- descFR -->
				<div class="editor" id="descFR" align="center">
				</div>
				<script language="javascript" type="text/javascript">
				  with (document.getElementById ("descFR")) {
					with (appendChild (document.createElement ("TEXTAREA"))) {
					  name = "descFR";
					  cols = 120;
					  rows = 25;
					  value = "Votre article en français ici...";
					}
				  }
				//-->
				</script>
				<noscript>
				  The editor requires scripting to be enabled.
				</noscript>
				<noscript>mce:3</noscript>
				<!-- descEN -->
				<div class="editor" id="descEN" align="center">
				</div>
				<script language="javascript" type="text/javascript">
				  with (document.getElementById ("descEN")) {
					with (appendChild (document.createElement ("TEXTAREA"))) {
					  name = "descEN";
					  cols = 120;
					  rows = 25;
					  value = "Here, your article in english...";
					}
				  }
				//-->
				</script>
				<noscript>
				  The editor requires scripting to be enabled.
				</noscript>
				<noscript>mce:3</noscript>
			</p>
	</form>
	<div align="center">
		<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
		<a href="index.php?page=ecole"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
