<?php
function printModif()
{
	if (!$fp = fopen("listeModif.txt","r"))
	{
		echo "Echec de l'ouverture du fichier";
		exit;
	}
	else
	{
		$i=0;
		$toReturn="<ul>";
		while(!feof($fp) && $i<10)
		{
			$line = fgets($fp,255);
			$toReturn .= "<li>".$line."</li>";
			$i++;
		}
		fclose($fp);
		$toReturn.="</ul>";
		return $toReturn;
	}
}
?>