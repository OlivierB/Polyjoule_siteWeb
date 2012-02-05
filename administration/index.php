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
include("modeles/variablesGlobales.php");

// Lancement session : session déjà lancé sur le site principal ?
session_start();
connexionbdd();
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" media="screen" type="text/css" title="design" href="ressources/design/style1/design.css"  />
		<!-- Inclusion de tinyMCE et paramètrage -->
		<script type="text/JavaScript" src="ressources/autres/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
		<script type="text/JavaScript" src="modeles/functions.js"></script>
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
	<?php
	if(isset($_SESSION['id_membre'])) // Si le membre est connecté on affiche l'accueil du site
	{
	?>
		<div id="entete">
		</div>
		<div id="menu">	
			<div id="menuDeroulant">
				<ul>
					<li>
						<a class="Menu" href="index.php">ADMINISTRATION</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="#">Panneau d'administration</a></li>
							<li><a href="#">Statistiques</a></li>
							<li><a href="index.php?page=profil">Mon profil</a></li>
							<li><a href="#">Maintenance</a></li>
							<li><a href="index.php?page=gestionComptes">Gestion des comptes</a></li>
							<li><a href="index.php?page=deconnexion">Déconnexion</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="#"  >MENUS</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php?page=rubrique">Gestion des rubriques</a></li>
							<li><a href="#">Menu principal</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
					<li>
						<a href="#"  >CONTENU</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="index.php?page=article">Gestion des articles</a></li>
							<li><a href="#">Gestion des catégories</a></li>
							<li><a href="#">Articles en vedette</a></li>
							<li><a href="#">Gestion des médias</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
						<li>
						<a href="#"  >AIDE</a>
						<ul class="sousMenu"  >
							<div class="menuH"></div>
							<li><a href="#">Aide administration</a></li>
							<li><a href="#">Contact</a></li>
							<li><a href="#">Liens utiles</a></li>
							<div class="menuB"></div>
						</ul>
					</li>
				</ul>
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
		<div class="contenuB"></div>
		<?php
	}else{
		include('controleurs/connexion.co.php');
	}
	?>
	<footer>
		Copyright &copy; Polyjoule 2012 - Tous droits réservés.
	</footer>
	</body>
</html>

<?php
// Fermeture session
//mysql_close();
