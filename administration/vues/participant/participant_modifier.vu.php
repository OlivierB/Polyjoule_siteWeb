<!--
/**********
Page de modification d'un participant
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Modification d'un participant", "modify_participant.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="editUser" method="post" action="index.php?page=participant&action=5"  enctype="multipart/form-data">
		<div class="formulaire">
			<input type="text" hidden="hidden" name="id" value="<?php echo $idPart; ?>" />
			
			<label for="nom" >Nom : </label>
			<input type="text" size="50" value="<?php echo $part[1]; ?>" name="nom"/><br/>
			
			<label for="prenom" >Prénom : </label>
			<input type="text" size="50" value="<?php echo $part[2]; ?>" name="prenom"/><br/>
			
			<label for="mail" >Mail : </label>
			<input type="email" size="50" value="<?php echo $part[4]; ?>" name="mail"/><br/>
			
			<label for="role" >Rôle : </label>
			<input type="text" size="50" value="<?php echo $part[5]; ?>" name="role"/><br/>
			
			<label for="photo">Photo : </label>
			<img src="<?php echo $part[3]; ?>"/>
		</div>
		
		<div  class="editor" id="bioFR" name="bioFR" align="center">
		</div>
	
		<script language="javascript" type="text/javascript">
		  with (document.getElementById ("bioFR")) {
			with (appendChild (document.createElement ("TEXTAREA"))) {
			  name = "bioFR";
			  cols = 120;
			  rows = 25;
			  value = "<?php echo mysql_real_escape_string($part[6]);?>";
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
			  value = "<?php echo mysql_real_escape_string($part[7]);?>";
			}
		  }
		//-->
		</script>
		<noscript>
		  The editor requires scripting to be enabled.
		</noscript>
		<noscript>mce:3</noscript>
		<div align="center">
			<a href="javascript:document.editUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>
