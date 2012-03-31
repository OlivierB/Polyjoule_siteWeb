<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* page de connexion de la partie admin
*
-->


<div id='connexion'>
		
	<div class="centre">
		<h2>Service d'authentification du site Polyjoule</h2>
		
		<p>Veuillez saisir votre adresse mail pour recevoir votre nouveau mot de passe.</p>
	</div>
	
	<div id="cadena">
		<img src="ressources/design/style1/images/lock.png"/>
	</div>
	
	<div id="form_connexion">
	
		<form name="connexion" method="post" action="connexion.php?action=3">
			<p>
				<strong><label for="mail">Mail :</label></strong>
				<input id="mail" type="text" value="" name="mail" onKeyPress="Submit_enter(this,event);"/><br/>
			</p>
			<p id="bouton_connexion">
				<a class="button" href="javascript:document.connexion.submit()" >Envoyer</a>
			</p>
		</form>
		
		<?php
		// affichage des erreurs
		$infos->printInfos();
		?>
	</div>
	<div class="centre">
		<a href="index.php" > Retour </a>
	</div>
</div>
