<!--
/**********
Page de gestion des formations

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des formations","gestion_formation.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des formations</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Num formation
			</th>
			<th class="blue_tabular_title">
				Nom de la formation (FR)
			</th>
			<th class="blue_tabular_title">
				Nom de l'école
			</th>
			<th class="blue_tabular_title">
				Nb inscrits
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
	<?php
		affichageFormations();
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_formation.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=formation&action=1"> Ajouter une formation </a>
				</td>
			</tr>
		</table>
	</div>
</div>
