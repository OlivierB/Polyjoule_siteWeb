<!--/**********Page de gestion du profil**********/--><?php $actions = array(1,2,3,4,5,6); // Tableau des actions possibles/*	Action 1 : modifier pseudo	Action 2 : modifier mot de passe	Action 3 : modifier email	Action 4 : Traitement modification pseudo	Action 5 : Traitement modification mot de passe	Action 6 : traitement modification email	Default : Affichage du profil*/if(isset($_GET['action']) && in_array($_GET['action'],$actions)){	$action = securite($_GET['action']);	if ($action==1) { //modifier pseudo		?>			<div class="contenu">				<?php echo create_title_bar("Modification du pseudo", "ressources/design/style1/images/modify_profil.png"); ?>				<div class="formulaire">					<strong>Information</strong> : Vous serez déconnecté une fois la procédure achevée si tout s'est bien passé.<br /><hr />					<form name="formPseudo" method="post" action="index.php?page=profil&action=4">						<label for="pseudo"><strong>Pseudo</strong> :</label>						<input type="text" size="20" value="<?php echo $_SESSION['pseudo_membre']; ?>" name="pseudo"/>					</form>				</div>				<div align="center">						<a href="javascript:document.formPseudo.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>						<a href="index.php?page=profil"> <img src="ressources/design/style1/images/cancel.png"/></a>				</div>			</div>		<?php	} else if ($action==2) { //modifier mot de passe		?>			<div class="contenu">				<?php echo create_title_bar("Modification du mot de passe", "ressources/design/style1/images/modify_profil.png"); ?>				<div class="formulaire">					<strong>Information</strong> : Vous serez déconnecté une fois la procédure achevée si tout s'est bien passé.<br /><hr />					<form name="formProfil" method="post" action="index.php?page=profil&action=5">						<label for="ancien"><strong>Mot de passe actuel</strong> :</label>						<input type="password" size="20" value="" name="ancien"/><br /><br /><br />						<label for="mdp"><strong>Mot de passe</strong> :</label>						<input type="password" size="20" value="" name="mdp"/><br /><br />						<label for="mdp2"><strong>Confirmation</strong> :</label>						<input type="password" size="20" value="" name="mdp2"/>					</form>				</div>				<div align="center">						<a href="javascript:document.formProfil.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>						<a href="index.php?page=profil"> <img src="ressources/design/style1/images/cancel.png"/></a>				</div>			</div>		<?php	} else if ($action==3) { //modifier email		?>		<div class="contenu">				<?php echo create_title_bar("Modification de l'email", "ressources/design/style1/images/modify_profil.png"); ?>				<div class="formulaire">					<form name="formMail" method="post" action="index.php?page=profil&action=6">						<label for="mail"><strong>Nouvel E-mail</strong> :</label>						<input type="email" size="20" value="" name="mail"/><br /><br />						<label for="mail2"><strong>Confirmation</strong> :</label>						<input type="email" size="20" value="" name="mail2"/>					</form>				</div>				<div align="center">						<a href="javascript:document.formMail.submit();"> <img src="ressources/design/style1/images/validate.png"/></a>						<a href="index.php?page=profil"> <img src="ressources/design/style1/images/cancel.png"/></a>				</div>			</div>		<?php	} else if ($action==4) { //Traitement modification pseudo		if (isset($_POST['pseudo'])) {			MAJPseudo(securite($_POST['pseudo']));		} else {			header("Location: index.php?page=profil&message=erreurFormulaire");		}	} else if ($action==5) { //Traitement modification mot de passe		if (isset($_POST['ancien']) && isset($_POST['mdp']) && isset($_POST['mdp2'])) {			MAJMotDePasse(sha1(securite($_POST['ancien'])),sha1(securite($_POST['mdp'])),sha1(securite($_POST['mdp2'])));		} else {			header("Location: index.php?page=profil&message=erreurFormulaire");		}	} else if ($action==6) { //traitement modification email		if (isset($_POST['mail']) && isset($_POST['mail2'])) {			MAJMail(securite($_POST['mail']),securite($_POST['mail2']));		} else {			header("Location: index.php?page=profil&message=erreurFormulaire");		}	} else { //affichage du profil		header("Location: index.php?page=profil");	}} else {	?>			<div class="contenu">                  <?php echo create_title_bar("Profil","ressources/design/style1/images/gestion_profil.png"); ?>    <?php    if (isset($_GET['message'])) { /* si il y a un message*/     ?>      <div style="background-color : #f0f0ee;margin : 10px 12px 20px 13px;border : 1px solid #cccccc;text-align:left; padding-left :20px;">      <strong>Message :</strong>     <?php     echo getMessage(securite($_GET['message']));     ?>      </div>     <?php    }    ?>    <div class="formulaire">     <strong>Pseudo</strong> : <?php echo getPseudo(); ?><br /><br />     <?php echo changementPseudo(); ?><br /><br />     <a href='index.php?page=profil&action=2'>Changement du mot de passe</a><br /><br />     <strong>Mail</strong> : <?php echo getMail(); ?><br /><br />     <a href="index.php?page=profil&action=3">Changement de l'adresse mail</a>    </div>   </div>		</div>	<?php}?>