<!--
/**********
Page de gestion des participations

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des participations","gestion_participation.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<?php /**/affichageEquipe();/* ?>
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Num équipe
			</th>
			<th class="blue_tabular_title">
				Année de l'équipe
			</th>
			<th class="blue_tabular_title">
				Nb de participants
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
	<?php
		affichageEquipe();
	?>
	</table>
	<?php /**/ ?>
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_equipe.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=equipe&action=1"> Ajouter une équipe </a><br />
				</td>
			</tr>
		</table>
	</div>
</div>
