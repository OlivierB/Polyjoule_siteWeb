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
	require_once('vues/informations.php');
	exit();
	}
?>

<div class="contenu">
	<?php
		echo create_title_bar("Gestion des comptes", "ressources/design/style1/images/gestion_user.png");
	?>
	<ul class="section_name">
		<li>Liste des membres</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_cell">
			<th class="blue_tabular_cell"> <input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=CheckAll('checkAll','checkArticle');"/> </th>
			<th class="blue_tabular_cell">Pseudo</th>
			<th class="blue_tabular_cell">Adresse mail</th>
			<th class="blue_tabular_cell">Statut</th>
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
					<a class="liens_Action" href="#" >Inscrire un utilisateur</a>
				</td>
			</tr>
		</table>
	</div>
</div>


