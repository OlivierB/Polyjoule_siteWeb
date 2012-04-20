<!--
/**********
Page d'accueil
page par défaut lors de l'affichage

**********/
-->

<div class="contenu" style="z-index:0;">
	<?php echo create_title_bar("Panneau d'administration", "admin.png"); 
	
	// affichage des erreurs ou succes
	$infos->printInfos();
	
	?>
	
	<table id="interface">
		<tr>
			<td id="raccourci">
				<table id="img_raccourci">
					<tr>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=article&action=1';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_article.png"/></br>
								Ajouter un article
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=article';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_article.png"/><br/>
								Gestion des articles
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=rubrique';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_rubrique.png"/><br/>
								Gestion des rubriques</a>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=album';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_media.png"/><br/>
								Gestion des médias
							</div>
						</td>
						<!--
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_menus.png"/><br/>
								Gestion des menus
							</div>
						</td>
						-->
					</tr>
				</table>
			</td>
			<td id="statInfo">
					<h3> Derniers articles ajoutés : </h3>
					
					<?php
					if (!empty($article))
					{
						foreach ($article as $cleArticle) 
						{
						?>
							<p>
								<b style="text-decoration:none;color:black;" ><?php echo $cleArticle['date_article'] ; ?> : </b> <a style="text-decoration:none;color:blue;" href="index.php?page=article&action=2&id=<?php echo $cleArticle['id_article'] ; ?>" ><?php echo $cleArticle['titreFR_article'] ; ?></a>
							<p>
						<?php
						}
					} else
					{
						echo "...";
					}
					?>
			</td>
		</tr>
	</table>
</div>

