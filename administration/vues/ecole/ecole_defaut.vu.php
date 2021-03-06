<!--
/**********
Page de gestion des écoles

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des écoles","gestion_ecole.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des écoles</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Num école
			</th> 
			<th class="blue_tabular_title">
				Nom de l'école
			</th>
			<th class="blue_tabular_title">
				Adresse de l'école
			</th>
			<th class="blue_tabular_title">
				Nb formations
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
		<?php
			affichageEcoles();
		?>
	</table>
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_ecole.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=ecole&action=1"> Ajouter une école </a>
				</td>
			</tr>
		</table>
	</div>
</div>
