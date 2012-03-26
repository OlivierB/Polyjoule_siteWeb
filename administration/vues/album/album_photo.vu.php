<!--
/**********
Page de gestion du contenu d'un album

**********/
-->



<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des photo","gestion_photo.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des photo de l'album</li>
		
	</ul>
	<a style="text-decoration:none;color:green;" href="index.php?page=album"><p>Retour sur la liste des albums</p></a>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Info
			</th>
			<th class="blue_tabular_title">
				Photo
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
	<?php
		foreach ($listPhoto as $val)
		{ 
			$myFile = $val['lien_photo'];
			$nomFmin = $DirPhoto.$myFile;
			$myFile = str_replace ('_', '', $myFile);
			$nomFmax = $DirPhoto.$myFile;
			
		?>
		<tr class='blue_tabular_cell'>
			<td class='blue_tabular_cell'>
				<?php  echo $val['titreFR_photo'] ?> <br/>
				<?php  echo $val['titreEN_photo'] ?> <br/>
				<?php  echo $val['date_photo'] ?>
			</td>
			<td class='blue_tabular_cell'>
				<a href="<?php echo $nomFmax; ?>" ><img src="<?php  echo $nomFmin ?>" /></a>
				
			</td>
			<td class='blue_tabular_cell'>
				<a style="text-decoration:none;color:green;" href="index.php?page=album&action=6&idPhoto=<?php  echo $val['id_photo']; ?> &idAlbum=<?php  echo $idAlbum; ?>">Modifier</a>
				-
				<a style="text-decoration:none;color:red;" href="index.php?page=album&action=7&idPhoto=<?php  echo $val['id_photo']; ?> &idAlbum=<?php  echo $idAlbum; ?>">Supprimer</a>
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
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_participant.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=album&action=3&idAlbum=<?php  echo $idAlbum; ?>"> Ajouter une photo </a>
				</td>
			</tr>
		</table>
	</div>
</div>
