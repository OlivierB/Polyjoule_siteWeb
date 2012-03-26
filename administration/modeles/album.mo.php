<!--
/*****************************
|    Partie Administration	 |
|        du site web 		 |
|         Polyjoule		     |
*****************************/
*
* Gestion des requetes de la
* page de gestion des formations
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


function updateAlbum($id, $nom) {
	$req="UPDATE ALBUM SET nom_album='$nom' WHERE id_album='$id'";
	mysql_query($req) or die(mysql_error());
}


function deleteAlbum($id) {
	$req="DELETE FROM ALBUM WHERE id_album='$id'";
	mysql_query($req) or die(mysql_error());
}


function addAlbum($nom) {
	$today = date('Y-m-d');
 	$req="INSERT INTO ALBUM VALUES (NULL,'".$nom."', '".$today."');";
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


function deletePhoto($id) {
	$req="DELETE FROM PHOTO WHERE id_photo='$id'";
	mysql_query($req) or die(mysql_error());
}


function updatePhoto($id, $tfr, $ten) {
	$req="UPDATE SET PHOTO titreFR_photo='".$tfr."' titreEN_photo='".$ten."' titreEN_photo='".$ten."' WHERE id_photo='$id'";
	mysql_query($req) or die(mysql_error());
}

function addPhoto($idAlbum, $nfr, $nen, $nomfichier) {
	$today = date('Y-m-d');
 	$req="INSERT INTO PHOTO VALUES (NULL, '".$idAlbum."', '".$nfr."', '".$nen."', '".$nomfichier."', '".$today."');";
	mysql_query($req) or die(mysql_error());
}




?>
