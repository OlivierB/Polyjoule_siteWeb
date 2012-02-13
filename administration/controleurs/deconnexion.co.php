<!-- // fichier de gestion de la deconnexion


traitements

-->

<?php
	// destruction des variables
	vidersession();
	// renvoyer vers la page pricipale
	// -> la redirection vers connection se fera automatiquement
	header('Location: index.php');
?>
