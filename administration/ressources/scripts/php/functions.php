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
?>
