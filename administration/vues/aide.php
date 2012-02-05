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
			<h1> Besoin d'aide ? </h1>
			<div align=center>
			<table>
				<tr>
					<td>
						<img width="50px" height="50px" src="ressources/design/style1/images/help.png" />
					</td>
					<td>
						<a href="index.php?page=aide&option=1" >Obtenir de l'aide sur l'administration</a>
					</td>
				</tr>
				<tr>
					<td>
						<img width="50px" height="50px" src="ressources/design/style1/images/contact.png" />
					</td>
					<td>
						<a href="index.php?page=aide&option=2" >Envoyer un mail aux administrateurs</a>
					</td>
				</tr>
				<tr>
					<td>
						<img width="50px" height="50px" src="ressources/design/style1/images/web.png" />
					</td>
					<td>
						<a href="index.php?page=aide&option=3" >Liens utiles</a>
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
				<h1> Aide Administration </h1>
			</div>
			<?php
		}
		else if( $_GET['option']==2 )
		{
			?>
			<div class="contenu">
				<h1> Formulaire de contact </h1>
			</div>
			<?php
		}
		else if( $_GET['option']==3 )
		{
			?>
			<div class="contenu">
				<h1> Liens utiles </h1>
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
