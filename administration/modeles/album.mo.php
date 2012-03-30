<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion de l'album
*
-->

<?php

function countAlbum(){
	$req = mysql_query("SELECT count(*) FROM ALBUM;");
	$count = mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}


function countPhotoInAlbum($id){
	$req = mysql_query("SELECT count(*) FROM PHOTO WHERE id_album='".$id."';");
	$count = mysql_fetch_array($req);
	mysql_free_result($req);
	return $count[0];
}


function getListAlbum() {
	$listAlbum = array();

	$req = mysql_query("SELECT * FROM ALBUM ORDER BY date_album DESC");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listAlbum[] = $donnees;
	}

	mysql_free_result($req);
	
	return $listAlbum;
}


function addAlbum($nom) {
	$today = date('Y-m-d H:i:s'); //date('Y-m-d');
 	$req="INSERT INTO ALBUM VALUES (NULL,'".$nom."', '".$today."', ' ', '');";
	mysql_query($req) or die(mysql_error());
}


function updateAlbum($id, $nom) {
	$req="UPDATE ALBUM SET nom_album='$nom' WHERE id_album='$id'";
	mysql_query($req) or die(mysql_error());
}


function deleteAlbum($id) {
	$req="DELETE FROM ALBUM WHERE id_album='$id'";
	mysql_query($req) or die(mysql_error());
	
	$req="DELETE FROM PHOTO WHERE id_album='$id'";
	mysql_query($req) or die(mysql_error());
}





function getListPhoto($id) {
	$listPhoto = array();

	$req = mysql_query("SELECT * FROM PHOTO WHERE id_album='".$id."' ORDER BY date_photo DESC;");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listPhoto[] = $donnees;
	}

	mysql_free_result($req);
	
	return $listPhoto;
}


function addPhoto($idAlbum, $nfr, $nen, $nomfichier, $destFR, $destEN) {
	$today = date('Y-m-d H:i:s');
 	$req="INSERT INTO PHOTO VALUES (NULL, '".$idAlbum."', '".$nfr."', '".$nen."', '".$nomfichier."', '".$today."', '".$destFR."', '".$destEN."');";
	mysql_query($req) or die(mysql_error());
}


function updatePhoto($id, $tfr, $ten, $dfr, $den) {
	$req="UPDATE PHOTO SET titreFR_photo='$tfr', titreEN_photo='$ten', descFR_photo='$dfr',  descEN_photo='$den' WHERE id_photo='$id'";
	mysql_query($req) or die(mysql_error());
}


function deletePhoto($id) {
	$req="DELETE FROM PHOTO WHERE id_photo='$id'";
	mysql_query($req) or die(mysql_error());
}


function getNameAlbum ($id)
{
	$listAlbum = array();
	$Album = "";
	$req = mysql_query("SELECT nom_album FROM ALBUM WHERE id_album='".$id."';");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listAlbum[] = $donnees;
	}

	mysql_free_result($req);
	
	foreach ($listAlbum as $val)
		$Album = $val['nom_album'];
	
	return $Album;
}

function getLinkPhoto ($id)
{
	$listPhoto = array();
	$Photo = "";
	$req = mysql_query("SELECT lien_photo FROM PHOTO WHERE id_photo='".$id."';");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listPhoto[] = $donnees;
	}

	mysql_free_result($req);
	
	foreach ($listPhoto as $val)
		$Photo = $val['lien_photo'];
	
	return $Photo;
}

function getInfoPhoto ($id)
{
	$listPhoto = array();
	$req = mysql_query("SELECT * FROM PHOTO WHERE id_photo='".$id."';");

	while ($donnees = mysql_fetch_assoc($req)) {
		$listPhoto[] = $donnees;
	}

	mysql_free_result($req);

	if (!empty ($listPhoto))
		return $listPhoto[0];
	else
		return Array ("titreFR_photo" => "titreFR", "titreEN_photo" => "titreEN", "descFR_photo" => "description FR", "descEN_photo" => "description EN",);
}



function multipleName ($nom)
{
	$nomSvg = $nom;
	$i = 0;
	do{
		if ($i != 0)
			$nom = $nomSvg."_".$i;
		$req = mysql_query("SELECT count(*) FROM ALBUM WHERE nom_album='".$nom."';");
		$count = mysql_fetch_array($req);
		mysql_free_result($req);	
		$i++;
	} while ($count[0] != 0);

	return $nom;
}



?>
