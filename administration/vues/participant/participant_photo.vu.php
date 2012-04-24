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
	<form name="editUser" method="post" action="index.php?page=participant&action=8"  enctype="multipart/form-data">
		<div class="formulaire">
			<input type="text" hidden="hidden" name="id" value="<?php echo $idPart; ?>" />
			
			<label for="nom" >Nom : </label><?php echo $part[1]; ?><br /><br />
			
			<label for="prenom" >Prénom : </label><?php echo $part[2]; ?><br /><br />
			
			<label for="anciennePhoto">Photo : </label>
			<img src="ressources/data/Participants/<?php echo $part['photo_participant']; ?>" width="100px" height="100px"/><br/><br/>
			
			<label for="photo">Changer la photo : </label>
			<input type="file" name="photo" maxlength="1048576" accept="image/*"/>
			
		</div>
		<div align="center">
			<a href="javascript:document.editUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=participant"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>
