<!--
/**********
Page de gestion des formations -> ajout d'une formation

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une formation", "add_formation.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=formation&action=4">
		<div class="formulaire">
			<label for="nomFR" ><strong>Nom</strong> (FR) :</label>
			<input type="text" size="60" value="" name="nomFR"/> <br/><br/>
		
			<label for="nomEN" ><strong>Nom</strong> (EN) :</label>
			<input type="text" size="60" value="" name="nomEN"/> <br/><br/>
		
			<label for="ecole" ><strong>Nom de l'école</strong> :</label>
			<?php listeEcole(); ?><br/><br/>
			
			<label for="lien"><strong>Site internet</strong> :</label>
			<input type="url" size="60" value="" name="lien"/>
		</div>
		<div  class="editor" id="descFR" name="descriptionFR" align="center">
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
	
		<div class="editor" id="descEN" name="descriptionEN" align="center">
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
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=formation"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
