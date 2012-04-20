<!--
/**********
Page de gestion des articles

**********/
-->


<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des articles", "gestion_article.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	
	<ul class="section_name">
		<li>Liste des articles</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				<input type='checkbox' name="checkAll" id="checkAll" onClick="CheckAll('checkAll','checkArticle');"/>
			</th>
			<th class="blue_tabular_title">
				Titre FR
			</th>
			<th class="blue_tabular_title">
				Titre EN
			</th >
			<th class="blue_tabular_title">
				Auteur
			</th>
			<th class="blue_tabular_title">
				Rubrique
			</th>
			<th class="blue_tabular_title">
				Commentaires autorisés
			</th>
			<th class="blue_tabular_title">
				Statut
			</th>
			<th class="blue_tabular_title">
				Date d'ajout
			</th>
			<th class="blue_tabular_title">
				Nombre de commentaires
			</th>
			<th class="blue_tabular_title">
				A la une
			</th>
		</tr>
		
		<?php
		for($i=0;$i<sizeof($articles);$i++)
		{
			echo "<tr class='blue_tabular_cell'>
					<td class='blue_tabular_cell'>
						<input type='checkbox' name='checkArticle' value='".$articles[$i]["id_article"]."'/>
					</td>
					<td class='blue_tabular_cell'>".coupeChaine($articles[$i]["titreFR_article"],50)."</td>
					<td class='blue_tabular_cell'>".coupeChaine($articles[$i]["titreEN_article"],50)."</td>
					<td class='blue_tabular_cell'>".$articles[$i]["auteur_article"]."</td>
					<td class='blue_tabular_cell'>".$articles[$i]["titreFR_rubrique"]."</td>";
			if ($articles[$i]["autorisation_com"])
				echo "<td class='blue_tabular_cell'>Oui</td>";
			else
				echo "<td class='blue_tabular_cell'>Non</td>";
			if ($articles[$i]["statut_article"])
				echo "<td class='blue_tabular_cell'>En ligne</td>";
			else
				echo "<td class='blue_tabular_cell'> -- </td>";
			echo "<td class='blue_tabular_cell'>".$articles[$i]["date_article"]."</td>";
			
			echo"<td class='blue_tabular_cell'>".sizeof($articles[$i]["commentaires"])."</td>";
			
			if ($articles[$i]["visible_home"])
				echo "<td class='blue_tabular_cell'>Oui</td></tr>";
			else
				echo "<td class='blue_tabular_cell'> Non</td></tr>";
			
		}
		
		?>
	</table>
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td class="section_name"> Pour la sélection : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/modify_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkArticle',<?php echo sizeof($articles);?>,'index.php?page=article&action=2');">Modifier</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/delete_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkArticle',<?php echo sizeof($articles);?>,'index.php?page=article&action=5');">Supprimer</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/gestion_comment.png" />
				</td>
				<td>
					<a class="liens_Action" href="#" onclick="window.location.href=recuperer_selection('checkArticle',<?php echo sizeof($articles);?>,'index.php?page=article&action=6');">Gerer les commentaires</a>
				</td>
			</tr>
			<tr>
				<td class="section_name"> Autres actions : </td>
			</tr>
			<tr>
				<td>
					<img src="<?php echo $_SESSION['design_path']; ?>images/add_article.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=article&action=1">Ajouter un article </a>
				</td>
			</tr>
		</table>
	</div>	
</div>
