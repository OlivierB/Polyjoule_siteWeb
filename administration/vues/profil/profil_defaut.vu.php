<!--
/**********
Page de gestion du profil

**********/
-->

<div class="contenu">
	<?php 
		echo create_title_bar("Profil","gestion_profil.png"); 
		// affichage succès ou erreurs
		$infos->printInfos();
	?>

	<div class="photo_membre">
		<img src="<?php echo $profil['photo_membre']; ?>" />
	</div>
	
	<div class="formulaire">
		<strong>Pseudo</strong> : <?php echo $profil['pseudo_membre']; ?>
		<?php if(isset($lienChgtPseudo)) echo $lienChgtPseudo; ?><br /><br />
		<a href='index.php?page=profil&action=2'>Changement du mot de passe</a><br /><br />
		<strong>Mail</strong> : <?php echo $profil['mail_membre'] ?><br /><br />
		<a href="index.php?page=profil&action=3">Changement de l'adresse mail</a><br /><br />
		
		<a href="index.php?page=profil&action=7">Changement de photo</a>
	</div>
</div>
