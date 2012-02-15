<!--
/**********
Page de modification des informations d'un membre
Réservé aux administrateurs
**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Modifier les informations d'un membre", "ressources/design/style1/images/edit_user.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="modifyUser" method="POST" action="index.php?page=gestionComptes&action=4">
		<div class="formulaire">
			<p>
				<label for="pseudo" >Pseudo : </label>
				<input type="text" size="50" value="<?php echo $membre['pseudo_membre']; ?>" name="pseudo"/><br/>
				
				<label for="mail" >Adresse mail : </label>
				<input type="text" size="50" value="<?php echo $membre['mail_membre']; ?>" name="mail"/><br/>
				
				<label for="statut" >Statut : </label>
				<input type="radio" value="admin" <?php if($membre['statut_membre']=='admin') echo "checked='checked'";?> name="statut"/> Administrateur
				<input type="radio" <?php if($membre['statut_membre']=='user') echo "checked='checked'";?> value="user" name="statut"/> Utilisateur
				
				<input type="hidden" value="<?php echo $membre['id_membre'];?>" name="id"/>
			</p>
		</div>
	
		<div align="center">
			<a href="javascript:document.modifyUser.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>
			<a href="index.php?page=gestionComptes"> <img src="ressources/design/style1/images/cancel.png"/></a>
		</div>
		
	</form>
</div>


