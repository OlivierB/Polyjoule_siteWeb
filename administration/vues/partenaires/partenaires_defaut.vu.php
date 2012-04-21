<!--
/**********
Page de gestion des partenaires

**********/
-->

<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des partenaires","gestion_partenaires.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des partenaires</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Nom
			</th> 
			<th class="blue_tabular_title">
				Logo
			</th>
			<th class="blue_tabular_title">
				Site web
			</th>
			<th class="blue_tabular_title">
				Description FR
			</th>
			<th class="blue_tabular_title">
				Description EN
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
		<?php
		for($i=0;$i<sizeof($partenaires);$i++)
		{
			echo "<tr class='blue_tabular_cell'>
					<td class='blue_tabular_cell'>".$partenaires[$i]["nom_partenaire"]."</td>
					<td class='blue_tabular_cell'><img src='".$partenaires[$i]["logo_partenaire"]."' width='50px' height='30px' /></td>
					<td class='blue_tabular_cell'><a href='".$partenaires[$i]["site_partenaire"]."'>".$partenaires[$i]["site_partenaire"]."</a></td>
					<td class='blue_tabular_cell'>".coupeChaine($partenaires[$i]["descFR_partenaire"],20)."</td>
					<td class='blue_tabular_cell'>".coupeChaine($partenaires[$i]["descEN_partenaire"],20)."</td>";
					
			echo "<td class='blue_tabular_cell'><a style='text-decoration:none;color:green;' href='index.php?page=partenaires&action=2&idPart=".$partenaires[$i]['id_partenaire']."'>Modifier</a> - ";
			echo "<a style='text-decoration:none;color:red;' href='index.php?page=partenaires&action=3&idPart=".$partenaires[$i]['id_partenaire']."'>Supprimer</a></td></tr>";			
		}
		
		?>
	</table>
</div>
