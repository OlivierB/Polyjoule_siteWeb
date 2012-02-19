<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une formation", "modify_formation.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form method="post" name="formAjout" action="index.php?page=formation&action=5">
		<div class="formulaire">
			<p>
				<input type="text" name="id" hidden="hidden" value="<?php echo $formation[0]; ?>" />
				<label for="titreFR" style="float : left;"><strong>Nom (FR)</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[2]; ?>" name="nomFR"/><br/><br/>
				<label for="titreEN" style="float : left;"><strong>Nom (EN)</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $formation[3]; ?>" name="nomEN"/><br/><br/>
				<label for="idEcole" style="float : left;"><strong>Nom de l'école</strong> :</label>
				<?php listeEcoleSelect($formation[1]); ?><br/><br/>
				<label for="lien" style="float : left;"><strong>Site internet</strong> :</label>
				<input type="url" style="margin-left:10px;" size="60" value="<?php echo $formation[4]; ?>" name="lien"/>
			</p>
		</div>
		<p>
			<!-- descFR_formation -->
			<div class="editor" id="descFR" align="center">
			</div>
			<script language="javascript" type="text/javascript">
			  with (document.getElementById ("descFR")) {
				with (appendChild (document.createElement ("TEXTAREA"))) {
				  name = "descFR";
				  cols = 120;
				  rows = 25;
				  value = "<?php echo mysql_real_escape_string($formation[5]);?>";
				}
			  }
			//-->
			</script>
			<noscript>
			  The editor requires scripting to be enabled.
			</noscript>
			<noscript>mce:3</noscript>
			<!-- descEn_formation -->
			<div class="editor" id="descEN" align="center">
			</div>
			<script language="javascript" type="text/javascript">
			  with (document.getElementById ("descEN")) {
				with (appendChild (document.createElement ("TEXTAREA"))) {
				  name = "descEN";
				  cols = 120;
				  rows = 25;
				  value = "<?php echo mysql_real_escape_string($formation[6]);?>";
				}
			  }
			//-->
			</script>
			<noscript>
			  The editor requires scripting to be enabled.
			</noscript>
			<noscript>mce:3</noscript>
		</p>
		<div align="center">
			<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=formation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
