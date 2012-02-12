<!--
/**********
Page de gestion des comptes
Réservé à l'administrateur du site
**********/
-->

<?php
	/* Vérification du statut du membre : si admin autorisation d'accéder à cette page sinon redirection vers l'accueil */
	if(isset($_SESSION['statut_membre']) && $_SESSION['statut_membre']!='admin')
	{
		$informations = Array(/*Erreur*/
						true,
						'Erreur',
						'Vous n\'êtes pas autorisé à accéder à cette page...',
						'index.php',
						2
						);
	require_once('vues/informations.vu.php');
	exit();
	}
	
	$actions = array(1,2,3,4,5); // Tableau des actions possibles
	/*
		Action 1 : Inscrire un membre
		Action 2 : Traitement de l'inscription
		Action 3 : Modifier les informations sur un membre
		Action 4 : Traitement de mise à jour des informations d'un membre
		Action 5 : Traitement de suppression d'un membre
		Defaut : Gestion des membres
	*/

	if(isset($_GET['action']) && in_array(securite($_GET['action']),$actions)) $action = securite($_GET['action']);
	else $action = 0;
	
	if($action == 1) // Inscription d'un membre
	{
		?>
		<div class="contenu">
			<?php
				echo create_title_bar("Inscription d'un membre", "ressources/design/style1/images/add_user.png");
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
		<?php
	}
	else if($action == 2) // Traitement inscription
	{
		if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['statut']))
			register(securite($_POST['pseudo']), securite($_POST['mail']), securite($_POST['statut']));
		header('Location:index.php?page=gestionComptes');
	}
	else
	{
	?>
		<div class="contenu">
			<?php
				echo create_title_bar("Gestion des comptes", "ressources/design/style1/images/gestion_user.png");
			?>
			<ul class="section_name">
				<li>Liste des membres</li>
			</ul>
			
			<table class="blue_tabular">
				<tr class="blue_tabular_title">
					<th class="blue_tabular_title"> <input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=CheckAll('checkAll','checkArticle');"/> </th>
					<th class="blue_tabular_title">Pseudo</th>
					<th class="blue_tabular_title">Adresse mail</th>
					<th class="blue_tabular_title">Statut</th>
				</tr>
				<?php
				for($i=0;$i<sizeof($membres);$i++)
				{
					echo "
						<tr class='blue_tabular_cell'>
							<td class='blue_tabular_cell'>
								<input type='checkbox' name='checkArticle' value='".$membres[$i]['id_membre']."'/>
							</td>
							<td class='blue_tabular_cell'>
								".$membres[$i]['pseudo_membre']."
							</td>
							<td class='blue_tabular_cell'>
								".$membres[$i]['mail_membre']."
							</td>
							<td class='blue_tabular_cell'>
								".$membres[$i]['statut_membre']."
							</td>
						</tr>";
				}
				?>
			</table>
			<div align=center>
				<br/><br/>
				<table>
					<tr>
						<td class="section_name"> Pour la sélection : </td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/edit_user.png" />
						</td>
						<td>
							<a class="liens_Action" href="#" >Modifier les informations d'un utilisateur</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/delete_user.png" />
						</td>
						<td>
							<a class="liens_Action" href="#" >Désinscrire un membre</a>
						</td>
					</tr>
					<tr>
						<td class="section_name"> Autres actions : </td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/add_user.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=gestionComptes&action=1" >Inscrire un utilisateur</a>
						</td>
					</tr>
				</table>
			</div>
		</div>
		<?php
	}
?>

