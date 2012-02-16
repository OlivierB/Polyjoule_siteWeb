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
				<img src='".$_SESSION['design_path']."/images/".$icone."' alt='icone_titre'>
			</div>
			<div style='float:left; margin-top:10px; margin-left:20px;'>".$title."
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
	unlink($directory."/".$file_name);	
	closedir ($dir);
}

function save_picture($pict, $width, $height, $dest, $pict_name)
{
	$ext = explode('.', $pict['name']);
	$ext = strtolower($ext[count($ext)-1]);
	
	$img_dest = imagecreatetruecolor($width , $height);
	$fond_noir = imagecolorallocate($img_dest, 0, 0, 0);
	$taille = getimagesize($pict['tmp_name']);
	
	switch ($ext)
	{
		case "jpg":
		case "jpeg": //pour le cas où l'extension est "jpeg"
			$img_src = imagecreatefromjpeg( $pict['tmp_name']);
			imagecopyresampled($img_dest , $img_src, 0, 0, 0, 0, $width, $height, $taille[0], $taille[1]);
			imagejpeg($img_dest , $dest.$pict_name.'.'.$ext, 100);
			break;

		case "gif":
			$img_src = imagecreatefromgif( $pict['tmp_name'] );
			imagecopyresampled($img_dest , $img_src, 0, 0, 0, 0, $width, $height, $taille[0], $taille[1]);
			imagegif($img_dest , $dest.$pict_name.'.'.$ext);
			break;

		case "png":
			$img_src = imagecreatefrompng( $pict['tmp_name'] );
			imagecolortransparent($img_dest, $fond_noir);
			imagecopyresampled($img_dest , $img_src, 0, 0, 0, 0, $width, $height, $taille[0], $taille[1]);
			imagepng($img_dest , $dest.$pict_name.'.'.$ext, 0, PNG_ALL_FILTERS);
			break;
	}

	imagedestroy($img_src);
	imagedestroy($img_dest);
	return $dest.$pict_name.'.'.$ext;

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

?>
