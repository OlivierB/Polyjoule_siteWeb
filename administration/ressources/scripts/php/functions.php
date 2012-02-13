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
				<img src='".$icone."' alt='icone_titre'>
			</div>
			<div style='float:left; margin-top:10px; margin-left:20px;'>".$title."
			</div>
		</div> <div style='height:40px;'></div>";
	
	return $barre;
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
	$date = date('d - m - Y', $date);
	return $date;
}
// ecrire une date et l'heure
function formatDateJH($date) 
{
	$date = date('d/m/y H:i:s', $date);
	return $date;
}

// ecrire une date et l'heure
function formatDate($date) 
{
	$positionEspace = stripos($date, " ");
	$date 			= substr($date, 0, $positionEspace);
	
	return $date;
}

function coupeChaine($text, $max) 
{
	if (strlen($text) >= $max) {
		$text = ereg_replace("<[^>]*>", "", $text);
		$text = substr($text, 0, $max);
		$positionEspace = strrpos($text, " ");
		$text = substr($text, 0, $positionEspace)."...";
	}
	return $text;
}




?>
