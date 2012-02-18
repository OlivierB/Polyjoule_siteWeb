<!--
/**********
Page de gestion des rubriques

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des rubriques","gestion_rubrique.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des rubriques</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Numéro Rubrique
			</th> 
			<th class="blue_tabular_title">
				Titre de la rubrique (FR)
			</th>
			<th class="blue_tabular_title">
				Titre de la rubrique (EN)
			</th>
			<th class="blue_tabular_title">
				Nombre d'articles
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
		<?php
			affichageRubriques(null,0);
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_rubrique.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=rubrique&action=1"> Ajouter une rubrique </a>
				</td>
			</tr>
		</table>
	</div>
</div>
