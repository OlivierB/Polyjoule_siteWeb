<!--
/**********
Page d'inscription d'un membre
Réservé aux administrateurs
**********/
-->
	
<div class="contenu">
	<?php
		echo create_title_bar("Inscription d'un membre", "ressources/design/style1/images/add_user.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<form name="addUser" method="POST" action="index.php?page=gestionComptes&action=2">
		<div class="formulaire">
			<p>
				<label for="pseudo" >Pseudo : </label>
				<input type="text" size="50" value="" name="pseudo"/><br/>
				
				<label for="mail" >Adresse mail : </label>
				<input type="text" size="50" value="" name="mail"/><br/>
				
				<label for="statut" >Statut : </label>
				<input type="radio" value="admin" name="statut"/> Administrateur
				<input type="radio" checked="checked" value="user" name="statut"/> Utilisateur
			</p>
		</div>
	
		<div align="center">
			<a href="javascript:document.addUser.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>
			<a href="index.php?page=gestionComptes"> <img src="ressources/design/style1/images/cancel.png"/></a>
		</div>
		
	</form>
</div>