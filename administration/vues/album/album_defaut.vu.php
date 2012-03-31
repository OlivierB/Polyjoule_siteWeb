<!--
/**********
Page de gestion des albums

**********/
-->



<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des albums","gestion_album.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des albums</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Nom
			</th>
			<th class="blue_tabular_title">
				Date
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
	<?php
		foreach ($listAlbum as $val)
		{ ?>
		<tr class='blue_tabular_cell'>
			<td class='blue_tabular_cell'>
				<a style="text-decoration:none;color:blue;font-weight:bold;" href="index.php?page=album&action=1&idAlbum=<?php  echo $val['id_album']; ?>">
				<?php  echo $val['nom_album'] ?>
				</a> </td>
			<td class='blue_tabular_cell'><?php  echo $val['date_album'] ?></td>
			<td class='blue_tabular_cell'>
				<a style="text-decoration:none;color:green;" href="index.php?page=album&action=4&idAlbum=<?php  echo $val['id_album']; ?>&nomAlbum=<?php  echo $val['nom_album']; ?>">Modifier</a>
				-
				<a style="text-decoration:none;color:red;" href="index.php?page=album&action=5&idAlbum=<?php  echo $val['id_album']; ?>&nomAlbum=<?php  echo $val['nom_album']; ?>">Supprimer</a>
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
					<a class="liens_Action"href="index.php?page=album&action=2"> Ajouter un album </a>
				</td>
			</tr>
		</table>
	</div>
</div>
