<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
-->

<?php

// fonctions
include("modeles/functions.php");

// Lancement session : session déjà lancé sur le site principal ?
session_start();

//connexionbdd();

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/classique/design.css"  />
		
		<title>Polyjoule-Administration</title>
	</head>

	<body>
		<div id="entete">
	
			<div id="logo">
			</div>
			
			<div id="menuDeroulant">
				<ul>
					<li>
						<a href="#">Administration</a>
						<ul class="sousMenu">
							<li><a href="#">Panneau d'administration</a></li>
							<li><a href="#">Statistiques</a></li>
							<li><a href="#">Mon profil</a></li>
							<li><a href="#">Maintenance</a></li>
							<li><a style="color:red;" href="#">Déconnexion</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Menus</a>
						<ul class="sousMenu">
							<li><a href="#">Gestion des rubriques</a></li>
							<li><a href="#">Menu principal</a></li>
						</ul>
					</li>
					<li>
						<a href="#">Contenu</a>
						<ul class="sousMenu">
							<li><a href="#">Gestion des articles</a></li>
							<li><a href="#">Gestion des catégories</a></li>
							<li><a href="#">Articles en vedette</a></li>
							<li><a href="#">Gestion des médias</a></li>
						</ul>
					</li>
						<li>
						<a href="#">Aide</a>
						<ul class="sousMenu">
							<li><a href="#">Aide administration</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Liens utiles</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<div id='connexion'>
				<?php
					if(isset($_SESSION['id_membre']))
					{
						$requete="SELECT pseudo_membre FROM MEMBRE WHERE id_membre=".$_SESSION['id_membre'].";";
						$req = mysql_query($requete) or die(mysql_error());
						$res=mysql_fetch_array($req);
						echo $res[0];
						?>
						<a href="#">Se déconnecter</a>
					<?php
					}
					else
					{
					?>
					<form name="connexion" method="post" action="">
						<p style="margin:2px;padding:0;">
							<input type="text" style="width:80px;vertical-align:middle;" onclick="this.value='';" value="Pseudo" id="login" name="pseudo"/>
							<input type="password" style="width:80px;vertical-align:middle;" onclick="this.value='';" value="passwd" name="mdp"/>
							<input type="submit" value="Login"/>
						</p>
					</form>
					<?php
					}
				?>
			</div>
		</div>
		<?php
		// Inclusion de la page demandée (page d'accueil si aucune) ==> Il faut ajouter une sécurité avec la liste des fichiers qui peuvent être inclus
		// Faire du rewriting sur ces adresses
		if (!empty($_GET['page']) && is_file('controleurs/'.$_GET['page'].'.co.php'))
		{
				include ('controleurs/'.$_GET['page'].'.co.php');

		}
		else
		{
				include ('controleurs/accueil.co.php');

		}

		?>
	</body>
</html>

<?php
// Fermeture session
//mysql_close();
