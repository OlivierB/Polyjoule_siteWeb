<!--
/**********
Page de gestion des écoles

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des courses","gestion_course.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des écoles</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Num
			</th> 
			<th class="blue_tabular_title">
				Équipe
			</th>
			<th class="blue_tabular_title">
				Date
			</th>
			<th class="blue_tabular_title">
				Lieu
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
		<?php
			affichageCourses();
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_course.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=course&action=1"> Ajouter une course </a>
				</td>
			</tr>
		</table>
	</div>
</div>
