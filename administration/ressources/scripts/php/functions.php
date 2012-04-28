<?php

/* sécuriser les entrée pour éviter les injections */
function securite($string)
{
	if(ctype_digit($string))
	{	// On regarde si le type de string est un nombre entier (int)
		$string = intval($string);
	}
	else
	{	// Pour tous les autres types
		$string = mysql_real_escape_string($string);
		$string = addcslashes($string, '%_');
	}
	return $string;
}

/*Vide la session*/
function vidersession()
{
	foreach($_SESSION as $cle => $element)
	{
		unset($_SESSION[$cle]);
	}
}

function create_title_bar($title, $icone)
{
	$barre ="
		<div class='barre_titre'>
			<div style='float:left'>
				<img src='".$_SESSION['design_path']."/images/".$icone."' alt='icone_titre'/>
			</div>
			<div style='float:left; margin-top:10px; margin-left:20px;position:relative;z-index:0;'>".$title."
			</div>
		</div> <div style='height:40px;'></div>";
	
	return $barre;
}

function create_information($string)
{
	return "<div class='info'>
				<img src='".$_SESSION['design_path']."/images/info.png' />
				<div class='message'>"
					.$string.
				"</div>
			</div>";
}
				
function verify_picture($pict, $size_max)
{
	$ListeExtension = array('jpg' => 'image/jpg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
	$ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg');
	
	if (!empty($pict))
	{
		if ($pict['error'] <= 0)
		{
			if ($pict['size'] <= $size_max)
			{
				$ext = explode('.', $pict['name']);
				$ext = strtolower($ext[count($ext)-1]);
				if( in_array('image/'.$ext,$ListeExtension) || in_array('image/'.$ext,$ListeExtensionIE))
				{
					return "";
				}
				else
					return "Mauvais format d'image.";
			}
			else
				return "Taille de l'image trop élevée";
		}
		else
			return "Erreur lors du transfert de l'image.";
	}
	else
		return "Erreur lors du transfert de l'image.";
}


function delete_file($directory, $file_name)
{
	$dir = opendir ($directory);
	if(file_exists($directory."/".$file_name))
		unlink($directory."/".$file_name);	
	closedir ($dir);
}



function uploadImg (&$infos, $file, $directory, $maxSize, $extensions, $maxPixel)
{
// récupération des informations sur le fichier
	$fichier = basename($file['name']);
	$taille = filesize($file['tmp_name']);
	$extension = strtolower(strrchr($file['name'], '.'));
	$directory = $directory."";
// variables
	$retour = "";
	$mini = 1;	// pour vérifier si on peut creer une miniature
	
// Vérifications de base
	if(!in_array($extension, $extensions)) 
	{
		$infos->addError("Type de fichier non accepté !");
	} else if($taille>$maxSize)
	{
		$infos->addError("Le fichier a une taille trop importante !");
	} else 
	{
	// Création du nom de l'image (miniature ET taille réelle)
		$newName = time();
		
		$fileMaxi = $newName.$extension;
		$fileMini = $newName.'_'.$extension;
		
		// UPLOAD DE L'IMAGE
		if(move_uploaded_file($file['tmp_name'], $directory . $fileMaxi)) 
		{
			$infos->addSucces("Upload effectué avec succès !");
			$retour = $fileMini;
			
		// CREATION DE LA MINIATURE
			// chargement de la surface selon le type d'image
			switch ( $extension ) {
				case ".jpg":
				case ".jpeg":
					$img_src_resource = imagecreatefromjpeg( $directory . $fileMaxi );
					break;

				case ".png":
					$img_src_resource = imagecreatefrompng( $directory . $fileMaxi );
					break;

				default:
					$mini = 0;
					break;
			}
			
			if ($mini == 1)
			{ // creation de la mini
				
				// calcul de la taille pour le respect des proportions
				$TailleImageChoisie = getimagesize($directory . $fileMaxi);
				$largeur = $TailleImageChoisie[0];
				$hauteur = $TailleImageChoisie[1];
				
				if ($largeur > $hauteur)
				{
					$NouvelleLargeur = $maxPixel;
					$NouvelleHauteur = $hauteur * $maxPixel / $largeur;
				} else if ($largeur < $hauteur)
				{
					$NouvelleLargeur = $largeur * $maxPixel / $hauteur;
					$NouvelleHauteur = $maxPixel;
				} else
				{
					$NouvelleLargeur = $maxPixel;
					$NouvelleHauteur = $maxPixel;
				}
				
				// création d'une nouyvelle surface
				$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
				// remplissage de la surface
				imagecopyresampled($NouvelleImage , $img_src_resource  , 0,0, 0,0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
				// liberation de la memoire
				imagedestroy($img_src_resource);
				
				// enregistrement de l'image
				switch ( $extension ) {
					case ".jpg":
					case ".jpeg":
						imagejpeg( $NouvelleImage , $directory.$fileMini );
						break;

					case ".png":
						imagepng( $NouvelleImage , $directory.$fileMini );
						break;

					default:
						$mini = 0;
						break;
				}
				
				// nom du fichier
				$retour = $fileMini;
			} else
			{ // pas de cration de mini possible -> on envoie l'image taille réelle.
				$infos->addError("Pas de création de miniature possible !");
				$retour = $fileMaxi; // nom du fichier
			}
			
		}
		else 
		{
			$infos->addError("Echec de l'upload !");
		}
	}
	
	return $retour;
}


function uploadFile (&$infos, $file, $directory, $maxSize, $extensions)
{
	
	$fichier = basename($file['name']);
	$taille = filesize($file['tmp_name']);
	$extension = strtolower(strrchr($file['name'], '.'));
	
	$retour = "";
	
	if(!in_array($extension, $extensions)) 
	{
		$infos->addError("Type de fichier non accepté !");
	}
	if($taille>$maxSize)
	{
		$infos->addError("Le fichier a une taille trop importante !");
	}
	if(!isset($erreur)) 
	{
		$newName = time();
		/*$fichier = strtr($fichier, 
		  'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
		  'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		$fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);*/
		
		$fileMaxi = $newName.$extension;
		
		
		if(move_uploaded_file($file['tmp_name'], $directory . $fileMaxi)) 
		{
			$infos->addSucces("Upload effectué avec succès !");
			
			$retour = $fileMaxi;
		}
		else 
		{
			$infos->addError("Echec de l'upload !");
		}
	}
	
	return $retour;

}


function save_picture($file, $dest)
{
	$fichier = basename($file['name']);
	$taille = filesize($file['tmp_name']);
	$ext = strtolower(strrchr($file['name'], '.'));
	
	$newName = time();
	$fileMaxi = $newName.$ext;
	
	if(!move_uploaded_file($file['tmp_name'], $dest.$fileMaxi)) 
	{
		$infos->addError("Echec de l'upload !");
	}
	
	return $fileMaxi;
}


// Classe pour gérer les erreurs

class Informations
{

	private $errors;
	private $succes;

	public function __construct()
	{
		$this->errors = array();
		$this->succes = array();
	}
	
	public function addError	($error)
	{
		$this->errors[] = $error;
	}
	
	public function addSucces	($succes)
	{
		$this->succes[] = $succes;
	}
	
	public function reset		()
	{
		unset($this->succes);
		unset($this->errors);
	}
	
	public function printInfos	()
	{
		if (!empty($this->succes)) 
		{
			echo '<ul id="succes">';
			foreach($this->succes as $cle) 
			{
				echo '<li>'.$cle.'</li>';
			}
			echo "</ul>";
		}
		if (!empty($this->errors)) 
		{
			echo '<ul id="errors">';
			foreach($this->errors as $cle) 
			{
				echo '<li>'.$cle.'</li>';
			}
			echo "</ul>";
		}
	}
}

// ecrire une date 
function formatDateJ($date) 
{
	return $date->format('Y-m-d');
}
// ecrire une date et l'heure
function formatDateJH($date) 
{
	return $date->format('Y-m-d H:i:s');
}

// ecrire une date et l'heure
function formatDate($date) 
{
	return $date->format('Y-m-d');
}

function coupeChaine($text, $max) 
{
	if (strlen($text) >= $max) {
		//$text = ereg_replace("<[^>]*>", "", $text); BUG !!!
		$text = substr($text, 0, $max);
		$positionEspace = strrpos($text, " ");
		$text = substr($text, 0, $positionEspace)."...";
	}
	return $text;
}

function formatString ($fichier)
{
	//On formate le nom du fichier
     $fichier = strtr($fichier, 
          'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
          'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
     $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
	return $fichier;
}


// ensure $dir ends with a slash 
function delTree($dir) { 
    $files = glob( $dir . '*', GLOB_MARK ); 
    foreach( $files as $file ){ 
        if( substr( $file, -1 ) == '/' ) 
            delTree( $file ); 
        else 
            unlink( $file ); 
    } 
    if (is_dir($dir)) rmdir( $dir );
} 


?>
