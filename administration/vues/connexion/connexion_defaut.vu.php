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
		
		<p>Pour vous identifier et accéder à l'interface d'administration, veuillez entrer 
			vos codes personnels et valider en cliquant sur le bouton connexion.</p>
	</div>
	
	<div id="cadena">
		<img src="ressources/design/style1/images/lock.png"/>
	</div>
	
	<div id="form_connexion">
	
		<form name="connexion" method="post" action="connexion.php?action=1">
			<p>
				<strong><label for="login">Login :</label></strong>
				<input id="login" type="text" value="" name="login" onKeyPress="Submit_enter(this,event);"/>
			</p>
			<p>
				<strong><label for="passwd">Password : </label></strong>
				<input id="passwd" type="password" value="" name="passwd" onKeyPress="Submit_enter(this,event);"/>
			</p>
			<p id="bouton_connexion">
				<a class="button" href="javascript:document.connexion.submit()" >Connexion</a>
			</p>
			
			<a href="connexion.php?action=2">Mot de passe oublié ?</a>
		</form>
		
		<?php
		// affichage des erreurs
		$infos->printInfos();
		?>
	</div>
</div>
