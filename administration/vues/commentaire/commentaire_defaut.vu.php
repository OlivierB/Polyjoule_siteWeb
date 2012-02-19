<!--
/**********
Page de gestion des commentaires

**********/
-->


<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion des commentaire", "gestion_comment.png");
		
		// affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	
	<ul class="section_name">
		<li>Commentaires de l'article : <?php echo $article['titreFR_article'];?></li>
	</ul>
	
	<table>
		<tr>
			<td>
				<img src="<?php echo $_SESSION['design_path']; ?>images/add_comment.png" />
			</td>
			<td>
				<a class="liens_Action" href="index.php?page=commentaire&action=1&id_article=<?php echo $id_article;?>#ajout">Ajouter un commentaire </a>
			</td>
		</tr>
	</table>
	
	<ul class='commentaire'>
	</ul>
	
	<?php
	if(sizeof($commentaires) == 0)
	{
		echo "<ul class='commentaire'>
					<p align='center'>Aucun commentaire sur cet article</p>
				</ul>";
	}
	else
	{
		for($i=0;$i<sizeof($commentaires);$i++)
		{
			echo "<ul class='commentaire'>
						<li>
							<p>
								<span class='posteur'>".$commentaires[$i]['posteur_commentaire']."</span>
								<span class='mail'>(".$commentaires[$i]['mail_commentaire'].")</span>
								<span class='date'>".$commentaires[$i]['date_commentaire']."</span>
								<a class='liens_Action' href='index.php?page=commentaire&action=2&id_article=".$commentaires[$i]['id_article']."&id_com=".$commentaires[$i]['id_commentaire']."'>Modifier</a>
								<a class='liens_Action' href='index.php?page=commentaire&action=3&id_article=".$commentaires[$i]['id_article']."&id_com=".$commentaires[$i]['id_commentaire']."'>Supprimer</a>
							</p>
							<p>
								<span class='message'>".$commentaires[$i]['message_commentaire']."</span>
							</p>
						</li>
					</ul>";
		}
	}	
	?>
	
	<table style="margin-top:20px;">
		<tr>
			<td>
				<img src="<?php echo $_SESSION['design_path']; ?>images/gestion_article.png" />
			</td>
			<td>
				<a class="liens_Action" href="index.php?page=article">Retour à la gestion des articles </a>
			</td>
		</tr>
	</table>

