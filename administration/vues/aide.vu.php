<!--
/**********
Page d'aide

	Option 1 : aide administration
	Option 2 : Contact
	Option 3 : Liens utiles

**********/
-->

<?php
	$Options = array(1,2,3); // Tableau des options possibles

	if( !isset($_GET['option']) )
	{
		?>
		<div class="contenu">
			<?php
				echo create_title_bar("Besoin d'aide ?", "ressources/design/style1/images/help.png");
			?>
			<div align=center>
				<br/><br/>
				<table>
					<tr>
						<td>
							<img src="ressources/design/style1/images/help.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=1" >Obtenir de l'aide sur l'administration</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/contact.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=2" >Envoyer un mail aux administrateurs</a>
						</td>
					</tr>
					<tr>
						<td>
							<img src="ressources/design/style1/images/web.png" />
						</td>
						<td>
							<a class="liens_Action" href="index.php?page=aide&option=3" >Liens utiles</a>
						</td>
					</tr>
				</table>
			</div>	
		</div>
		<?php
	}
	else
	{
		if( $_GET['option']==1 )
		{
			?>
			<div class="contenu">
			<?php
				echo create_title_bar("Aide administration", "ressources/design/style1/images/help.png");
			?>
			</div>
			<?php
		}
		else if( $_GET['option']==2 )
		{
			?>
			<div class="contenu">
			<?php
				echo create_title_bar("Formulaire de contact", "ressources/design/style1/images/contact.png");
			?>
			</div>
			<?php
		}
		else if( $_GET['option']==3 )
		{
			?>
			<div class="contenu">
			<?php
				echo create_title_bar("Liens utiles", "ressources/design/style1/images/web.png");
			?>
			</div>
			<?php
		}
		else
		{
			$informations = Array(/*Erreur*/
							true,
							'Erreur',
							'La page demandée n\'est pas accessible.',
							'index.php',
							2
							);
			require_once('vues/informations.php');
			exit();
		}
	}
