<!--
/**********
Page de gestion des équipes -> ajout d'une équipe

**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'une équipe", "add_equipe.png"); 
		$infos->printInfos();
	?>
	<form name="formAjout" method="post" action="index.php?page=equipe&action=4">
		<div class="formulaire">
			<label for="annee" ><strong>Année</strong> :</label>
			<input type="text" size="60" value="" name="annee"/> <br/><br/>
		</div>
		<div align="center">
				<a href="javascript:document.formAjout.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
				<a href="index.php?page=equipe"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
	</form>
</div>
