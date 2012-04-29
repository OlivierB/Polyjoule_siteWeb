<!--
/**********
Page de gestion des participants

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des polyjoulistes","gestion_participant.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des polyjoulistes</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				ID
			</th>
			<th class="blue_tabular_title">
				Nom
			</th> 
			<th class="blue_tabular_title">
				Prénom
			</th>
			<th class="blue_tabular_title">
				Nb participations
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
		<?php
			affichageParticipant();
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_participant.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=participant&action=1"> Ajouter un participant </a>
				</td>
			</tr>
		</table>
	</div>
</div>
