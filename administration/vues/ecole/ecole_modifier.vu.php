<div class="contenu">
	<?php 
		echo create_title_bar("Mise à jour d'une école","modify_ecole.png"); 
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=ecole&action=5" name="formMAJ" enctype="multipart/form-data">
		<div class="formulaire">
			<p>
				<input type="text" hidden="hidden" name="idEcole" value="<?php echo $idEcole; ?>"/>
				<label for="nom" style="float : left;"><strong>Nom de l'école</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[1]; ?>" name="nom"/><br /><br />
				<label for="adresse" style="float : left;"><strong>Adresse de l'école</strong> :</label>
				<input type="text" style="margin-left:10px;" size="60" value="<?php echo $ecole[2]; ?>" name="adresse"/><br /><br />
				<label for="photo" style="float : left;"><strong>Photo de l'école</strong> : </label>
				<img src="<?php echo $ecole[3]; ?>"/><br /><br />
				<input type="file" name="photo" maxlength="1048576" accept="image/*"/>
			</p>
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
					  value = "<?php echo mysql_real_escape_string($ecole[4]);?>";
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
				  value = "<?php echo mysql_real_escape_string($ecole[5]);?>";
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
		<a href="javascript:document.formMAJ.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
		<a href="index.php?page=ecole"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
