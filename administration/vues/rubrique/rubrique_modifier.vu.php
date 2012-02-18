<div class="contenu">
	<?php
		echo create_title_bar("Mise à jour d'une rubrique", "modify_rubrique.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form method="post" name="formAjout" action="index.php?page=rubrique&action=5">
		<div class="formulaire">
				<p>
					<input type="hidden" name="rubrique_id" value="<?php echo $rubrique[0]; ?>"/>
				
					<label for="titleFR">Titre(FR) :</label>
					<input type="text"  size="60" value="<?php echo $rubrique[2]; ?>" name="titleFR"/> <br/><br/>
				
					<label for="titleEN" >Titre(EN) :</label>
					<input type="text"  size="60" value="<?php echo $rubrique[3]; ?>" name="titleEN"/> <br/><br/>
				
					<label for="rubrique"> Rubrique mère: </label>
					<?php
						listeRubriqueSelected($rubrique[1],$rubrique[0]);
					?>
				</p>
		</div>
		<div  class="editor" id="descriptionFR" align="center">
		</div>

		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("descriptionFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "descriptionFR";
			  cols = 120;
			  rows = 25;
			  value = "<?php echo mysql_real_escape_string($rubrique[4]);?>";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
	
		<div  class="editor" id="descriptionEN" align="center">
		</div>

		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("descriptionEN")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "descriptionEN";
			  cols = 120;
			  rows = 25;
			  value = "<?php echo mysql_real_escape_string($rubrique[5]);?>";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
		<div align="center">
			<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=rubrique"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
