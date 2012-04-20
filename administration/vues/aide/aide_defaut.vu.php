<!--
/**********
Page d'aide

	lien vers les aides

		Option 1 : aide administration
		Option 2 : Contact
		Option 3 : Liens utiles
**********/
-->

<div class="contenu">
	<?php
		echo create_title_bar("Besoin d'aide ?", "help.png");
	?>
	<div align=center>
		<br/><br/>
		<table>
			<tr>
				<td>
					<img src="ressources/design/style1/images/help.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=aide&amp;option=1" >Obtenir de l'aide sur l'administration</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="ressources/design/style1/images/contact.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=aide&amp;option=2" >Contacter les administrateurs</a>
				</td>
			</tr>
			<tr>
				<td>
					<img src="ressources/design/style1/images/web.png" />
				</td>
				<td>
					<a class="liens_Action" href="index.php?page=aide&amp;option=3" >Liens utiles</a>
				</td>
			</tr>
		</table>
	</div>	
</div>
