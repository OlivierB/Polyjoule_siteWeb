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
		
		affichageEquipe2();
	
	?>
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_participation.png" />
				</td>
				<td>
					<a class="liens_Action"href="index.php?page=participation&action=1"> Ajouter une participation </a>
				</td>
			</tr>
		</table>
	</div>
</div>
