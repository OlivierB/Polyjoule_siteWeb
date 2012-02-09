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

function create_title_bar( $title, $icone)
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
			
?>