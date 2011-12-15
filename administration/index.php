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
connexionbdd();

?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/classique/design.css"  />
		<!-- Inclusion de tinyMCE et paramètrage -->
		<script type="text/JavaScript" src="ressources/autres/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/javascript">
			tinyMCE.init({
				// General options
				mode : "textareas",
				theme : "advanced",
				plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

				// Theme options
				theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
				theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
				theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
				theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
				theme_advanced_toolbar_location : "top",
				theme_advanced_toolbar_align : "left",
				theme_advanced_statusbar_location : "bottom",
				theme_advanced_resizing : false,

				// Drop lists for link/image/media/template dialogs
				template_external_list_url : "editor/editor/lists/template_list.js",
				external_link_list_url : "editor/editor/lists/link_list.js",
				external_image_list_url : "editor/editor/lists/image_list.js",
				media_external_list_url : "editor/editor/lists/media_list.js",

				// Replace values for the template plugin
				template_replace_values : {
				username : "Some User",
				staffid : "991234"
				}
			});
		</script>
		<!-- Fin tinyMCE -->
		<title>Polyjoule-Administration</title>
	</head>

	<body>

		<div id="entete">
	
			<div id="logo">
			</div>
			
			<div id="menuDeroulant">
				<ul>
					<li>
						<a href="index.php">Administration</a>
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
							<li><a href="index.php?page=article">Gestion des articles</a></li>
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
