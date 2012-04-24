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
		{ ?>
			<tr class='blue_tabular_cell'>
				<td class='blue_tabular_cell'> <?php echo $partenaires[$i]["nom_partenaire"]; ?> </td>
				<td class='blue_tabular_cell'><img src="<?php echo $partenaires[$i]['logo_partenaire']; ?>" max-width='150px' maxheight='50px' /></td>
				<td class='blue_tabular_cell'><a href="<?php echo $partenaires[$i]['site_partenaire']; ?>"> <?php echo $partenaires[$i]['site_partenaire'] ?> </a></td>
				<td class='blue_tabular_cell'> <?php echo coupeChaine($partenaires[$i]['descFR_partenaire'],50); ?> </td>
				<td class='blue_tabular_cell'> <?php echo coupeChaine($partenaires[$i]['descEN_partenaire'],50); ?></td>
					
				<td class='blue_tabular_cell'>
					<a style='text-decoration:none;color:green;'  href="index.php?page=partenaires&action=2&idPart=<?php echo $partenaires[$i]['id_partenaire']; ?>">Modifier</a> -
					<a style='text-decoration:none;color:red;' href="index.php?page=partenaires&action=3&idPart=<?php echo $partenaires[$i]['id_partenaire']; ?>">Supprimer</a>
				</td>
			</tr>	
		<?php	
		}
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_album.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=partenaires&action=1"> Ajouter un partenaire </a>
				</td>
			</tr>
		</table>
	</div>
</div>
