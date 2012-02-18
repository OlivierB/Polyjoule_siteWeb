<!--
/**********
Page de gestion des rubriques -> ajout d'une rubrique

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une rubrique", "add_rubrique.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=rubrique&action=4">
		<div class="formulaire">
			<label for="titleFR" >Titre(FR) :</label>
			<input type="text" size="60" value="" name="titleFR"/> <br/><br/>
		
			<label for="titleEN" >Titre(EN) :</label>
			<input type="text" size="60" value="" name="titleEN"/> <br/><br/>
		
			<label for="rubriqueMère" >Rubrique mère :</label>
			<?php listeRubrique(); ?>
		</div>
		<div  class="editor" id="descriptionFR" name="descriptionFR" align="center">
		</div>
	
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("descriptionFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "descriptionFR";
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
	
		<div class="editor" id="descriptionEN" name="descriptionEN" align="center">
		</div>
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("descriptionEN")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "descriptionEN";
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
				<a href="index.php?page=rubrique"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
