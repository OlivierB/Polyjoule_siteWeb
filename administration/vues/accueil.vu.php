<!--
/**********
Page d'accueil
page par défaut lors de l'affichage

**********/
-->

<div class="contenu" style="z-index:0;">
	<?php echo create_title_bar("Panneau d'administration", "ressources/design/style1/images/admin.png"); ?>
	
	<table id="interface">
		<tr>
			<td id="raccourci">
				<table id="img_raccourci">
					<tr>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=article&action=1';">
								<img class="img_icone" src="ressources/design/classique/images/gestion_article.png"/></br>
								Ajouter un article
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='index.php?page=article';">
								<img class="img_icone" src="ressources/design/classique/images/gestion_article.png"/><br/>
								Gestion des articles
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/classique/images/gestion_cat.png"/><br/>
								Gestion des catégories</a>
							</div>
						</td>
					</tr>
					<tr>
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/classique/images/gestion_media.png"/><br/>
								Gestion des médias
							</div>
						</td>
						<td>
							<div class="icone_gestion" onclick="window.location.href='#';">
								<img class="img_icone" src="ressources/design/classique/images/gestion_menus.png"/><br/>
								Gestion des menus
							</div>
						</td>
					</tr>
				</table>
			</td>
			<td id="statInfo">
					<h3> Les 5 derniers articles ajoutés </h3>
					<h3> Les 5 articles les plus consultés </h3>
					<h3> Les 5 derniers messages du livre d'or </h3>
			</td>
		</tr>
	</table>
</div>

