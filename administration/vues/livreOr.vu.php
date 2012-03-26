<!--
/**********
Page de gestion du contenu du livre d'Or

**********/
-->



<div class="contenu" align="center">
	<?php
		echo create_title_bar("Gestion du livre d'Or","gestion_livreOr.png");
		
		//affichage succès ou erreurs
		$infos->printInfos();
	?>
	
	<ul class="section_name">
		<li>Liste des commentaires</li>
	</ul>
	
	<table class="blue_tabular">
		<tr class="blue_tabular_title">
			<th class="blue_tabular_title">
				Posteur
			</th>
			<th class="blue_tabular_title">
				Message
			</th>
			<th class="blue_tabular_title">
				Administration
			</th>
		</tr>
	<?php
		foreach ($listPost as $val)
		{ ?>
		<tr class='blue_tabular_cell'>
			<td class='blue_tabular_cell'><?php  echo $val['posteur_post'] ?><br/>(<?php  echo $val['mail_post'] ?>)</td>
			<td class='blue_tabular_cell'><?php  echo $val['message_post'] ?></td>
			<td class='blue_tabular_cell'>
				<?php  if ($val['accept_post'] == 0)
				{ ?>
					<a style="text-decoration:none;color:green;" href="index.php?page=livreOr&action=1&idPost=<?php  echo $val['id_post']; ?> &numPage=<?php  echo $numPage; ?>">Accecpter</a>
				
				<?php 
				} else
				{
					echo 'Accecpter';
				}?>
				-
				<a style="text-decoration:none;color:red;" href="index.php?page=livreOr&action=2&idPost=<?php  echo $val['id_post']; ?> &numPage=<?php  echo $numPage; ?>">Supprimer</a>
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
				<td class="section_name"> 
					<?php
						for ($i = 1; $i <= $pageTot; $i++) {
							echo "<a href=\"index.php?page=livreOr&amp;numPage=$i\"> $i </a>";
						}
					?>
				 </td>
			</tr>
		</table>
	</div>
</div>
