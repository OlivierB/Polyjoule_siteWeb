<!--
/**********
Page de modification des informations d'un membre
Réservé aux administrateurs
**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Modifier les informations d'un membre", "edit_user.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<div class="photo_membre">
		<img src="<?php echo $membre['photo_membre']; ?>" />
	</div>
	<form name="modifyUser" method="POST" action="index.php?page=gestionComptes&action=4">
		<div class="formulaire">
			<p>
				<label for="pseudo" >Pseudo : </label>
				<input type="text" size="50" value="<?php echo $membre['pseudo_membre']; ?>" name="pseudo"/><br/><br/>
				
				<label for="mail" >Adresse mail : </label>
				<input type="text" size="50" value="<?php echo $membre['mail_membre']; ?>" name="mail"/><br/><br/>
				
				<label for="statut" >Statut : </label>
				<input type="radio" value="admin" <?php if($membre['statut_membre']=='admin') echo "checked='checked'";?> name="statut"/> Administrateur
				<input type="radio" <?php if($membre['statut_membre']=='user') echo "checked='checked'";?> value="user" name="statut"/> Utilisateur<br/><br/>
				
				<label for="photo_membre" >Changer la photo membre :</label>
				<input type="hidden" name="MAX_FILE_SIZE" value="2097152" />
            <input type="file" name="photo_membre" id="photo_membre" />
                
				<input type="hidden" value="<?php echo $membre['id_membre'];?>" name="id"/>
			</p>
		</div>
	
		<div align="center">
			<a href="javascript:document.modifyUser.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
			<a href="index.php?page=gestionComptes"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
		</div>
		
	</form>
</div>


