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
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_rubrique.png"/><br/>
								Gestion des catégories</a>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_media.png"/><br/>
								Gestion des médias
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/style1/images/gestion_menus.png"/><br/>
								Gestion des menus
							</div>
						</td>
					</tr>
				</table>
			</td>
			<td id="statInfo">
					<h3> Les 5 derniers articles ajoutés </h3>
					
					<?php
					if (!empty($article))
					{
						foreach ($article as $cleArticle) 
						{
						?>
							<p>
								<b><?php echo $cleArticle['titreFR_article'] ; ?> :</b> <?php echo  coupeChaine(stripcslashes ($cleArticle['contenuFR_article']), 50) ; ?>
							<p>
						<?php
						}
					} else
					{
						echo "Pas d'article";
					}
					?>
					
					<hr/>
					<h3> Les 5 articles les plus consultés </h3>
					
					<p>...</p>
					
					<hr/>
					
					
					<h3> Les 5 derniers messages du livre d'or </h3>
					
					<?php
					if (!empty($livre))
					{
						foreach ($livre as $cleLivre) 
						{
						?>
							<p>
								<b><?php echo $cleLivre['posteur_post']."  (<i>".formatDate($cleLivre['date_post'])."</i>)" ; ?> :</b> <?php echo  coupeChaine(stripcslashes ($cleLivre['message_post']), 50) ; ?>
							<p>
						<?php
						}
					} else
					{
						echo "Livre d'or vide !";
					}
					?>
	
			</td>
		</tr>
	</table>
</div>

