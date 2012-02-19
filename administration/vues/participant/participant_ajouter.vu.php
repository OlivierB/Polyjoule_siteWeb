<!--
/**********
Page d'inscription d'un participant
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Ajout d'un participant", "add_participant.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="addUser" method="post" action="index.php?page=participant&action=4"  enctype="multipart/form-data">
		<div class="formulaire">
				<label for="nom" >Nom : </label>
				<input type="text" size="50" value="" name="nom"/><br/>
				
				<label for="prenom" >Prénom : </label>
				<input type="text" size="50" value="" name="prenom"/><br/>
				
				<label for="mail" >Mail : </label>
				<input type="email" size="50" value="" name="mail"/><br/>
				
				<label for="role" >Rôle : </label>
				<input type="text" size="50" value="" name="role"/><br/>
				
				<label for="photo">Photo : </label>
				<input type="file" name="photo" maxlength="1048576" accept="image/*"/>
		</div>
		
		<div  class="editor" id="bioFR" name="bioFR" align="center">
		</div>
	
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("bioFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "bioFR";
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
	
		<div class="editor" id="bioEN" name="bioEN" align="center">
		</div>
		
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("bioEN")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "bioEN";
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
			<a href="javascript:document.addUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>
