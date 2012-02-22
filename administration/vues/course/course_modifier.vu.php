<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une course","modify_course.png");
		$infos->printInfos();
	?>
	<form method="post" action="index.php?page=course&action=5" name="formAjout" enctype="multipart/form-data">
		<div class="formulaire">
			<label for="equipe"><strong>Équipe</strong> :</label>
			<?php listeEquipeSelected($course[1]); ?><br /><br />
			<label for="date"><strong>Date de la course</strong> :</label>
			<input type="date" size="7" value="<?php echo $course[2]; ?>" name="date"/><br /><br />
			<label for="lieu"><strong>Lieu de la course</strong> :</label>
			<input type="text" size="60" value="<?php echo $course[3]; ?>" name="lieu"/><br /><br />
			<label for="photo"><strong>Photo de la course</strong> : </label>
			<img src="<?php echo $course[4]; ?>"/><br /><br />
			<input type="file" name="photo" maxlength="1048576" accept="image/*"/><br /><br />
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
					  value = "<?php echo mysql_real_escape_string($course[5]);?>";
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
					  value = "<?php echo mysql_real_escape_string($course[6]);?>";
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
		<a href="index.php?page=course"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
	</div>
</div>
