<!--
/**********
Page de modification d'un commentaire

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
	for($i=0;$i<sizeof($commentaires);$i++)
	{
		if($commentaires[$i]['id_commentaire'] != $id_com)
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
		else
		{
			echo "<ul class='commentaire'>
						<li>
							<p>
								<span class='posteur'>".$commentaires[$i]['posteur_commentaire']."</span>
								<span class='mail'>(".$commentaires[$i]['mail_commentaire'].")</span>
								<span class='date'>".$commentaires[$i]['date_commentaire']."</span>
								<a class='liens_Action' href='index.php?page=commentaire&action=2&id_article=".$commentaires[$i]['id_article']."&id_com=".$commentaires[$i]['id_commentaire']."'>Modifier</a>
								<a class='liens_Action' href='index.php?page=commentaire&action=3&id_article=".$commentaires[$i]['id_article']."&id_com=".$commentaires[$i]['id_commentaire']."'>Supprimer</a>
							</p>";
			?>
			<div id="modif" name="modif">
				<form name="ajoutCom" method="POST" action="index.php?page=commentaire&id_article=<?php echo $id_article;?>&action=5">
					<div align="center">
						<p>
							<textarea name="message"><?php echo $commentaires[$i]['message_commentaire'] ?></textarea>
							<input type="hidden" value="<?php echo $commentaires[$i]['id_commentaire']; ?>" name="id_com"/>
						</p>
					
						<a href="javascript:document.ajoutCom.submit();"> <img src="<?php echo $_SESSION['design_path']; ?>images/validate.png"/></a>
						<a href="index.php?page=commentaire&id_article=<?php echo $id_article; ?>"> <img src="<?php echo $_SESSION['design_path']; ?>images/cancel.png"/></a>
					</div>
				</form>
			</div>
			<?php
			echo "</li></ul>";
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

