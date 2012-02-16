<!--
/**********
Page de gestion des comptes
Réservé aux administrateurs
**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Gestion des comptes", "gestion_user.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	<ul class="section_name">
		<li>Liste des membres</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title"> <input type='checkbox' name="checkAll" id="checkAll" onClick="this.checked=CheckAll('checkAll','checkMembre');"/> </th>
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
						<input type='checkbox' name='checkMembre' value='".$membres[$i]['id_membre']."'/>
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/edit_user.png" />
				</td>
				<td>
					<a class="liens_Action"  href="#" onclick="window.location.href=recuperer_selection('checkMembre',<?php echo sizeof($membres);?>,'index.php?page=gestionComptes&action=3');" >Modifier les informations d'un utilisateur</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/delete_user.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkMembre',<?php echo sizeof($membres);?>,'index.php?page=gestionComptes&action=5');" >Désinscrire un membre</a>
				</td>
			</tr>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_user.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=gestionComptes&action=1" >Inscrire un utilisateur</a>
				</td>
			</tr>
		</table>
	</div>
</div>
